@extends('layout')

@section('title', '街区运动会－排行榜')

@section('content')
  <div class="weui-navbar">
    @foreach($sports as $tmpSport)
      <div class="weui-navbar__item @if($tmpSport->id == $sport->id) weui-bar__item_on @endif" data-sport-id="{{ $tmpSport['id'] }}">
          {{ $tmpSport['name'] }}
      </div>
    @endforeach
  </div>
  <div class="weui-tab__panel">
    <div class="weui-cells__title standard">{{ $sport->standard }}</div>
    <div class="weui-cells">
      @foreach($list as $item)
        <div class="weui-cell @if($item['rank']==1) gold @elseif($item['rank']==2) sliver @elseif($item['rank']==3) bronze @endif">
            <div class="weui-cell__bd">
                <p>{{ $item['rank'] }} {{ $item['name'] }}</p>
            </div>
            <div class="weui-cell__ft">{{ $item['readable_score'] }}</div>
        </div>
      @endforeach
    </div>
  </div>
@endsection

@section('js')
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">
    wx.config({!! $js->config(array('onMenuShareTimeline', 'onMenuShareAppMessage'), false) !!});
</script>
<script type="text/javascript">
$('.weui-navbar__item').click(function() {
  var sportId = $(this).data('sport-id')
  window.location.href = '/sport/' + sportId + '/top-list'
})
wx.ready(function(){
  wx.onMenuShareTimeline({
      title: '街区体育排行榜',
      link: window.location.href,
      imgUrl: 'http://mmbiz.qpic.cn/mmbiz_jpg/oMibuKYSu2KtcLUtQjnrYuDaYVjiazDv2SQQ1zBQLGeqQWcFoSnuBcF0VHibg07vVf38w9XkI3yayxUT6NhUgFGLg/0?wx_fmt=jpeg'
  })
  wx.onMenuShareAppMessage({
      title: '街区体育排行榜',
      desc: '{{ $sport->name }}排行榜',
      link: window.location.href,
      imgUrl: 'http://mmbiz.qpic.cn/mmbiz_jpg/oMibuKYSu2KtcLUtQjnrYuDaYVjiazDv2SQQ1zBQLGeqQWcFoSnuBcF0VHibg07vVf38w9XkI3yayxUT6NhUgFGLg/0?wx_fmt=jpeg',
      type: 'link'
  })
});
</script>
@endsection

@section('css')
<style type="text/css">
  .weui-cell__bd p {
    padding-left: 25px;
  }
  .gold .weui-cell__bd:before,
  .sliver .weui-cell__bd:before,
  .bronze .weui-cell__bd:before {
    content: '';
    position: absolute;
    display: block;
    left: 8px;
    top: 0;
    width: 30px;
    height: 44px;
    background-image: url('/image/medal.png');
    background-size: 300%;
    background-position: 0px 0;
    background-repeat: no-repeat;
  }
  .gold .weui-cell__bd:before {
    background-position: 0 0;
  }
  .sliver .weui-cell__bd:before {
    background-position: -30px 0;
  }
  .bronze .weui-cell__bd:before {
    background-position: -60px 0;
  }
  .standard {
    text-align: right;
  }
</style>
@endsection
