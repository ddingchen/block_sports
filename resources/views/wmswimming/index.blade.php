@extends('layouts.wm')

@section('content')
<div class="container">
	<div class="page js_show">
		<article class="weui-article">
			<h1 style="text-align: center;">
				{{ $setting->title }}
				@if($setting->sub_title)
				<br/>
				<small>{{ $setting->sub_title }}</small>
				@endif
			</h1>
            <section>
                <img src="/storage/image/wm_banner.jpg">
            </section>
            <section>
            	<a href="http://mp.weixin.qq.com/s?__biz=MzAwNTAyNzEwOQ==&mid=503151796&idx=1&sn=8fb6cbde5a2d543828b9e13c02d72dcf&chksm=032b38fe345cb1e860d1e2260dc713e9fa4b8b239281f2798dbae5157c6a18579c8e12b34db7#rd">
            		<h1 style="text-decoration: underline; text-align: center; color: #1AAD19">完整赛事规程</h1>
            	</a>
            </section>
            <section>
            	@if($setting->enable_register)
                <a class="weui-btn weui-btn_primary" href="/wm/group">前往报名</a>
                @else
                <a class="weui-btn weui-btn_primary weui-btn_disabled" href="javascript:">报名未开启</a>
                @endif
				<a class="weui-btn weui-btn_plain-primary" href="/wm/i/ticket">我的报名</a>
            </section>
        </article>
	</div>
</div>
@endsection
