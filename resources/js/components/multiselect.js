module.exports = function () {
	$('.multi-select-item').multiselect({
		includeSelectAllOption: true,
		numberDisplayed: 1,
		buttonWidth: '100%',
		allSelectedText: 'No option left ...'
	});
   $(".multiselect").click(function() {
        $(this).closest('.btn-group').toggleClass('open');
   });
}