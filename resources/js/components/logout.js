module.exports = function(core) {

	$('.logout').on('click', function() {
		localStorage.removeItem('access_token');
		window.location = '/';
	});
};
