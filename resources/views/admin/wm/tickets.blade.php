@extends('admin.layout')

@section('page-title', '网民游泳-报名列表')

@section('content')
<div class="table-responsive">
	@if(!$group->team_required)
	@foreach($tickets as $ageRange => $ageTickets)
	<table class="table table-striped single">
		<caption>{{ $group->name }} {{ $ageRange }} 报名名单</caption>
		<thead>
        	<tr>
        		<td>#</td>
        		<td>报名时间</td>
        		<td>真实姓名</td>
        		<td>性别</td>
        		<td>生日</td>
        		<td>联系电话</td>
        		<td>身份证号</td>
        		<td>团队名称</td>
        		<td>支付状态</td>
        		<td>微信支付后台订单号</td>
        		<td></td>
        		<td></td>
        	</tr>
        </thead>
        <tbody>
        	@foreach($ageTickets as $ticket)
        		@php
        		$registion = $ticket->registion;
        		@endphp
	        	<tr>
	        		<td>{{ $loop->iteration }}</td>
	        		<td>{{ $registion->created_at->diffForHumans() }}</td>
	        		<td>{{ $registion->realname }}</td>
	        		<td>{{ $registion->readableSex() }}</td>
	        		<td>{{ $registion->getBirthday()->format('Y-m-d') }}</td>
	        		<td>{{ $registion->tel }}</td>
	        		<td>{{ $registion->idcard_no }}</td>
	        		<td>{{ $registion->team_name }}</td>
	        		<td>{{ $ticket->paid ? '已支付' : '' }}</td>
	        		<td>{{ $ticket->out_trade_no }}</td>
	        		<td>
	        			<a href="/admin/wm/registion/{{ $registion->id }}" class="btn btn-primary btn-xs">更改</a>
	        		</td>
	        		<td>
	        			<form class="delete" method="post" action="/admin/wm/ticket/{{ $ticket->id }}">
	        				{{ csrf_field() }}
	        				{{ method_field('delete') }}
	        				<button type="submit" class="btn btn-danger btn-xs">删除</button>
	        			</form>
	        		</td>
	        	</tr>
        	@endforeach
        </tbody>
	</table>
	@endforeach
	@else
		<table class="table team">
			<caption>{{ $group->name }} 报名名单</caption>
			<thead>
	        	<tr>
	        		<td>#</td>
	        		<td>报名时间</td>
	        		<td>真实姓名</td>
	        		<td>性别</td>
        			<td>生日</td>
	        		<td>联系电话</td>
	        		<td>身份证号</td>
        			<td>团队名称</td>
	        		<td>支付状态</td>
        			<td>微信支付后台订单号</td>
        			<td></td>
        			<td></td>
	        	</tr>
	        </thead>
	        <tbody>
			@foreach($group->tickets as $ticket)
        		@foreach($ticket->registion->registions as $registion)
	        	<tr @if($loop->parent->iteration % 2 != 0) class="row-striped" @endif>
	        		@if($loop->first)
	        		<td rowspan="4">{{ $loop->parent->iteration }}</td>
	        		@endif
	        		<td>{{ $registion->created_at->diffForHumans() }}</td>
	        		<td>{{ $registion->realname }}</td>
	        		<td>{{ $registion->readableSex() }}</td>
	        		<td>{{ $registion->getBirthday()->format('Y-m-d') }}</td>
	        		<td>{{ $registion->tel }}</td>
	        		<td>{{ $registion->idcard_no }}</td>
	        		<td>{{ $registion->team_name }}</td>
	        		@if($loop->first)
	        		<td rowspan="4">{{ $ticket->paid ? '已支付' : '' }}</td>
	        		<td rowspan="4">{{ $ticket->out_trade_no }}</td>
	        		@endif
	        		<td>
	        			<a href="/admin/wm/registion/{{ $registion->id }}" class="btn btn-primary btn-xs">更改</a>
	        		</td>
	        		@if($loop->first)
	        		<td rowspan="4">
	        			<form class="delete" method="post" action="/admin/wm/ticket/{{ $ticket->id }}">
	        				{{ csrf_field() }}
	        				{{ method_field('delete') }}
	        				<button type="submit" class="btn btn-danger btn-xs">删除并退款</button>
	        			</form>
	        		</td>
	        		@endif
	        	</tr>
	        	@endforeach
			@endforeach
	        </tbody>
		</table>
	@endif
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
	$('form.delete').submit(function() {
		if(!confirm('请确认是否已经支付，如果已经支付需要考虑是否需要退款，可以截屏或复制保存该信息以备使用！报名信息将无法找回，是否继续？')) {
			return false
		}
	})

	$('table').tableExport()
</script>
@endsection

@section('page-css')
<style type="text/css">
.row-striped {
	background-color: #f9f9f9;
}
</style>
@endsection
