<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Division;
use App\Models\Files;
use App\Models\Officer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DivisionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:division');
    }

    public function index()
    {
        $divisions = Division::select('name')
            ->orderBy('id', 'desc')
            ->get();
        $data = [
            'divisions' => $divisions,
        ];
        return view('division', $data);
    }

    public function getFiles($slug)
    {
    }

    public function myupload()
    {
    }

    public function saveEditDivision(Request $request)
    {
        if (!$request->expectsJson()) {
            return response(null, Response::HTTP_BAD_REQUEST);
        }

        $user = Auth::user();

        if (str_contains($request->input('picture'), 'data:image')) {
            $image_64 = $request->input('picture'); //your base64 encoded data
            $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];   // .jpg .png .pdf
            $replace = substr($image_64, 0, strpos($image_64, ',') + 1);
            // find substring fro replace here eg: data:image/png;base64,
            $image = str_replace($replace, '', $image_64);
            $image = str_replace(' ', '+', $image);
            $imageName = Str::random(10) . '.' . $extension;
            Storage::disk('public')->put($imageName, base64_decode($image));
        } else {
            $imageName = $request->input('picture');
        }

        $division = Division::find($user->division);
        $division->name = $request->input('divisionName');
        $division->slug = $request->input('divisionSlug');
        $division->icon = $request->input('icon');
        $division->picture = $imageName;

        $division->save();

        $officer = new Officer;

        if (str_contains($request->input('officerPicture'), 'data:image')) {
            $image_64 = $request->input('officerPicture'); //your base64 encoded data
            $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];   // .jpg .png .pdf
            $replace = substr($image_64, 0, strpos($image_64, ',') + 1);
            // find substring fro replace here eg: data:image/png;base64,
            $image = str_replace($replace, '', $image_64);
            $image = str_replace(' ', '+', $image);
            $imageName = Str::random(10) . '.' . $extension;
            Storage::disk('public')->put($imageName, base64_decode($image));
        } else {
            $imageName = $request->input('officerPicture');
        }

        if (Officer::where('division', $user->division)->exists()) {
            $officer = Officer::where('division', $user->division)->first();
        } else {
            $officer->division = $user->division;
        }
        $officer->name = $request->input('officerName');
        $officer->position = $request->input('officerPosition');
        $officer->telephone = $request->input('officerTelephone');
        $officer->email = $request->input('officerEmail');
        $officer->picture = $imageName;
        $officer->save();
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
