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
        $this->middleware('role:division');
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
        if (!$request->expectsJson()) {
            return response(null, Response::HTTP_BAD_REQUEST);
        }

        $this->write_log('store aaa');

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

        $this->write_log('aaa');
        $file = [
            'title' => $request->input('title'),
            'description' => $description,
            'path' => $imageName,
            'from' => $request->input('from'),
            'to' => $request->input('to'),
            'owner' => $user->id,
            'division' => $user->division,
        ];
        $this->write_log('bbb');

        $result = Files::create($file);

        $result = $result->refresh();
        return response($result, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Files  $files
     * @return \Illuminate\Http\Response
     */
    public function show(Files $files)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Files  $files
     * @return \Illuminate\Http\Response
     */
    public function edit(Files $files)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Files  $files
     * @return \Illuminate\Http\Response
     */
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
