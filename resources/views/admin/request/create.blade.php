@extends('admin.layout')

@section('page-title','申请管理员')

@section('content')
<h3>管理员申请</h3>
@if(!auth()->user()->adminRequest)
<form method="post" action="/admin/request">
	{{ csrf_field() }}
	<div class="form-group">
		<label>帐号（邮箱）</label>
		<input type="text" class="form-control" name="email" placeholder="请输入邮箱作为登录帐号">
	</div>
	<div class="form-group">
		<label>申请备注</label>
		<input type="text" class="form-control" name="note" placeholder="请注明必要的身份信息">
	</div>
	<button type="submit" class="btn btn-block btn-lg btn-primary">提交申请</button>
</form>
@else
<p>您的申请已提交，请等待审核...</p>
@endif
@endsection

@section('page-js')
<script type="text/javascript">
	@if(count($errors))
	alert('{{ $errors->all()[0] }}')
	@endif
</script>
@endsection
