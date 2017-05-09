@extends('layout', ['hideTab' => true])

@section('title', '添加队员')

@section('content')
<div class="header weui-flex">
	<div class="weui-flex__item">
		<i class="fa fa-users"></i>
		<span>战队加入-{{ $team->name }}</span>
	</div>
	<div class="top-bar">
		<a href="javascript:history.back()"><i class="fa fa-close fa-lg"></i></a>
	</div>
</div>

<div class="weui-cells">
	<div class="weui-cell">
		<div class="weui-cell__bd qrcode">
			<p class="tip">扫描下方二维码<br/>即成为战队成员</p>
			<img src="/i/team/{{ $team->id }}/qrCode">
		</div>
	</div>
</div>

@endsection

@section('css')
<style type="text/css">
.qrcode .tip {
	font-size: 16px;
	text-align: center;
	color: #999;
}
.qrcode img {
	margin: 0 auto;
	display: block;
	border: none;
}
</style>
@endsection
