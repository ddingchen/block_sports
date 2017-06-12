@extends('layouts.wm')

@section('content')
	<div class="container">
		<div class="page js_show">
			<div class="page__hd">
				<h1 class="page__title">我的报名</h1>
				<p class="page__desc">报名需支付完成后才生效</p>
			</div>

			<div class="page__bd">
				@foreach($tickets as $ticket)
				<div class="weui-form-preview">
			        <div class="weui-form-preview__hd">
			            <div class="weui-form-preview__item">
			                <label class="weui-form-preview__label">{{ $ticket->group->name }}</label>
			                <div class="weui-form-preview__value" style="font-size: inherit;color: #999">{{ $ticket->paid?'报名成功':'待支付' }}</div>
			            </div>
			        </div>
			        <div class="weui-form-preview__bd">
			            @if($ticket->group->team_required)
				            @foreach($ticket->registion->registions as $registion)
				            <div class="weui-form-preview__item">
				                <label class="weui-form-preview__label">@if($loop->first)参赛人员@endif</label>
				                <span class="weui-form-preview__value">{{ $registion->realname }}</span>
				            </div>
				            @endforeach
			            @else
			            	<div class="weui-form-preview__item">
				                <label class="weui-form-preview__label">参赛人员</label>
				                <span class="weui-form-preview__value">{{ $ticket->registion->realname }}</span>
				            </div>
			            @endif
			            <div class="weui-form-preview__item">
			                <label class="weui-form-preview__label">报名费用</label>
			                <span class="weui-form-preview__value">¥{{$ticket->group->price}}.00</span>
			            </div>
			        </div>
			        @if($ticket->paid)
			        <div class="weui-form-preview__ft">
			            <a class="weui-form-preview__btn weui-form-preview__btn_default" href="/wm/ticket/{{ $ticket->id }}">报名详情</a>
			        </div>
			        @else
			        <div class="weui-form-preview__ft">
		                <a class="weui-form-preview__btn weui-form-preview__btn_default" href="/wm/ticket/{{ $ticket->id }}">报名详情</a>
		                <a class="weui-form-preview__btn weui-form-preview__btn_primary" href="/wm/ticket/{{ $ticket->id }}/pay">继续支付</a>
		            </div>
			        @endif
			    </div>
			    @if(!$loop->last) <br/> @endif
			    @endforeach
			</div>
		</div>
	</div>
@endsection
