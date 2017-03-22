<?php

namespace App\Http\Controllers;

use App\MatchResult;

class MatchResultController extends Controller
{
    public function show(MatchResult $result)
    {
        $js = app('wechat')->js;
        $ticket = auth()->user()->ticket;
        $result = $ticket->matchResults->first();
        return view('activities.hsblockgame.result', compact('result', 'js'));
    }
}
