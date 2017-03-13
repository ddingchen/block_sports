@extends('admin.layout')

@section('page-title', '添加小区')

@section('content')
<form method="post" action="/admin/area">
  {{ csrf_field() }}
  <div class="form-group">
    <label for="name">名称</label>
    <input type="text" class="form-control" id="name" name="name" placeholder="小区名称">
  </div>
  <div class="form-group">
    <label for="block">所属社区</label>
    <select class="form-control" name="block">
    	@foreach($blocks as $block)
    	<option value="{{ $block->id }}" @if($defaultBlock == $block->id) selected @endif>{{ $block->name }}</option>
    	@endforeach
      <option value="" @if(!$defaultBlock) selected @endif>其他</option>
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
