jQuery(document).ready(function() {
	jQuery("div.work-panel img.cs-hover-image").hide();
	jQuery("div.work-panel").hover(function() {
		jQuery(this).find('img').fadeIn(200);
	}, function() {
		jQuery(this).find('img.cs-hover-image').fadeOut(200);
	});
	
	jQuery("div.work-panel").click(function(){
    	window.location=jQuery(this).find("a").attr("href");
    	return false;
	});
    jQuery('.work-panel').hover(function() {
	  jQuery(this).addClass('active');
	}, function() {
	  jQuery(this).removeClass('active');
	});

	jQuery(".fade img").fadeTo(10, 0.15);
	
	jQuery('.fade img').hover(function() {
		jQuery(this).fadeTo(100, 1);
	}, function() {
		jQuery(".fade img").fadeTo(100, 0.15);
	});
	
});