<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use EasyWeChat\Message\Material;
use EasyWeChat\Message\News;
use Illuminate\Http\Request;

class WechatController extends Controller
{
    public function serve()
    {
        $wechat = app('wechat');
        $wechat->server->setMessageHandler(function ($message) {
            $openId = $message->FromUserName;
            // 如果该用户未曾记录性别信息，则尝试从微信信息中更新
            $this->setSexForUser($openId);
            switch ($message->MsgType) {
                case 'event':
                    switch ($message->Event) {
                        case 'subscribe':
                            if (preg_match('/reg_\d+_\d+$/', $message->EventKey) === 1) {
                                // 带区域参数的报名入口
                                $datas = explode('_', $message->EventKey);
                                $mode = $datas[0];
                                $matchId = $datas[1];
                                $blockId = $datas[2];
                                // TO DO
                            }
                            break;
                        default:
                            break;
                    }
                    break;
                case 'text':
                    if ($message->Content == '报名') {
                        return new News([
                            'title' => '街区运动会',
                            'description' => '点击进入报名入口',
                            'url' => 'http://wap.zhongkaiyun.com/activities/hsblockgame',
                            'image' => 'http://mmbiz.qpic.cn/mmbiz_jpg/oMibuKYSu2KtcLUtQjnrYuDaYVjiazDv2SQQ1zBQLGeqQWcFoSnuBcF0VHibg07vVf38w9XkI3yayxUT6NhUgFGLg/0?wx_fmt=jpeg',
                        ]);
                    } else if ($message->Content == '投票') {
                        return new News([
                            'title' => '投票 丨最佳网络人气队伍',
                            'description' => '动一动手指的事儿',
                            'url' => 'http://mp.weixin.qq.com/s?__biz=MzAwNTAyNzEwOQ==&mid=503151671&idx=1&sn=9aaace34410d5eacedfe74d7e9432e51&chksm=032b387d345cb16b1aecff4a2d820a0fa1f98feae1acb3d661ce396d9a1d54cf4975f9aca1ec#rd',
                        ]);
                    }
                    break;
                case 'image':
                    break;
                case 'voice':
                    break;
                case 'video':
                    break;
                case 'location':
                    break;
                case 'link':
                    break;
                default:
                    break;
            }
        });
        return $wechat->server->serve();
    }

    public function updateMenu()
    {
        $wechat = app('wechat');
        $menu = $wechat->menu;
        $buttons = [
            [
                "name" => "街区运动会",
                "sub_button" => [
                    [
                        "type" => "view",
                        "name" => "说明",
                        "url" => "https://mp.weixin.qq.com/s?__biz=MzAwNTAyNzEwOQ==&mid=503151575&idx=1&sn=49cb1cce3c4b03d5dc87218664507990&chksm=032b3f9d345cb68b2bdab17fb08c7e6330221593a616354450743063f7286dfdb0a61f92659e#rd",
                    ],
                    [
                        "type" => "view",
                        "name" => "报名",
                        "url" => "http://wap.zhongkaiyun.com/activities/hsblockgame",
                    ],
                ],
            ],
            [
                "type" => "media_id",
                "name" => "交流群",
                "media_id" => "LUY0P8mlFZSb6H24mzka7CcnnC_iIReGDavGqKoEflU",
            ],
            [
                "type" => "view",
                "name" => "你想看的",
                "url" => "http://mp.weixin.qq.com/mp/homepage?__biz=MzAwNTAyNzEwOQ==&hid=1&sn=025af7649cb648388f72ee8f3926b337#wechat_redirect",
            ],
        ];
        $menu->add($buttons);
    }

    public function material(Request $request)
    {
        $type = $request->input('type') ? $request->input('type') : 'news';
        $page = $request->input('page') ? $request->input('page') : 0;
        $countPerPage = 12;
        $material = app('wechat')->material;
        $resource = $material->lists($type, $countPerPage * $page, $countPerPage * ($page + 1));
        return $resource;
    }

    private function setSexForUser($openId)
    {
        $user = User::where('open_id', $openId)->first();
        if ($user && !$user->sex) {
            $userService = app('wechat')->user;
            $wechatUser = $userService->get($openId);
            $user->sex = $this->sexTranslator($wechatUser->sex);
            $user->save();
            \Log::debug('Refresh sex info of user.');
        }
    }

    private function sexTranslator($wechatSex)
    {
        $sex = null;
        if ($wechatSex === 1) {
            $sex = 'male';
        } else if ($wechatSex === 2) {
            $sex = 'female';
        }
        return $sex;
    }
}
