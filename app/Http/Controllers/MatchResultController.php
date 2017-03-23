<?php

namespace App\Http\Controllers;

use App\MatchResult;

class MatchResultController extends Controller
{
    public function show($resultId)
    {
        $result = MatchResult::findOrFail($resultId);
        $js = app('wechat')->js;
        return view('activities.hsblockgame.result', compact('result', 'js'));
    }
}
