module.exports = function(core) {

	$('.logout').on('click', function() {
		core.service.rest.delete(core.config.api.base + '/sessions')
			.then(function(res) {
				window.location = '/';
			});
	});
};
