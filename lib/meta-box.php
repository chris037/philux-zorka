<?php
/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/
 */


add_filter( 'rwmb_meta_boxes', 'g5plus_register_meta_boxes' );

/**
 * Register meta boxes
 *
 * Remember to change "your_prefix" to actual prefix in your project
 *
 * @return void
 */
function g5plus_register_meta_boxes( $meta_boxes )
{
	/**
	 * prefix of meta keys (optional)
	 * Use underscore (_) at the beginning to make keys hidden
	 * Alt.: You also can make prefix empty to disable it
	 */
	// Better has an underscore as last sign
	$prefix = 'g5plus-';
	// Post Format
	$meta_boxes[] = array(
		'title'  => __('Post Format: Image','zorka'),
		'id'     => $prefix. 'meta-box-post-format-image',
		'pages'  => array( 'post' ),
		'fields' => array(
			array(
				'name'             => __( 'Image', 'zorka' ),
				'id'               => 'post-format-image',
				'type'             => 'image_advanced',
				'max_file_uploads' => 1,
			),
		),
	);

	$meta_boxes[] = array(
		'title'  => __( 'Post Format: Gallery', 'zorka' ),
		'id'     => $prefix. 'meta-box-post-format-gallery',
		'pages'  => array( 'post' ),
		'fields' => array(
			array(
				'name' => __( 'Images', 'zorka' ),
				'id'   => 'post-format-gallery',
				'type' => 'image_advanced',
			),
		),
	);

	$meta_boxes[] = array(
		'title'  => __( 'Post Format: Video', 'zorka' ),
		'id'     => $prefix. 'meta-box-post-format-video',
		'pages'  => array( 'post' ),
		'fields' => array(
			array(
				'name' => __( 'Video URL or Embeded Code', 'zorka' ),
				'id'   => 'post-format-video',
				'type' => 'textarea',
			),
		)
	);

	$meta_boxes[] = array(
		'title'  => __( 'Post Format: Audio', 'zorka' ),
		'id'     => $prefix. 'meta-box-post-format-audio',
		'pages'  => array( 'post' ),
		'fields' => array(
			array(
				'name' => __( 'Audio URL or Embeded Code', 'zorka' ),
				'id'   => 'post-format-audio',
				'type' => 'textarea',
			),
		)
	);




	// Display Settings
	$meta_boxes[] = array(
		'title'  => __( 'Page Settings', 'zorka' ),
		'pages'  => array( 'page','post' ),
		'fields' => array(
			array(
				'name' => __( 'Page Title Area', 'zorka' ),
				'id'   => 'heading-title',
				'type' => 'heading',
			),
            array(
                'name'  => __( 'Hide Page Title Area?', 'zorka' ),
                'id'    => 'hide-page-title',
                'type'  => 'checkbox',
                'class' => 'checkbox-toggle reverse',
            ),

            array(
                'name'     => __( 'Select Page Title Style', 'zorka' ),
                'id'       => "custom-page-title-style",
                'type'     => 'select',
                'options'  => array(
                    '1' 	=> 'Style 1',
                    '2' 	=> 'Style 2',
                ),
                // Select multiple values, optional. Default is false.
                'multiple'    => false,
                'std'         => '1',
                'before'  => '<div>'
            ),
			array(
				'name'   => __( 'Custom Page Title', 'zorka' ),
				'id'     => 'custom-page-title',
				'type'   => 'text',
				'desc'   => __( 'Leave empty to use post title', 'zorka' ),
			),

			array(
				'name'   => __( 'Custom Page Sub Title', 'zorka' ),
				'id'     => 'custom-page-sub-title',
				'type'   => 'text',
			),
            array(
                'name' => __( 'Custom Page Title Background', 'zorka' ),
                'id'   => 'custom-page-title-background',
                'type' => 'file_input',
                'after' => '</div>',
            ),

			array(
				'name' => __( 'Custom Layout', 'zorka' ),
				'id'   => 'heading-layout',
				'type' => 'heading'
            ),
			array(
				'name'  => __( 'Use Custom Layout?', 'zorka' ),
				'id'    => 'use-custom-layout',
				'type'  => 'checkbox',
				'class' => 'checkbox-toggle',
				'desc'  => sprintf( __( 'This will <b>overwrite</b> layout settings in <a href="%s" target="_blank">Theme Options</a> with values different <b>none</b>.', 'zorka' ), admin_url( 'themes.php?page=optionsframework' ) ),
			),
			array(
				'name'     => __( 'Select Layout Style', 'zorka' ),
				'id'       => "layout-style",
				'type'     => 'select',
				'options'  => array(
					'none' => __('None','zorka'),
					'wide' => __( 'Wide', 'zorka' ),
					'boxed' => __( 'Boxed', 'zorka' ),
				),
				// Select multiple values, optional. Default is false.
				'multiple'    => false,
				'std'         => 'none',
				'before'  => '<div>'
			),
			array(
				'name'    => __( 'Page Layout', 'zorka' ),
				'id'      => 'page-layout',
				'type'    => 'select',
				'std'     => 'none',
				'options' => array(
					'none' => 'None',
					'full-content'  => __('Full Width','zorka'),
                    'container-full-content'  => __('Container Full Width','zorka'),
					'left-sidebar'  => __('Left Sidebar','zorka'),
					'right-sidebar' => __('Right Sidebar','zorka'),
				),
				'after'   => '</div>'
			),
			array(
				'name' => __( 'Custom Header', 'zorka' ),
				'id'   => 'heading-header',
				'type' => 'heading'),
			array(
				'name'     => __( 'Select Header Layout', 'zorka' ),
				'id'       => "header-layout",
				'type'     => 'select',
				'options'  => array(
					'none' => __('None','zorka'),
					'1' => __( 'Header 1', 'zorka' ),
					'2' => __( 'Header 2', 'zorka' ),
					'3' => __( 'Header 3', 'zorka' ),
					'4' => __( 'Header 4', 'zorka' ),
					'5' => __( 'Header 5', 'zorka' ),
					'6' => __( 'Header 6', 'zorka' ),
					'7' => __( 'Header 7', 'zorka' ),
					'8' => __( 'Header 8', 'zorka' ),
					'9' => __( 'Header 9', 'zorka' ),
					'10' => __( 'Header 10', 'zorka' ),
					'11' => __( 'Header 11', 'zorka' ),
				),
				// Select multiple values, optional. Default is false.
				'multiple'    => false,
				'std'         => 'none'
			),
            array(
                'name' => __( 'Custom Footer', 'zorka' ),
                'id'   => 'heading-footer',
                'type' => 'heading'),
			array(
                'name'     => __( 'Select Footer Layout', 'zorka' ),
                'id'       => "footer-layout",
                'type'     => 'select',
                'options'  => array(
                    'none' => __('None','zorka'),
                    '1' => __( 'Light', 'zorka' ),
                    '2' => __( 'Dark', 'zorka' )
                ),
                // Select multiple values, optional. Default is false.
                'multiple'    => false,
                'std'         => 'none'
            ),

		)
	);

	return $meta_boxes;
}

add_action( 'admin_enqueue_scripts', 'g5plus_admin_script_meta_box' );

function g5plus_admin_script_meta_box() {
	$screen = get_current_screen();
	if ( ! in_array( $screen->post_type, array( 'post', 'page') ) ) {
		return;
	}
	wp_enqueue_script( 'g5plus-meta-box', THEME_URL . 'assets/admin/js/meta-boxes.js', array( 'jquery' ), '', true );
}