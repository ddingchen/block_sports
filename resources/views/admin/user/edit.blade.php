@extends('admin.layout')

@section('page-title', '用户信息编辑')

@section('content')
<h3>用户信息编辑</h3>
<form method="post" action="/admin/user/{{ $user->id }}">
  {{ method_field('PUT') }}
  {{ csrf_field() }}
  <div class="form-group">
    <label for="name">姓名</label>
    <input type="text" class="form-control" name="name" value="{{ $user->name }}">
  </div>
  <div class="form-group">
    <label for="tel">手机号</label>
    <input type="number" class="form-control" name="tel" value="{{ $user->tel }}">
  </div>
  <div class="form-group">
    <label for="area">小区</label>
    <select class="form-control" id="area" name="area">
      @foreach($areas as $area)
          <option value="{{ $area->id }}" @if($user->residentialArea->id==$area->id) selected @endif>{{ $area->name }}</option>
      @endforeach
    </select>
  </div>
  <button type="submit" class="btn btn-primary btn-lg btn-block">保存修改</button>
</form>
@endsection
