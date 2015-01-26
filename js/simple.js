jQuery(document).ready(function(){

	jQuery('#header .search-toggle a').click(function(){
		jQuery('#header .search-form .form-group').animate({width: 'toggle'});
		jQuery('#header .search-form .form-group input.search-text').focus();
	});

	jQuery(".entry-content").fitVids();

	var resized;

	jQuery(window).resize(function() {

		clearTimeout(resized);

		resized = setTimeout(function() {

			if ( Modernizr.mq('(max-width:767px)' ) ) {

				jQuery('#header .search-form .form-group').removeAttr('style'); 

			}

		}, 100);

	});

	jQuery('form.search-form').submit(function(e){

		if( jQuery.trim( jQuery(this).find('input.search-text').val() ) == "" ){
			return false;
		}

	});

});

