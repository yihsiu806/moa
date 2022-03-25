<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use App\Models\Files;

class DownloadFilesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function increaseDownloadCounter($file)
    {
        try {
            $target = Files::where('path', '=', $file)->first();
            $target->download = $target->download + 1;
            $target->save();
        } catch (Exception $e) {
        }
    }

    public function returnFile($file)
    {
        //This method will look for the file and get it from drive
        $path = storage_path('app/uploads/' . $file);

        try {
            $result = File::get($path);
            $type = File::mimeType($path);
            $response = Response::make($result, 200);
            $response->header("Content-Type", $type);
            $this->increaseDownloadCounter($file);
            return $response;
        } catch (FileNotFoundException $exception) {
            abort(404);
        }
    }

    public function licenceFileShow($file)
    {
        if (strpos($file, '.') !== false) {
            return $this->returnFile($file);
        } else {
            //Invalid file name given
            return abort(404);
        }
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
