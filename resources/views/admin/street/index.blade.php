@extends('admin.layout')

@section('page-title', '街道列表')

@section('content')
<div class="table-responsive">
	<table class="table">
		<thead>
			<th>名称</th>
			<th></th>
			<th></th>
		</thead>
		<tbody>
			@foreach($streets as $street)
			<tr>
				<td>{{ $street->name }}</td>
				<td><a class="btn btn-primary btn-xs" href="/admin/street/{{ $street->id }}/blocks/import">导入社区</a></td>
				<td><a class="btn btn-default btn-xs" href="/admin/block?street={{ $street->id }}">社区列表</a></td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
<a class="btn btn-success btn-block btn-lg" href="/admin/street/create">添加街道</a>
@endsection
