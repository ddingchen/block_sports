<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ResidentialArea;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        if (!$keyword) {
            return [];
        }
        $users = User::where('name', 'like', "%{$keyword}%")
            ->orWhere('nickname', 'like', "%{$keyword}%")
            ->orWhere('tel', 'like', "%{$keyword}%")
            ->get();
        return $users;
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, User $user)
    {
        $areas = ResidentialArea::all();
        return view('admin.user.edit', compact('user', 'areas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required|max:15',
            'tel' => 'required',
            'area' => 'required|exists:residential_areas,id',
            'sex' => 'nullable|in:female,male',
            'age' => 'digits:2',
        ]);

        $user->name = $request->input('name');
        $user->tel = $request->input('tel');
        $user->residential_area_id = $request->input('area');
        $user->age = $request->input('age');
        $user->sex = $request->input('sex') ?: null;
        $user->save();

        return redirect('admin/ticket');
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
