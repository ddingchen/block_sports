@extends('admin.layout')

@section('page-title', '赛事成绩确认')

@section('content')
<h3>{{ $match->title }}[{{ $ticket->owner->name }}]</h3>
<form method="post" action="/admin/match/{{ $match->id }}/ticket/{{ $ticket->id }}/result">
	{{ csrf_field() }}
	{{-- <div class="form-group">
		<label>视频路径</label>
		<input type="text" class="form-control" name="video" value="{{ $result->video }}">
	</div>
	<div class="form-group">
		<label>荣誉</label>
		<input type="text" class="form-control" name="honour" value="{{ $result->honour }}">
	</div>
	<label>视频预览</label>
	<video src="{{ $result->video }}" controls></video> --}}
	<input type="hidden" name="owner_id" value="{{ $ticket->owner->id }}">
	<div class="form-group">
		<label>成绩分数</label>
		<input type="text" class="form-control" name="score">
	</div>
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
