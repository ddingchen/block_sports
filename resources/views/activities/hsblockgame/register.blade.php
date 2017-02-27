<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>街区运动会－报名通道</title>
    <link rel="stylesheet" type="text/css" href="{{ mix('css/activities/hsblockgame.css') }}">
  </head>
  <body>
  	<form id="app" method="post" action="/activities/hsblockgame"
  	v-on:submit="confirm">
  		{{ csrf_field() }}
	    <div class="weui-cells__title">联系方式</div>
	  	<div class="weui-cells weui-cells_form">
	        <div class="weui-cell">
	            <div class="weui-cell__hd"><label class="weui-label">联系人</label></div>
	            <div class="weui-cell__bd">
	                <input name="name" class="weui-input" type="text" placeholder="请输入参赛人姓名" value="{{ old('name') }}">
	            </div>
	        </div>
	        <div class="weui-cell">
	            <div class="weui-cell__hd"><label class="weui-label">联系电话</label></div>
	            <div class="weui-cell__bd">
	                <input name="tel" class="weui-input" type="text" placeholder="请输入参赛人联系方式" value="{{ old('tel') }}">
	            </div>
	        </div>
	        <div class="weui-cell weui-cell_select weui-cell_select-after">
	            <div class="weui-cell__hd">
	                <label class="weui-label">小区</label>
	            </div>
	            <div class="weui-cell__bd">
	                <select class="weui-select" name="area">
	                	@foreach($residentialAreas as $area)
	                    <option value="{{ $area->id }}" @if(old('area')==$area->id) selected @endif>{{ $area->name }}</option>
	                    @endforeach
	                </select>
	            </div>
	        </div>
	    </div>
	    <div class="weui-cells__title">参与项目（建议最多报名两项）</div>
	    <div class="weui-cells weui-cells_checkbox">
	    	@foreach($sports as $sport)
	        <label class="weui-cell weui-check__label" for="s{{ $sport->id }}">
	            <div class="weui-cell__hd">
	                <input type="checkbox" class="weui-check" name="sports[]" id="s{{ $sport->id }}" value="{{ $sport->id }}" @if(old('sports') && in_array($sport->id,old('sports'))) checked @endif>
	                <i class="weui-icon-checked"></i>
	            </div>
	            <div class="weui-cell__bd">
	                <p>{{ $sport->name }}</p>
	            </div>
	        </label>
	        @endforeach
	    </div>
	    <div class="weui-cells__tips">赛制规则说明：<a href="#">羽毛球</a>，<a href="#">篮球</a>，<a href="#">足球</a></div>
	    <div style="padding: 0 15px">
	    	<input type="submit" class="weui-btn weui-btn_primary" value="确认提交">
	    </div>
  	</form>
  	<script type="text/javascript">
  	@if (count($errors) > 0)
       	alert('{{$errors->all()[0]}}')
	@endif
	</script>
  	<script type="text/javascript" src="{{ mix('js/activities/hsblockgame.js') }}"></script>
  </body>
</html>
