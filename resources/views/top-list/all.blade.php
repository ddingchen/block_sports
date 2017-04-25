@extends('layout')

@section('title', '街区运动会－排行榜')

@section('content')
  <div class="weui-navbar">
    @foreach($topLists->pluck('sport') as $sport)
      <div class="weui-navbar__item @if($loop->first) weui-bar__item_on @endif" data-sport-id="{{ $sport['id'] }}">
          {{ $sport['name'] }}
      </div>
    @endforeach
  </div>
  <div class="weui-tab__panel">
  @foreach($topLists as $topList)
    <div class="weui-cells list" data-sport-id="{{ $topList['sport']['id'] }}" @if(!$loop->first) style="display: none;" @endif>
      @foreach($topList['list'] as $item)
        <div class="weui-cell @if($item['rank']==1) gold @elseif($item['rank']==2) sliver @elseif($item['rank']==3) bronze @endif">
            <div class="weui-cell__bd">
                <p>{{ $item['rank'] }} {{ $item['name'] }}</p>
            </div>
            <div class="weui-cell__ft">{{ $item['readable_score'] }}</div>
        </div>
        @endforeach
    </div>
  @endforeach
  </div>
@endsection

@section('js')
<script type="text/javascript">
  $('.weui-navbar__item').click(function() {
    $(this).addClass('weui-bar__item_on')
        .siblings().removeClass('weui-bar__item_on')
    var sportId = $(this).data('sport-id')
    $('.weui-tab__panel .weui-cells').hide()
    $('.weui-tab__panel .weui-cells[data-sport-id="' + sportId + '"]').show()
        // .siblings('.weui-tab__panel').hide()
  })
</script>
@endsection

@section('css')
<style type="text/css">
  .weui-cell__bd p {
    padding-left: 25px;
  }
  .list .gold .weui-cell__bd:before,
  .list .sliver .weui-cell__bd:before,
  .list .bronze .weui-cell__bd:before {
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
  .list .gold .weui-cell__bd:before {
    background-position: 0 0;
  }
  .list .sliver .weui-cell__bd:before {
    background-position: -30px 0;
  }
  .list .bronze .weui-cell__bd:before {
    background-position: -60px 0;
  }
</style>
@endsection
