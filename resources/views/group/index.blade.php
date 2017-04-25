@extends('layout')

@section('title', '街区运动会－报名')

@section('content')
<ul>
    @foreach($groups as $group)
    <a href="/match/group/{{ $group->id }}">
        <li>
            <div class="month">{{ $group->sub_title }}</div>
            <div class="title">{{ $group->title }}</div>
            <span class="tag @if($group->top) hot @endif">
                @if($group->top)
                火热报名
                @else
                预热报名
                @endif
            </span>
        </li>
    </a>
    @endforeach
</ul>
@endsection

@section('css')
<style type="text/css">
body, html {
    margin: 0;
    padding: 0;
}
img {
    display: block;
    margin: 0;
    padding: 0;
    border: 0;
}
ul, li {
    list-style: none;
    margin: 0;
    padding: 0;
}
ul {
    margin: 10px;
}
li {
    position: relative;
    height: 140px;
    margin-bottom: 10px;
    border-radius: 10px;
    background: linear-gradient(45deg, #3fd2ff, #1f4cff, #806aff);
    overflow: hidden;
    box-shadow: #666 0 3px 5px;
}
li .title {
    position: absolute;
    right: 10px;
    bottom: 10px;
    font-size: 26px;
    color: #eef;
    text-shadow: 0px 0px 5px #eef;
}
li .month {
    position: absolute;
    right: 10px;
    bottom: 50px;
    font-size: 24px;
    font-style: initial;
    color: #eef;
    text-shadow: 0px 0px 5px #eef;
}
li .tag {
    position: absolute;
    left: -30px;
    top: 30px;
    padding: 0 30px;
    background-color: #3fd2ff;
    box-shadow: #666 0 3px 5px;
    color: #666;
    letter-spacing: 5px;
    transform: rotate(-45deg);
    font-weight: bold;
}
li .tag.hot {
    background-color: #E64340;
    color: #eef;
}
</style>
@endsection
