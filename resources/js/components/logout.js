module.exports = function(core) {
<<<<<<< HEAD

=======
	$('.logout').on('click', function() {
		core.service.rest.delete(core.config.api.base + '/sessions')
			.then(function(res) {
				window.location = '/';
			});
	});
>>>>>>> d431e242ac04bce49e69c35e673d9f0a096d074c
};
