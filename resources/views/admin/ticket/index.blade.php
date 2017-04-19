@extends('admin.layout')

@section('page-title', '报名列表')

@section('content')
<div class="form-inline">
  {{-- <label id="summary" style="display: none">当前项目共<span id="currentCount">{{ $tickets->count() }}</span>人／总计<span id="allCount">{{ $tickets->count() }}</span>人</label> --}}
</div>
<div class="filter">
  <div class="form-group">
    <label>运动项目筛选</label>
    <div>
      <div class="btn-group sports-filter" role="group" aria-label="...">
        @foreach($sports as $sport)
        <button type="button" class="btn btn-default">{{ $sport->name }}</button>
        @endforeach
      </div>
    </div>
  </div>
    {{-- <ul class="list-group">
      @foreach($sports as $sport)
      <li class="list-group-item">{{ $sport->name }}</li>
      @endforeach
    </ul> --}}
  <div class="form-group">
    <label>社区筛选</label>
    <select id="block" class="form-control">
      <option value="" selected>所有社区</option>
      @foreach($blocks as $block)
      <option value="{{ $block->name }}">{{ $block->name }}</option>
      @endforeach
    </select>
  </div>

</div>
{{-- <div class="form-group">
  <select id="sport" class="form-control">
    <option value="" selected>所有项目</option>
    @foreach($sports as $sport)
    <option value="{{ $sport->name }}">{{ $sport->name }}</option>
    @endforeach
  </select>
</div> --}}

<a class="btn btn-success" href="/admin/ticket/create?match={{ $match->id }}">线下报名录入</a>

<div class="table-responsive">
    <table class="table table-hover">
      <caption>
        当前项目共<span id="currentCount">{{ $tickets->count() }}</span>人／总计<span id="allCount">{{ $tickets->count() }}</span>人
      </caption>
      <thead>
        <tr>
          <th>#</th>
          <th>报名时间</th>
          <th>运动项目</th>
          <th>小区</th>
          <th>社区</th>
          <th>姓名</th>
          <th>性别</th>
          <th>年龄</th>
          <th>联系电话</th>
          <th>团队</th>
          <th>备注</th>
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
          <td>{{ $ticket->owner->residentialArea->name or '其他' }}</td>
          <td>{{ $ticket->owner->residentialArea->block->name or '' }}</td>
          <td>{{ $ticket->owner->name }}</td>
          @if($ticket->owner->sex == 'male')
          <td class="sex">男</td>
          @elseif($ticket->owner->sex == 'female')
          <td class="sex">女</td>
          @else
          <td class="sex"></td>
          @endif
          <td class="age">{{ $ticket->owner->age }}</td>
          <td class="tel">{{ $ticket->owner->tel }}</td>
          <td class="team">{{ $ticket->ticketSports->implode('team_name', ' ') }}</td>
          <td class="note">{{ $ticket->note }}</td>
          <td class="control">
            <div class="btn-group">
              <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                操作 <span class="caret"></span>
              </button>
              <ul class="dropdown-menu dropdown-menu-right">
                <li><a href="/admin/user/{{ $ticket->owner->id }}/edit">个人信息编辑</a></li>
                <li><a href="/admin/ticket/{{ $ticket->id }}/edit">报名信息编辑</a></li>
                {{-- <li role="separator" class="divider"></li>
                <li><a href="/admin/ticket/{{ $ticket->id }}">删除信息</a></li> --}}
              </ul>
            </div>
          </td>
         {{--  <td class="control">
          	<a class="btn btn-primary btn-xs" href="/admin/user/{{ $ticket->owner->id }}/edit" role="button">联系方式</a>
          </td>
          <td class="control">
            <a class="btn btn-primary btn-xs" href="/admin/ticket/{{ $ticket->id }}/edit" role="button">报名信息</a>
          </td> --}}
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
  table tr td.age{
     min-width: 50px
  }
  table tr td.tel{
     min-width: 160px
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
  var sportFilter = [], blockFilter

  // 删除
  $('form.delete').submit(function(event) {
    if(!confirm('是否确认删除')) {
      event.preventDefault()
    }
  })

  // 筛选
  // 按钮样式切换
  $('.sports-filter button').click(function() {
    $(this).toggleClass(function() {
      if($(this).hasClass('btn-default')) {
        return 'btn-primary'
      } else {
        return 'btn-default'
      }
    })
    sportFilter = []
    $('.sports-filter button.btn-primary').each(function(i, n) {
      return sportFilter.push($(n).text())
    })
    filter()
  })
  $('#sport, #block').change(function() {
    blockFilter = $('#block').val()
    filter()
  })
  function filter() {
    var $allRows = $('table tbody tr')
    var $showRows = $allRows
    if(sportFilter.length == 0 && !blockFilter) {
      $allRows.show()
      $('#summary').hide()
      return
    }
    if(sportFilter.length > 0) {
      for(var i in sportFilter) {
        var curFilter = sportFilter[i]
        $showRows = $showRows.filter(":contains('"+curFilter+"')")
      }
    }
    if(blockFilter) {
      $showRows = $showRows.filter(":contains('"+blockFilter+"')")
    }
    $allRows.hide()
    $showRows.show()
    $('#allCount').text($allRows.length)
    $('#currentCount').text($showRows.length)
    $('#summary').show()
  }
</script>
@endsection
