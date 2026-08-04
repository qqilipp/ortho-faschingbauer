<?php 
if( function_exists('acf_add_options_page') ) {
	acf_add_options_sub_page( 
		array(
			'title' 	 => 'SEO Optionen',
			'slug' 		 => 'seooptions',
			'parent' 	 => 'options-general.php',
			'capability' => 'manage_options'
		)
	);
}		
	
if( function_exists('acf_add_local_field_group') ) {
	
	// SEO Informationen (Post Types)
	acf_add_local_field_group(
		array(
			'key' => 'group_5ec2a51b1d832',
			'title' => 'SEO Informationen',
			'fields' => array(
				array(
					'key' => 'field_5ec2a52401841',
					'label' => 'SEO Titel',
					'name' => 'seotitle',
					'type' => 'text',
					'instructions' => '(meta title)',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => 70,
				),
				array(
					'key' => 'field_5ec2a53601842',
					'label' => 'SEO Beschreibung',
					'name' => 'seodescr',
					'type' => 'textarea',
					'instructions' => '(meta description)',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'maxlength' => 180,
					'rows' => 3,
					'new_lines' => '',
				),
				// array(
				// 	'key' => 'field_60c0504962751',
				// 	'label' => 'Vorschaubild',
				// 	'name' => 'seoimg',
				// 	'type' => 'image',
				// 	'instructions' => 'Empfohlene Größe: 1200 × 630 Pixel',
				// 	'required' => 0,
				// 	'conditional_logic' => 0,
				// 	'wrapper' => array(
				// 		'width' => '',
				// 		'class' => '',
				// 		'id' => '',
				// 	),
				// 	'return_format' => 'url',
				// 	'preview_size' => 'thumbnail',
				// 	'library' => 'all',
				// 	'min_width' => '',
				// 	'min_height' => '',
				// 	'min_size' => '',
				// 	'max_width' => '',
				// 	'max_height' => '',
				// 	'max_size' => '',
				// 	'mime_types' => '',
				// ),
				// array(
				// 	'key' => 'field_60c05429a13b9',
				// 	'label' => 'SEO Index',
				// 	'name' => 'seonoindex',
				// 	'type' => 'true_false',
				// 	'instructions' => '',
				// 	'required' => 0,
				// 	'conditional_logic' => 0,
				// 	'wrapper' => array(
				// 		'width' => '',
				// 		'class' => '',
				// 		'id' => '',
				// 	),
				// 	'message' => 'Seite vor Suchmaschinen verstecken',
				// 	'default_value' => 0,
				// 	'ui' => 0,
				// 	'ui_on_text' => '',
				// 	'ui_off_text' => '',
				// ),
			),
			'location' => array(
				array(
					array(
						'param' => 'post_type',
						'operator' => '==',
						'value' => 'all',
					),
				),
				// array(
				// 	array(
				// 		'param' => 'post_type',
				// 		'operator' => '==',
				// 		'value' => 'page',
				// 	),
				// ),
				// array(
				// 	array(
				// 		'param' => 'post_type',
				// 		'operator' => '==',
				// 		'value' => 'produkte',
				// 	),
				// ),
				// array(
				// 	array(
				// 		'param' => 'post_type',
				// 		'operator' => '==',
				// 		'value' => 'termine',
				// 	),
				// ),
				// // Taxonomien. 
				// array(
				// 	array(
				// 		'param' => 'taxonomy',
				// 		'operator' => '==',
				// 		'value' => 'all',
				// 	),
				// ),
			),
			'menu_order' => 999,
			'position' => 'normal',
			'style' => 'default',
			'label_placement' => 'left',
			'instruction_placement' => 'label',
			'hide_on_screen' => '',
			'active' => true,
			'description' => '',
		)
	);
	
	// SEO Optionen (on options page)
	acf_add_local_field_group(
		array(
			'key' => 'group_60c05263370fd',
			'title' => 'SEO Optionen',
			'fields' => array(
				array(
					'key' => 'field_60c0526b62ab6',
					'label' => 'Trennzeichen',
					'name' => 'seodivider',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '•',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
				array(
					'key' => 'field_60c0528062ab7',
					'label' => 'Suffix',
					'name' => 'seosuffix',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
			),
			'location' => array(
				array(
					array(
						'param' => 'options_page',
						'operator' => '==',
						'value' => 'seooptions',
					),
				),
			),
			'menu_order' => 999,
			'position' => 'normal',
			'style' => 'default',
			'label_placement' => 'left',
			'instruction_placement' => 'label',
			'hide_on_screen' => '',
			'active' => true,
			'description' => '',
		)
	);

}
?>