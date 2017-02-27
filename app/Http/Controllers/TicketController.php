<?php

namespace App\Http\Controllers;

use App\ResidentialArea;
use App\Sport;
use App\Ticket;
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
        $user = auth()->user();
        if (!$user->ticket) {
            return redirect('activities/hsblockgame/register');
        }
        $sports = $user->ticket->sports;
        return view('activities.hsblockgame.index', compact('user', 'sports'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();
        if ($user->ticket) {
            return redirect('activities/hsblockgame');
        }

        $residentialAreas = ResidentialArea::all();
        $sports = Sport::all();
        return view('activities.hsblockgame.register', compact('residentialAreas', 'sports'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'name.required' => '请输入姓名',
            'name.max' => '姓名最长不超过15字',
            'tel.required' => '请输入11位手机号',
            'tel.digits' => '请输入11位手机号',
            'area.required' => '请选择所在小区',
            'area.exists' => '请选择有效的小区',
            'sports.required' => '请选择想要参与的项目',
            'sports.*.required' => '请选择想要参与的项目',
            'sports.*.exists' => '请选择想要参与的项目',
        ];

        $this->validate($request, [
            'name' => 'required|max:15',
            'tel' => 'required|digits:11',
            'area' => 'required|exists:residential_areas,id',
            'sports' => 'required|array',
            'sports.*' => 'required|exists:sports,id',
        ], $messages);

        $user = auth()->user();
        $user->name = $request->input('name');
        $user->tel = $request->input('tel');
        $user->residential_area_id = $request->input('area');
        $user->save();

        $ticket = Ticket::create(['user_id' => $user->id]);
        $ticket->sports()->attach($request->input('sports'));

        return redirect('activities/hsblockgame');
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
