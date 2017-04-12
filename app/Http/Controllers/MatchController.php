<?php

namespace App\Http\Controllers;

class MatchController extends Controller
{

    public function index()
    {
        return view('ticket.index', compact('faker'));
    }
}
