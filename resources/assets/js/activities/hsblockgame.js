require('./../bootstrap');

$(function() {
    // 仅有一个选项时，默认选中一个
    $('input[name="sports[]"]').click(function() {
        if($('input[name="sports[]"]').length == 1) {
            return false
        }
    })
    // 运动项目选择过多时，显示提示
    $('input[name="sports[]"]').change(function() {
        // 是否需要团队信息
        var groupInfoRequired = false
        $('input[name="sports[]"]:checked').each(function(i, n) {
            if($(n).data('group')) {
                groupInfoRequired = true
                return
            }
        })
        if(groupInfoRequired) {
            $('.group-info').show()
        } else {
            $('.group-info').hide()
        }
        // 报名项数推荐
        var tip, checkedCount = $('input[name="sports[]"]:checked').length
        tip = checkedCount > 1 ? '建议报名两项' : ''
        tip += checkedCount > 5 ? '，最多报名五项' : ''
        tip = tip ? `（${tip}）` : ''
        $('.sport-tip').text(tip)
    })
    // 街道选择变更时，社区数据重新加载
    $('select[name="match"]').change(function() {
        if($(this).val() != '-1') {
            window.location.href = '/match/' + $(this).val() + '/ticket/create';
        }
    })
    // 自定义小区名称的切换
    $('select[name="area"]').change(function() {
        if($(this).val() == '0') {
            $('.area-field').hide()
            $('.area-custom-field').show()
        }
    })
    // 提交报名
    $('form').submit(function(event) {
        $('input[type="submit"]').attr('disabled', 'disabled')
        event.preventDefault()
        $.ajax({
            url: '/match/' + $('select[name="match"]').val() + '/ticket',
            data: $('form').serializeArray(),
            complete: function(xhr, status) {
                $('input[type="submit"]').removeAttr('disabled')
            },
            error: function(xhr, status, error) {
                if(xhr.status != 422) {
                    return
                }
                for(var i in xhr.responseJSON) {
                    alert(xhr.responseJSON[i][0])
                    if(i == 'contact_changed') {
                        if(confirm('是否确认使用新的联系方式进行报名？是：使用当前信息完成报名；否：复原此前使用的联系方式')) {
                            $('input[name="contact_confirm"]').val(1)
                            $('form').submit()
                        } else {
                            $('input[name="name"]').val($('input[name="name"]').data('old-name'))
                            $('input[name="tel"]').val($('input[name="tel"]').data('old-tel'))
                        }
                    }
                    break
                }
            },
            success: function(data, status, xhr) {
                window.location.href = "/i/ticket"
            },
            type: 'POST'
        })
    })

    // 页面首次加载时，检测是否需要选中默认项
    // var defaultMatch = queryParam('match')
    // if(defaultMatch) {
    //     $('select[name="match"]').val(defaultMatch).change()
    // }
})