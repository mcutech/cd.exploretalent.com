'use strict';

function handler(core, user){
	self = this;
	self.core = core;
	self.user = user;
	self.refreshList();
}

handler.prototype.refreshList = function(){
	var qs = self.core.service.query_string();
	var btnExpiredCastings = $('#btn-show-expired-castings');

	if(qs.expired == 'true'){
		var data = {
			query : [
				[ 'with', 'bam_roles' ],
				['orderBy', 'sub_timestamp','DESC'],
			],
			page : qs.page || 1,
			per_page : 20
		};
		btnExpiredCastings.text('Do not show Expired Projects');
		btnExpiredCastings.attr('href', 'projects?expired=false');
	}
	else{
		var data = {
			query : [
				[ 'with', 'bam_roles' ],
				[ 'where', 'asap', '>=', Math.floor(new Date().getTime() / 1000)],
				['orderBy', 'sub_timestamp','DESC'],
			],
			page : qs.page || 1,
			per_page : 20
		};
		btnExpiredCastings.text('Show Expired Projects');
		btnExpiredCastings.attr('href', 'projects?expired=true');
	}

	var searchterm = $('#project-name').val();

	if(searchterm) {
		data.query.push([ 'where', [
				[ 'where', 'project', 'LIKE', '%' + searchterm + '%' ],
				[ 'orWhere', 'name', 'LIKE', '%' + searchterm + '%' ],
				[ 'orWhere', 'name_original', 'LIKE', '%' + searchterm + '%' ],
				[ 'orWhere', 'casting_id', '=', searchterm ]
			]
		]);
	}

	var status = $('#project-status').val();

	if(status) {
		if(status == '1') { // ACTIVE
			data.query.push([ 'where', [
					[ 'where', 'status', '=', 1 ],
				]
			]);
		}
		else if(status == '0') { // PENDING REVIEW
			data.query.push([ 'where', [
					[ 'where', 'status', '=', 0 ],
				]
			]);
		}
		else { // ALL
			// push nothing to query
		}
	}

	self.core.resource.project.get(data)
		.then(function(res){
			console.log(res);
			if(res.data.length == 0) {
				$('#no-projects-found').removeClass('hide');
			}

			if(res.data.length == 0) {
				$('.no-project-found-header-hide, .breadcrumb').addClass('hide');
			}

			self.core.service.databind('#projects-list', res);
			self.core.service.paginate('#projects-pagination', { total : res.total, class : 'pagination', name : 'page', per_page: res.per_page });
			self.core.service.paginate('#projects-pagination2', { total : res.total, class : 'pagination', name : 'page', per_page: res.per_page });
		});
}

module.exports = function(core, user) {
	return new handler(core, user);
};
