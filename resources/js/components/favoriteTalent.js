module.exports = function(core, user) {

	console.log(user);

	$(document).on('click', '.favorite-talent', function(e){
		e.preventDefault();
		var talentnum = $(this).attr('id');
		console.log(talentnum);
		

		core.resource.favorite_talent.get({ bam_cd_user_id : user.bam_cd_user.user_id, bam_talentnum : talentnum})
			.then(function(res){
				var a = [], b = [];
				console.log(res);
				_.each(res.data, function(val, ind){
					a.push(val.bam_talentnum);
					b.push(val.id);
					/*console.log(val.bam_talentnum);
					if(val.bam_talentnum == talentnum){
						console.log('deleted');
						;
					} else {
						console.log('added');
						;
					}*/
				});
				
				_.each(a, function(val1, ind1){
					if(val1 == talentnum){
						console.log('deleted');
					} else {
						console.log('added');
					}
					return false;
				})
			});
		
	});
}
