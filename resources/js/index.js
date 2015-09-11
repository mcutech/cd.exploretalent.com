var jscore = require('jscore');

jscore.config(function(core) {
	// @if ENV='development'
	core.config.api.base = 'http://localhost:8000/api/v1';
	// @endif
	// @if ENV='production'
	core.config.api.base = 'http://stage-cd.exploretalent.com/api/v1';
	// @endif
	core.config.api.type = '/cd'
});

jscore.run(function(core) {
	core.service.rest.settings.statusCode = {
		401: function() {
			if(window.location.pathname !== '/login') {
				window.location.href = '/login';
			}
		}
	};

	// registers all controllers for the router to recognize
	core.service.router.$$controllers = require('./controllers/**/*.js', { hash: true });

	// default parameters for all controllers
	core.service.router.$$params = [core];

	core.service.router

		// add routes here

		.add('/login', 'login')

		// end routes

		.finalize();


	var components = require('./components/**/*.js', { hash : true });

	_.each(components, function(component) {
		component(core);
	});

});

jscore.initialize();
