@extends('admin.layout')

@section('page-title', '编辑小区')

@section('content')
<form method="post" action="/admin/area/{{ $area->id }}">
  {{ csrf_field() }}
  {{ method_field('PUT') }}
  <div class="form-group">
    <label for="name">名称</label>
    <input type="text" class="form-control" id="name" name="name" value="{{ $area->name }}">
  </div>
  <div class="form-group">
    <label for="block">所属社区</label>
    <select class="form-control" name="block">
    	@foreach($blocks as $block)
      @if($area->block)
      <option value="{{ $block->id }}" @if($area->block->id == $block->id) selected @endif>{{ $block->name }}</option>
      @else
      <option value="{{ $block->id }}">{{ $block->name }}</option>
      @endif
    	@endforeach
      @if($area->block)
      <option value="">其他</option>
      @else
      <option value="" selected>其他</option>
      @endif
    </select>
  </div>
  <button type="submit" class="btn btn-primary btn-block btn-lg">保存</button>
</form>
<script type="text/javascript">
@if (count($errors) > 0)
  alert('{{$errors->all()[0]}}')
@endif
</script>
@endsection
