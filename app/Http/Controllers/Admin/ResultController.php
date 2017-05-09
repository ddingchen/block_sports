<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Match;
use App\MatchResult;
use App\Result;
use App\Ticket;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Match $match)
    {
        $tickets = $match->tickets;
        return view('admin.result.index', compact('match', 'tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Match $match, Ticket $ticket)
    {
        return view('admin.result.create', compact('match', 'ticket'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Match $match, Ticket $ticket)
    {
        $result = new Result($request->all());
        $result->match()->associate($match);
        $result->owner()->associate($ticket->owner);
        $result->save();
        return redirect("admin/match/{$match->id}/result");
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
        return redirect("admin/match/{$match->id}/result?sport={$result->sport->id}");
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
