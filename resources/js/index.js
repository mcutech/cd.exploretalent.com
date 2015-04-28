var jscore = require('jscore'),
	crossroads = require('crossroads');

jscore.config(function(core) {
	// @if ENV='development'
	core.config.api.base = 'http://localhost:9000';
	// @endif
	// @if ENV='production'
	core.config.api.base = 'http://localhost:9002';
	// @endif
});

jscore.run(function(core) {

	core.service.rest.settings.statusCode = {
		401: function() {
			if(window.location.pathname !== '/login') {
				window.location.href = '/login';
			}
		}
	};

	core.service.router.$$controllers = require('./controllers/**/*.js', { hash: true });
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
