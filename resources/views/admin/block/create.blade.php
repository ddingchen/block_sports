@extends('admin.layout')

@section('page-title', '添加社区')

@section('content')
<form method="post" action="/admin/block">
  {{ csrf_field() }}
  <div class="form-group">
    <label for="name">名称</label>
    <input type="text" class="form-control" id="name" name="name" placeholder="社区名称">
  </div>
  <button type="submit" class="btn btn-primary btn-block btn-lg">保存</button>
</form>
<script type="text/javascript">
@if (count($errors) > 0)
  alert('{{$errors->all()[0]}}')
@endif
</script>
@endsection
