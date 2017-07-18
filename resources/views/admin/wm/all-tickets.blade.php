@extends('admin.layout')

@section('page-title', '网民游泳-所有报名')

@section('content')
<div class="table-responsive">
	<table class="table">
		<thread>
			<tr>
				<th>#</th>
				<th>报名项目</th>
				<th>真实姓名</th>
				<th>性别</th>
				<th>生日</th>
				<th>联系电话</th>
				<th>身份证号</th>
				<th>团队名称</th>
				<th>支付状态</th>
			</tr>
		</thread>
		<tbody>
			@foreach($tickets as $ticket)
				@if(!$ticket->group->team_required)
					@php
		    			$registion = $ticket->registion;
		    		@endphp
					<tr>
						<td>{{ $loop->iteration }}</td>
		        		<td>{{ $ticket->group->name }}</td>
		        		<td>{{ $registion->realname }}</td>
		        		<td>{{ $registion->readableSex() }}</td>
		        		<td>{{ $registion->getBirthday()->format('Y-m-d') }}</td>
		        		<td>{{ $registion->tel }}</td>
		        		<td>{{ $registion->idcard_no }}</td>
		        		<td>{{ $registion->team_name }}</td>
		        		<td>{{ $ticket->paid ? '已支付' : '' }}</td>
					</tr>
				@else
					@php
		    			$teamRegistions = $ticket->registion;
		    		@endphp
					{{-- {{ $registion }} --}}
					@foreach($teamRegistions->registions as $registion)
						<tr>
							<td>{{ $loop->parent->iteration }}</td>
			        		<td>{{ $ticket->group->name }}</td>
			        		<td>{{ "(#{$teamRegistions->id}) " . $registion->realname }}</td>
			        		<td>{{ $registion->readableSex() }}</td>
			        		<td>{{ $registion->getBirthday()->format('Y-m-d') }}</td>
			        		<td>{{ $registion->tel }}</td>
			        		<td>{{ $registion->idcard_no }}</td>
			        		<td>{{ $registion->team_name }}</td>
			        		<td>{{ $ticket->paid ? '已支付' : '' }}</td>
						</tr>
					@endforeach
				@endif
			@endforeach
		</tbody>
	</table>
</div>
@endsection

@section('page-js')
<script src="/js/FileSaver.min.js"></script>
<script src="http://cdn.bootcss.com/TableExport/5.0.0-rc.4/css/tableexport.min.css"></script>
<script src="http://cdn.bootcss.com/TableExport/5.0.0-rc.4/img/csv.svg"></script>
<script src="http://cdn.bootcss.com/TableExport/5.0.0-rc.4/img/icsv.png"></script>
<script src="http://cdn.bootcss.com/TableExport/5.0.0-rc.4/img/itxt.png"></script>
<script src="http://cdn.bootcss.com/TableExport/5.0.0-rc.4/img/ixls.png"></script>
<script src="http://cdn.bootcss.com/TableExport/5.0.0-rc.4/img/ixlsx.png"></script>
<script src="http://cdn.bootcss.com/TableExport/5.0.0-rc.4/img/txt.svg"></script>
<script src="http://cdn.bootcss.com/TableExport/5.0.0-rc.4/img/xls.svg"></script>
<script src="http://cdn.bootcss.com/TableExport/5.0.0-rc.4/img/xlsx.svg"></script>
<script src="http://cdn.bootcss.com/TableExport/5.0.0-rc.4/js/tableexport.min.js"></script>
<script type="text/javascript">
	$('table').tableExport()
</script>
@endsection
