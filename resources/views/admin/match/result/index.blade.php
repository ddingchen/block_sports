@extends('admin.layout')

@section('page-title', '比赛信息')

@section('content')
<div class="form-group">
	<label>比赛项目</label>
	<select class="form-control" id="sport">
		@foreach($sports as $sport)
		<option value="{{ $sport->id }}" @if($selectedSport->id==$sport->id) selected @endif>{{ $sport->name }}</option>
		@endforeach
	</select>
</div>
<div class="table-responsive">
	<table class="table">
		<thead>
			<th>#</th>
			<th>参赛人</th>
			<th>社区</th>
			<th>确认成绩</th>
			<th>荣誉</th>
			<th>个人展示页</th>
		</thead>
		<tbody>
			@foreach($results as $result)
			<tr>
				<th>{{ $loop->iteration }}</th>
				<td>{{ $result->ticket->owner->name }}</td>
				<td>{{ $result->ticket->owner->residentialArea->block->name or '其他社区' }}</td>
				<td>
					<a class="btn btn-primary btn-xs" href="/admin/match/result/{{ $result->id }}/edit">确认成绩</a>
				</td>
				<td>{{ $result->honour }}</td>
				<td>{{ url("match/result/{$result->id}") }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
@endsection

@section('page-js')
<script type="text/javascript">
	$('#sport').change(function() {
		var sportId = $(this).val()
		window.location.href = '?sport=' + sportId
	})
</script>
@endsection
