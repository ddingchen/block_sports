@extends('admin.layout')

@section('page-title', '报名列表')

@section('content')
<div class="form-inline" style="margin: 20px 0">
  <label for="exampleInputEmail1">运动项目筛选：</label>
  <label id="summary" style="display: none">当前项目共<span id="currentCount">{{ $tickets->count() }}</span>人／总计<span id="allCount">{{ $tickets->count() }}</span>人</label>
  <select id="sport" class="form-control">
    <option value="" selected>所有项目</option>
    @foreach($sports as $sport)
    <option value="{{ $sport->name }}">{{ $sport->name }}</option>
    @endforeach
  </select>
</div>
<div class="table-responsive">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>#</th>
          <th>报名时间</th>
          <th>运动项目</th>
          <th>小区</th>
          <th>社区</th>
          <th>姓名</th>
          <th>性别</th>
          <th>联系电话</th>
          <th></th>
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
      	@foreach($tickets as $ticket)
        <tr @if(!$ticket->owner->open_id) style="background-color: #eee" @endif>
          <th scope="row">{{ $loop->index + 1 }}</th>
          @if($ticket->created_at->isToday())
          <td>{{ '今天 ' . $ticket->created_at->format('H:i') }}</td>
          @else
          <td>{{ $ticket->created_at->format('m-d H:i') }}</td>
          @endif
          <td>{{ $ticket->sports->implode('name', '，') }}</td>
          <td>{{ $ticket->owner->residentialArea->name }}</td>
          <td>{{ $ticket->owner->residentialArea->block->name or '' }}</td>
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
          <td>
            <a class="btn btn-primary btn-xs" href="/admin/ticket/{{ $ticket->id }}/edit" role="button">更改报名项目</a>
          </td>
          <td>
            <form class="delete" method="post" action="/admin/ticket/{{ $ticket->id }}">
              {{ method_field('DELETE') }}
              {{ csrf_field() }}
              <button class="btn btn-danger btn-xs" type="submit">删除</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
</div>
@endsection

@section('page-js')
<script type="text/javascript">
  $('form.delete').submit(function(event) {
    if(!confirm('是否确认删除')) {
      event.preventDefault()
    }
  })
  $('#sport').change(function() {
    var sportName = $(this).val()
    var $allRows = $('table tbody tr')
    if(!sportName) {
      $allRows.show()
      $('#summary').hide()
      return
    }
    var $showRows = $("table tbody tr:contains('"+sportName+"')")
    $allRows.hide()
    $showRows.show()
    $('#allCount').text($allRows.length)
    $('#currentCount').text($showRows.length)
    $('#summary').show()
  })
</script>
@endsection
