jQuery(document).ready(function() { 

	jQuery('#twitter-home').twitterSearch({ 
    term:  '@findingsimple findingsimple', 
    title: '',
    colorExterior: '#f1f1f1', 
    colorInterior: 'white', 
    });

	jQuery('#home-test .test-content');
	setInterval(function(){
		jQuery('#home-test .test-content').filter(':visible').fadeOut(1000,function(){
			if(jQuery(this).next('div.test-content').size()){
				jQuery(this).next().fadeIn(1000);
			}
			else{
				jQuery('#home-test .test-content').eq(0).fadeIn(1000);
			}
		});
	},10000);
}); 