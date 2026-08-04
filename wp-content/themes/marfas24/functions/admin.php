<?php 

/*************************************************
* KOMMENTARE AUSBLENDEN
*************************************************/
function tigris_remove_menus() {	
	remove_menu_page( 'edit-comments.php' );        // Kommentare ausblenden
}
add_action('admin_menu', 'tigris_remove_menus');


/*************************************************
* TAGS deaktivieren
*************************************************/

function tigris_unregister_tags() {
    unregister_taxonomy_for_object_type('post_tag', 'post');
}
add_action('init', 'tigris_unregister_tags');


/*************************************************
* SPALTEN/FELDER ausblenden
*************************************************/

function tigris_deactivate_support() {

	/* Posts */
    remove_post_type_support( 'post', 'comments' );
    // remove_post_type_support( 'post', 'author' );
    // remove_post_type_support( 'post', 'thumbnail' );
    
    /* pages */
    remove_post_type_support( 'page', 'comments' );
}
add_action( 'admin_init', 'tigris_deactivate_support' );


/*************************************************
* Admin Style CSS
*************************************************/

function tigris_admin_style() {
  wp_enqueue_style('admin-styles', get_template_directory_uri().'/css/admin.css');
}
add_action('admin_enqueue_scripts', 'tigris_admin_style');


/*************************************************
* EDITOR
*************************************************/

// Editor Style CSS
function tigris_editor_styles() {
    add_editor_style( 'css/editor.css' );
}
add_action( 'after_setup_theme', 'tigris_editor_styles' );

// Editor Buttons entfernen, 1. Zeile
function tigris_mce_buttons_1($buttons) {
	$remove = array('wp_more');
	return array_diff($buttons,$remove);
}
add_filter('mce_buttons','tigris_mce_buttons_1');

// Editor Buttons entfernen, 2. Zeile
function tigris_mce_buttons_2($buttons) {
	$remove = array('alignjustify','forecolor','underline');
	return array_diff($buttons,$remove);
}
add_filter('mce_buttons_2','tigris_mce_buttons_2');

// Editor Dropdown - h1, h2, pre entfernen
function tigris_format_mce( $in ) {
    $in['block_formats'] = "Absatz=p;Überschrift 3=h3;Überschrift 4=h4;Überschrift 5=h5;Überschrift 6=h6;";
    return $in;
}
add_filter( 'tiny_mce_before_init', 'tigris_format_mce' );


?>