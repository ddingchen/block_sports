@extends('layout', ['hideTab' => true])

@section('title', '中铠街区体育－报名')

@section('content')
<form id="app" method="post">
	{{ csrf_field() }}
	{{-- <div class="weui-cells__title">所在区域</div>
	<div class="weui-cells weui-cells_form">
	    <div class="weui-cell weui-cell_select weui-cell_select-after">
	        <div class="weui-cell__hd">
	            <label class="weui-label">街道</label>
	        </div>
	        <div class="weui-cell__bd">
	            <select class="weui-select" name="match">
	            	<option class="placeholder" value="-1">请选择所在街道</option>
	            	@foreach($matches as $tmpMatch)
	                <option value="{{ $tmpMatch->id }}" data-street="{{ $tmpMatch->street->id }}" @if($match->id==$tmpMatch->id) selected @endif>{{ $tmpMatch->street->name }}</option>
	                @endforeach
	            </select>
	        </div>
	    </div>
	    <div class="weui-cell weui-cell_select weui-cell_select-after area-field">
	        <div class="weui-cell__hd">
	            <label class="weui-label">小区</label>
	        </div>
	        <div class="weui-cell__bd">
	            <select class="weui-select" name="area">
	            	<option class="placeholder" value="-1">请选择所在小区</option>
	            	@foreach($areas as $area)
	            	<option value="{{ $area->id }}">{{ $area->name }}</option>
	            	@endforeach
	            	<option class="placeholder" value="0">以上都不是</option>
	            </select>
	        </div>
	    </div>
	    <div class="weui-cell area-custom-field" style="display: none;">
	        <div class="weui-cell__hd"><label class="weui-label">小区</label></div>
	        <div class="weui-cell__bd">
	            <input name="custom_area" class="weui-input" type="text" value="" placeholder="请输入所在小区名称（无需门牌号）">
	        </div>
	    </div>
	    <div class="weui-cell block-field" @if(!old('block'))style="display: none;"@endif>
	        <div class="weui-cell__hd"><label class="weui-label">社区</label></div>
	        <div class="weui-cell__bd">
	            <input name="block" class="weui-input" type="text" readonly="true" value="{{ old('block') }}">
	        </div>
	    </div>
	</div> --}}
	<div class="weui-cells__title">运动项目<span class="sport-tip"><span></div>
	<div class="weui-cells weui-cells_checkbox">
	    <label class="weui-cell weui-check__label" for="sport">
	        <div class="weui-cell__hd">
	            <input type="checkbox" class="weui-check" id="sport" checked onclick="return false" />
	            <i class="weui-icon-checked"></i>
	        </div>
	        <div class="weui-cell__bd">
	            <p>{{ $match->sport->name }}</p>
	        </div>
	    </label>
	</div>
	@if($match->sport->is_group)
	<div class="weui-cells__title group-info">参赛信息</div>
	<div class="weui-cells weui-cells_form group-info">
	    <div class="weui-cell">
	        <div class="weui-cell__hd"><label class="weui-label">团队名称</label></div>
	        <div class="weui-cell__bd">
	            <input name="team_name" class="weui-input" type="text" placeholder="参赛队名，例：XXX队" value="">
	        </div>
	    </div>
	</div>
	@endif
	<div class="weui-cells__title">联系方式</div>
		<div class="weui-cells weui-cells_form">
	    <div class="weui-cell">
	        <div class="weui-cell__hd"><label class="weui-label">联系人</label></div>
	        <div class="weui-cell__bd">
	            <input name="name" class="weui-input" type="text" placeholder="请输入参赛人姓名" value="{{ $user->name }}" data-old-name="{{ $user->name }}">
	        </div>
	    </div>
	    <div class="weui-cell">
	        <div class="weui-cell__hd"><label class="weui-label">联系电话</label></div>
	        <div class="weui-cell__bd">
	            <input name="tel" class="weui-input" type="text" placeholder="请输入参赛人联系方式" value="{{ $user->tel }}" data-old-tel="{{ $user->tel }}">
	        </div>
	    </div>
	    <input type="hidden" name="contact_confirm" value="0">
	</div>
	<div style="padding: 20px 15px;">
		<input type="submit" class="weui-btn weui-btn_primary" value="确认提交">
	</div>

{{-- 	<div class="weui-cells__tips">赛制规则说明：
	    @foreach($sports as $sport)
	    <a class="sport-rule" href="{{ $sport->fileOfGameRule }}">{{ $sport->name }}</a>@if(!$loop->last)，@endif
	    @endforeach
	</div> --}}
</form>
@endsection

@section('js')
<script src="{{ mix('/js/ticket/create.js') }}"></script>
@endsection

@section('css')
<style type="text/css">
.sport-rule {
	text-decoration: underline;
}
.team-tip {
	color: #E64340;
}
</style>
@endsection
