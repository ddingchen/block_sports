@extends('admin.layout')

@section('page-title', '创建比赛')

@section('content')
<form method="post" action="/admin/match">
  {{ csrf_field() }}
  <div class="form-group">
    <label for="street">举办街道</label>
    <select class="form-control" name="street">
    	@foreach($streets as $street)
    	<option value="{{ $street->id }}">{{ $street->name }}</option>
    	@endforeach
    </select>
  </div>
  <div class="form-group">
    <label for="sports">运动项目</label>
    @foreach($sports as $sport)
    <div class="checkbox">
      <label>
        <input type="checkbox" name="sports[]" value="{{ $sport->id }}">
        {{ $sport->name }}
      </label>
    </div>
    @endforeach
  </div>
  <button type="submit" class="btn btn-primary btn-block btn-lg">确认创建</button>
</form>
@endsection
