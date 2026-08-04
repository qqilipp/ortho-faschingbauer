<?php 
add_theme_support( 'menus' );

if ( function_exists( 'register_nav_menu' ) )
	register_nav_menu('menu_main', 'Hauptnavigation');
	register_nav_menu('menu_mobile', 'Hauptnavigation mobil');
	// register_nav_menu('menu_meta', 'Metanavigation');
	register_nav_menu('menu_footer1', 'Footer 1');
	register_nav_menu('menu_footer2', 'Footer 2');
	register_nav_menu('menu_footer3', 'Footer 3');
	register_nav_menu('menu_subfooter', 'Subfooter');
	// register_nav_menu('menu_master', 'SEO Menu (nicht verändern)');
	
?>