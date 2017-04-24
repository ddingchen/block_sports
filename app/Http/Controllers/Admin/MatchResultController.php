<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Match;
use App\MatchResult;
use Illuminate\Http\Request;

class MatchResultController extends Controller
{
    public function fetchFirstMatch()
    {
        $match = Match::first();
        return redirect("admin/match/{$match->id}/result");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Match $match)
    {
        // $sports = Sport::all();
        // $selectedSport = $request->has('sport') ? Sport::find($request->input('sport')) : $sports->first();
        // $results = $selectedSport->matchResults;
        // return view('admin.match.result.index', compact('sports', 'selectedSport', 'results'));
        $matches = Match::all();
        $sports = $match->sports;
        $results = $match->results;
        return view('admin.result.index', compact('sports', 'matches', 'results'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Match $match, $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Match $match, $id)
    {
        $result = MatchResult::findOrFail($id);
        return view('admin.result.edit', compact('result', 'match'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Match $match, $id)
    {
        $result = MatchResult::findOrFail($id);
        $this->validate($request, [
            'score' => 'nullable|numeric',
        ]);

        $result->update($request->all());
        return redirect("admin/match/{$match->id}/result");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
