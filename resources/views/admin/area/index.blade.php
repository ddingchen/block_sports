@extends('admin.layout')

@section('page-title', '小区列表')

@section('content')
<div class="table-responsive">
	<table class="table">
		<caption>{{ $block ? $block->name . '的小区' : '' }}</caption>
		<thead>
			<th>小区名称</th>
			<th>所属社区</th>
			<th></th>
		</thead>
		<tbody>
			@foreach($areas as $area)
			<tr>
				<td>{{ $area->name }}</td>
				<td>{{ $area->block ? $area->block->name : '' }}</td>
				<td><a class="btn btn-primary btn-xs" href="/admin/area/{{ $area->id }}/edit">编辑</a></td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
<a class="btn btn-success btn-block btn-lg" href="/admin/area/create{{ $block ? "?block={$block->id}" : '' }}">添加小区</a>
@endsection
