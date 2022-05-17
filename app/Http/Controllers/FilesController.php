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
        // $imageName = Str::random(10) . '.' . $extension;
        $imageName = Str::random(10) . $request->input('extension');
        // Storage::disk('public')->put($imageName, base64_decode($image));
        Storage::disk('myDisk')->put($imageName, base64_decode($image));

        if (!$request->input('description')) {
            $description = '';
        } else {
            $description = $request->input('description');
        }

        $file = [
            'title' => $request->input('title') . $request->input('extension'),
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

    public function show(Request $request, $id)
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
            'divisions.name as division',
        )
            ->leftJoin('users', 'users.id', '=', 'files.owner');
        // ->leftJoin('divisions', 'divisions.id', '=', 'files.division');
        // ->where('divisions.id', '=', 'files.division');

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
        $colname = ['title', 'divisions.name', 'files.from', 'files.updated_at', 'description', 'download', 'path', 'from'];
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
        $result = Files::latest()->take(5)->get();
        return response($result, Response::HTTP_OK);
    }

    public function mostDownloaded(Request $request)
    {
        $result = Files::orderBy('download', 'desc')
            ->take(5)->get();
        return response($result, Response::HTTP_OK);
    }

    public function update(Request $request, Files $files, $id)
    {
        if (!$request->expectsJson()) {
            return response(null, Response::HTTP_BAD_REQUEST);
        }

        $user = Auth::user();


        $target = Files::where('id', '=', $id);


        if ($request->input('file')) {
            Storage::disk('myDisk')->delete($target->first()->path);
            $file_64 = $request->input('file'); //your base64 encoded data
            $extension = explode('/', explode(':', substr($file_64, 0, strpos($file_64, ';')))[1])[1];   // .jpg .png .pdf
            $replace = substr($file_64, 0, strpos($file_64, ',') + 1);
            // find substring fro replace here eg: data:image/png;base64,
            $image = str_replace($replace, '', $file_64);
            $image = str_replace(' ', '+', $image);
            // $imageName = Str::random(10) . '.' . $extension;
            $imageName = Str::random(10) . $request->input('extension');
            // Storage::disk('public')->put($imageName, base64_decode($image));
            Storage::disk('myDisk')->put($imageName, base64_decode($image));
        } else {
            $imageName = null;
        }

        if (!$request->input('description')) {
            $description = '';
        } else {
            $description = $request->input('description');
        }


        $file = [
            'title' => $request->input('title') . $request->input('extension'),
            'description' => $description,
            'from' => $request->input('from'),
            'to' => $request->input('to'),
            'owner' => $user->id,
            'division' => $user->division,
        ];

        $target->update($file);
        if ($imageName) {
            $target->update(['path' => $imageName]);
        }

        // return response($target, Response::HTTP_CREATED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Files  $files
     * @return \Illuminate\Http\Response
     */
    public function destroy(Files $files, $id)
    {
        Files::find($id)->delete();
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
