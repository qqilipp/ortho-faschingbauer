<?php 	
/*************************************************
* ALLOW SHORTCODE IN TEXT FIELD
*************************************************/
add_filter('acf/format_value/type=text', 'do_shortcode');

/*************************************************
* ALLOW UNSAFTE HTML
*************************************************/

add_filter( 'acf/the_field/allow_unsafe_html', function( $allowed, $selector ) {
    if ( $selector === 'text' || $selector === 'headline' || $selector === 'anotherfieldid' || $selector === 'anotherfieldid' || $selector === 'anotherfieldid' ) {
        return true;
    }
    return $allowed;
}, 10, 2);
	
/*************************************************
* ACF OPTIONS SEITEN 
*************************************************/

if( function_exists('acf_add_options_page') ) {

	// Options-Seite Kontaktinfo
	acf_add_options_page( array(
        'page_title'    => 'Kontaktdaten',
        'menu_title'    => 'Kontaktdaten',
        'menu_slug'     => 'acf-kontaktinfo',
        'capability'    => 'edit_posts',
        'icon_url' 		=> 'dashicons-email-alt',	// https://developer.wordpress.org/resource/dashicons/
        'redirect'      => false 					// true = redirect to first child page 
    ));
    
   //  acf_add_options_page( array(
   //      'page_title'    => 'Globaler Hinweis im Info-Balken',
   //      'menu_title'    => 'Info-Balken',
   //      'menu_slug'     => 'acf-infobar',
   //      'capability'    => 'edit_posts',
   //      'icon_url' 		=> 'dashicons-megaphone',	// https://developer.wordpress.org/resource/dashicons/
   //      'redirect'      => false 					// true = redirect to first child page 
   //  ));
    
    // // 1. Unterseite für Kontaktinfo
    // acf_add_options_sub_page(array(
	// 	'title' => 'Unternehmen',
	// 	'slug' => 'Unternehmen',
	// 	'parent' => 'acf-kontaktinfo',
	// ));
    // // 2. Unterseite für Kontaktinfo 
    // acf_add_options_sub_page(array(
	// 	'page_title'    => 'Standorte',
    //     'menu_title'    => 'Standorte',
	// 	'parent' => 'acf-kontaktinfo',
	// ));
}

?>