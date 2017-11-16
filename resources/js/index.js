var jscore = require('jscore');

jscore.config(function(core) {
	// @if ENV='development'
	// core.config.api.base = 'http://localhost:8000/api/v1';
	core.config.api.base = 'https://dev-api.exploretalent.com/api/v1';
	// @endif
	// @if ENV='production'
	core.config.api.base = 'https://api.exploretalent.com/api/v1';
	// @endif

	core.config.gapi.key = 'AIzaSyDrPvalUo7Qc6hGNU9jpyyXhZOvSOf6ock';

	core.config.api.type = '/cd';
	core.config.api.client_id      = '1397ef61d42ee4b09f89349b2613a92bda90a1e4';
	core.config.api.client_secret  = '61c9b2b17db77a27841bbeeabff923448b0f6388';
});

jscore.run(function(core) {
	var qs = core.service.query_string();
	if (qs.access_token) {
		localStorage.setItem('access_token', qs.access_token);
		localStorage.setItem('refresh_token', qs.refresh_token || '');
		localStorage.setItem('expires_on', Math.round(new Date().getTime() / 1000) + parseInt(qs.expires_in));
		core.service.rest.settings.headers = { Authorization : 'Bearer ' + qs.access_token };
	}

	core.resource.user.get({ userId : 'me', withs : [ 'bam_cd_user', 'user_apps', 'user_apps.app', 'user_apps.app.app_xorigins' ] })
		.then(init, init);

	function init(user) {
		core.service.rest.settings.statusCode = {
			401: function() {
				if(window.location.pathname !== '/login' && window.location.pathname !== '/register' && window.location.pathname !== '/forgot-password' && window.location.pathname !== '/reset-password' && window.location.pathname !== '/error') {
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




		const cd = {
			homeLogo: '/images/logo-home-et.png',
			slogan: 'Casting Director Module',
            loggedInLogo: '/images/logo-home-et-cd.png',
            bodyClass: 'cd',
            favicon: '/images/favicon.ico',
		};

		const auditions = {
			homeLogo: '/images/Auditions-net/logo.png',
			slogan: 'Casting Director Module',
            loggedInLogo: '/images/Auditions-net/logo-loggedin.png',
            bodyClass: 'auditions',
            favicon: '/images/Auditions-net/favicon.ico',
		};




		//create deep nested property for skins to avoid variable override in templates
		core.vars = {
			skins: {}
		};

        // Check which version of the skin we want?
		if ( /(.*)auditions\.net$/.test(window.location.hostname) ) {
			core.vars.skins = auditions;
		}
		else {
			core.vars.skins = cd;
		}

		self.core.service.databind('.skins', core.vars);



		// default parameters for all controllers
		core.service.router.$$params = [core, user];

		core.service.router

		// add routes here
		.add('/login'           , 'login')
		.add('/register'        , 'register')
		.add('/settings'        , 'settings')
		.add('/welcome'         , 'welcome')
		.add('/reset-password'  , 'password.reset')
		.add('/forgot-password' , 'password.forgot')

		// talents
		.add('/talents'            , 'talent.index')
		.add('/talents/favorite'   , 'talent.favorite')
		.add('/talents/{talentId}' , 'talent.resume')

		//landing
		.add('/landing' , 'landing.index')

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
		.add('/projects/{projectId}/roles/{roleId}/landing'                           , 'role.landing')
		.add('/projects/{projectId}/roles/{roleId}/public-like-it-list'               , 'role.publiclikeitlist')
		.add('/projects/{projectId}/roles/{roleId}/public-like-it-list/{accessToken}' , 'role.publiclikeitlist')
		.add('/projects/{projectId}/roles/{roleId}/edit'                              , 'role.edit')

		.add('/audition-worksheet/{campaignId}' , 'worksheet.show')
		.add('/audition-worksheet'              , 'worksheet')
	    .add('/messages/{projectId}/{roleId}'   , 'message')
	    .add('/messages/{projectId}'            , 'message')
	    .add('/messages'                        , 'message')
		.add('/feedback'                        , 'feedback')
        .add('/error'                           , 'error')
		.add('/unsubscribe'						, 'unsubscribe')

		// end routes

		.finalize();
	}
});

jscore.initialize();
