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
        var tip, checkedCount = $('input[name="sports[]"]:checked').length
        tip = checkedCount > 1 ? '建议报名两项' : ''
        tip += checkedCount > 5 ? '，最多报名五项' : ''
        tip = tip ? `（${tip}）` : ''
        $('.sport-tip').text(tip)
    })
    // 街道选择变更时，社区数据重新加载
    $('select[name="match"]').change(function() {
        if($(this).val() == '-1') {
            $('select[name="area"] option').not('.placeholder').remove()
        } else {
            var streetId = $(this).find('option:selected').data('street');
            $.get('/street/' + streetId + '/area', function(areas) {
                $('select[name="area"] option').not('.placeholder').remove()
                for(var i in areas) {
                    var area = areas[i]
                    $('select[name="area"]').append($('<option/>').val(area.id).text(area.name))
                }
                $('select[name="area"]').append($('<option/>').val(0).text('其他'))
            })
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
        event.preventDefault()
        $.ajax({
            url: '/ticket',
            data: $('form').serializeArray(),
            error: function(xhr, status, error) {
                if(xhr.status == 422) {
                    for(var i in xhr.responseJSON) {
                        alert(xhr.responseJSON[i][0])
                        break
                    }
                }
            },
            success: function(data, status, xhr) {
                window.location.href = "/ticket"
            },
            type: 'POST'
        })
    })

    // 页面首次加载时，检测是否需要选中默认项
    var defaultMatch = queryParam('match')
    if(defaultMatch) {
        $('select[name="match"]').val(defaultMatch).change()
    }
})