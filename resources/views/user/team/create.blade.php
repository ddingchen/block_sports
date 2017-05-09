@extends('layout', ['hideTab' => true])

@section('title', '中铠街区体育')

@section('content')
<div class="header weui-flex">
	<div class="weui-flex__item">
		<i class="fa fa-users"></i>
		<span>创建战队</span>
	</div>
</div>
<form method="post" action="/i/team">
	{{ csrf_field() }}
	<div class="weui-cells">
	    <div class="weui-cell">
	        <div class="weui-cell__bd">
	            <input class="weui-input" type="text" name="name" placeholder="请命名你的战队名称" value="{{ old('name') }}">
	        </div>
	    </div>
	</div>
	<div class="block-btn">
		<button type="submit" class="weui-btn weui-btn_primary">确认创建</button>
	</div>
</form>
@endsection

@section('js')
@if (count($errors) > 0)
	<script type="text/javascript">
		alert('{{ $errors->first() }}');
	</script>
@endif
@endsection
