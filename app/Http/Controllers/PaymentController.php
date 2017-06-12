<?php

namespace App\Http\Controllers;

use App\Wm\Ticket;
use Carbon\Carbon;
use Log;

class PaymentController extends Controller
{
    public function notify()
    {
        $response = app('wechat')->payment->handleNotify(function ($notify, $successful) {
            Log::debug('Notify callback:out_trade_no=' . $notify->out_trade_no);
            Log::debug('Notify callback:successful=' . $successful);

            // 使用通知里的 "微信支付订单号" 或者 "商户订单号" 去自己的数据库找到订单
            $ticket = Ticket::where('out_trade_no', $notify->out_trade_no)->first();

            if (!$ticket) { // 如果订单不存在
                return 'order not exist.'; // 告诉微信，我已经处理完了，订单没找到，别再通知我了
            }

            // 如果订单存在
            // 检查订单是否已经更新过支付状态
            if ($ticket->paid) { // 假设订单字段“支付时间”不为空代表已经支付
                return true; // 已经支付成功了就不再更新了
            }

            // 用户是否支付成功
            if ($successful) {
                // 不是已经支付状态则修改为已经支付状态
                $ticket->paid = true;
                $ticket->paid_at = Carbon::now();
                $ticket->save();
            }

            return true; // 返回处理完成
        });

        return $response;
    }
}
