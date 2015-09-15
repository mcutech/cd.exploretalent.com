'use strict';

function handler(core, user){

	self = this;
	self.core = core;
	self.user = user;
	self.refreshList();
}

handler.prototype.refreshList = function(){
	console.log(self.user);

	var data = {
		casting_id : self.user.bam_cd_user.user_id,
		withs : [
			'bam_roles'
		],
		per_page : 5,
		/*wheres : [
			[ 'where', 'casting_id', '=', self.user.bam_cd_user.user_id]
		]*/
	};

	return self.core.resource.project.get(data)
		.then(function(res){
			console.log(res);

			_.each(res.data, function(value, index){
				//for rate
				switch(value.rate_des){
					case 0:
						res.data[index].rate_des = "";
						break;
					case 1:
						res.data[index].rate_des = "event";
						break;
					case 2:
						res.data[index].rate_des = "hour";
						break;
					case 3:
						res.data[index].rate_des = "day";
						break;
					case 4:
						res.data[index].rate_des = "week";
						break;
					case 5:
						res.data[index].rate_des = "month";
						break;
				}
				
				//for category
				switch(value.cat){
					case 0:
						res.data[index].cat = "";
						break;
					case 43:
						res.data[index].cat = "Acting - Acrobatics/Stunts";
						break;
					case 41:
						res.data[index].cat = "Acting - Comedy/Clown";
						break;
					case 61:
						res.data[index].cat = "Acting - Other";
						break;
					case 42:
						res.data[index].cat = "Variety - Variety Acts";
						break;
					case 1:
						res.data[index].cat = "Commercials";
						break;
					case 16:
						res.data[index].cat = "Crew - Assistants & Entry Level";
						break;
					case 49:
						res.data[index].cat = "Crew - Accounting/Payroll/HR";
						break;
					case 35:
						res.data[index].cat = "Crew - Camera/Editor";
						break;
					case 48:
						res.data[index].cat = "Crew - Graphic/Web/Animate";
						break;
					case 34:
						res.data[index].cat = "Crew - Ligthing/Sound";
						break;
					case 37:
						res.data[index].cat = "Crew - Make Up/Stylist";
						break;
					case 51:
						res.data[index].cat = "Crew - Management";
						break;
					case 25:
						res.data[index].cat = "Crew - Marketing/PR";
						break;
					case 38:
						res.data[index].cat = "Crew - Other";
						break;
					case 36:
						res.data[index].cat = "Crew - Producer/Director";
						break;
					case 40:
						res.data[index].cat = "Crew - Showbiz Internship";
						break;
					case 52:
						res.data[index].cat = "Crew - Talent/Casting Mgmt";
						break;
					case 50:
						res.data[index].cat = "Crew - Technology/MIS";
						break;
					case 47:
						res.data[index].cat = "Crew - TV/Radio";
						break;
					case 39:
						res.data[index].cat = "Crew - Writing/Script/Edit";
						break;
					case 3:
						res.data[index].cat = "Dance - Ballet/Classic";
						break;
					case 56:
						res.data[index].cat = "Dance - Choreography";
						break;
					case 54:
						res.data[index].cat = "Dance - Club/Gogo";
						break;
					case 53:
						res.data[index].cat = "Dance - HipHop";
						break;
					case 4:
						res.data[index].cat = "Dance - Modern/Jazz";
						break;
					case 58:
						res.data[index].cat = "Dance - Other/General";
						break;
					case 57:
						res.data[index].cat = "Dance - Teacher";
						break;
					case 55:
						res.data[index].cat = "Dance - Traditonal/Latin";
						break;
					case 5:
						res.data[index].cat = "Episodic TV - Pilots";
						break;
					case 6:
						res.data[index].cat = "Episodic TV - SAG";
						break;
					case 7:
						res.data[index].cat = "Episodic TV - AFTRA";
						break;
					case 8:
						res.data[index].cat = "Episodic TV - Non-Union";
						break;
					case 60:
						res.data[index].cat = "Extras";
						break;
					case 9:
						res.data[index].cat = "Feature Film - SAG";
						break;
					case 10:
						res.data[index].cat = "Feature Film - Non-SAG";
						break;
					case 11:
						res.data[index].cat = "Feature Film - Student Films";
						break;
					case 12:
						res.data[index].cat = "Feature Film - Short Film";
						break;
					case 13:
						res.data[index].cat = "Feature Film - Documentaries";
						break;
					case 14:
						res.data[index].cat = "Feature Film - :Low Budget/Independent";
						break;
					case 15:
						res.data[index].cat = "Infomercials";
						break;
					case 17:
						res.data[index].cat = "Industrial/Training Films";
						break;
					case 27:
						res.data[index].cat = "Internet";
						break;
					case 18:
						res.data[index].cat = "Modeling - Runway";
						break;
					case 19:
						res.data[index].cat = "Modeling - Hair/Cosmetics";
						break;
					case 20:
						res.data[index].cat = "Modeling - Print";
						break;
					case 21:
						res.data[index].cat = "Music Videos";
						break;
					case 44:
						res.data[index].cat = "Music - Band";
						break;
					case 45:
						res.data[index].cat = "Music - DJ/Sound";
						break;
					case 30:
						res.data[index].cat = "Music - Horns";
						break;
					case 32:
						res.data[index].cat = "Music - Drums";
						break;
					case 31:
						res.data[index].cat = "Music - Keyboards";
						break;
					case 33:
						res.data[index].cat = "Music - Other";
						break;
					case 29:
						res.data[index].cat = "Music - Strings";
						break;
					case 46:
						res.data[index].cat = "Music - Teacher";
						break;
					case 28:
						res.data[index].cat = "Music - Vocals";
						break;
					case 59:
						res.data[index].cat = "Reality TV";
						break;
					case 22:
						res.data[index].cat = "Theatre - Equity (Union)";
						break;
					case 23:
						res.data[index].cat = "Theatre - Non-Equity";
						break;
					case 24:
						res.data[index].cat = "Trade Shows/Live Events/Promo Model";
						break;
					case 26:
						res.data[index].cat = "Voice Over";
						break;
				}
				
				_.each(value.bam_roles, function(res1, index1){

					//convert height_min to feet
					var inches = (res1.height_min*0.393700787).toFixed(0);
				    var feet = Math.floor(inches / 12);
				    inches %= 12;
				    res.data[index].bam_roles[index1].height_min = feet + "' " + inches + '"';

					res.data[index].bam_roles[index1].height_min = feet + "' " + inches + '"';
					//convert height_max to feet
					var inches = (res1.height_max*0.393700787).toFixed(0);
				    var feet = Math.floor(inches / 12);
				    inches %= 12;
				    res.data[index].bam_roles[index1].height_max = feet + "' " + inches + '"';
				})
			})
			

			self.core.service.databind('#project-listing', res);
		});
}

module.exports = function(core, user) {
	return new handler(core, user);
};