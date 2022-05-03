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
    }

    public function index()
    {
        return view('division');
    }

    public function deleteDivision(Request $request)
    {
        $this->write_log($request->input('id'));
        $deleted = DB::table('divisions')->where('id', '=', $request->input('id'))->delete();
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
        } else if ($request->input('picture') == 'reset') {
            $imageName = 'reset';
        } else {
            $imageName = null;
        }

        // if (str_contains($request->input('icon'), 'data:image/svg')) {
        //     $image_64 = $request->input('icon'); //your base64 encoded data
        //     $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];   // .jpg .png .pdf
        //     $replace = substr($image_64, 0, strpos($image_64, ',') + 1);
        //     // find substring fro replace here eg: data:image/png;base64,
        //     $image = str_replace($replace, '', $image_64);
        //     $image = str_replace(' ', '+', $image);
        //     $iconName = Str::random(10) . '.' . 'svg';
        //     Storage::disk('public')->put($iconName, base64_decode($image));
        // } else {
        //     $iconName = null;
        // }

        if ($request->input('icon')) {
            $iconName = $request->input('icon');
            $pattern = '/width\s*=\s*".*?"/m';
            $replacement = 'width="24"';
            $iconName = preg_replace($pattern, $replacement, $iconName);

            $pattern = '/height\s*=\s*".*?"/m';
            $replacement = 'height="24"';
            $iconName = preg_replace($pattern, $replacement, $iconName);

            $pattern = '/fill\s*=\s*".*?"/m';
            $replacement = ' ';
            $iconName = preg_replace($pattern, $replacement, $iconName);
        } else if ($request->input('icon') == 'reset') {
            $iconName = 'reset';
        } else {
            $iconName = null;
        }

        $division = null;
        if ($request->input('division')) {
            $division = Division::find($request->input('division'));
        }
        if (!$division) {
            $division = new Division;
            $slug = $request->input('divisionName');
            $slug = substr($slug, 0, 5);
            $count = 1;
            while (Division::where('slug', '=', $slug . '-' . $count)->exists()) {
                $count++;
            }
            $slug = $slug . '-' . $count;
            $division->slug = $slug;
        }
        $division->name = $request->input('divisionName');
        if ($iconName == 'reset') {
            $division->icon = null;
        } else if ($iconName) {
            $division->icon = $iconName;
        }
        if ($imageName == 'reset') {
            $division->picture = null;
        } else if ($imageName) {
            $division->picture = $imageName;
        }
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
        } else if ($request->input('officerPicture') == 'reset') {
            $imageName = 'reset';
        } else {
            $imageName = null;
        }

        if ($request->input('division')) {
            $divisionId = $request->input('division');
        } else {
            $divisionId = $division->id;
        }

        if (Officer::where('division', $divisionId)->exists()) {
            $officer = Officer::where('division', $divisionId)->first();
        } else {
            $officer->division = $divisionId;
        }

        $officer->name = $request->input('officerName');
        $officer->position = $request->input('officerPosition');
        $officer->telephone = $request->input('officerTelephone');
        $officer->email = $request->input('officerEmail');
        if ($imageName == 'reset') {
            $officer->picture = null;
        } else if ($imageName) {
            $officer->picture = $imageName;
        }
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
