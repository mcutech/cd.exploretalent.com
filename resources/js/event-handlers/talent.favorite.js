function handler(core, user){
	self = this;
	self.core = core;
	self.user = user;
	self.refresh();
}
handler.prototype.refresh = function(){
	

	self.core.resource.favorite_talent.get()
	.then(function(result){
		console.log(result);
	}) 
	
};
module.exports = function(core, user){
	return new handler(core, user);
}