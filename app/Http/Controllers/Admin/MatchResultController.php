<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\MatchResult;
use App\Sport;
use Illuminate\Http\Request;

class MatchResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sports = Sport::all();
        $selectedSport = $request->has('sport') ? Sport::find($request->input('sport')) : $sports->first();
        $results = $selectedSport->matchResults;
        return view('admin.match.result.index', compact('sports', 'selectedSport', 'results'));
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
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(MatchResult $result)
    {
        return view('admin.match.result.edit', compact('result'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MatchResult $result)
    {
        $this->validate($request, [
            'video' => 'required',
            'honour' => 'required',
        ]);

        $result->update($request->all());
        return redirect('admin/match/result');
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
