<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link href="http://cdn.bootcss.com/weui/1.1.2/style/weui.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/font-awesome/css/font-awesome.min.css">
    @yield('css')
    <style type="text/css">
        body {
            background-color: #f8f8f8;
        }
        a {
            color: inherit;
        }
        .container {
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            top: 0;
        }
        .fa {
            position: relative;
        }
        .header {
            box-sizing: border-box;
            height: 60px;
            background: #fff;
            align-items: center;
            padding: 15px;
            font-size: 18px;
        }
        .top-bar {
            color: #666;
        }
        .top-bar a+a i{
            margin-left: 10px;
        }
        .empty-tip {
            margin-top: 1em;
            margin-bottom: .3em;
            padding-left: 15px;
            padding-right: 15px;
            color: #999;
            font-size: 16px;
            text-align: center;
        }
        .block-btn{
            margin: 15px auto;
            padding: 0 15px;
        }
        .narrow-btn {
            margin: 0 auto;
            padding: 15px 0;
            width: 60%;
        }
        .small-btn {
            margin: 0 auto;
            /*padding: 15px 0;*/
            width: 100px;
        }
        .small-btn .weui-btn{
            line-height: 2.3;
            font-size: 14px;
        }
        .weui-cell__hd i.fa{
            margin-right: 5px;
        }
    </style>
  </head>
  <body>
    <div class="container">
    @if(isset($hideTab))
        @yield('content')
    @else
        <div class="weui-tab">
            <div class="weui-tab__panel">
              @yield('content')
            </div>
            <div class="weui-tabbar">
                <a href="/match/group" class="weui-tabbar__item @if(preg_match('/\/match\/group/' ,url()->current())) weui-bar__item_on @endif">
                    <i class="weui-tabbar__icon fa fa-file-text"></i>
                    <p class="weui-tabbar__label">比赛报名</p>
                </a>
                <a href="/sport/top-list" class="weui-tabbar__item @if(preg_match('/\/sport\/(\d+\/)?top-list/' ,url()->current())) weui-bar__item_on @endif">
                    <i class="weui-tabbar__icon fa fa-trophy"></i>
                    <p class="weui-tabbar__label">排行榜</p>
                </a>
                <a href="/i" class="weui-tabbar__item @if(preg_match('/\/i/' ,url()->current())) weui-bar__item_on @endif">
                    <i class="weui-tabbar__icon fa fa-user" style="position: relative;">
                        <span class="weui-badge weui-badge_dot" style="position: absolute;top: 0;right: -6px;"></span>
                    </i>
                    <p class="weui-tabbar__label">我</p>
                </a>
            </div>
        </div>
    @endif
    </div>
    <script src="{{ mix('/js/common.js') }}"></script>
    @yield('js')
  </body>
</html>
