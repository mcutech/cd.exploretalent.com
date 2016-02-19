$(document).on('click', '#scheduled-photo-view-2', function(){
	$('#role-list-container .view-container').addClass('talent-photo-view')
	$('#role-list-container .view-container').removeClass('talent-confirmation-view submission-note-view casting-note-view list-view');
});
$(document).on('click', '#scheduled-confirmation-view-2', function(){
	$('#role-list-container .view-container').addClass('talent-confirmation-view')
	$('#role-list-container .view-container').removeClass('talent-photo-view submission-note-view casting-note-view list-view');
});
$(document).on('click', '#scheduled-submission-note-view-2', function(){
	$('#role-list-container .view-container').addClass('submission-note-view')
	$('#role-list-container .view-container').removeClass('talent-photo-view talent-confirmation-view casting-note-view list-view');
});	
$(document).on('click', '#scheduled-casting-note-view-2', function(){
	$('#role-list-container .view-container').addClass('casting-note-view')
	$('#role-list-container .view-container').removeClass('talent-photo-view submission-note-view talent-confirmation-view list-view');
});
$(document).on('click', '#scheduled-list-view-2', function(){
	$('#role-list-container .view-container').addClass('list-view')
	$('#role-list-container .view-container').removeClass('talent-photo-view submission-note-view talent-confirmation-view casting-note-view');
});	

$(document).on('click', '#scheduled-photo-view-1', function(){
	$('#schedule-time-container .view-container').addClass('talent-photo-view')
	$('#schedule-time-container .view-container').removeClass('talent-confirmation-view submission-note-view casting-note-view list-view');
});
$(document).on('click', '#scheduled-confirmation-view-1', function(){
	$('#schedule-time-container .view-container').addClass('talent-confirmation-view')
	$('#schedule-time-container .view-container').removeClass('talent-photo-view submission-note-view casting-note-view list-view');
});
$(document).on('click', '#scheduled-submission-note-view-1', function(){
	$('#schedule-time-container .view-container').addClass('submission-note-view')
	$('#schedule-time-container .view-container').removeClass('talent-photo-view talent-confirmation-view casting-note-view list-view');
});	
$(document).on('click', '#scheduled-casting-note-view-1', function(){
	$('#schedule-time-container .view-container').addClass('casting-note-view')
	$('#schedule-time-container .view-container').removeClass('talent-photo-view submission-note-view talent-confirmation-view list-view');
});
$(document).on('click', '#scheduled-list-view-1', function(){
	$('#schedule-time-container .view-container').addClass('list-view')
	$('#schedule-time-container .view-container').removeClass('talent-photo-view submission-note-view talent-confirmation-view casting-note-view');
});	


$(function () {
	var $height = $(window).height();
	var $adheight = $height - 200;
	$('#role-list-container').css('height', $adheight +'px');
	$('#role-list-container').slimScroll({ height: $adheight });
	$('#schedule-time-container').css('height', $adheight +'px');
	$('#schedule-time-container').slimScroll({ height: $adheight });
});