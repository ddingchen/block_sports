<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    @yield('css')
  </head>
  <body>
    <div class="weui-tab">
        <div class="weui-tab__panel">
          @yield('content')
        </div>
        <div class="weui-tabbar">
            <a href="/match/group" class="weui-tabbar__item @if(preg_match('/\/match\/group/' ,url()->current())) weui-bar__item_on @endif">
                <img src="/image/match.png" alt="" class="weui-tabbar__icon">
                <p class="weui-tabbar__label">比赛报名</p>
            </a>
            <a href="/sport/top-list" class="weui-tabbar__item @if(preg_match('/\/sport\/top-list/' ,url()->current())) weui-bar__item_on @endif">
                <img src="/image/rank.png" alt="" class="weui-tabbar__icon">
                <p class="weui-tabbar__label">排行榜</p>
            </a>
        </div>
    </div>
    @yield('js')
  </body>
</html>
