@extends('admin.layout')

@section('page-title', '更改运动项目')

@section('content')
<h3>更改运动项目</h3>
<form method="post" action="/admin/ticket/{{ $ticket->id }}">
  {{ method_field('PUT') }}
  {{ csrf_field() }}
  @foreach($sports as $sport)
	<div class="checkbox">
	  <label>
	    <input type="checkbox" name="sports[]" value="{{ $sport->id }}" @if($ticket->sports->contains($sport)) checked @endif>
	    {{ $sport->name }}
	  </label>
	</div>
  @endforeach
  <button type="submit" class="btn btn-primary btn-lg btn-block">保存修改</button>
</form>
@endsection

@section('page-js')
<script type="text/javascript">
@if (count($errors) > 0)
	alert('{{$errors->all()[0]}}')
@endif
</script>
@endsection
