<?php
/**
* Register custom Gutenberg blocks category
*
*/
add_filter('block_categories', function ($categories, $post) {
	return array_merge(
		$categories,
		array(
			array(
				'slug' 	=> 'mind-blocks',
				'title' => __('Mindshare Blocks', 'mindshare'),
				'icon' 	=> file_get_contents(get_template_directory() . '/img/mind-logo-sq.svg'),
			),

		)
	);
}, 10, 2);

add_action('acf/init', function () {
	// Check function exists.
	if( function_exists('acf_register_block_type') ) {

	

		//Block: Map w/ Markers
		acf_register_block_type(array(
			'name'              => 'map-w-marker',
			'title'             => __('Map with Markers'),
			'description'       => __('A map block using the mapbox API.'),
			'render_template'   => get_template_directory() . '/inc/block-templates/map-w-marker.php',
			'category'          => 'mind-blocks',
			'icon'              => file_get_contents(get_template_directory() . '/img/logo.svg'),
			'keywords'          => array( 'call', 'action', 'brand', 'ksfb', 'button', 'main'),
			'align'             => 'full',
			'mode'            	=> 'edit',
			'supports'					=> array(
				'align' => false,
			),
			'enqueue_assets' => function(){
				// We're just registering it here and then with the action get_footer we'll enqueue it.
				wp_register_style( 'block-styles', get_template_directory_uri() . '/css/block-styles.css' );
				add_action( 'get_footer', function () {wp_enqueue_style('block-styles');});


				wp_register_script('google-maps', 'https://maps.googleapis.com/maps/api/js?key=' . GOOGLE_MAPS_API_KEY, array('jquery'), THEME_VERSION, true);
				wp_enqueue_script('google-maps');

				wp_register_script('map-block-init', get_template_directory_uri() . '/js/map-init.js', array('jquery', 'google-maps'), THEME_VERSION, true);
				wp_enqueue_script('map-block-init');
				wp_localize_script( 'map-block-init', 'map_box_params', array(
					'postID' => get_the_id(), // WordPress AJAX
					'data' => get_field('map_block_options')
				));


				},
			)
		);

		//Block: Post or Page Repeater
		acf_register_block_type(array(
			'name'              => 'post-repeater',
			'title'             => __('Post or Page Repeater'),
			'description'       => __('A block that shows posts/pages/cpt in a card format.'),
			'render_template'   => get_template_directory() . '/inc/block-templates/post-repeater.php',
			'category'          => 'mind-blocks',
			'icon'              => file_get_contents(get_template_directory() . '/img/logo.svg'),
			'keywords'          => array( 'posts', 'pages', 'recent', 'loop', 'repeater', 'ksfb', 'button', 'main'),
			'align'             => 'full',
			'mode'            	=> 'edit',
			'supports'					=> array(
				'align' => false,
			),
			'enqueue_assets' => function(){
				// We're just registering it here and then with the action get_footer we'll enqueue it.
				wp_register_style( 'block-styles', get_template_directory_uri() . '/css/block-styles.css' );
				add_action( 'get_footer', function () {wp_enqueue_style('block-styles');});

				},
			)
		);

		//Block: Accordion
		acf_register_block_type(array(
			'name'              => 'accordion-block',
			'title'             => __('Accordion'),
			'description'       => __('A repeating accordion block.'),
			'render_template'   => get_template_directory() . '/inc/block-templates/accordion-block.php',
			'category'          => 'mind-blocks',
			'icon'              => file_get_contents(get_template_directory() . '/img/mind-logo-sq.svg'),
			'keywords'          => array( 'accordion', 'repeater', 'collapse', 'Mindshare' ),
			'align'             => 'full',
			'mode'            	=> 'edit',
			'supports'					=> array(
				'align' => false,
			),
			'enqueue_assets' => function(){
				// We're just registering it here and then with the action get_footer we'll enqueue it.
				wp_register_style( 'block-styles', get_template_directory_uri() . '/inc/css/block-styles.css' );
				add_action( 'get_footer', function () {wp_enqueue_style('block-styles');});

				},
			)
		);

		//Block: Image Slider
		acf_register_block_type(array(
			'name'              => 'image-slider',
			'title'             => __('Image Slider'),
			'description'       => __('This block displays an image slider with captions.'),
			'render_template'   => get_template_directory() . '/inc/block-templates/image-slider.php',
			'category'          => 'mind-blocks',
			'icon'              => file_get_contents(get_template_directory() . '/img/mind-logo-sq.svg'),
			'keywords'          => array( 'slider', 'image', 'captions', 'Mindshare' ),
			'align'             => 'full',
			'mode'            	=> 'edit',
			'supports'					=> array(
				'align' => false,
			),
			'enqueue_assets' => function(){
				// We're just registering it here and then with the action get_footer we'll enqueue it.
				wp_register_style( 'block-styles', get_template_directory_uri() . '/css/block-styles.css' );
				add_action( 'get_footer', function () {wp_enqueue_style('block-styles');});

				wp_register_style( 'slick-styles', get_template_directory_uri() . '/css/slick.css' );
				add_action( 'get_footer', function () {wp_enqueue_style('slick-styles');});

				if(!is_admin()) :
					wp_register_script('slick-slider', get_template_directory_uri() . '/js/slick.min.js', array(), THEME_VERSION);
		      wp_enqueue_script('slick-slider');

					wp_register_script('image-slider-js', get_template_directory_uri(). '/js/image-slider.js', array('jquery'), THEME_VERSION, true);
					wp_enqueue_script('image-slider-js');
				endif;

				},
			)
		);

		//Block: Image Grid
		acf_register_block_type(array(
				'name'              => 'image-grid',
				'title'             => __('Image Grid'),
				'description'       => __('This block displays a grid of images with titles, captions and an optional link.'),
				'render_template'   => get_template_directory() . '/inc/block-templates/image-grid.php',
				'category'          => 'mind-blocks',
				'icon'              => file_get_contents(get_template_directory() . '/img/mind-logo-sq.svg'),
				'keywords'          => array( 'grid', 'gallery', 'image', 'captions', 'Mindshare' ),
				'align'             => 'full',
				'mode'            	=> 'edit',
				'supports'					=> array(
					'align' => false,
				),
				'enqueue_assets' => function(){
					// We're just registering it here and then with the action get_footer we'll enqueue it.
					wp_register_style( 'block-styles', get_template_directory_uri() . '/css/block-styles.css' );
					add_action( 'get_footer', function () {wp_enqueue_style('block-styles');});

					},
				)
			);

		//Block: Container
		acf_register_block_type(array(
				'name'              => 'container',
				'title'             => __('Container Block'),
				'description'       => __('A block that limits the width of content based on some selection criteria.'),
				'render_template'   => get_template_directory() . '/inc/block-templates/container.php',
				'category'          => 'mind-blocks',
				'icon'              => file_get_contents(get_template_directory() . '/img/mind-logo-sq.svg'),
				'keywords'          => array( 'container', 'width', 'Mindshare' ),
				'align'             => 'full',
				'mode'            	=> 'preview',
				'supports'					=> array(
					'align' => true,
          'mode' => false,
          'jsx' => true
				),
				)
			);

		}
	}
);



if( function_exists('acf_add_local_field_group') ):

	//ACF Block Fields: Map w/ Marker
	acf_add_local_field_group(array(
		'key' => 'group_5fad8bfb7b985',
		'title' => 'Block: Map w/ Marker',
		'fields' => array(
			array(
				'key' => 'field_5fad8c0313f53',
				'label' => 'Map w/ Marker',
				'name' => 'map_w_marker',
				'type' => 'group',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'layout' => 'block',
				'sub_fields' => array(
					array(
						'key' => 'field_5fad8c1513f54',
						'label' => 'Location',
						'name' => 'location',
						'type' => 'google_map',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'center_lat' => '',
						'center_lng' => '',
						'zoom' => '',
						'height' => '',
					),
				),
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'block',
					'operator' => '==',
					'value' => 'acf/map-w-marker',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
	));

	//ACF Block Fields: Post Repeater
	acf_add_local_field_group(array(
		'key' => 'group_5fac7c23165ca',
		'title' => 'Block: Post Repeater',
		'fields' => array(
			array(
				'key' => 'field_5fac7c2969667',
				'label' => 'Post Repeater',
				'name' => 'post_repeater',
				'type' => 'group',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'layout' => 'block',
				'sub_fields' => array(
					array(
						'key' => 'field_5fac7c3169668',
						'label' => 'Post Type',
						'name' => 'post_type',
						'type' => 'radio',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'choices' => array(
							'post' => 'Posts',
							'page' => 'Pages',
							'staff' => 'Staff',
						),
						'allow_null' => 1,
						'other_choice' => 0,
						'default_value' => 'post',
						'layout' => 'vertical',
						'return_format' => 'value',
						'save_other_choice' => 0,
					),
					array(
						'key' => 'field_5fac7c71b3bef',
						'label' => 'Posts Per Page',
						'name' => 'posts_per_page',
						'type' => 'number',
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
						'min' => 1,
						'max' => 12,
						'step' => 1,
					),
				),
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'block',
					'operator' => '==',
					'value' => 'acf/post-repeater',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
	));

	//ACF Block Fields: Accordion
	acf_add_local_field_group(array(
		'key' => 'group_5faae62cc8b8e',
		'title' => 'Block: Accordion',
		'fields' => array(
			array(
				'key' => 'field_5faae6330b120',
				'label' => 'Accordions',
				'name' => 'accordions',
				'type' => 'repeater',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'collapsed' => '',
				'min' => 0,
				'max' => 0,
				'layout' => 'block',
				'button_label' => 'Add Accordion Item',
				'sub_fields' => array(
					array(
						'key' => 'field_5faae6380b121',
						'label' => 'Accordion Header',
						'name' => 'accordion_header',
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
					array(
						'key' => 'field_5faae6400b122',
						'label' => 'Content',
						'name' => 'content',
						'type' => 'wysiwyg',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'tabs' => 'all',
						'toolbar' => 'full',
						'media_upload' => 1,
						'delay' => 0,
					),
				),
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'block',
					'operator' => '==',
					'value' => 'acf/accordion-block',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
	));

	//ACF Block Fields: Slider Image
	acf_add_local_field_group(array(
		'key' => 'group_5fa9944816d06',
		'title' => 'Block: Image Slider',
		'fields' => array(
			array(
				'key' => 'field_5fa994503d2ac',
				'label' => 'Images',
				'name' => 'block_image_slides',
				'type' => 'repeater',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'collapsed' => '',
				'min' => 0,
				'max' => 0,
				'layout' => 'block',
				'button_label' => 'Add Image',
				'sub_fields' => array(
					array(
						'key' => 'field_5fa994553d2ad',
						'label' => 'Image',
						'name' => 'image',
						'type' => 'image',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'return_format' => 'array',
						'preview_size' => 'medium',
						'library' => 'all',
						'min_width' => '',
						'min_height' => '',
						'min_size' => '',
						'max_width' => '',
						'max_height' => '',
						'max_size' => '',
						'mime_types' => '',
					),
					array(
						'key' => 'field_5fa9945b3d2ae',
						'label' => 'Caption',
						'name' => 'caption',
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
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'block',
					'operator' => '==',
					'value' => 'acf/image-slider',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
	));

	//ACF Block Fields: Image Grid
	acf_add_local_field_group(array(
		'key' => 'group_5fa9a845af0e5',
		'title' => 'Block: Image Grid',
		'fields' => array(
			array(
				'key' => 'field_5fa9a85064f7b',
				'label' => 'Images',
				'name' => 'block_image_grid',
				'type' => 'repeater',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'collapsed' => '',
				'min' => 0,
				'max' => 0,
				'layout' => 'block',
				'button_label' => 'Add Card',
				'sub_fields' => array(
					array(
						'key' => 'field_5fa9a85b64f7c',
						'label' => 'Image',
						'name' => 'image',
						'type' => 'image',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'return_format' => 'array',
						'preview_size' => 'medium',
						'library' => 'all',
						'min_width' => '',
						'min_height' => '',
						'min_size' => '',
						'max_width' => '',
						'max_height' => '',
						'max_size' => '',
						'mime_types' => '',
					),
					array(
						'key' => 'field_5fa9a86064f7d',
						'label' => 'Title',
						'name' => 'title',
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
					array(
						'key' => 'field_5fa9a86464f7e',
						'label' => 'Description',
						'name' => 'desc',
						'type' => 'textarea',
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
						'maxlength' => '',
						'rows' => '',
						'new_lines' => '',
					),
					array(
						'key' => 'field_5fa9a87064f7f',
						'label' => 'Link',
						'name' => 'link',
						'type' => 'link',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'return_format' => 'array',
					),
				),
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'block',
					'operator' => '==',
					'value' => 'acf/image-grid',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
	));

	//ACF Block Fields: Container
	acf_add_local_field_group(array(
		'key' => 'group_5faca1b7c808b',
		'title' => 'Block: Container',
		'fields' => array(
			array(
				'key' => 'field_5faca1bcebcb7',
				'label' => 'Container Options',
				'name' => 'container_options',
				'type' => 'group',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'layout' => 'block',
				'sub_fields' => array(
					array(
						'key' => 'field_5faca1daebcb8',
						'label' => 'Width',
						'name' => 'width',
						'type' => 'radio',
						'instructions' => 'This setting specifies the width on desktop devices, mobile devices will always be full width. Note: Odd numbers are used to ensure that the content is centered, based on Twitter Bootstrap',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'choices' => array(
							2 => '2 Columns',
							4 => '4 Columns',
							6 => '6 Columns',
							8 => '8 Columns',
							10 => '10 Columns',
							12 => '12 Columns (default)',
						),
						'allow_null' => 0,
						'other_choice' => 0,
						'default_value' => 12,
						'layout' => 'vertical',
						'return_format' => 'value',
						'save_other_choice' => 0,
					),
					array(
						'key' => 'field_5faca3f4d2f06',
						'label' => 'Background Color',
						'name' => 'background_color',
						'type' => 'color_picker',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
					),
				),
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'block',
					'operator' => '==',
					'value' => 'acf/container',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
	));




endif;
