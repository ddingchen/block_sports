<div class="form-group">
	<label>赛事组名称</label>
	<input class="form-control" name="name" value="{{ $group->name or '' }}" />
</div>
<div class="form-group">
	<label>报名列表标题</label>
	<input class="form-control" name="title" value="{{ $group->title or '' }}" />
</div>
<div class="form-group">
	<label>报名列表小标题</label>
	<input class="form-control" name="sub_title" value="{{ $group->sub_title or '' }}" />
</div>
<div class="form-group">
	<label>是否设置为TOP热门</label>
	<div class="radio">
		<label>
			<input type="radio" name="top" value="1" @if(isset($group) && $group->top) checked @endif />
			TOP热门
		</label>
	</div>
	<div class="radio">
		<label>
			<input type="radio" name="top" value="0" @if(isset($group) && !$group->top) checked @endif />
			预热报名
		</label>
	</div>
</div>
<div class="form-group">
	<label>包含赛事</label>
	@foreach($containsMatches as $match)
	<div class="checkbox">
		<label>
			<input type="checkbox" name="matches[]" value="{{ $match->id }}" checked>
			{{ $match->street->name }} {{ $match->sports->implode('name', ',') }}
		</label>
	</div>
	@endforeach
	@foreach($matches as $match)
	<div class="checkbox">
		<label>
			<input type="checkbox" name="matches[]" value="{{ $match->id }}">
			{{ $match->street->name }} {{ $match->sports->implode('name', ',') }}
		</label>
	</div>
	@endforeach
</div>
