<?php

namespace App\Http\Controllers\Admin;

use App\Block;
use App\Http\Controllers\Controller;
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
    public function index()
    {
        $tickets = Ticket::all()->sortByDesc('created_at');
        $sports = Sport::all();
        $blocks = Block::all();
        return view('admin.ticket.index', compact('tickets', 'sports', 'blocks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $areas = ResidentialArea::all()->sortBy('py');
        $sports = Sport::all();
        return view('admin.ticket.create', compact('areas', 'sports'));
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

        $ticket = Ticket::create(['user_id' => $user->id]);
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
