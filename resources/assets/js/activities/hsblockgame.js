require('./../bootstrap');

$(function() {
    $('input[name="sports[]"]').click(function() {
        if($('input[name="sports[]"]').length == 1) {
            return false
        }
    })
    $('input[name="sports[]"]').change(function() {
        var tip, checkedCount = $('input[name="sports[]"]:checked').length
        tip = checkedCount > 1 ? '建议报名两项' : ''
        tip += checkedCount > 5 ? '，最多报名五项' : ''
        tip = tip ? `（${tip}）` : ''
        $('.sport-tip').text(tip)
    })
    $('select[name="match"]').change(function() {
        console.log('change')
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
    $('select[name="area"]').change(function() {
        if($(this).val() == '0') {
            $('.area-field').hide()
            $('.area-custom-field').show()
        }
    })
    $('form').submit(function(event) {
        event.preventDefault()
        $.ajax({
            url: '/ticket',
            data: $('form').serializeArray(),
            error: function(xhr, status, error) {
                console.log(xhr)
                console.log(status)
                console.log(error)
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
})