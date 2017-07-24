@extends('admin.layout')

@section('page-title', '更改报名项目')

@section('content')
<h3>更改{{ $ticket->registion->realname }}的报名项目</h3>
<form method="post" action="/admin/wm/ticket/{{ $ticket->id }}">
  {{ method_field('PUT') }}
  {{ csrf_field() }}
  <div class="form-group">
    <label for="group">报名项目</label>
    <select class="form-control" id="group" name="group_id">
      @foreach($groups as $group)
      <option value="{{ $group->id }}" @if($ticket->group_id==$group->id) selected @endif >{{ $group->name }}</option>
      @endforeach
    </select>
  </div>
  <button type="submit" class="btn btn-primary btn-lg btn-block">保存修改</button>
</form>
@endsection

@section('page-js')
<script type="text/javascript">
@if (count($errors) > 0)
  alert('{{$errors->all()[0]}}')
@endif

@if(session('status'))
  alert('保存成功')
@endif
</script>
@endsection
