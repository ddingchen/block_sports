@extends('admin.layout')

@section('page-title', '网民游泳-报名列表')

@section('content')
<div class="table-responsive">
	@if(!$group->team_required)
	<table class="table table-striped">
		<caption>{{ $group->name }} 报名名单</caption>
		<thead>
        	<tr>
        		<td>#</td>
        		<td>报名时间</td>
        		<td>真实姓名</td>
        		<td>性别</td>
        		<td>联系电话</td>
        		<td>身份证号</td>
        		<td>支付状态</td>
        		<td></td>
        		<td></td>
        	</tr>
        </thead>
        <tbody>
        	@foreach($group->tickets as $ticket)
        		@php
        		$registion = $ticket->registion;
        		@endphp
	        	<tr>
	        		<td>{{ $loop->iteration }}</td>
	        		<td>{{ $registion->created_at->diffForHumans() }}</td>
	        		<td>{{ $registion->realname }}</td>
	        		<td>{{ $registion->readableSex() }}</td>
	        		<td>{{ $registion->tel }}</td>
	        		<td>{{ $registion->idcard_no }}</td>
	        		<td>{{ $ticket->paid ? '已支付' : '' }}</td>
	        		<td>
	        			<a href="/admin/wm/registion/{{ $registion->id }}" class="btn btn-primary btn-xs">更改</a>
	        		</td>
	        		<td>
	        			<form method="post" action="/admin/wm/ticket/{{ $ticket->id }}">
	        				{{ csrf_field() }}
	        				{{ method_field('delete') }}
	        				<button type="submit" class="btn btn-danger btn-xs">删除并退款</button>
	        			</form>
	        		</td>
	        	</tr>
        	@endforeach
        </tbody>
	</table>
	@else
		<table class="table">
			<caption>{{ $group->name }} 报名名单</caption>
			<thead>
	        	<tr>
	        		<td>#</td>
	        		<td>报名时间</td>
	        		<td>真实姓名</td>
	        		<td>性别</td>
	        		<td>联系电话</td>
	        		<td>身份证号</td>
	        		<td>支付状态</td>
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
	        		<td>{{ $registion->tel }}</td>
	        		<td>{{ $registion->idcard_no }}</td>
	        		@if($loop->first)
	        		<td rowspan="4">{{ $ticket->paid ? '已支付' : '' }}</td>
	        		@endif
	        		<td>
	        			<a href="/admin/wm/registion/{{ $registion->id }}" class="btn btn-primary btn-xs">更改</a>
	        		</td>
	        		@if($loop->first)
	        		<td rowspan="4">
	        			<form method="post" action="/admin/wm/ticket/{{ $ticket->id }}">
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

@section('page-css')
<style type="text/css">
.row-striped {
	background-color: #f9f9f9;
}
</style>
@endsection
