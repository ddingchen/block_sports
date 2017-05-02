@extends('layout')

@section('title', '中铠街区体育－报名通道')

@section('content')
<div class="swiper-container">
    <div class="swiper-wrapper">
        <img class="swiper-slide" src="/image/slider/slide1.jpg">
        <img class="swiper-slide" src="/image/slider/slide2.jpg">
        <img class="swiper-slide" src="/image/slider/slide3.jpg">
        <img class="swiper-slide" src="/image/slider/slide4.jpg">
        <img class="swiper-slide" src="/image/slider/slide5.jpg">
        <img class="swiper-slide" src="/image/slider/slide6.jpg">
    </div>
    <div class="swiper-pagination"></div>
</div>

<div class="weui-panel weui-panel_access">
    <div class="weui-panel__bd">
        @foreach($groups as $group)
        <a class="weui-media-box weui-media-box_text" href="/match/group/{{ $group->id }}" style="display: block">
            <h4 class="weui-media-box__title">{{ $group->title }}
                <span class="weui-badge" style="float: right;">火热招募</span>
            </h4>
            <p class="weui-media-box__desc">{{ $group->sub_title }}</p>
            <ul class="weui-media-box__info">
                <li class="weui-media-box__info__meta">发布时间</li>
                <li class="weui-media-box__info__meta">{{ $group->matches->first()->created_at->diffForHumans() }}</li>
                <li class="weui-media-box__info__meta weui-media-box__info__meta_extra">官方发布</li>
            </ul>
        </a>
        @endforeach
    </div>
</div>
@endsection

@section('js')
<script src="http://cdn.bootcss.com/Swiper/3.4.2/js/swiper.jquery.js"></script>
<script type="text/javascript">
$(document).ready(function () {
    //initialize swiper when document ready
    var mySwiper = new Swiper ('.swiper-container', {
        pagination: '.swiper-pagination',
        slidesPerView: 'auto',
        centeredSlides: true,
        paginationClickable: false,
        spaceBetween: 30,
        loop: true,
        autoplay: 2000
    })
});
</script>
@endsection

@section('css')
<link href="http://cdn.bootcss.com/Swiper/3.4.2/css/swiper.min.css" rel="stylesheet">
<style type="text/css">
.swiper-container {
    width: 100%;
    height: 300px;
    margin: 10px auto;
}
.swiper-slide {
    text-align: center;
    font-size: 18px;
    background: #fff;
    width: auto;
    /* Center slide text vertically */
    display: -webkit-box;
    display: -ms-flexbox;
    display: -webkit-flex;
    display: flex;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    -webkit-justify-content: center;
    justify-content: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    -webkit-align-items: center;
    align-items: center;
}
</style>
@endsection
