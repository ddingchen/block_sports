<?php

namespace App\Http\Controllers;

class IController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('user.home', compact('user'));
    }
}
