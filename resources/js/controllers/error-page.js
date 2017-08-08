module.exports = function(core, user) {
	function thirty_pc() {
	    var height = $(window).height();
	    var errorPage = (height);
	    errorPage = parseInt(errorPage) - 80 + 'px';
	    $("#error-page").css('height',errorPage);
	    $("#content-wrapper").css('padding', '20px');
	}

	$(document).ready(function() {
	    thirty_pc();
	    $(window).bind('resize', errorPage);
	});
}
