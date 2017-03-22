@extends('admin.layout')

@section('page-title', '赛事成绩确认')

@section('content')
<form method="post" action="/admin/match/result/{{ $result->id }}">
	{{ csrf_field() }}
	{{ method_field('PUT') }}
	<div class="form-group">
		<label>视频路径</label>
		<input type="text" class="form-control" name="video" value="{{ $result->video }}">
	</div>
	<div class="form-group">
		<label>荣誉</label>
		<input type="text" class="form-control" name="honour" value="{{ $result->honour }}">
	</div>
	<label>视频预览</label>
	<video src="{{ $result->video }}" controls></video>
	<button class="btn btn-primary btn-block btn-lg" type="submit">提交保存</button>
</form>
@endsection

@section('page-js')
<script type="text/javascript">
@if (count($errors) > 0)
  alert('{{$errors->all()[0]}}')
@endif
</script>
@endsection

@section('page-css')
<style type="text/css">
	video{
		width: 90%;
		margin: 5%;
		border: solid 1px #ddd;
	}
</style>
@endsection
