@extends('admin.layout')

@section('page-title', '报名列表')

@section('content')
<div class="table-responsive">
  @foreach($registionsByGroup as $teamName => $registions)
    <h3>团队名称：{{ $teamName }}</h3>
    <table class="table table-hover">
      <thead>
        <tr>
          <th>#</th>
          <th>姓名</th>
          <th>身份证</th>
        </tr>
      </thead>
      <tbody>
        @foreach($registions as $registion)
          <tr>
            <td>{{ $loop->index + 1 }}</td>
            <td>{{ $registion->realname }}</td>
            <td>{{ $registion->idcard_no }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @endforeach
</div>
@endsection

@section('page-css')
<style type="text/css">

</style>
@endsection

@section('page-js')
<script type="text/javascript">

</script>
@endsection
