@extends('admin.layout')

@section('page-title', '比赛信息')

@section('content')
<div class="form-group">
	<label>赛事</label>
	<select class="form-control" id="match">
		@foreach($matches as $match)
		<option value="{{ $match->id }}">{{ $match->street->name . $match->created_at->format('Y-m-d') }}</option>
		@endforeach
	</select>
</div>
<div class="form-group">
	<label>比赛项目</label>
	<select class="form-control" id="sport">
		@foreach($sports as $sport)
		<option value="{{ $sport->id }}">{{ $sport->name }}</option>
		@endforeach
	</select>
</div>
<div class="table-responsive">
	<table class="table">
		<thead>
			<th>#</th>
			<th>参赛人</th>
			<th>运动项目</th>
			<th>成绩</th>
			<th>成绩录入</th>
			{{-- <th>荣誉</th>
			<th>个人展示页</th> --}}
		</thead>
		<tbody>
			@foreach($results as $result)
			<tr>
				<th>{{ $loop->iteration }}</th>
				<td class="user">{{ $result->ticket->owner->name . ($result->team_name ? "({$result->team_name})" : "") }}</td>
				<td>{{ $result->sport->name }}</td>
				<td>{{ $result->score or '暂无成绩' }}</td>
				<td>
					<a class="btn btn-primary btn-xs" href="{{ url()->current() . "/{$result->id}/edit" }}">确认成绩</a>
				</td>
				{{-- <td>{{ $result->honour }}</td>
				<td>{{ url("match/result/{$result->id}") }}</td> --}}
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
@endsection

@section('page-js')
<script type="text/javascript">
	$('#match').change(function() {
		var matchId = $('#match').val()
		window.location.href = '/admin/match/' + matchId + '/result'
	})
	$('#sport').change(function() {
		var selectedSport = $('#sport option:selected').text()
		$('tbody tr').hide()
		$('tbody tr:contains("' + selectedSport + '")').show()
	})
</script>
@endsection

@section('page-css')
<style type="text/css">
	.user {
		max-width: 60px;
	}
</style>
@endsection
