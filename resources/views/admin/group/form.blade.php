<div class="form-group">
	<label>赛事组名称</label>
	<input class="form-control" name="name" value="{{ $group->name or '' }}" />
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
