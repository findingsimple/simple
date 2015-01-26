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

	//Check to see if the window is top if not then display button
	jQuery(window).scroll(function(){
		if ( jQuery(this).scrollTop() > 100) {
			jQuery('.scrollToTop').fadeIn();
		} else {
			jQuery('.scrollToTop').fadeOut();
		}
	});
	
	//Click event to scroll to top
	$('.scrollToTop').click(function(){
		jQuery('html, body').animate({scrollTop : 0},800);
		return false;
	});

});

