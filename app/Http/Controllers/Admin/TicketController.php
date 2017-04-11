<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Match;
use App\ResidentialArea;
use App\Sport;
use App\Ticket;
use App\User;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $match = $request->has('match') ? Match::find($request->input('match')) : Match::first();
        $tickets = $match->tickets->sortByDesc('created_at');
        $sports = Sport::all();
        $blocks = $match->street->blocks;
        return view('admin.ticket.index', compact('tickets', 'sports', 'match', 'blocks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $match = Match::find($request->input('match'));
        $areas = ResidentialArea::all()->sortBy('py');
        $sports = Sport::all();
        return view('admin.ticket.create', compact('match', 'areas', 'sports'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:15',
            'tel' => 'required|unique:users',
            'match' => 'required|exists:matches,id',
            'area' => 'required|exists:residential_areas,id',
            'sports' => 'required|array|max:5',
            'sports.*' => 'required|exists:sports,id',
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'tel' => $request->input('tel'),
            'sex' => $request->input('sex') ?: null,
            'residential_area_id' => $request->input('area'),
        ]);

        $ticket = Ticket::create([
            'match_id' => $request->input('match'),
            'user_id' => $user->id,
            'note' => $request->input('note'),
        ]);
        $ticket->sports()->attach($request->input('sports'));

        return redirect('admin/ticket');
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
    public function edit(Ticket $ticket)
    {
        $sports = Sport::all();
        return view('admin.ticket.edit', compact('ticket', 'sports'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        $this->validate($request, [
            'sports' => 'required|array|max:5',
            'sports.*' => 'required|exists:sports,id',
        ]);
        $ticket->sports()->sync($request->input('sports'));
        $ticket->note = $request->input('note');
        $ticket->save();
        return redirect('admin/ticket');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->sports()->detach();
        $ticket->delete();
        return redirect('admin/ticket');
    }
}
