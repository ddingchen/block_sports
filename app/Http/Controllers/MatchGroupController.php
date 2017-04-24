<?php

namespace App\Http\Controllers;

use App\MatchGroup;

class MatchGroupController extends Controller
{
    public function index()
    {
        $groups = MatchGroup::all();
        return view('group.index', compact('groups'));
    }

    public function show($id)
    {
        $group = MatchGroup::findOrFail($id);
        return redirect("match/{$group->matches->first()->id}/ticket/create");
    }
}
