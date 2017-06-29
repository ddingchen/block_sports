@extends('layouts.wm')

@section('content')
<div class="container">
    <div class="page js_show">
        <div class="page__hd">
            <h1 class="page__title">所属团体</h1>
            <p class="page__desc">
                本次比赛接受团体报名<br/>
                使用<span class="notice">相同的团体名称</span>报名视为同一团体<br/>
                团体报名人数不可<span class="notice">少于10人</span><br/>
                团体比赛将设立专门的团体比赛奖项<br/>
            </p>
        </div>

        <div class="page__bd">
            <form method="post" action="/wm/type">
                {{ csrf_field() }}
                <div class="weui-cells">
                    <div class="weui-cell">
                        <div class="weui-cell__hd"><label class="weui-label">团体名称</label></div>
                        <div class="weui-cell__bd">
                            <small></small>
                            <input class="weui-input" type="text" name="team_name" placeholder="请输入团体名称" value="{{ session('team_name') }}">
                        </div>
                    </div>
                </div>

                <div class="weui-btn-area">
                    <button type="submit" class="weui-btn weui-btn_primary">下一步</button>
                    <a href="javascript:clearTeamName()" class="weui-btn weui-btn_plain-primary">跳过，以个人身份报名</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('css')
<style type="text/css">
</style>
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
            success: function(res) {
                window.location.href = '/wm/group';
            },
            error: function (xhr, status, error) {
                $('.weui-cell').removeClass('weui-cell_warn').find('small').empty()
                for(var errorName in xhr.responseJSON) {
                    var errorDesc = xhr.responseJSON[errorName]
                    $('[name="'+ errorName +'"]')
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

    function clearTeamName() {
        if(ajaxing == true) {
            return false
        }
        ajaxing = true
        $.ajax({
            type: 'post',
            url: $('form').attr('action'),
            success: function(res) {
                window.location.href = '/wm/group';
            },
            complete: function(xhr, status) {
                ajaxing = false
            }
        })
    }
</script>
@endsection
