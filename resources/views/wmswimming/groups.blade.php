@extends('layouts.wm')

@section('content')
<div class="container">
    <div class="page js_show">
        <div class="page__hd">
            <h1 class="page__title">选择竞赛项目</h1>
            <p class="page__desc">
                每人（按身份证号）最多可报两个项目<br/>
                可以多次报名或代理报名
            </p>
        </div>

        <div class="page__bd">
            <div class="weui-cells">
                @foreach($groups as $group)
                <a class="weui-cell weui-cell_access" href="/wm/group/{{ $group->id }}/register">
                    <div class="weui-cell__bd">
                        <p>{{ $group->name . ($group->team_required ? '（两男两女）' : '') }}</p>
                    </div>
                    <div class="weui-cell__ft">
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>


</div>
@endsection
