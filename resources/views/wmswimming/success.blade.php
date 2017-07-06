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
	            	更多比赛信息可以查看<a href="http://mp.weixin.qq.com/s?__biz=MzAwNTAyNzEwOQ==&mid=503151796&idx=1&sn=8fb6cbde5a2d543828b9e13c02d72dcf&chksm=032b38fe345cb1e860d1e2260dc713e9fa4b8b239281f2798dbae5157c6a18579c8e12b34db7">比赛规程</a>
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
