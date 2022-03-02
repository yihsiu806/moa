<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Division;

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
}
