var jscore = require('jscore');

jscore.config(function(core) {
	// @if ENV='development'
	core.config.api.base = 'http://localhost:8000/api/v1';
	// @endif
	// @if ENV='production'
	core.config.api.base = 'https://api.exploretalent.com/api/v1';
	// @endif

	core.config.api.type = '/cd';
});

jscore.run(function(core) {
<<<<<<< HEAD
	core.service.rest.settings.statusCode = {
		401: function() {
			if(window.location.pathname !== '/login') {
				window.location.href = '/login';
=======
	core.resource.user.get({ userId : 'me', withs : [ 'bam_cd_user' ] })
		.then(init, init);

	function init(user) {
		core.service.rest.settings.statusCode = {
			401: function() {
				if(window.location.pathname !== '/login') {
					window.location.href = '/login';
				}
>>>>>>> d431e242ac04bce49e69c35e673d9f0a096d074c
			}
		};
		var components = require('./components/**/*.js', { hash : true });

		_.each(components, function(component) {
			component(core);
		});

		// registers all controllers for the router to recognize
		core.service.router.$$controllers = require('./controllers/**/*.js', { hash: true });

		// default parameters for all controllers
		core.service.router.$$params = [core, user];

		core.service.router

		// add routes here

		.add('/login', 'login')
		.add('/settings', 'settings')

		// project pages

		.add('/projects/create', 'projects.create')

		// end routes

			.finalize();
	}
});

jscore.initialize();
