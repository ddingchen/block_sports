@extends('admin.layout')

@section('page-title', '报名二维码管理')

@section('content')
  <div class="form-group">
    <label for="match">赛事</label>
    <select class="form-control" name="match">
    	@foreach($matches as $match)
    	<option value="{{ $match->id }}" data-street="{{ $match->street->id }}">{{ $match->created_at->format('Y-m-d') }} {{ $match->street->name }}</option>
    	@endforeach
    </select>
  </div>
  <div class="form-group">
    <label for="block">社区</label>
    <select class="form-control" name="block">
    	@foreach($blocks as $block)
    	<option value="{{ $block->id }}">{{ $block->name }}</option>
    	@endforeach
    </select>
  </div>
  <button id="generate" class="btn btn-primary btn-block btn-lg">生成</button>
  <img id="qrcode">
@endsection

@section('page-js')
<script type="text/javascript">
$('select[name="street"]').change(function() {
	var streetId = $(this).find('option:selected').data('street')
	$.getJSON('/admin/street/'+streetId+'/block', function(blocks) {
		var $select = $('select[name="block"]')
		$select.empty()
		for(var i in blocks) {
			var block = blocks[i]
			$select.append($('<option/>').val(block.id).text(block.name))
		}
	})
})
$('#generate').click(function() {
	var match = $('select[name="match"]').val()
	var block = $('select[name="block"]').val()
	if(match && block) {
		$.get('/admin/match/register/qrcode/generate', {
			match: match,
			block: block
		}, function(qrcodeUrl) {
			$('#qrcode').attr('src', qrcodeUrl);
		})
	}
})
</script>
@endsection
