@extends('admin.layout')

@section('page-title', '管理员列表')

@section('content')
	<h3>管理员列表</h3>
	<div class="list-group">
	  @foreach($adminList as $admin)
	  <a href="#" class="list-group-item">{{ $admin->nickname }}</a>
	  @endforeach
	</div>
	<a class="btn btn-success" href="/admin/role/create" role="button">添加管理员</a>
@endsection
