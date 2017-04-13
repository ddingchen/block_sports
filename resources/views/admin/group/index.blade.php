@extends('admin.layout')

@section('title', '赛事列表管理')

@section('content')
<div class="table-responsive">
	<table class="table">
		<thead>
			<th>赛事组</th>
			<th></th>
			<th></th>
		</thead>
		<tbody>
			@foreach($groups as $group)
			<tr>
				<td>{{ $group->name }}</td>
				<td><a class="btn btn-primary btn-xs" href="/admin/group/{{ $group->id }}/edit">管理</a></td>
				<td>
					<form method="post" action="/admin/group/{{ $group->id }}" onsubmit="deleteConfirm(event)">
						{{ csrf_field() }}
						{{ method_field('delete') }}
						<button type="submit" class="btn btn-danger btn-xs">删除</button>
					</form>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
<a class="btn btn-success btn-block btn-lg" href="/admin/group/create">添加赛事组</a>
@endsection

@section('page-js')
<script type="text/javascript">
	function deleteConfirm(event) {
		if(!confirm('确认删除吗？')) {
			event.preventDefault()
		}
	}
</script>
@endsection
