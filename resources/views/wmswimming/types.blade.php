@extends('layouts.wm')

@section('content')
<div class="container">
    <div class="page js_show">

        <div class="section">
            <h3 class="section-title">个人报名</h3>
            <p class="section-desc">
                如果您没有所属的俱乐部或其他团体组织，则直接选择<span class="notice">以个人身份报名</span>
            </p>
            <div class="weui-btn-area">
                <a href="javascript:clearTeamName()" class="weui-btn weui-btn_primary">以个人身份报名</a>
            </div>
        </div>

        <hr>

        <div class="section">
            <h3 class="section-title">团体报名</h3>
            <p class="section-desc">
                本次比赛接受团体报名<br/>
                使用<span class="notice">相同的团体名称</span>报名将视为同一团体<br/>
                团体报名人数不可<span class="notice">少于10人</span><br/>
                团体比赛将设立专门的团体比赛奖项
            </p>

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
                    <button type="submit" class="weui-btn weui-btn_primary">以该团体成员身份报名</button>
                </div>
            </form>
        </section>

    </div>
</div>
@endsection

@section('css')
<style type="text/css">
.section {
    padding-bottom: 40px;
}
.section-title {
    padding: 0 40px;
    padding-top: 40px;
    font-weight: 400;
    text-align: left;
}
.section-desc {
    padding: 0 40px;
    margin-top: 5px;
    color: #888;
    text-align: left;
    font-size: 14px;
}
</style>
@endsection

@section('js')
<script type="text/javascript">
    var ajaxing = false
    $('form').submit(function(event) {
        if(!$('input[name="team_name"]').val()) {
            alert('请输入您的团体名称');
            return false;
        }

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
