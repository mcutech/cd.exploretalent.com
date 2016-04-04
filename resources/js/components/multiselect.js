module.exports = function () {
	$('select[multiple="multiple"]').each(function() {
	    var select = $(this);
	    select.multiselect({
			includeSelectAllOption: true,
			numberDisplayed: 1,
			buttonWidth: '100%',
			allSelectedText: 'All was selected',	    	
	        nonSelectedText: select.data('selected-text'),
	        header:  false,
	        selectedText: function(numChecked, numTotal, checkedItems) {
	           return numChecked + ' of ' + numTotal + ' checked';
	        }
	    });
	});

   $(".multiselect").click(function() {
        $(this).closest('.btn-group').toggleClass('open');
   });
}