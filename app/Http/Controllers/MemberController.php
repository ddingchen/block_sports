<?php

namespace App\Http\Controllers;

use App\Member;
use App\Team;
use Illuminate\Http\Request;
use Validator;

class MemberController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team, Member $member)
    {
        return view('user.team.member.edit', compact('team', 'member'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team, Member $member)
    {
        $this->validate($request, [
            'alias' => 'nullable|max:10',
        ], [
            'alias.max' => '备注最长不能超过10字',
        ]);
        // 更新备注
        $member->update($request->all());
        // 如果有设置为leader，则设置当前队员为leader
        if ($request->has('is_leader') && $request->input('is_leader')) {
            $team->leader()->associate($member->user);
            $team->save();
        }

        return redirect("i/team/{$team->id}");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Team $team, Member $member)
    {
        // 站队至少有一个队员
        if ($team->members->count() == 1) {
            $validator = Validator::make($request->all(), []);
            $validator->errors()->add('del_deny', '战队至少需要一名队员');
            return back()->withErrors($validator);
        }
        // 删除队员
        $member->delete();
        // 删除
        $team->leader()->associate($team->members->first());
        $team->save();
        return back();
    }
}
