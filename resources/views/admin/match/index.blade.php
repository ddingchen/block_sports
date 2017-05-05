@extends('admin.layout')

@section('page-title', '比赛列表')

@section('content')
<div class="table-responsive">
	<table class="table">
		<thead>
			<th>赛事标题</th>
			<th>比赛项目</th>
			<th>报名人数</th>
			<th>创建时间</th>
		</thead>
		<tbody>
			@foreach($matches as $match)
			<tr>
				<td>{{ $match->title }} {{ $match->sub_title }}</td>
				<td>{{ $match->sport->name }}</td>
				<td><a href="/admin/match/{{ $match->id }}/ticket">{{ $match->tickets->count() }}</a></td>
				<td>{{ $match->created_at->format('Y-m-d') }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
<a class="btn btn-success btn-block btn-lg" href="/admin/match/create">创建比赛</a>
@endsection
