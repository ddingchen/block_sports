<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Wm\Group;
use App\Wm\Registion;
use App\Wm\Ticket;
use DB;
use Illuminate\Http\Request;

class WMSwimmingController extends Controller
{
    public function allTickets(Request $request)
    {
        $query = Ticket::orderBy('group_id');
        if ($paid = $request->exists('paid')) {
            $query->where('paid', true);
        }
        if ($from = $request->input('from')) {
            $query->whereDate('created_at', '>', $from);
        }
        $tickets = $query->get();
        return view('admin.wm.all-tickets', compact('tickets', 'paid'));
    }

    public function tickets(Group $group)
    {
        $tickets = $group->tickets()->with('registion')->get();
        if (!$group->team_required) {
            $tickets = $tickets->groupBy(function ($ticket) {
                $year = $ticket->registion->getBirthday()->year;
                if ($year >= 1988 && $year <= 1999) {
                    return '1988 ~ 1999';
                } elseif ($year >= 1983 && $year <= 1987) {
                    return '1983 ~ 1987';
                } elseif ($year >= 1978 && $year <= 1982) {
                    return '1978 ~ 1982';
                } elseif ($year >= 1973 && $year <= 1977) {
                    return '1973 ~ 1977';
                } elseif ($year >= 1968 && $year <= 1972) {
                    return '1968 ~ 1972';
                } elseif ($year >= 1963 && $year <= 1967) {
                    return '1963 ~ 1967';
                } elseif ($year >= 1957 && $year <= 1962) {
                    return '1957 ~ 1962';
                } elseif ($year >= 2002 && $year <= 2004) {
                    return '2002 ~ 2004';
                }
                return 'out of age';
            })->sortBy(function ($ageTickets, $ageRange) {
                return $ageRange;
            });

        }

        return view('admin.wm.tickets', compact('group', 'tickets'));
    }

    public function registionForm(Registion $registion)
    {
        return view('admin.wm.registion', compact('registion'));
    }

    public function editRegistion(Request $request, Registion $registion)
    {
        $this->validate($request, [
            'realname' => 'required|string|max:15',
            'sex' => 'required|in:male,female',
            'idcard_no' => ['required', 'string', 'regex:/^[0-9]{17}([0-9]|X)$/'],
            'tel' => 'required',
        ]);
        $registion->update($request->all());
        return redirect("admin/wm/group/{$registion->registerGroup()->id}/ticket");
    }

    public function ticketForm(Ticket $ticket)
    {
        $groups = Group::where('name', 'not like', '%接力%')->get();
        return view("admin.wm.ticket-edit", compact('ticket', 'groups'));
    }

    public function editTicket(Request $request, Ticket $ticket)
    {
        $this->validate($request, [
            'group_id' => 'required|exists:groups,id',
        ]);

        $ticket->group_id = $request->input('group_id');
        $ticket->save();

        return redirect("admin/wm/group/{$request->input('group_id')}/ticket");
    }

    public function destoryTicket(Ticket $ticket)
    {
        if ($ticket->paid) {
            //     // refund
            //     $out_refund_no = date('ymd') . substr(time(), -5) . substr(microtime(), 2, 5);
            //     $result = app('wechat')->payment->refund($ticket->out_trade_no, $out_refund_no, $ticket->group->price * 100);
            DB::table('refunds')->insert(['detail' => json_encode($ticket)]);
        }

        // delete
        $ticket->delete();
        return redirect("admin/wm/group/{$ticket->group->id}/ticket");
    }

    public function searchForm()
    {
        $registions = [];
        if ($keyword = request('idcard_no')) {
            $registions = Registion::where('idcard_no', 'like', "%{$keyword}%")->get();
        }

        return view('admin.wm.search', compact('registions'));
    }

    public function settingForm()
    {
        $setting = DB::table('wm_settings')->first();
        return view('admin.wm.setting', compact('setting'));
    }

    public function setting(Request $request)
    {
        // register switch
        if (DB::table('wm_settings')->first()) {
            DB::table('wm_settings')->update($request->only(['title', 'sub_title', 'enable_register']));
        } else {
            DB::table('wm_settings')->insert($request->only(['title', 'sub_title', 'enable_register']));
        }
        // home banner
        // dd($_FILES);
        if ($request->hasFile('banner')) {
            // dd($request->banner);
            // $request->banner->storeAs('public/image', 'wm_banner.jpg');
            move_uploaded_file($_FILES['banner']['tmp_name'], storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'image' . DIRECTORY_SEPARATOR . 'wm_banner.jpg'));
        }

        return back()->with('status', 'success');
    }

    public function teams()
    {
        $registions = Registion::whereNotNull('team_name')->get()->unique(function ($registion) {
            return $registion['realname'] . $registion['idcard_no'];
        });
        $registionsByGroup = $registions->groupBy(function ($registion) {
            return $registion->team_name;
        });
        return view('admin.wm.team', compact('registionsByGroup'));
    }
}
