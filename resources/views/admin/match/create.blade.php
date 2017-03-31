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
  <button type="submit" class="btn btn-primary btn-block btn-lg">确认创建</button>
</form>
@endsection
