@extends('admin.layout')

@section('page-title', '报名列表')

@section('content')
<h2>{{ $match->title }} {{ $match->sub_title }}</h2>
<a class="btn btn-success" href="/admin/match/{{ $match->id }}/ticket/create">线下报名录入</a>
<div class="table-responsive">
    <table class="table table-hover">
      <thead>
        <tr>
          <th>#</th>
          <th>报名时间</th>
          @if($match->sport->is_group)
          <th>团队</th>
          <th>领队姓名</th>
          <th>领队电话</th>
          @else
          <th>姓名</th>
          <th>性别</th>
          <th>年龄</th>
          <th>联系电话</th>
          @endif
          <th>备注</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
      	@foreach($tickets as $ticket)
        <tr @if(!$ticket->owner->open_id) style="background-color: #eee" @endif>
          <th scope="row">{{ $loop->index + 1 }}</th>
          <td>{{ $ticket->created_at->diffForHumans() }}</td>
          @if($match->sport->is_group)
          <td class="team">{{ $ticket->owner->name }}</td>
          <td>{{ $ticket->owner->leader->name }}</td>
          <td>{{ $ticket->owner->leader->tel }}</td>
          @else
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
          @endif
          <td class="note">{{ $ticket->note }}</td>
          <td class="control">
            <div class="btn-group">
              <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                变更 <span class="caret"></span>
              </button>
              <ul class="dropdown-menu dropdown-menu-right">
                <li><a href="/admin/user/{{ $ticket->owner->id }}/edit">个人信息编辑</a></li>
                <li><a href="/admin/ticket/{{ $ticket->id }}/edit">报名信息编辑</a></li>
              </ul>
            </div>
          </td>
          <td class="control">
            <form class="delete" method="post" action="/admin/match/{{ $match->id }}/ticket/{{ $ticket->id }}">
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
     min-width: 120px
  }
  table tr td.control{
     min-width: 60px
  }
  table tr td.note{
     max-width: 250px
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
