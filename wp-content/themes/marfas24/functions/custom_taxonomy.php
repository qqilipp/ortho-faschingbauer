<?php
// hook into the init action and call create_produkte_taxonomies when it fires
add_action( 'init', 'create_produkte_taxonomies', 0 );

// create two taxonomies, Produktkategorien and Marken for the post type "produkte"
function create_produkte_taxonomies() {

	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Produktkategorien', 'taxonomy general name' ),				// Plural
		'singular_name'     => _x( 'Produktkategorie', 'taxonomy singular name' ),				// Singular
		'search_items'      => __( 'Produktkategorie suchen' ),
		'parent_item'       => __( 'Übergeordnete Kategorie' ),
		'parent_item_colon' => __( 'Übergeordnete Produktkategorie:' ),
		'edit_item'         => __( 'Produktkategorie bearbeiten' ),
		'update_item'       => __( 'Produktkategorie aktualisieren' ),
		'add_new_item'      => __( 'Produktkategorie hinzufügen' ),
		'new_item_name'     => __( 'Neue Produktkategorie' ),
		'menu_name'         => __( 'Produktkategorien' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'produktkategorie' ),							// Slug
	);

	register_taxonomy( 'produktkategorie', array( 'produkte' ), $args );

	// Add new taxonomy, NOT hierarchical (like tags)
	$labels = array(
		'name'                       => _x( 'Marken', 'taxonomy general name' ),
		'singular_name'              => _x( 'Marke', 'taxonomy singular name' ),
		'search_items'               => __( 'Marken durchsuchen' ),
		'popular_items'              => __( 'Häufigste Marken' ),
		'all_items'                  => __( 'Alle Marken' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Marke bearbeiten' ),
		'update_item'                => __( 'Marke aktualisieren' ),
		'add_new_item'               => __( 'Neue Marke' ),
		'new_item_name'              => __( 'Neue Marke' ),
		'separate_items_with_commas' => __( 'Markenmit Beistrich trennen' ),
		'add_or_remove_items'        => __( 'Marken hinzufügen oder entfernen' ),
		'choose_from_most_used'      => __( 'Am häufigsten verwendete Marken' ),
		'not_found'                  => __( 'Keine Marken gefunden.' ),
		'menu_name'                  => __( 'Marken' ),
	);

	$args = array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'marke' ),
	);

	register_taxonomy( 'marke', 'produkte', $args );
}
?>