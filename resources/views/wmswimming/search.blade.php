@extends('layouts.wm')

@section('css')
<style type="text/css">
	.result {
		margin: 20px 0;
	}
</style>
@endsection

@section('content')
	<div class="container">
		<div class="page js_show">
			<div class="page__hd">
				<h1 class="page__title">报名查询</h1>
				<p class="page__desc">
					请于下方输入完整的身份证号及相应姓名进行查询<br/>
					如发现提交的报名信息有误，可致电客服修改<br/>
					客服热线：<a href="tel:0510-88751569">0510-88751569</a><br/>
					咨询时间：工作日 10:00～17:00
				</p>
			</div>

			<div class="page__bd">
				<form method="get" action="">
					<div class="weui-cells">
						<div class="weui-cell">
						    <div class="weui-cell__hd"><label class="weui-label">真实姓名</label></div>
						    <div class="weui-cell__bd">
						    	<small></small>
						        <input class="weui-input" type="text" name="realname" placeholder="请输入真实姓名" value="{{ request('realname') }}">
						    </div>
						</div>
						<div class="weui-cell">
						    <div class="weui-cell__hd"><label class="weui-label">身份证号</label></div>
						    <div class="weui-cell__bd">
						    	<small></small>
						        <input class="weui-input" type="text" name="idcard_no" placeholder="请输入二代身份证号码" value="{{ request('idcard_no') }}">
						    </div>
						</div>
					</div>

					<div class="weui-btn-area">
			            <button type="submit" class="weui-btn weui-btn_primary">查询</button>
			        </div>
				</form>

				<div class="result">
					@forelse($tickets as $ticket)
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
						                <span class="weui-form-preview__value">
						                	@if($registion->team_name) [ {{ $registion->team_name }} ] @endif
						                	{{ $registion->realname }}
						                </span>
						            </div>
						            @endforeach
					            @else
					            	<div class="weui-form-preview__item">
						                <label class="weui-form-preview__label">参赛人员</label>
						                <span class="weui-form-preview__value">
						                	@if($ticket->registion->team_name) [ {{ $ticket->registion->team_name }} ] @endif
						                	{{ $ticket->registion->realname }}
						                </span>
						            </div>
					            @endif
					            <div class="weui-form-preview__item">
					                <label class="weui-form-preview__label">报名费用</label>
					                <span class="weui-form-preview__value">¥{{$ticket->group->price}}.00</span>
					            </div>
					        </div>
					        @if($ticket->paid)
					        <div class="weui-form-preview__ft">
					            <a class="weui-form-preview__btn weui-form-preview__btn_default" href="/wm/ticket/{{ $ticket->id }}?realname={{ request('realname') }}&idcard_no={{ request('idcard_no') }}">报名详情</a>
					        </div>
					        @else
					        <div class="weui-form-preview__ft">
				                <a class="weui-form-preview__btn weui-form-preview__btn_default" href="/wm/ticket/{{ $ticket->id }}?realname={{ request('realname') }}&idcard_no={{ request('idcard_no') }}">报名详情</a>
				                <a class="weui-form-preview__btn weui-form-preview__btn_primary" href="/wm/pay?ticket={{$ticket->id}}">继续支付</a>
				            </div>
					        @endif
					    </div>
					    @if(!$loop->last) <br/> @endif
					@empty
						<div class="weui-msg">
							<p class="weui-msg__desc">没有查询到任何报名记录</p>
						</div>
				    @endforelse
			    </div>
			</div>
		</div>
	</div>
@endsection
