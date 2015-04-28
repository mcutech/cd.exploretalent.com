var jscore = require('jscore'),
	crossroads = require('crossroads');

jscore.config(function(core) {
	// @if ENV='development'
	core.config.api = 'http://api.development.com';
	// @endif
	// @if ENV='production'
	core.config.api = 'http://api.production.com';
	// @endif
});

jscore.run(function(core) {

	crossroads.addRoute('/login').matched.add(require('./controllers/login.js'));

	crossroads.parse(window.location.pathname);

});

jscore.initialize();
