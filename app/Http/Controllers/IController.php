<?php

namespace App\Http\Controllers;

class IController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('i.home', compact('user'));
    }
}
