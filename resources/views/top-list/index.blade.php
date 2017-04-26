@extends('layout')

@section('title', '中铠街区体育－排行榜')

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
    <div class="weui-cells list">
      @foreach($list as $item)
      <div class="weui-cell @if($item['rank']==1) gold @elseif($item['rank']==2) sliver @elseif($item['rank']==3) bronze @endif">
          <div class="weui-cell__hd">
            <i class="@if($item['rank']<=3) fa fa-trophy @endif">{{ $item['rank']>3?$item['rank']:'' }}</i>
          </div>
          <div class="weui-cell__bd">
              <p>{{ $item['name'] }}</p>
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
      title: '中铠街区体育-排行榜',
      link: window.location.href,
      imgUrl: 'http://mmbiz.qpic.cn/mmbiz_jpg/oMibuKYSu2KtcLUtQjnrYuDaYVjiazDv2SQQ1zBQLGeqQWcFoSnuBcF0VHibg07vVf38w9XkI3yayxUT6NhUgFGLg/0?wx_fmt=jpeg'
  })
  wx.onMenuShareAppMessage({
      title: '中铠街区体育',
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
  .weui-cell__hd {
    margin-right: 5px;
  }

  .list .gold i {
    color: #f2c056;
  }

  .list .sliver i {
    color: #e9e9d8;
  }

 .list .bronze i {
    color: #bfad6f;
  }

  .standard {
    text-align: right;
  }
</style>
@endsection
