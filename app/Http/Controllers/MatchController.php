<?php

namespace App\Http\Controllers;

use App\Match;

class MatchController extends Controller
{
    public function index()
    {
        $matches = Match::all();
        return view('match.index', compact('matches'));
    }

    public function show(Match $match)
    {
        return redirect("match/{$match->id}/ticket/create");
    }
}
