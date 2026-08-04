<?php add_theme_support('post-thumbnails');
	
		add_image_size('slider', 		1920,  768, true);
		add_image_size('slider_s', 		 840,  700, true);
	//	add_image_size('slider_s_high',  840,  840, true);
	
		add_image_size('sliderlow', 	1920,  600, true);
		add_image_size('sliderlow_s', 	 840,  660, true);
	
		add_image_size('square', 		1200, 1200, true);
		add_image_size('square_s', 		 840,  840, true);
	
		add_image_size('landscape', 	1200, 1000, true);
		add_image_size('landscape_s', 	 900,  750, true);
	//	add_image_size('landscape_h',	1200, 1000, true);
	
		add_image_size('portrait', 		 900, 1120, true);
		add_image_size('portrait_s', 	 800, 1000, true);
	
	//	add_image_size('portrait', 		 900, 1200, true);
	//	add_image_size('portrait_s', 	 840, 1120, true);
	
	
	add_filter('jpeg_quality', function($arg) { return 100; } );
?>