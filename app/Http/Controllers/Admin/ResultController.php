<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Match;
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
    public function edit(Match $match, Result $result)
    {
        return view('admin.result.edit', compact('result', 'match'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Match $match, Result $result)
    {
        $this->validate($request, [
            'score' => 'nullable|numeric',
        ]);

        if ($request->input('score')) {
            $result->update($request->all());
        } else {
            $result->delete();
        }

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
