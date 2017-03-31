@extends('admin.layout')

@section('page-title', '导入社区至街道')

@section('content')
<form method="post">
	{{ csrf_field() }}
	@foreach($blocks as $block)
	<div class="checkbox">
	  <label>
	    <input type="checkbox" name="blocks[]" value="{{ $block->id }}">
	    {{ $block->name }}
	  </label>
	</div>
	@endforeach
	<button type="submit" class="btn btn-lg btn-primary btn-block">导入社区</button>
</form>

@endsection
