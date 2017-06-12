<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<table>
		<tr>
			<td>真实姓名</td>
			<td>性别</td>
			<td>身份证</td>
			<td>联系电话</td>
			<td>团体编号</td>
		</tr>
		@foreach($tickets as $ticket)
			@if(!$ticket->group->team_required)
			<tr>
				<td>{{ $ticket->registion->realname }}</td>
				<td>{{ $ticket->registion->sex }}</td>
				<td>{{ $ticket->registion->idcard_no }}</td>
				<td>{{ $ticket->registion->tel }}</td>
			</tr>
			@else
				@foreach($ticket->registion->registions as $registion)
				<tr>
					<td>{{ $registion->realname }}</td>
					<td>{{ $registion->sex }}</td>
					<td>{{ $registion->idcard_no }}</td>
					<td>{{ $registion->tel }}</td>
					<td>{{ $ticket->registion->id }}</td>
				</tr>
				@endforeach
			@endif
		@endforeach
	</table>
</body>
</html>
