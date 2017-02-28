<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Log;

class WechatController extends Controller
{
    public function serve()
    {
        Log::info('request arrived.');

        $wechat = app('wechat');
        $wechat->server->setMessageHandler(function ($message) {
            return "欢迎关注中铠街区体育";
        });

        Log::info('return response.');

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
                "media_id" => "LUY0P8mlFZSb6H24mzka7A8uU2cuzv74yBcaGYcSpsk",
            ],
            [
                "type" => "view",
                "name" => "关于我们",
                "url" => "http://mp.weixin.qq.com/s/om2H-aU3OMw3Qm9chY56mw",
            ],
        ];
        $menu->add($buttons);
    }

    public function material(Request $request)
    {
        $type = $request->input('type') ? $request->input('type') : 'news';
        $material = app('wechat')->material;
        $resource = $material->lists($type);
        return $resource;
    }
}
