@extends('admin.layout')

@section('page-title', '更改报名信息')

@section('content')
<h3>更改报名信息</h3>
<form method="post" action="/admin/wm/registion/{{ $registion->id }}">
  {{ method_field('PUT') }}
  {{ csrf_field() }}
  <div class="form-group">
    <label for="realname">真实姓名</label>
    <input type="text" class="form-control" id="realname" name="realname" value="{{ $registion->realname }}">
  </div>
  <div class="form-group">
    <label for="sex">性别</label>
    <div class="radio">
	  <label>
	    <input type="radio" name="sex" value="male" @if($registion->sex=='male') checked @endif>男
	  </label>
	</div>
	<div class="radio">
	  <label>
	    <input type="radio" name="sex" value="female" @if($registion->sex=='female') checked @endif>女
	  </label>
	</div>
  </div>
  <div class="form-group">
    <label for="tel">联系电话</label>
    <input type="text" class="form-control" id="tel" name="tel" value="{{ $registion->tel }}">
  </div>
  <div class="form-group">
    <label for="idcard_no">身份证号</label>
    <input type="text" class="form-control" id="idcard_no" name="idcard_no" value="{{ $registion->idcard_no }}">
  </div>
  <button type="submit" class="btn btn-primary btn-lg btn-block">保存修改</button>
</form>
@endsection

@section('page-js')
<script type="text/javascript">
@if (count($errors) > 0)
	alert('{{$errors->all()[0]}}')
@endif
</script>
@endsection
