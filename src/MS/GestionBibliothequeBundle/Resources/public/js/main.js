//require('init_date_picker.js')

$( document ).ready(function(){
	 acme.initLocale();
	 acme.initDatePicker();
	
	// activation du menu adherent
	$(".dropdown-button").dropdown();

	// menu smartphones
	$(".button-collapse").sideNav();
	
	// set current tab with class active
//	var selector = 'ul.tabs li.tab';
//	$(selector).on('click', function(){
//	    $(selector).removeClass('active');
//	    $(this).addClass('active');
//	})
	
//	$('.dropdown-button').dropdown('open');
});