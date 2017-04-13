@extends('admin.layout')

@section('title', '添加赛事组')

@section('content')
<form method="post" action="/admin/group">
	{{ csrf_field() }}
	@include('admin.group.form', ['containsMatches' => []])
	<button type="submit" class="btn btn-primary btn-block btn-lg">创建</button>
</form>
@endsection
