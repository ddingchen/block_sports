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
  <select id="block" class="form-control">
    <option value="" selected>所有社区</option>
    @foreach($blocks as $block)
    <option value="{{ $block->name }}">{{ $block->name }}</option>
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
          <th>备注</th>
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
          <td class="sex">男</td>
          @elseif($ticket->owner->sex == 'female')
          <td class="sex">女</td>
          @else
          <td class="sex"></td>
          @endif
          <td>{{ $ticket->owner->tel }}</td>
          <td class="note">{{ $ticket->note }}</td>
          <td class="control">
          	<a class="btn btn-primary btn-xs" href="/admin/user/{{ $ticket->owner->id }}/edit" role="button">联系方式</a>
          </td>
          <td class="control">
            <a class="btn btn-primary btn-xs" href="/admin/ticket/{{ $ticket->id }}/edit" role="button">报名信息</a>
          </td>
          <td class="control">
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

@section('page-css')
<style type="text/css">
  table tr td{
     min-width: 100px
  }
  table tr td.sex{
     min-width: 50px
  }
  table tr td.control{
     min-width: 60px
  }
  table tr td.note{
     max-width: 150px
  }
</style>
@endsection

@section('page-js')
<script type="text/javascript">
  var sportFilter, blockFilter
  $('form.delete').submit(function(event) {
    if(!confirm('是否确认删除')) {
      event.preventDefault()
    }
  })
  $('#sport, #block').change(function() {
    sportFilter = $('#sport').val()
    blockFilter = $('#block').val()
    var $allRows = $('table tbody tr')
    var $showRows = $allRows
    if(!sportFilter && !blockFilter) {
      $allRows.show()
      $('#summary').hide()
      return
    }
    if(sportFilter) {
      $showRows = $showRows.filter(":contains('"+sportFilter+"')")
    }
    if(blockFilter) {
      $showRows = $showRows.filter(":contains('"+blockFilter+"')")
    }
    $allRows.hide()
    $showRows.show()
    $('#allCount').text($allRows.length)
    $('#currentCount').text($showRows.length)
    $('#summary').show()
  })
</script>
@endsection
