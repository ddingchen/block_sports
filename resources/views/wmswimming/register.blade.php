@extends('layouts.wm')

@section('content')
	<div class="container">
		<div class="page js_show">
			<div class="page__hd">
				<h1 class="page__title">填写参赛信息</h1>
				<p class="page__desc">
					请确认<span class="notice">填写信息与真实身份信息相符</span>，否则赛场取消比赛资格
					@if($group->team_required)
					<br/>填表顺序与实际比赛接力顺序无关
					@endif
				</p>
			</div>

			<div class="page__bd">
				@if(session('team_name'))
				<div class="weui-cells">
					<a class="weui-cell weui-cell_access" href="javascript:changeType()">
		                <div class="weui-cell__bd">
		                    <p>报名团体</p>
		                </div>
		                <div class="weui-cell__ft">{{ session('team_name') }}</div>
		            </a>
				</div>
				<div class="weui-cells__tips" style="text-align: right;">点击可更改团体名称，或改为个人报名</div>
				@endif
				<div class="weui-cells">
					<a class="weui-cell weui-cell_access" href="javascript:changeGroup()">
		                <div class="weui-cell__bd">
		                    <p>参赛项目</p>
		                </div>
		                <div class="weui-cell__ft">{{ $group->name }}</div>
		            </a>
				</div>
				@if(!$group->team_required)
				<div class="weui-cells__tips" style="text-align: right;">系统将根据身份证号的生日自动选择年龄分组</div>
				@endif
				<br/>
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
						@if($registerEnabled)
			            <button type="submit" class="weui-btn weui-btn_primary">确认报名</button>
			            @else
			            <button type="submit" class="weui-btn weui-btn_primary weui-btn_disabled" disabled>未开启报名</button>
			            @endif
			        </div>
				</form>
			</div>
		</div>
	</div>
@endsection

@section('js')
<script type="text/javascript">
	function changeGroup() {
		if(confirm('更改参赛项目后，当前填写的信息将会清空，是否确认继续')) {
			window.location.href = '/wm/group';
		}
	}

	function changeType() {
		if(confirm('更改报名团体后，当前填写的信息将会清空，是否确认继续')) {
			window.location.href = '/wm/type';
		}
	}

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
				if(xhr.status == 403) {
					alert('抱歉，报名未开启')
					return
				}

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
