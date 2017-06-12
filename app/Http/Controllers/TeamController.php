<?php

namespace App\Http\Controllers;

use App\Team;
use Illuminate\Http\Request;
use PHPQRCode\QRcode;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams = auth()->user()->teams;
        return view('user.team.index', compact('teams'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.team.create');
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
            'name' => 'required|unique:teams',
        ], [
            'name.required' => '请输入战队名称',
            'name.unique' => '该站队名称已被使用',
        ]);

        $user = auth()->user();
        // basic info
        $team = new Team($request->all());
        // leader set
        $team->leader()->associate($user);
        $team->save();
        // set member
        $team->members()->attach($user);
        return redirect("i/team/{$team->id}");
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        return view('user.team.show', compact('team'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        $team->members()->detach();
        $team->delete();
        return redirect('/i/team');
    }

    /**
     * 加入战队的二维码
     *
     * @return \Illuminate\Http\Response
     */
    public function invite(Team $team)
    {
        return view('user.team.invite', compact('team'));
    }

    /**
     * 扫码加入战队
     *
     * @return \Illuminate\Http\Response
     */
    public function join(Team $team)
    {
        $user = auth()->user();
        if (!$team->members->contains($user)) {
            // 加入
            $team->members()->attach($user);
        }
        return redirect("i/team/{$team->id}");
    }

    public function qrCode(Team $team)
    {
        // check permission
        if (!$team->members->contains(auth()->user())) {
            return;
        }
        return response(QRcode::png(url("i/team/{$team->id}/join"), false, 'L', 3))
            ->header('Content-Type', 'image/png');
    }
}
