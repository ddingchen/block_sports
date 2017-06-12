@extends('layout', ['hideTab' => true])

@section('title', '我的战队')

@section('content')
<div class="header weui-flex">
	<div class="weui-flex__item">
		<i class="fa fa-users"></i>
		<span class="nickname">我的战队</span>
	</div>
	<div class="top-bar">
		<a href="/i/team/create"><i class="fa fa-plus fa-lg"></i></a>
	</div>
</div>
<div>
	@if(!$teams->isEmpty())
	<div class="weui-cells">
		@foreach($teams as $team)
		<a class="weui-cell weui-cell_access" href="/i/team/{{ $team->id }}">
            <div class="weui-cell__bd">
                <p>{{ $team->name }}</p>
            </div>
            <div class="weui-cell__ft">
            </div>
        </a>
		@endforeach
	</div>
	@else
	<p class="empty-tip">尚未组建任何战队</p>
	<div class="small-btn">
		<a href="/i/team/create" class="weui-btn weui-btn_plain-primary">添加战队</a>
	</div>
	@endif
</div>
@endsection
