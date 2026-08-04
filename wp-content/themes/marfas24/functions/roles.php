<?php 
// allow editors to edit nav menus
$role_object = get_role( 'editor' );
$role_object->add_cap( 'edit_theme_options' );

// remove customize link
function remove_customize_page(){
	global $submenu;
	unset($submenu['themes.php'][6]); 
}
add_action( 'admin_menu', 'remove_customize_page');

// hide these admin pages for editors:
if( current_user_can('editor') ) {								 
	function hide_menu_editors() {
		remove_menu_page( 'tools.php', 'tools.php' );   			// hide the tools menu
	    remove_submenu_page( 'themes.php', 'themes.php' ); 			// hide the theme selection submenu
	    remove_submenu_page( 'themes.php', 'widgets.php' ); 		// hide the widgets submenu
	    remove_submenu_page( 'customize.php', 'customize.php' );   	// hide the customize submenu
	    remove_submenu_page( 'themes.php', 'customize.php?return=' . urlencode($_SERVER['SCRIPT_NAME']));
	}	
	add_action('admin_head', 'hide_menu_editors');	
} 

?>