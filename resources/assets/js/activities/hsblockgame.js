require('./../bootstrap');

$(function() {
    $('input[name="sports[]"]').change(function() {
        var tip, checkedCount = $('input[name="sports[]"]:checked').length
        tip = checkedCount > 1 ? '建议报名两项' : ''
        tip += checkedCount > 5 ? '，最多报名五项' : ''
        tip = tip ? `（${tip}）` : ''
        $('.sport-tip').text(tip)
    })
    $('select[name="area"]').change(function() {
    	var areaId = $(this).val()
    	$.get(`/residentialArea/${areaId}/blockName`, function(blockName) {
    		if(blockName) {
	    		$('input[name="block"]').val(blockName)
	    		$('.block-field').show()
    		} else {
	    		$('input[name="block"]').val('')
	    		$('.block-field').hide()
    		}
    	})
    })
})