@extends('admin.layout')

@section('page-title', '报名列表')

@section('content')
<h3>报名列表</h3>
<div class="table-responsive">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>#</th>
          <th>报名时间</th>
          <th>小区</th>
          <th>社区</th>
          <th>运动项目</th>
          <th>姓名</th>
          <th>性别</th>
          <th>联系电话</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
      	@foreach($tickets as $ticket)
        <tr>
          <th scope="row">{{ $loop->index + 1 }}</th>
          <td>{{ $ticket->created_at->format('m-d H:i') }}</td>
          <td>{{ $ticket->owner->residentialArea->name }}</td>
          <td>{{ $ticket->owner->residentialArea->block->name or '' }}</td>
          <td>{{ $ticket->sports->implode('name', '，') }}</td>
          <td>{{ $ticket->owner->name }}</td>
          @if($ticket->owner->sex == 'male')
          <td>男</td>
          @elseif($ticket->owner->sex == 'female')
          <td>女</td>
          @else
          <td></td>
          @endif
          <td>{{ $ticket->owner->tel }}</td>
          <td>
          	<a class="btn btn-primary btn-xs" href="/admin/user/{{ $ticket->owner->id }}/edit" role="button">编辑个人信息</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
</div>
</div>
@endsection
