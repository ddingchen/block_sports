<?php

namespace App\Http\Controllers;

use App\Wm\Group;
use App\Wm\RegisterTeam;
use App\Wm\Registion;
use App\Wm\Ticket;
use Carbon\Carbon;
use DB;
use EasyWeChat\Payment\Order;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Validator;

class WMSwimmingController extends Controller
{

    public function index()
    {
        $setting = DB::table('wm_settings')->first();
        return view('wmswimming.index', compact('setting'));
    }

    public function types()
    {
        return view('wmswimming.types');
    }

    public function type(Request $request)
    {
        $this->validate($request, [
            'team_name' => 'nullable|string|max:30',
        ], [
            'team_name.string' => '请输入有效的团体名称',
            'team_name.max' => '团体名称不能超过30个字',
        ]);

        if ($teamName = $request->input('team_name')) {
            // add session
            session()->put('team_name', $teamName);
        } else {
            // destory session
            session()->forget('team_name');
        }
    }

    public function groups()
    {
        return view('wmswimming.groups', [
            'groups' => Group::all(),
        ]);
    }

    public function registerForm(Group $group)
    {
        $registerEnabled = $this->registerEnabled();
        return view('wmswimming.register', compact('group', 'registerEnabled'));
    }

    public function register(Request $request, Group $group)
    {
        // 报名未开启
        if (!$this->registerEnabled()) {
            return abort('403');
        }

        $message = [
            '*.required' => '必填',
            'members.*.realname.max' => '请输入15字内身份证姓名',
            'members.*.idcard_no.regex' => '请输入18位有效二代身份证号',
            'members.*.tel.digits' => '请输入11位手机号',
        ];

        $validator = Validator::make($request->all(), [
            'members' => 'required|array',
            'members.*.realname' => 'required|string|max:15',
            'members.*.sex' => 'required|in:male,female',
            'members.*.idcard_no' => ['required', 'string', 'regex:/^[0-9]{17}([0-9]|X)$/'],
            'members.*.tel' => 'required|digits:11',
        ], $message);

        if ($validator->fails()) {
            $this->throwValidationException($request, $validator);
        }

        $validator->after(function ($validator) use ($request, $group) {
            $membersCount = count($request->input('members'));
            if ($group->team_required) {
                if ($membersCount != 4) {
                    $validator->errors()->add("members", '4X50米接力报名必须有4个人组成');
                    return;
                }
            } else {
                if ($membersCount != 1) {
                    $validator->errors()->add("members", '该项目为单人比赛');
                    return;
                }
            }

            $idcardNos = collect($request->input('members.*.idcard_no'));
            $idcardNos->each(function ($idcardNo, $index) use ($validator, $group, $idcardNos, $request) {
                // 组队报名是
                if ($group->team_required && $idcardNos->filter(function ($no) use ($idcardNo) {
                    return $no == $idcardNo;
                })->count() > 1) {
                    $validator->errors()->add("members.{$index}.idcard_no", '同一组队中不可有重复的队员');
                    return;
                }

                // 报名人次限制
                $registions = Registion::where('idcard_no', $idcardNo)->get();
                if ($registions->count() != 0) {
                    if ($registions->count() >= 2) {
                        $validator->errors()->add("members.{$index}.idcard_no", '抱歉，该身份证已报名过两个项目，不可再报名');
                        return;
                    }
                    $registion = $registions->first();
                    if ($registion->registerGroup()->id == $group->id) {
                        $validator->errors()->add("members.{$index}.idcard_no", '抱歉，该身份证已报名过该项目，不可重复报名');
                        return;
                    }
                }

                // 身份证实名认证
                $validateResult = $this->validateIdcard($idcardNo, $request->input("members.{$index}.realname"));
                if (!$validateResult['isValid']) {
                    $validator->errors()->add("members.{$index}.idcard_no", $validateResult['message']);
                    return;
                }
                // 年龄范围限定
                $birthdayStr = substr($idcardNo, 6, 8);
                $birthday = Carbon::createFromFormat('Ymd', $birthdayStr);
                if ($this->isAgeOutOfRange($birthday)) {
                    $validator->errors()->add("members.{$index}.idcard_no", '抱歉，该年龄不在我们的年龄组别范围内，无法报名');
                    return;
                }
            });

        });
        if ($validator->fails()) {
            $this->throwValidationException($request, $validator);
        }

        // 待确认：团体分组统一
        // 待完善：身份证验证

        $formInput = $request->input('members');
        // add team name if exists
        if (session('team_name')) {
            foreach ($formInput as &$input) {
                $input['team_name'] = session('team_name');
            }
        }
        \Log::debug($formInput);
        if ($group->team_required) {
            $registion = $this->registerForTeam($formInput);
        } else {
            $registion = Registion::create($formInput[0]);
        }
        $ticket = new Ticket;
        $ticket->out_trade_no = date('ymd') . substr(time(), -5) . substr(microtime(), 2, 5);
        $ticket->group()->associate($group);
        $ticket->owner()->associate(auth()->user());
        $ticket->registion()->associate($registion);
        $ticket->save();

        return json_encode(['target_url' => "/wm/pay?ticket={$ticket->id}"]);
    }

    protected function validateIdcard($idcardNo, $realname)
    {
        if (app()->isLocal()) {
            return [
                'isValid' => true,
            ];
        }

        $appKey = 'b7bb221d5ec25d7838a848f1a1fcf7d6';
        $realname = urlencode($realname);
        $client = new Client;
        $response = $client->request('get', "http://op.juhe.cn/idcard/query?key={$appKey}&idcard={$idcardNo}&realname={$realname}");
        \Log::debug($response->getBody());
        $data = json_decode($response->getBody());
        switch ($data->error_code) {
            case 0:
                if ($data->result->res == 1) {
                    // 匹配成功
                    return [
                        'isValid' => true,
                    ];
                } else {
                    // 匹配失败
                    return [
                        'isValid' => false,
                        'message' => '您输入的姓名与身份证不匹配，请检查输入是否有误',
                    ];
                }
                break;
            case 210301:
                return [
                    'isValid' => false,
                    'message' => '您输入的身份证不存在，请检查输入是否有误',
                ];
                break;
            default:
                \Log::error("身份证实名认证异常，身份证号{$idcardNo}，异常代码{$data->error_code}");
                return [
                    'isValid' => true,
                ];
                break;
        }
    }

    public function payForm()
    {
        $ticket = Ticket::findOrFail(request('ticket'));

        if ($ticket->owner->id != auth()->id()) {
            return abort('403', '没有访问权限');
        }

        // if (!app()->isLocal()) {
        $prepayId = $this->prepareForWechat($ticket);
        // $request->session()->put('success_callback', '/history/book/finish');
        // $request->session()->put('fail_callback', '/history/book/unfinish');
        // return redirect('payment/wxpub')->with([
        //     'prepay_id' => $prepayId,
        // ]);
        $jsApiParameters = app('wechat')->payment->configForPayment($prepayId);
        // } else {
        // $payment->successCallbackForWxpub();
        // if ($payMethod != 'wxpub') {
        //     return redirect('sport/success');
        // } else {
        //     return redirect('history/book/finish');
        // }
        // }
        return view('wmswimming.pay', compact('ticket', 'prepayId', 'jsApiParameters'));
    }

    private function getWechatPaymentAttribute()
    {
        return [
            'notify_url' => config('app.url') . '/payment/notify',
            'trade_type' => 'JSAPI',
            'openid' => auth()->user()->open_id,
        ];
    }

    private function prepareForWechat(Ticket $ticket)
    {
        $order = new Order(array_merge($this->getWechatPaymentAttribute(), [
            'body' => '无锡网民公益游泳比赛报名',
            'detail' => $ticket->group->name,
            'out_trade_no' => $ticket->out_trade_no,
            'total_fee' => $ticket->group->price * 100,
        ]));
        \Log::debug($order);
        $result = app('wechat')->payment->prepare($order);
        \Log::debug($result);
        return $result->prepay_id;
    }

    public function success()
    {
        return view('wmswimming.success');
    }

    public function myTickets()
    {
        return view('wmswimming.myticket', [
            'tickets' => auth()->user()->wmTickets,
        ]);
    }

    public function allTickets()
    {
        return view('wmswimming.alltickets', [
            'tickets' => Ticket::all(),
        ]);
    }

    public function ticket(Ticket $ticket)
    {
        if ($ticket->owner->id != auth()->id()) {
            return abort('403', '没有访问权限');
        }
        return view('wmswimming.ticket', compact('ticket'));
    }

    public function destoryTicket(Ticket $ticket)
    {
        if ($ticket->owner->id != auth()->id()) {
            return abort('403', '没有访问权限');
        }
        if ($ticket->paid) {
            return abort('403', '订单已经支付不可进行删除操作');
        }
        // delete
        $ticket->delete();
        return redirect('wm');
    }

    private function registerForTeam($formInput)
    {
        $registions = collect($formInput)->map(function ($input) {
            return new Registion($input);
        });
        $teamRegistion = RegisterTeam::create();
        $teamRegistion->registions()->saveMany($registions);
        return $teamRegistion;
    }

    private function isValidDate($date)
    {
        return date('Ymd', strtotime($date)) == $date;
    }

    private function isAgeOutOfRange($date)
    {
        $year = $date->year;
        if ($year >= 1957 && $year <= 1999) {
            return false;
        }
        if ($year >= 2002 && $year <= 2004) {
            return false;
        }
        return true;
    }

    private function registerEnabled()
    {
        $setting = DB::table('wm_settings')->first();
        return $setting && $setting->enable_register;
    }
}
