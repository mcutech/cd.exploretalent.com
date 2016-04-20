'use strict';

function handler(core, user){
	self = this;
	self.core = core;
	self.user = user;
	self.refreshList();
}

handler.prototype.refreshList = function(){
	var qs = self.core.service.query_string();
	var data = {
		query : [
			[ 'with', 'bam_roles' ],
			['orderBy', 'last_modified','DESC'],
		],
		page : qs.page || 1,
		per_page : 20
	};

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
			self.core.service.databind('#projects-list', res);
			self.core.service.paginate('#projects-pagination', { total : res.total, class : 'pagination', name : 'page', per_page: res.per_page });
			self.core.service.paginate('#projects-pagination2', { total : res.total, class : 'pagination', name : 'page', per_page: res.per_page });
		});
}

module.exports = function(core, user) {
	return new handler(core, user);
};
