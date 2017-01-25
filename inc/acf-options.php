<?php if( function_exists('acf_add_local_field_group') ):

	/*--------------------------------------------------------------
	# Subheadings
	--------------------------------------------------------------*/
	acf_add_local_field_group(array (
		'key' => 'group_strt_subheading',
		'title' => 'Subheading',
		'fields' => array (
			array (
				'default_value' => '',
				'maxlength' => '',
				'placeholder' => 'Subheading',
				'prepend' => '',
				'append' => '',
				'key' => 'field_strt_subheading',
				'label' => 'Subheading',
				'name' => 'subheading',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'acf_after_title',
		'style' => 'seamless',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));


	/*--------------------------------------------------------------
	# Page options
	--------------------------------------------------------------*/
	acf_add_local_field_group(array (
		'key' => 'group_page_options',
		'title' => 'Page options',
		'fields' => array (
			array (
				'default_value' => 0,
				'message' => '',
				'ui' => 1,
				'ui_on_text' => '',
				'ui_off_text' => '',
				'key' => 'field_hide_title',
				'label' => 'Hide title',
				'name' => 'hide_title',
				'type' => 'true_false',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '50',
					'class' => '',
					'id' => '',
				),
			),
			array (
				'default_value' => 0,
				'message' => '',
				'ui' => 1,
				'ui_on_text' => '',
				'ui_off_text' => '',
				'key' => 'field_hide_footer',
				'label' => 'Hide footer',
				'name' => 'hide_footer',
				'type' => 'true_false',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '50',
					'class' => '',
					'id' => '',
				),
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'side',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));


	/*--------------------------------------------------------------
	# Post options
	--------------------------------------------------------------*/
	acf_add_local_field_group(array (
		'key' => 'group_post_options',
		'title' => 'Post options',
		'fields' => array (
			array (
				'default_value' => 0,
				'message' => '',
				'ui' => 1,
				'ui_on_text' => '',
				'ui_off_text' => '',
				'key' => 'field_hide_featured_image',
				'label' => 'Hide featured image',
				'name' => 'hide_featured_image',
				'type' => 'true_false',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array (
					'width' => '',
					'class' => '',
					'id' => '',
				),
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'side',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => 1,
		'description' => '',
	));
	
endif;