<?php

namespace App\Http\Controllers;

use App\Match;
use App\Sport;
use App\Ticket;
use Illuminate\Http\Request;
use Validator;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    public function indexOfUser()
    {
        $user = auth()->user();
        $tickets = $user->tickets;
        return view('user.ticket.index', compact('user', 'tickets'));
    }

    // public function result()
    // {
    //     $ticket = auth()->user()->ticket;
    //     if ($ticket) {
    //         $result = $ticket->matchResults->first(function ($res) {
    //             return $res->video && $res->honour;
    //         });
    //         $result = $result ?: $ticket->matchResults->first();
    //         return redirect("match/result/{$result->id}");
    //     }
    //     return redirect('activities/hsblockgame/register');
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Match $match)
    {
        $user = auth()->user();
        $matches = $match->group->matches;
        $areas = $match->street->areas->sortBy('py')->values();
        $sports = $match->sports;
        return view('ticket.create', compact('matches', 'sports', 'match', 'areas', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Match $match)
    {
        $messages = [
            'match.required' => '请选择街道',
            'match.exists' => '请选择有效的街道',
            'name.required' => '请输入姓名',
            'name.max' => '姓名最长不超过15字',
            'tel.required' => '请输入11位手机号',
            'tel.digits' => '请输入11位手机号',
            'area.required' => '请选择所在小区',
            'area.exists' => '请选择有效的小区',
            'custom_area.required_if' => '请输入您所在的小区',
            'sports.required' => '请选择想要参与的项目',
            'sports.max' => '最多仅可以选择五个项目',
            'sports.*.required' => '请选择想要参与的项目',
            'sports.*.exists' => '请选择想要参与的项目',
            'team_name.required' => '请输入团队名称',
            'team_name.max' => '请输入20字以内的队名',
        ];

        $validator = Validator::make($request->all(), [
            'match' => 'required|exists:matches,id',
            'name' => 'required|max:15',
            'tel' => 'required|digits:11',
            'custom_area' => 'required_if:area,0',
            'sports' => 'required|array|max:5',
            'sports.*' => 'required|exists:sports,id',
        ], $messages);

        $validator->sometimes('area', 'required|exists:residential_areas,id', function ($input) {
            return $input['area'] != 0;
        });

        $validator->sometimes('team_name', 'required|max:20', function ($input) {
            return Sport::findMany($input['sports'])->contains(function ($sport) {
                return $sport->is_group;
            });
        });

        $validator->after(function ($validator) use ($request, $match) {
            $user = auth()->user();
            // 已报名过该项比赛
            if ($user->ticketForMatch($match)) {
                $validator->errors()->add('duplicate_register', '您已报名过该项比赛，如需更改参赛项目或其他报名信息，可联系官方客服进行咨询。');
                return;
            }
            // 联系方式变更
            if ($request->has('contact_confirm')
                && $request->input('contact_confirm') == 0) {
                if ($user->name && $user->tel) {
                    if ($user->name != $request->input('name')
                        || $user->tel != $request->input('tel')) {
                        $validator->errors()->add('contact_changed', '友情提醒：联系方式与此前您填写过的信息发生了变更！您是否正在给他人进行报名，如果是，请使用他本人微信或其他报名渠道，如：官方交流群、官方报名热线等。否则新的联系方式将覆盖此前的联系人信息。');
                        return;
                    }
                }
            }
        });

        if ($validator->fails()) {
            $this->throwValidationException($request, $validator);
        }

        $user = auth()->user();
        $user->name = $request->input('name');
        $user->tel = $request->input('tel');
        if ($request->input('area') != 0) {
            $user->residential_area_id = $request->input('area');
        } else {
            $user->custom_area = $request->input('custom_area');
        }
        $user->save();

        $ticket = Ticket::create([
            'user_id' => $user->id,
            'match_id' => $request->input('match'),
        ]);

        // append team name
        $attachment = collect($request->input('sports'))->mapWithKeys(function ($sportId) use ($request) {
            return [$sportId => ['team_name' => $request->input('team_name')]];
        });
        $ticket->sports()->attach($attachment);

        return redirect('i/ticket');
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
