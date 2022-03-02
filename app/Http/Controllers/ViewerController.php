<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ViewerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:viewer');
    }

    public function index()
    {
        return view('viewer');
    }
}
