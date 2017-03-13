@extends('admin.layout')

@section('page-title', '社区列表')

@section('content')
<div class="table-responsive">
	<table class="table">
		<thead>
			<th>名称</th>
			<th></th>
			<th></th>
		</thead>
		<tbody>
			@foreach($blocks as $block)
			<tr>
				<td>{{ $block->name }}</td>
				<td><a class="btn btn-primary btn-xs" href="/admin/block/{{ $block->id }}/edit">编辑名称</a></td>
				<td><a class="btn btn-default btn-xs" href="/admin/area?block={{ $block->id }}">小区列表</a></td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
<a class="btn btn-success btn-block btn-lg" href="/admin/block/create">添加社区</a>
@endsection
