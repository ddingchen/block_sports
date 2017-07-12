@extends('layouts.wm')

@section('content')
<div class="container">
	<div class="page js_show">
		<div class="page__hd">
			<h1 class="page__title">订单支付</h1>
			<p class="page__desc">网民全民健身游泳比赛报名</p>
		</div>

		<div class="page__bd">
			<div class="weui-form-preview">
		        <div class="weui-form-preview__hd">
		            <div class="weui-form-preview__item">
		                <label class="weui-form-preview__label">付款金额</label>
		                <em class="weui-form-preview__value">¥{{$ticket->group->price}}.00</em>
		            </div>
		        </div>
		        <div class="weui-form-preview__bd">
		            <div class="weui-form-preview__item">
		                <label class="weui-form-preview__label">报名项目</label>
		                <span class="weui-form-preview__value">{{ $ticket->group->name }}</span>
		            </div>
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
		                <label class="weui-form-preview__label">收费规则</label>
		                <span class="weui-form-preview__value">每人每项20元</span>
		            </div>
		        </div>
		    </div>

		    @if($isWeChatBrowser)
				<div class="weui-btn-area">
					@if(app()->isLocal())
					@php
						$ticket->paid = true;
						$ticket->paid_at = \Carbon\Carbon::now();
						$ticket->save();
					@endphp
		            <a href="/wm/success" class="weui-btn weui-btn_primary">微信支付</a>
		            @else
		            <a href="javascript:" onclick="callPay()" class="weui-btn weui-btn_primary">微信支付</a>
		            @endif
		        </div>
	        @else
	        	<div style="display: flex; flex-direction: column; margin: 20px;">
		        	<p style="text-align: center">扫描下方二维码完成支付</p>
		        	<img src="/storage/pay_qrcode/{{ $ticket->id }}.png">
				</div>
				<div class="weui-btn-area">
		            <a href="javascript:" class="weui-btn weui-btn_primary" onclick="complete()">我已成功支付</a>
		        </div>
	        @endif
		</div>
	</div>
</div>
@endsection

@section('js')
<script type="text/javascript">
function complete() {
	alert('可在主页进入“报名查询”，查询报名记录')
	window.location.href = '/wm'
}

function onBridgeReady(){
   WeixinJSBridge.invoke(
       	'getBrandWCPayRequest',
		{!! $jsApiParameters !!} @if($jsApiParameters),@endif
		function(res){
			if(res.err_msg == "get_brand_wcpay_request:ok") {
				window.location.href = '/wm/success';
			} else {
				alert('支付失败，请于主页进入“报名查询”，找回您的报名并重新发起支付。');
				window.location.href = '/wm';
			}
		}
   );
}

function callPay() {
	if (typeof WeixinJSBridge == "undefined"){
	   if( document.addEventListener ){
	       document.addEventListener('WeixinJSBridgeReady', onBridgeReady, false);
	   }else if (document.attachEvent){
	       document.attachEvent('WeixinJSBridgeReady', onBridgeReady);
	       document.attachEvent('onWeixinJSBridgeReady', onBridgeReady);
	   }
	}else{
	   onBridgeReady();
	}
}
</script>
@endsection
