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
  		<div class="weui-cells__title">联系方式</div>
  		<div class="weui-cells">
            <div class="weui-cell">
                <div class="weui-cell__bd">
                    <p>{{ $user->name }}</p>
                </div>
                <div class="weui-cell__ft">{{ $user->tel }}</div>
            </div>
        </div>
        <div class="weui-cells__title">报名项目</div>
  		<div class="weui-cells">
  			@foreach($sports as $sport)
            <a class="weui-cell weui-cell_access" href="{{ $sport->fileOfGameRule }}">
                <div class="weui-cell__bd">
                    <p>{{ $sport->name }}</p>
                </div>
                <div class="weui-cell__ft">
                </div>
            </a>
        @endforeach
      </div>
      <div class="weui-cells__tips">您已报名成功</div>
  	</div>
  </body>
</html>
