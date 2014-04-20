jQuery(document).ready(function(){

	jQuery('#header .search-toggle a').click(function(){
	    jQuery('#header .search-form .form-group').animate({width: 'toggle'});
	});

	jQuery(".entry-content").fitVids();

	jQuery(window).resize(function() {

	 	if ( Modernizr.mq('(max-width:767px)' ) ) {

			jQuery('#header .search-form .form-group').removeAttr('style'); 

		} 

	});

});

