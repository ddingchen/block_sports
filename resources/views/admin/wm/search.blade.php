@extends('admin.layout')

@section('page-title', '搜索报名信息')

@section('content')
<h3>查询报名信息</h3>
<form method="get">
  <div class="input-group">
    <input type="text" class="form-control" id="idcard_no" name="idcard_no" value="{{ request('idcard_no') }}" placeholder="请输入身份证号吗进行模糊查询">
    <span class="input-group-btn">
      <button type="submit" class="btn btn-primary">搜索</button>
    </span>
  </div>
</form>
<table class="table table-striped">
  <thead>
    <tr>
      <td>#</td>
      <td>报名时间</td>
      <td>报名项目</td>
      <td>真实姓名</td>
      <td>性别</td>
      <td>联系电话</td>
      <td>身份证号</td>
      <td></td>
    </tr>
  </thead>
  <tbody>
    @foreach($registions as $registion)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $registion->created_at->diffForHumans() }}</td>
        <td>{{ $registion->registerGroup()->name }}</td>
        <td>{{ $registion->realname }}</td>
        <td>{{ $registion->readableSex() }}</td>
        <td>{{ $registion->tel }}</td>
        <td>{{ $registion->idcard_no }}</td>
        <td>
          <a href="/admin/wm/registion/{{ $registion->id }}" class="btn btn-primary btn-xs">更改</a>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
@endsection

@section('page-js')
<script type="text/javascript">

</script>
@endsection
