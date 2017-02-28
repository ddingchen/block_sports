require('./../bootstrap');

$(function() {
    $('input[name="sports[]"]').change(function() {
        var tip, checkedCount = $('input[name="sports[]"]:checked').length
        tip = checkedCount > 1 ? '建议报名两项' : ''
        tip += checkedCount > 5 ? '，最多报名五项' : ''
        tip = tip ? `（${tip}）` : ''
        $('.sport-tip').text(tip)
    })
})