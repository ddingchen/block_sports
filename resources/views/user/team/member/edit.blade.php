@extends('layout', ['hideTab' => true])

@section('title', '中铠街区体育')

@section('content')
<div class="header weui-flex">
	<div class="weui-flex__item">
		<i class="fa fa-users"></i>
		<span>{{ $team->name }}【{{ $member->name }}】</span>
	</div>
	<div class="top-bar">
		<a href="javascript:" onclick="del()"><i class="fa fa-trash-o fa-lg"></i></a>
	</div>
</div>
<form method="post" action="/i/team/{{ $team->id }}/member/{{ $member->id }}">
	{{ method_field('PUT') }}
	{{ csrf_field() }}
	<div class="weui-cells">
		<div class="weui-cell">
	        <div class="weui-cell__hd"><label class="weui-label">备注</label></div>
	        <div class="weui-cell__bd">
	            <input class="weui-input" type="text" name="alias" placeholder="{{ $member->name }}" value="{{ $member->alias }}">
	        </div>
	    </div>
	    @if($team->leader != $member->user)
	    <div class="weui-cell weui-cell_switch">
	        <div class="weui-cell__bd">设为领队</div>
	        <div class="weui-cell__ft">
	            <label for="switchCP" class="weui-switch-cp">
	                <input id="switchCP" class="weui-switch-cp__input" type="checkbox" name="is_leader">
	                <div class="weui-switch-cp__box"></div>
	            </label>
	        </div>
	    </div>
	    @endif
	</div>
	<div class="block-btn">
		<button type="submit" class="weui-btn weui-btn_primary">保存</button>
	</div>
</form>
<form id="delForm" method="post" action="/i/team/{{ $team->id }}/member/{{ $member->id }}">
	{{ csrf_field() }}
	{{ method_field('DELETE') }}
</form>
@endsection

@section('js')
<script type="text/javascript">
	function del() {
		$('#delForm').submit()
	}
</script>

@if (count($errors) > 0)
	<script type="text/javascript">
		alert('{{ $errors->first() }}');
	</script>
@endif
@endsection
