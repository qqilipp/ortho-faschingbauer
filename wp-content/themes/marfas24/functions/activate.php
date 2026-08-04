<?php 

add_action( 'after_switch_theme', 'create_page_on_theme_activation' );

function create_page_on_theme_activation() {

    // $new_page_title     = 'Beispielseite Inhaltsbereiche';
    // $page_check 		= get_page_by_title( $new_page_title );
    // $new_page = array(
    //         'post_type'     => 'page', 
    //         'post_title'    => $new_page_title,
    //         'post_content'  => $new_page_content,
    //         'post_status'   => 'publish',
    //         'post_author'   => 1,
    //         'post_name'     => 'beispielseite',
    //         'menu_order'	=> 0
    //         );    
    // if( !isset( $page_check->ID ) ) {
    //     $new_page_id = wp_insert_post( $new_page );
    //     if( !empty( $new_page_template ) ) {
    //         update_post_meta( $new_page_id, '_wp_page_template', $new_page_template );
    //     }
    // }
    
    $new_page_title     = 'Kontakt';
    $page_check 		= get_page_by_title( $new_page_title );
    $new_page = array(
            'post_type'     => 'page', 
            'post_title'    => $new_page_title,
            'post_content'  => $new_page_content,
            'post_status'   => 'publish',
            'post_author'   => 1,
            'post_name'     => 'kontakt',
            'menu_order'	=> 900
            );    
    if( !isset( $page_check->ID ) ) {
        $new_page_id = wp_insert_post( $new_page );
        if( !empty( $new_page_template ) ) {
            update_post_meta( $new_page_id, '_wp_page_template', $new_page_template );
        }
    }
    
    $new_page_title     = 'Datenschutz'; 
    $page_check 		= get_page_by_title( $new_page_title ); 
    $new_page = array(
            'post_type'     => 'page', 
            'post_title'    => $new_page_title,
            'post_content'  => $new_page_content,
            'post_status'   => 'publish',
            'post_author'   => 1,
            'post_name'     => 'datenschutz',
            'menu_order'	=> 998
    );    
    if( !isset( $page_check->ID ) ) {
        $new_page_id = wp_insert_post( $new_page );
        if( !empty( $new_page_template ) ) {
            update_post_meta( $new_page_id, '_wp_page_template', $new_page_template );
        }
    }
    
    $new_page_title     = 'Impressum';
    $page_check 		= get_page_by_title( $new_page_title );
    $new_page = array(
            'post_type'     => 'page', 
            'post_title'    => $new_page_title,
            'post_content'  => $new_page_content,
            'post_status'   => 'publish',
            'post_author'   => 1,
            'post_name'     => 'impressum',
            'menu_order'	=> 999
            );    
    if( !isset( $page_check->ID ) ) {
        $new_page_id = wp_insert_post( $new_page );
        if( !empty( $new_page_template ) ) {
            update_post_meta( $new_page_id, '_wp_page_template', $new_page_template );
        }
    }   
}


add_action( 'after_switch_theme', 'create_menu_on_theme_activation' );

function create_menu_on_theme_activation() {
	
	$menus = array(
		// 'Top Menu' => array(
		//     'home' => 'Home', 
		//     'contact' => 'Contact', 
		//     'sitemap' => 'Sitemap'
		//   ),
		'Subfooter'	=> array(
			'datenschutz'  	=> 'Datenschutz', 
			'impressum'  	=> 'Impressum'
		),
	);
	
	foreach( $menus as $menuname => $menuitems ) {
		$menu_exists = wp_get_nav_menu_object( $menuname );
		// If it doesn't exist, let's create it.
		if ( !$menu_exists ) {
	    	$menu_id = wp_create_nav_menu( $menuname );
			foreach( $menuitems as $slug => $item ) {
				wp_update_nav_menu_item(
					$menu_id, 0, array(
						'menu-item-title'  		=> $item,
						'menu-item-object'  	=> 'page',
						'menu-item-object-id'  	=> get_page_by_path($slug)->ID,
						'menu-item-type' 		=> 'post_type',
						'menu-item-status'  	=> 'publish'
					)
				);
	    	}
		}
	}	
}

// $locations = get_theme_mod('nav_menu_locations');
// $locations['subfooter'] = $term_id_of_menu;
// set_theme_mod( 'nav_menu_locations', $locations );






