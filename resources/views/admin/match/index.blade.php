@extends('admin.layout')

@section('page-title', '比赛列表')

@section('content')
<div class="table-responsive">
	<table class="table">
		<thead>
			<th>创建时间</th>
			<th>所属街道</th>
		</thead>
		<tbody>
			@foreach($matches as $match)
			<tr>
				<td>{{ $match->created_at->format('Y-m-d') }}</td>
				<td>{{ $match->street->name }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
<a class="btn btn-success btn-block btn-lg" href="/admin/match/create">创建比赛</a>
@endsection
