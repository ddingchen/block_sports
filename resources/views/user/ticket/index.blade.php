@extends('layout', ['hideTab' => true])

@section('title', '中铠街区体育－我的报名')

@section('content')
<div class="weui-cells__title">报名项目</div>
<div class="weui-cells">
  @forelse($tickets as $ticket)
    <div class="weui-cell">
      <div class="weui-cell__bd">
          <p>{{ $ticket->sports->implode('name', '，') }}</p>
      </div>
      <div class="weui-cell__ft">{{ $ticket->match->street->name }}</div>
    </div>
  @empty
    <div class="weui-cell">
      <div class="weui-cell__bd">
          <p></p>
      </div>
      <div class="weui-cell__ft">尚未报名任何项目</div>
    </div>
  @endforelse
</div>
<div class="weui-cells__title">比赛咨询热线</div>
<div class="weui-cells">
  <div class="weui-cell">
    <div class="weui-cell__bd">
        <p><a href="tel:88751569">88751569</a></p>
    </div>
  </div>
  <div class="weui-cell">
    <div class="weui-cell__bd">
        <p><a href="tel:15716192599">15716192599</a></p>
    </div>
  </div>
</div>
@endsection
