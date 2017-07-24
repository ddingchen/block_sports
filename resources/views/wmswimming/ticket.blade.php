@extends('layouts.wm')

@section('content')
<div class="container">
	<div class="page js_show">
		<div class="page__hd">
			<h1 class="page__title">报名详情</h1>
			<p class="page__desc">
				如发现提交的报名信息有误，可致电客服修改<br/>
				客服热线：<a href="tel:0510-88751569">0510-88751569</a><br/>
				咨询时间：工作日 10:00～17:00
				@if(!$ticket->paid)
				<br/>
				未支付的报名可在底部点击“取消报名”，并进行其他报名
				@endif
			</p>
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
			@if(!$ticket->paid)
			<div class="weui-btn-area">
				<form method="post" action="/wm/ticket/{{ $ticket->id }}">
					{{ csrf_field() }}
					{{ method_field('delete') }}
	            	<button type="submit" class="weui-btn weui-btn_warn">取消报名</button>
				</form>
	        </div>
	        @endif
		</div>
	</div>
</div>
@endsection

@section('js')
<script type="text/javascript">
$('form').submit(function() {
	if(!confirm('删除后报名信息将不可找回，是否继续？')) {
		return false;
	}
})

</script>
@endsection
