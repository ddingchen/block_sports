@extends('layout')

@section('title', '个人中心')

@section('content')
<div class="header weui-flex">
	<div class="weui-flex__item">
		<img class="head-img" src="{{ $user->avatar }}">
		<span class="nickname">{{ $user->nickname }}</span>
	</div>
	<div class="top-bar">
		<i class="fa fa-bell-o fa-lg">
			<span class="msg-dot weui-badge weui-badge_dot"></span>
		</i>
		<i class="fa fa-gear fa-lg"></i>
	</div>
</div>
<div class="weui-cells__title">好友</div>
<div class="weui-cells">
	<a class="weui-cell weui-cell_access" href="javascript:;">
	    <div class="weui-cell__bd">
	        <p>关系圈</p>
	    </div>
	    <div class="weui-cell__ft">
	    </div>
	</a>
	<a class="weui-cell weui-cell_access" href="/i/team">
	    <div class="weui-cell__bd">
	        <p>我的战队</p>
	    </div>
	    <div class="weui-cell__ft">
            <span>{{ $user->teams->count() }}</span>
	    </div>
	</a>
</div>
<div class="weui-cells__title">成就</div>
<div class="weui-cells">
	<a class="weui-cell weui-cell_access" href="javascript:;">
	    <div class="weui-cell__bd">
	        <p>任务</p>
	    </div>
	    <div class="weui-cell__ft" style="font-size: 0">
            <span style="vertical-align:middle; font-size: 17px;">新任务</span>
            <span class="weui-badge weui-badge_dot" style="margin-left: 5px;margin-right: 5px;"></span>
        </div>
	</a>
	<a class="weui-cell weui-cell_access" href="javascript:;">
	    <div class="weui-cell__bd">
	        <p>徽章</p>
	    </div>
	    <div class="weui-cell__ft">
            <span style="vertical-align:middle; font-size: 17px;">3</span>
	    </div>
	</a>
</div>
@endsection

@section('css')
<style type="text/css">
/*.header {
	box-sizing: border-box;
	height: 60px;
	background: #fff;
	align-items: center;
	padding: 15px;
	font-size: 18px;
}*/
.head-img, .nickname {
	float: left;
}
.head-img {
	margin-right: 5px;
	width: 30px;
	height: 30px;
	border-radius: 50%;
}
/*.top-bar {
	color: #666;
}*/
.top-bar i {
	margin-left: 15px;
}
.msg-dot {
	position: absolute;
	top: -.3em;
	right: -.3em;
}
</style>
@endsection
