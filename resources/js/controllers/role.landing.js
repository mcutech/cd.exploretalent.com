 module.exports = function(core, user, projectId, roleId) {
	var handler = require('../event-handlers/role.landing.js')(core, user, projectId, roleId);

	$('#search-button').on('click', handler.findMatches);

	//refine search toggle location search
	$(document).on('click', '#location-search-change-btn', function(e){
		e.preventDefault();
		$('#location-search-display').show();
		$('#location-search-change').hide();
	});
	$(document).on('click', '#location-search-display-btn', function(e){
		e.preventDefault();
		$('#location-search-display').hide();
		$('#location-search-change').show();
	});

	$(document).on('click', '#contact-talent-btn', handler.confirmCdInfo);
	

	$(document).on('click', '.proceed-btn.confirm-email', function(){
		$('#onboarding-confirm-email').hide();
		$('#onboarding-create-password').show();
	});

	$(document).on('click', '.proceed-btn.create-password', function(){
		if($('#cdpass').val()){
			if($('#cdpass').val()==$('#conf_cdpass').val()){
				$('#onboarding-create-password').hide();
				$('#onboarding-other-email').show();	
			}
			else{
				$('#empty_password').addClass('hide');
				$('#password_mismatch').removeClass('hide');
			}

		}else{
			$('#password_mismatch').addClass('hide');
			$('#empty_password').removeClass('hide');
			
		}
		
	});

	$(document).on('click', '.proceed-btn.other-email', function(){
		$('#onboarding-other-email').hide();
		$('#onboarding-name').show();
	});

	$(document).on('click', '.proceed-btn.your-name', function(){
		$('#onboarding-name').hide();
		$('#onboarding-contact-num1').show();
	});

	$(document).on('click', '.proceed-btn.contact-num1', function(){
		$('#onboarding-contact-num1').hide();
		$('#onboarding-contact-num2').show();
	});

	$(document).on('click', '.proceed-btn.contact-num2', function(){
		$('#onboarding-contact-num2').hide();
		$('#onboarding-company-name').show();
	});

	// $(document).on('click', '.proceed-btn.company-name', function(){
	// 	$('#onboarding-company-name').hide();		
	// 	$('#onboarding-congratulations').show();
	// });

	$(document).on('click', '.proceed-btn.company-name', handler.updateCdInfo);
	

	$(window).on('scroll', function() {
		if ($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
			handler.findMatches(true);
		}
	});
};
