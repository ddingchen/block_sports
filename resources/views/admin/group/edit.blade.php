@extends('admin.layout')

@section('title', '管理赛事组')

@section('content')
<form method="post" action="/admin/group/{{ $group->id }}">
	{{ csrf_field() }}
	{{ method_field('put') }}
	@include('admin.group.form')
	<button type="submit" class="btn btn-primary btn-block btn-lg">更新</button>
</form>
@endsection
