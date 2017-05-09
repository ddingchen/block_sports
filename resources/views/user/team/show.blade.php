@extends('layout', ['hideTab' => true])

@section('title', '中铠街区体育')

@section('content')
<div class="header weui-flex">
	<div class="weui-flex__item">
		<i class="fa fa-users"></i>
		<span>战队管理-{{ $team->name }}</span>
	</div>
	<div class="top-bar">
		<a href="javascript:" onclick="del()"><i class="fa fa-trash-o fa-lg"></i></a>
		<a href="/i/team/{{ $team->id }}/invite"><i class="fa fa-plus fa-lg"></i></a>
	</div>
</div>

<div class="weui-cells__title">战队成员</div>
<div class="weui-cells">
	@foreach($team->members as $member)
	<a class="weui-cell weui-cell_access" href="/i/team/{{ $team->id }}/member/{{ $member->pivot->id }}/edit">
	    <div class="weui-cell__hd">
	    	<i class="fa fa-user fa-lg"></i>
	    </div>
	    <div class="weui-cell__bd">
	        <p>{{ $member->nickname }}</p>
	    </div>
	    <div class="weui-cell__ft">{{ $member->name }}</div>
	</a>
	@endforeach
</div>
<form id="delForm" method="post" action="/i/team/{{ $team->id }}" onsubmit="delConfirm(event)">
	{{ csrf_field() }}
	{{ method_field('DELETE') }}
</form>
@endsection

@section('js')
<script type="text/javascript">
	function del() {
		$('#delForm').submit()
	}
	function delConfirm(event) {
		if(confirm('是否确认删除该战队？')) {
			return
		}
		event.preventDefault()
	}
</script>

@if (count($errors) > 0)
	<script type="text/javascript">
		alert('{{ $errors->first() }}');
	</script>
@endif
@endsection
