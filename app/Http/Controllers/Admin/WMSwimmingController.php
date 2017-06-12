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
    public function tickets(Group $group)
    {
        $tickets = $group->tickets->all();
        return view('admin.wm.tickets', compact('group', 'tickets'));
    }

    public function registionForm(Registion $registion)
    {
        return view('admin.wm.registion', compact('registion'));
    }

    public function editRegistion(Request $request, Registion $registion)
    {
        $registion->update($request->all());
        return redirect("admin/wm/group/{$registion->registerGroup()->id}/ticket");
    }

    public function destoryTicket(Ticket $ticket)
    {
        if ($ticket->paid) {
            // refund
            $out_refund_no = date('ymd') . substr(time(), -5) . substr(microtime(), 2, 5);
            $result = app('wechat')->payment->refund($ticket->out_trade_no, $out_refund_no, 100);
            DB::table('refunds')->insert(['detail' => json_encode($result)]);
        }
        // delete
        $ticket->delete();
        return redirect("admin/wm/group/{$ticket->group->id}/ticket");
    }
}
