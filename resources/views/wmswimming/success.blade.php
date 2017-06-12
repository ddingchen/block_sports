@extends('layouts.wm')

@section('content')
<div class="container">
	<div class="page msg_success js_show">
	    <div class="weui-msg">
	        <div class="weui-msg__icon-area"><i class="weui-icon-success weui-icon_msg"></i></div>
	        <div class="weui-msg__text-area">
	            <h2 class="weui-msg__title">报名成功</h2>
	            <p class="weui-msg__desc">
	            	每个身份证号最多可以报名两个项目<br/>
	            	更多比赛信息可以查看<a href="javascript:void(0);">比赛规程</a>
	            </p>
	        </div>
	        <div class="weui-msg__opr-area">
	            <p class="weui-btn-area">
	                <a href="/wm/group" class="weui-btn weui-btn_primary">继续报名</a>
	                <a href="/wm/i/ticket" class="weui-btn weui-btn_default">查看我的报名</a>
	            </p>
	        </div>
	    </div>
	</div>
</div>
@endsection
