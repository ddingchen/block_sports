@extends('layouts.wm')

@section('content')
<div class="container">
	<div class="page js_show">
		<div class="page__hd">
			<h1 class="page__title">报名详情</h1>
			<p class="page__desc">如需更改报名信息，请发送“更改报名信息”至公众号后台，并根据提示发送需要更改的内容</p>
		</div>

		<div class="page__bd">
			<div class="weui-cells">
				<div class="weui-cell">
			        <div class="weui-cell__bd">
			            <p>报名项目</p>
			        </div>
			        <div class="weui-cell__ft">{{ $ticket->group->name }}</div>
			    </div>
			</div>
			@if($ticket->group->team_required)
				@foreach($ticket->registion->registions as $registion)
					@include('wmswimming.registion', ['registion' => $registion])
				@endforeach
			@else
				@include('wmswimming.registion', ['registion' => $ticket->registion])
			@endif
		</div>
	</div>
</div>


@endsection
