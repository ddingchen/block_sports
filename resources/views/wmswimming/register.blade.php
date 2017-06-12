@extends('layouts.wm')

@section('content')
	<div class="container">
		<div class="page js_show">
			<div class="page__hd">
				<h1 class="page__title">填写参赛信息</h1>
				<p class="page__desc">
					@if($group->team_required)
						填表顺序与实际比赛接力顺序无关
					@endif
				</p>
			</div>

			<div class="page__bd">
				<div class="weui-cells">
					<a class="weui-cell weui-cell_access" href="/wm/group">
		                <div class="weui-cell__bd">
		                    <p>参赛项目</p>
		                </div>
		                <div class="weui-cell__ft">{{ $group->name }}</div>
		            </a>
				</div>

				<form method="post" action="/wm/group/{{ $group->id }}/register">
					{{ csrf_field() }}
					@if($group->team_required)
						@include('wmswimming.form', ['member' => 0, 'sex' => 'male'])
						@include('wmswimming.form', ['member' => 1, 'sex' => 'male'])
						@include('wmswimming.form', ['member' => 2, 'sex' => 'female'])
						@include('wmswimming.form', ['member' => 3, 'sex' => 'female'])
					@else
						@include('wmswimming.form', ['member' => 0, 'sex' => ''])
					@endif
					<div class="weui-btn-area">
			            <button type="submit" class="weui-btn weui-btn_primary">确认报名</button>
			        </div>
				</form>
			</div>
		</div>
	</div>
@endsection

@section('js')
<script type="text/javascript">
	var ajaxing = false
	$('form').submit(function(event) {
		if(ajaxing == true) {
			return false
		}
		ajaxing = true
		$.ajax({
			type: 'post',
			url: $(this).attr('action'),
			data: $(this).serialize(),
			dataType: 'json',
			success: function(res) {
				window.location.href = res.target_url
			},
			error: function (xhr, status, error) {
				console.log(xhr.responseJSON)
				$('.weui-cell').removeClass('weui-cell_warn').find('small').empty()
				for(var errorName in xhr.responseJSON) {
					var errorDesc = xhr.responseJSON[errorName]
					var fieldName = convertFieldName(errorName)
					$('[name="'+ fieldName +'"]')
						.closest('.weui-cell')
						.addClass('weui-cell_warn')
						.find('small').text(errorDesc)
				}
			},
			complete: function(xhr, status) {
				ajaxing = false
			}
		})
		return false
	})

	function convertFieldName(errorName) {
		var parts = errorName.split('.')
		return 'members['+ parts[1] +']['+ parts[2] +']'
	}
</script>
@endsection
