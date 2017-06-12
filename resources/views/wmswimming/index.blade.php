@extends('layouts.wm')

@section('content')
<div class="container">
	<div class="page js_show">
	{{-- 	<div class="page__hd">
			<h1 class="page__title">无锡网民公益游泳比赛</h1>
		</div> --}}
		{{-- <div class="page__bd"> --}}
			<article class="weui-article">
				<h1>
					无锡网民公益游泳比赛<br/>
					<small>——暨中韩对抗赛</small>
				</h1>
	            <section>
	                <img src="/image/wm_banner.jpeg">
	            </section>
	            <section>
	                <a class="weui-btn weui-btn_primary" href="/wm/group">前往报名</a>
					<a class="weui-btn weui-btn_plain-primary" href="/wm/i/ticket">报名查询</a>
	            </section>
	        </article>
        {{-- </div> --}}
	</div>
</div>
@endsection
