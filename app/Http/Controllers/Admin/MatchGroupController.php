<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Match;
use App\MatchGroup;
use Illuminate\Http\Request;

class MatchGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = MatchGroup::all();
        return view('admin.group.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $matches = Match::all()->filter(function ($match) {
            return !$match->group;
        });
        return view('admin.group.create', compact('matches'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $group = MatchGroup::create($request->all());
        Match::find($request->input('matches'))->each(function ($match) use ($group) {
            $match->group()->associate($group);
            $match->save();
        });
        return redirect('admin/group');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($matchGroupId)
    {
        $group = MatchGroup::findOrFail($matchGroupId);
        $containsMatches = $group->matches;
        $matches = Match::all()->filter(function ($match) {
            return !$match->group;
        });
        return view('admin.group.edit', compact('group', 'matches', 'containsMatches'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $matchGroupId)
    {
        $group = MatchGroup::findOrFail($matchGroupId);
        // 解除之前的关系
        $group->matches->each(function ($match) {
            $match->group()->dissociate();
            $match->save();
        });
        // 添加新的赛事
        Match::findMany($request->input('matches'))->each(function ($match) use ($group) {
            $match->group()->associate($group);
            $match->save();
        });
        return redirect('admin/group');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        MatchGroup::findOrFail($id)->delete();
        return redirect('admin/group');
    }
}
