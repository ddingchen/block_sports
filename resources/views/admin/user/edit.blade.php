@extends('admin.layout')

@section('page-title', '用户信息编辑')

@section('content')
<h3>用户信息编辑</h3>
<form method="post" action="/admin/user/{{ $user->id }}">
  {{ method_field('PUT') }}
  {{ csrf_field() }}
  <div class="form-group">
    <label for="name">姓名</label>
    <input type="text" class="form-control" name="name" value="{{ $name }}">
  </div>
  <div class="form-group">
    <label for="tel">手机号</label>
    <input type="number" class="form-control" name="tel" value="{{ $tel }}">
  </div>
  <button type="submit" class="btn btn-primary btn-lg btn-block">保存修改</button>
</form>
@endsection
