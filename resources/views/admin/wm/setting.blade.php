@extends('admin.layout')

@section('content')
<form method="post" action="/admin/wm/setting" enctype="multipart/form-data" >
	{{ csrf_field() }}
	@if(session('status') == 'success')
	<div class="alert alert-success" role="alert">更新成功！</div>
	@endif
	<div class="form-group">
	    <label for="title">标题</label>
	    <input type="text" name="title" class="form-control" id="title" value="{{ $setting->title or '' }}">
	</div>
	<div class="form-group">
	    <label for="sub_title">副标题</label>
	    <input type="text" name="sub_title" class="form-control" id="sub_title" value="{{ $setting->sub_title or '' }}">
	</div>
	<label>报名通道开启／关闭</label>
	<div class="radio">
	  <label>
	    <input type="radio" name="enable_register" value="1" @if($setting && $setting->enable_register) checked @endif>开启
	  </label>
	</div>
	<div class="radio">
	  <label>
	    <input type="radio" name="enable_register" value="0" @if(!($setting && $setting->enable_register)) checked @endif>关闭
	  </label>
	</div>
	<div class="form-group">
	    <label for="banner">报名主页大图</label>
	    <input type="file" name="banner" id="banner" accept="image/jpeg">
	    <p class="help-block">上传图片不宜过大，300KB以下为宜，格式jpg</p>
	</div>
	<button type="submit" class="btn btn-success">应用</button>
</form>
@endsection
