@extends('layouts.wm')

@section('css')
<style type="text/css">
    h1 {
        text-align: center;
    }
    img {
        display: block;
        margin: auto;
        margin-bottom: 20px;
    }
    .rule {
        text-decoration: underline;
        color: #1AAD19
    }
    @media screen and (min-width: 768px) {
        img {
            width: 600px;
        }
    }
</style>
@endsection

@section('content')
<div class="container">
	<div class="page js_show">
		<article class="weui-article">
			<h1>
				{{ $setting->title }}
				@if($setting->sub_title)
				<br/>
				<small>{{ $setting->sub_title }}</small>
				@endif
			</h1>
            <img src="/storage/image/wm_banner.jpg">
            <section>
            	<a href="http://mp.weixin.qq.com/s?__biz=MzAwNTAyNzEwOQ==&mid=503151796&idx=1&sn=8fb6cbde5a2d543828b9e13c02d72dcf&chksm=032b38fe345cb1e860d1e2260dc713e9fa4b8b239281f2798dbae5157c6a18579c8e12b34db7">
            		<h1 class="rule">完整赛事规程</h1>
            	</a>
            </section>
            <section>
            	@if($setting->enable_register)
                <a class="weui-btn weui-btn_primary" href="/wm/type">前往报名</a>
                @else
                <a class="weui-btn weui-btn_primary weui-btn_disabled" href="javascript:">报名未开启</a>
                @endif
				<a class="weui-btn weui-btn_plain-primary" href="/wm/tickets/search">报名查询</a>
            </section>
        </article>
	</div>
</div>
@endsection
