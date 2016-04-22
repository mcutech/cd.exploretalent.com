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
	core.config.api.client_id      = '74d89ce4c4838cf495ddf6710796ae4d5420dc91';
	core.config.api.client_secret  = '61c9b2b17db77a27841bbeeabff923448b0f6388';
});

jscore.run(function(core) {
	var qs = core.service.query_string();
	if (qs.access_token) {
		localStorage.setItem('access_token', qs.access_token);
		localStorage.setItem('refresh_token', qs.refresh_token);
		core.service.rest.settings.headers = { Authorization : 'Bearer ' + qs.access_token };
	}

	core.resource.user.get({ userId : 'me', withs : [ 'bam_cd_user' ] })
		.then(init, init);

	function init(user) {
		core.service.rest.settings.statusCode = {
			401: function() {
				if(window.location.pathname !== '/login' && window.location.pathname !== '/register' && window.location.pathname !== '/forgot-password' && window.location.pathname !== '/reset-password') {
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
		.add('/login'           , 'login')
		.add('/register'        , 'register')
		.add('/settings'        , 'settings')
		.add('/reset-password'  , 'password.reset')
		.add('/forgot-password' , 'password.forgot')

		// talents
		.add('/talents'            , 'talent.index')
		.add('/talents/favorite'   , 'talent.favorite')
		.add('/talents/{talentId}' , 'talent.resume')

		// project pages
		.add('/projects'                       , 'project.index')
		.add('/projects/create'                , 'project.create')
		.add('/projects/quickpost'             , 'project.quickpost')
		.add('/projects/{projectId}/edit'      , 'project.edit')
		.add('/projects/{projectId}/worksheet' , 'project.worksheet')
		.add('/projects/{projectId}'           , 'project.show')

		// roles pages
		.add('/projects/{projectId}/roles/create'                                     , 'role.create')
		.add('/projects/{projectId}/roles/{roleId}/worksheet'                         , 'role.worksheet')
		.add('/projects/{projectId}/roles/{roleId}/like-it-list'                      , 'role.like-it-list')
		.add('/projects/{projectId}/roles/{roleId}/find-talents'                      , 'role.find-talents')
		.add('/projects/{projectId}/roles/{roleId}/submissions'                       , 'role.submissions')
		.add('/projects/{projectId}/roles/{roleId}/callbacks'                         , 'role.callbacks')
		.add('/projects/{projectId}/roles/{roleId}/booked'                            , 'role.booked')
		.add('/projects/{projectId}/roles/{roleId}/public-like-it-list'               , 'role.publiclikeitlist')
		.add('/projects/{projectId}/roles/{roleId}/public-like-it-list/{accessToken}' , 'role.publiclikeitlist')
		.add('/projects/{projectId}/roles/{roleId}/edit'                              , 'role.edit')

		.add('/audition-worksheet/{campaignId}' , 'worksheet.show')
		.add('/audition-worksheet'              , 'worksheet')
	    .add('/messages/{projectId}/{roleId}'   , 'message')
	    .add('/messages/{projectId}'            , 'message')
	    .add('/messages'                        , 'message')
		.add('/feedback'                        , 'feedback')

		// end routes

		.finalize();
	}
});

jscore.initialize();
