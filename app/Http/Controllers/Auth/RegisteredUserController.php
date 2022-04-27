<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Symfony\Component\HttpFoundation\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        if (!$request->expectsJson()) {
            return response(null, Response::HTTP_BAD_REQUEST);
        }

        $query = User::where('username', '=', $request->input('username'))->first();
        if ($query) {
            return response(['message' => 'Username already taken.'], Response::HTTP_BAD_REQUEST);
        }

        if (!preg_match("/^[a-zA-Z0-9_]+$/", $request->input('username'))) {
            return response(['message' => 'Username should only contain a-z A-Z 0-9 and underscore'], Response::HTTP_BAD_REQUEST);
        }

        $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'password' => ['required', Rules\Password::min(6)],
        ]);

        $user = User::create([
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
            'role' => $request->input('role'),
            'division' => $request->input('division'),
        ]);

        event(new Registered($user));
    }

    public function update(Request $request)
    {
        $query = User::where('username', '=', $request->input('username'))
            ->where('id', '!=', $request->input('id'))
            ->first();
        if ($query) {
            return response(['message' => 'Username already taken.'], Response::HTTP_BAD_REQUEST);
        }

        $request->validate([
            'username' => ['required', 'string', 'max:255'],
        ]);

        if (!preg_match("/^[a-zA-Z0-9_]+$/", $request->input('username'))) {
            return response(['message' => 'Username should only contain a-z A-Z 0-9 and underscore'], Response::HTTP_BAD_REQUEST);
        }

        $user = User::find($request->input('id'))->update([
            'username' => $request->input('username'),
            'role' => $request->input('role'),
            'division' => $request->input('division'),
        ]);
    }

    public function delete(Request $request)
    {
        $user = User::find($request->input('id'))->delete();
    }

    public function reset(Request $request)
    {
        $request->validate([
            'password' => ['required', Rules\Password::min(6)],
        ]);

        $user = User::find($request->input('id'))->update([
            'password' => Hash::make($request->input('password')),
        ]);
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'currentPassword' => ['required', Rules\Password::min(6)],
            'newPassword' => ['required', Rules\Password::min(6)],
            'confirmNewPassword' => ['required', Rules\Password::min(6)],
        ]);

        $check = Hash::check($request->input('currentPassword'), Auth::user()->password);
        if (!$check) {
            return response(['message' => 'Current password is not matching'], Response::HTTP_BAD_REQUEST);
        }

        if ($request->input('newPassword') != $request->input('confirmNewPassword')) {
            return response(['message' => 'New password is not match with confirm'], Response::HTTP_BAD_REQUEST);
        }

        $user = User::find(Auth::user()->id)->update([
            'password' => Hash::make($request->input('newPassword')),
        ]);

        Auth::logout();
    }

    function write_log($log_msg)
    {
        $log_filename = "/home/yihsiu/logs";
        if (!file_exists($log_filename)) {
            mkdir($log_filename, 0777, true);
        }
        $log_file_data = $log_filename . '/debug.log';
        file_put_contents($log_file_data, $log_msg . "\n", FILE_APPEND);
    }
}
