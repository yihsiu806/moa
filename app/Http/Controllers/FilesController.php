<?php

namespace App\Http\Controllers;

use App\Models\Files;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class FilesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        if (!$request->expectsJson()) {
            return response(null, Response::HTTP_BAD_REQUEST);
        }

        $user = Auth::user();

        $file_64 = $request->input('file'); //your base64 encoded data
        $extension = explode('/', explode(':', substr($file_64, 0, strpos($file_64, ';')))[1])[1];   // .jpg .png .pdf
        $replace = substr($file_64, 0, strpos($file_64, ',') + 1);
        // find substring fro replace here eg: data:image/png;base64,
        $image = str_replace($replace, '', $file_64);
        $image = str_replace(' ', '+', $image);
        $imageName = Str::random(10) . '.' . $extension;
        // Storage::disk('public')->put($imageName, base64_decode($image));
        Storage::disk('myDisk')->put($imageName, base64_decode($image));

        if (!$request->input('description')) {
            $description = '';
        } else {
            $description = $request->input('description');
        }

        $file = [
            'title' => $request->input('title'),
            'description' => $description,
            'path' => $imageName,
            'from' => $request->input('from'),
            'to' => $request->input('to'),
            'owner' => $user->id,
            'division' => $user->division,
        ];

        $result = Files::create($file);

        $result = $result->refresh();
        return response($result, Response::HTTP_CREATED);
    }

    public function show(Request $request)
    {
        $query = Files::select(
            'files.id as DT_RowId',
            'files.title',
            'files.description',
            'files.from',
            'files.to',
            DB::raw("CONCAT(files.from, ' ~ ', files.to) as duration"),
            'files.download',
            'files.path',
            'files.updated_at',
            'users.username as owner',
            DB::raw('divisions.name as division'),
            'divisions.name as division',
        )
            ->leftJoin('users', 'users.id', '=', 'files.owner')
            ->leftJoin('divisions', 'divisions.id', '=', 'files.division');

        // search
        $columns = $request->input('columns');
        if ($request->has('search') && $request->input('search')['value'] != '') {
            $str = $request->input('search')['value'];
            $where = '';

            for ($i = 0, $ien = count($columns); $i < $ien; $i++) {
                $name = $columns[$i]['data'];

                if ($columns[$i]['searchable'] == 'true') {
                    if ($where == '') {
                        $where = $name . ' like "%' . $str . '%"';
                    } else if ($i == 5) {
                        $where = $where . ' or "from" like "%' . $str . '%"';
                        $where = $where . ' or "to" like "%' . $str . '%"';
                    } else if ($i == 1) {
                        $where = $where . ' or "divisions.name" like "%' . $str . '%"';
                    } else if ($i == 2) {
                        $where = $where . ' or "files.updated_at" like "%' . $str . '%"';
                    } else {
                        $where = $where . ' or ' . $name . ' like "%' . $str . '%"';
                    }
                }
            }

            $query = $query->whereRaw($where);
        }

        // order
        $colname = ['title', 'description', 'from', 'divisions.name', 'download', 'path', 'files.updated_at'];
        if ($request->has('order') && count($request->input('order'))) {
            $order = $request->input('order');
            for ($i = 0, $ien = count($order); $i < $ien; $i++) {
                $query = $query->orderBy($colname[$order[$i]['column']], $order[$i]['dir']);
            }
        }

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
            'recordsTotal' => Files::count(),
            'recordsFiltered' => Files::count(),
            'data' => $query,
        ];

        return response($result, Response::HTTP_OK);
    }

    public function newest(Request $request)
    {
        $result = Files::latest()->take(5)->get();
        return response($result, Response::HTTP_OK);
    }

    public function mostDownloaded(Request $request)
    {
        $result = Files::orderBy('download', 'desc')
            ->take(5)->get();
        return response($result, Response::HTTP_OK);
    }

    public function update(Request $request, Files $files)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Files  $files
     * @return \Illuminate\Http\Response
     */
    public function destroy(Files $files)
    {
        //
    }

    public function write_log($log_msg)
    {
        $log_filename = "/home/yihsiu/logs";
        if (!file_exists($log_filename)) {
            mkdir($log_filename, 0777, true);
        }
        $log_file_data = $log_filename . '/debug.log';
        file_put_contents($log_file_data, $log_msg . "\n", FILE_APPEND);
    }
}
