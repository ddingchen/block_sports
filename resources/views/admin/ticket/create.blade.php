@extends('admin.layout')

@section('page-title', '线下报名录入')

@section('content')
<form method="post" action="/admin/ticket">
  {{ csrf_field() }}
  <div class="form-group">
    <label for="name">姓名</label>
    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
  </div>
  <div class="form-group">
    <label>性别</label>
    <div class="radio">
	  <label>
	    <input type="radio" name="sex" value="" @if(!old('sex')) checked @endif>
	    未知
	  </label>
	</div>
	<div class="radio">
	  <label>
	    <input type="radio" name="sex" value="male" @if(old('sex')=='male') checked @endif>
	    男
	  </label>
	</div>
	<div class="radio">
	  <label>
	    <input type="radio" name="sex" value="female" @if(old('sex')=='female') checked @endif>
	    女
	  </label>
	</div>
  </div>
  <div class="form-group">
    <label for="tel">电话</label>
    <input type="number" class="form-control" id="tel" name="tel" value="{{ old('tel') }}">
  </div>
  <div class="form-group">
    <label for="area">小区</label>
    <select class="form-control" id="area" name="area">
		@foreach($areas as $area)
        <option value="{{ $area->id }}" @if(old('area')==$area->id) selected @endif>{{ $area->name }}</option>
        @endforeach
	</select>
  </div>
  <div class="form-group">
  <label for="sports">运动项目</label>
  @foreach($sports as $sport)
	<div class="checkbox">
	  <label>
	    <input type="checkbox" name="sports[]" value="{{ $sport->id }}" @if(old('sports') && in_array($sport->id, old('sports'))) checked @endif>
	    {{ $sport->name }}
	  </label>
	</div>
  @endforeach
  </div>
  <div class="form-group">
    <label for="note">备注</label>
    <input type="text" class="form-control" id="note" name="note" value="{{ old('note') }}">
  </div>
  <button type="submit" class="btn btn-primary btn-lg btn-block">提交</button>
</form>
@endsection

@section('page-js')
<script type="text/javascript">
@if (count($errors) > 0)
   	alert('{{$errors->all()[0]}}')
@endif
</script>
@endsection
