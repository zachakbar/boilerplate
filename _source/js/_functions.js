/************************************************************************/
/* JAVASCRIPT FUNCTIONS
/************************************************************************/

function initMobileNav(){
	
	var menu = $('#menu'),
		nav_btn = $('#nav_btn');

	nav_btn.click(function() {
		nav_btn.toggleClass('active');
		nav_btn.find('#nav_icon').toggleClass('open');
		menu.slideToggle('fast');
		return false;
	});
}