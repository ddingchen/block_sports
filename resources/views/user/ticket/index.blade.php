<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>街区运动会－我的报名</title>
    <link rel="stylesheet" type="text/css" href="{{ mix('css/activities/hsblockgame.css') }}">
  </head>
  <body>
  	<div id="app">
      <div class="weui-cells__title">报名项目</div>
  		<div class="weui-cells">
  			@foreach($tickets as $ticket)
          {{-- <a class="weui-cell weui-cell_access" href="javascript:;">
            <div class="weui-cell__bd">
                <p></p>
            </div>
            <div class="weui-cell__ft"></div>
          </a> --}}
          <div class="weui-cell">
            <div class="weui-cell__bd">
                <p>{{ $ticket->sports->implode('name', '，') }}</p>
            </div>
            <div class="weui-cell__ft">{{ $ticket->match->street->name }}</div>
          </div>
        @endforeach
      </div>
      <div class="weui-cells__title">比赛咨询热线</div>
      <div class="weui-cells">
        <div class="weui-cell">
          <div class="weui-cell__bd">
              <p><a href="tel:88751569">88751569</a></p>
          </div>
        </div>
        <div class="weui-cell">
          <div class="weui-cell__bd">
              <p><a href="tel:15716192599">15716192599</a></p>
          </div>
        </div>
      </div>
  	</div>
  </body>
</html>
