var jscore = require('jscore');

jscore.config(function(core) {
	// @if ENV='development'
	// core.config.api.base = 'http://localhost:8000/api/v1';
	core.config.api.base = 'https://dev-api.exploretalent.com/api/v1';
	// @endif
	// @if ENV='production'
	core.config.api.base = 'https://api.exploretalent.com/api/v1';
	// @endif

	core.config.api.type = '/cd';
});

jscore.run(function(core) {
	core.resource.user.get({ userId : 'me', withs : [ 'bam_cd_user' ] })
		.then(init, init);

	function init(user) {
		core.service.rest.settings.statusCode = {
			401: function() {
				if(window.location.pathname !== '/login') {
					window.location.href = '/login?redirect=' + encodeURIComponent(window.location);
				}
			}
		};

		// run all components
		var components = require('./components/**/*.js', { hash : true });

		_.each(components, function(component) {
			component(core, user);
		});

		// registers all controllers for the router to recognize
		core.service.router.$$controllers = require('./controllers/**/*.js', { hash: true });

		// default parameters for all controllers
		core.service.router.$$params = [core, user];

		core.service.router

		// add routes here

		.add('/login', 'login')
		.add('/register', 'register')
		.add('/settings', 'settings')

		.add('/talents', 'talents')
		// project pages
		.add('/projects', 'projects')
		.add('/projects/create', 'projects.create')
		.add('/projects/{projectId}', 'project.show')
		.add('/projects/{projectId}/edit', 'projects.edit')


		.add('/projects/{projectId}/roles/{roleId}/matches', 'role.match')
		.add('/projects/{projectId}/roles/{roleId}/like-it-list', 'role.likeitlist')
		.add('/projects/{projectId}/roles/{roleId}/public-like-it-list', 'role.publiclikeitlist')
		.add('/projects/{projectId}/roles/{roleId}/self-submissions', 'role.selfsubmission')


		// roles pages
		.add('/projects/{projectId}/roles/create', 'roles.create')
		.add('/projects/{projectId}/roles/{roleId}/edit', 'roles.edit')

		// end routes

		.finalize();
	}
});

jscore.initialize();
