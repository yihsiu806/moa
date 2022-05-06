<?php

namespace App\Http\Controllers;

use App\Models\Files;
use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PublicFileController extends Controller
{
    public function show(Request $request, $id)
    {
        $query = Files::select(
            'files.title',
            'files.description',
            'files.from',
            'files.to',
            DB::raw("CONCAT(files.from, ' ~ ', files.to) as duration"),
            'files.download',
            'files.updated_at',
            'users.username as owner',
            'divisions.name as division',
        )
            ->leftJoin('users', 'users.id', '=', 'files.owner');

        $targetDivision = null;

        $allDivisionId = Division::select('id')->get();
        foreach ($allDivisionId as $divisionId) {
            if ($id == $divisionId->id) {
                $targetDivision = $id;
                break;
            }
        }
        if ($targetDivision) {
            $query = $query->join('divisions', function ($join) use ($id) {
                $join->on('files.division', '=', 'divisions.id')
                    ->where('divisions.id', '=', $id);
            });
        } else {
            $query = $query->leftJoin('divisions', 'divisions.id', '=', 'files.division');
        }

        // search
        if ($request->has('search') && $request->input('search')['value'] != '') {
            $str = $request->input('search')['value'];

            $query = $query->where('files.updated_at', 'like', '%' . $str . '%');
            $query = $query->orWhere('files.title', 'like', '%' . $str . '%');
            $query = $query->orWhere('files.description', 'like', '%' . $str . '%');
            $query = $query->orWhere('files.from', 'like', '%' . $str . '%');
            $query = $query->orWhere('files.to', 'like', '%' . $str . '%');
            $query = $query->orWhere('divisions.name', 'like', '%' . $str . '%');
        }

        // order
        $colname = ['title', 'divisions.name', 'files.from', 'files.updated_at', 'description', 'download'];
        if ($request->has('order') && count($request->input('order'))) {
            $order = $request->input('order');


            for ($i = 0, $ien = count($order); $i < $ien; $i++) {
                $query = $query->orderBy($colname[$order[$i]['column']], $order[$i]['dir']);
            }
        }

        $recordsTotal = $query->get()->count();
        $recordsFiltered = $query->get()->count();

        // limit
        if ($request->has('start') && $request->has('length')) {
            $start = intval($request->input('start'));
            $length = intval($request->input('length'));
            if ($length != -1) {
                $query = $query->offset($start)->limit($length);
            }
        }

        $query = $query->get();

        $result = [
            'draw' => $request->has('draw') ? intval($request->input('draw')) : 10,
            // 'recordsTotal' => Files::count(),
            // 'recordsFiltered' => Files::count(),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $query,
        ];

        return response($result, Response::HTTP_OK);
    }

    public function newest(Request $request)
    {
        $result = Files::select(
            'title',
            'description',
            'from',
            'to',
            DB::raw("CONCAT(files.from, ' ~ ', files.to) as duration"),
            'download',
            'updated_at'
        )->latest()->take(5)->get();
        return response($result, Response::HTTP_OK);
    }

    public function mostDownloaded(Request $request)
    {
        $result = Files::select(
            'title',
            'description',
            'from',
            'to',
            DB::raw("CONCAT(files.from, ' ~ ', files.to) as duration"),
            'download',
            'updated_at'
        )->orderBy('download', 'desc')
            ->take(5)->get();
        return response($result, Response::HTTP_OK);
    }
}
