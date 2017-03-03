<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class LoginAsWechatUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $wechatUser = session('wechat.oauth_user');

        // check if already loged in
        $loginUser = auth()->user();
        if ($loginUser && $loginUser->open_id == $wechatUser->id) {
            return $next($request);
        }

        // fetch by open id[服务号]
        $user = User::where('open_id', $wechatUser->id)->first();

        if (!$user) {
            // create new profile for user
            $user = User::create([
                'name' => $wechatUser->nickname,
                'open_id' => $wechatUser->id,
                'nickname' => $wechatUser->nickname,
                'sex' => $this->sexTranslator($wechatUser->getOriginal()['sex']),
                'avatar' => $wechatUser->avatar,
            ]);
        }

        // login fetched user in app
        auth()->login($user);
        return $next($request);
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
