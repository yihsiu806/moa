<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $role = Auth::user()->role;
        if ($role == 'admin') {
            return redirect('admin');
        } else if ($role == 'division') {
            return redirect('division');
        } else if ($role == 'viewer') {
            return redirect('viewer');
        } else {
            Auth::logout();
            return redirect('/');
        }
    }
}
