<?php

add_action( 'init', 'of_options' );

if ( ! function_exists( 'of_options' ) ) {
	function of_options() {
		//Access the WordPress Categories via an Array
		$of_categories     = array();
		$of_categories_obj = get_categories( 'hide_empty=0' );
		foreach ( $of_categories_obj as $of_cat ) {
			$of_categories[$of_cat->cat_ID] = $of_cat->cat_name;
		}
		$categories_tmp = array_unshift( $of_categories, "Select a category:" );

		//Access the WordPress Pages via an Array
		$of_pages     = array();
		$of_pages_obj = get_pages( 'sort_column=post_parent,menu_order' );
		foreach ( $of_pages_obj as $of_page ) {
			$of_pages[$of_page->ID] = $of_page->post_name;
		}
		$of_pages_tmp = array_unshift( $of_pages, "Select a page:" );

		//Testing 
		$of_options_select = array( "one", "two", "three", "four", "five" );
		$of_options_radio  = array( "one" => "One", "two" => "Two", "three" => "Three", "four" => "Four", "five" => "Five" );

		//Sample Homepage blocks for the layout manager (sorter)
		$of_options_homepage_blocks = array
		(
			"disabled" => array(
				"placebo"     => "placebo", //REQUIRED!
				"block_one"   => "Block One",
				"block_two"   => "Block Two",
				"block_three" => "Block Three",
			),
			"enabled"  => array(
				"placebo"    => "placebo", //REQUIRED!
				"block_four" => "Block Four",
			),
		);


		//Stylesheets Reader
		$alt_stylesheet_path = LAYOUT_PATH;
		$alt_stylesheets     = array();

		if ( is_dir( $alt_stylesheet_path ) ) {
			if ( $alt_stylesheet_dir = opendir( $alt_stylesheet_path ) ) {
				while ( ( $alt_stylesheet_file = readdir( $alt_stylesheet_dir ) ) !== false ) {
					if ( stristr( $alt_stylesheet_file, ".css" ) !== false ) {
						$alt_stylesheets[] = $alt_stylesheet_file;
					}
				}
			}
		}


		//Background Images Reader
		$bg_images_path = get_stylesheet_directory() . '/assets/images/patterns/'; // change this to where you store your patterns images
		$bg_images_url  = get_template_directory_uri() . '/assets/images/patterns/'; // change this to where you store your patterns images
		$bg_images      = array();

		if ( is_dir( $bg_images_path ) ) {
			if ( $bg_images_dir = opendir( $bg_images_path ) ) {
				while ( ( $bg_images_file = readdir( $bg_images_dir ) ) !== false ) {
					if ( stristr( $bg_images_file, ".png" ) !== false || stristr( $bg_images_file, ".jpg" ) !== false ) {
						natsort( $bg_images ); //Sorts the array into a natural order
						$bg_images[] = $bg_images_url . $bg_images_file;
					}
				}
			}
		}


		/*-----------------------------------------------------------------------------------*/
		/* TO DO: Add options/functions that use these */
		/*-----------------------------------------------------------------------------------*/

		//More Options
		$uploads_arr      = wp_upload_dir();
		$all_uploads_path = $uploads_arr['path'];
		$all_uploads      = get_option( 'of_uploads' );
		$other_entries    = array( "Select a number:", "1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19" );
		$body_repeat      = array( "no-repeat", "repeat-x", "repeat-y", "repeat" );
		$body_pos         = array( "top left", "top center", "top right", "center left", "center center", "center right", "bottom left", "bottom center", "bottom right" );

		// Image Alignment radio box
		$of_options_thumb_align = array( "alignleft" => "Left", "alignright" => "Right", "aligncenter" => "Center" );

		// Image Links to Options
		$of_options_image_link_to = array( "image" => "The Image", "post" => "The Post" );


		/*-----------------------------------------------------------------------------------*/
		/* The Options Array */
		/*-----------------------------------------------------------------------------------*/

// Set the Options Array
		global $of_options;
		$of_options = array();
		/*General Settings*/
		$of_options[] = array( "name" => __( 'General Settings', 'zorka' ),
							   "type" => "heading",
							   "icon" => ADMIN_IMAGES . "icon-settings.png"
		);
		$logo         = THEME_URL . 'assets/images/logo.png';

		$of_options[] = array( "name" => __( 'Logo', 'zorka' ),
							   "desc" => __( 'Enter URL or Upload an image file as your logo.', 'zorka' ),
							   "id"   => "site-logo",
							   "std"  => $logo,
							   "type" => "media"
		);

		$logo_second  = THEME_URL . 'assets/images/logo-white.png';
		$of_options[] = array( "name" => __( 'Logo White', 'zorka' ),
							   "desc" => __( 'Enter URL or Upload an image file as your logo.', 'zorka' ),
							   "id"   => "site-logo-white",
							   "std"  => $logo_second,
							   "type" => "media"
		);

		$favicon      = THEME_URL . 'assets/images/favicon.ico';
		$of_options[] = array( "name" => __( 'Favicon', 'zorka' ),
							   "desc" => __( "Enter URL or upload an icon image to represent your website's favicon (16px x 16px)", 'zorka' ),
							   "id"   => "favicon",
							   "std"  => $favicon,
							   "type" => "media"
		);


		$of_options[] = array( "name"    => __( 'Archive Paging Style', 'zorka' ),
							   "desc"    => __( 'Select paging style for Archive Page', 'zorka' ),
							   "id"      => "post-archive-paging-style",
							   "std"     => "default",
							   "type"    => "select",
							   "options" => array(
								   'default'         => 'Default',
								   'load-more'       => 'Load More',
								   'infinite-scroll' => 'Infinite Scroll'
							   )
		);


		$url          = ADMIN_DIR . 'assets/images/';
		$of_options[] = array( "name"    => __( 'Archive Layout', 'zorka' ),
							   "desc"    => __( 'Select layout for Archive Page', 'zorka' ),
							   "id"      => "post-archive-layout",
							   "std"     => "right-sidebar",
							   "type"    => "images",
							   "options" => array(
								   'full-content'  => $url . '1col.png',
								   'left-sidebar'  => $url . '2cl.png',
								   'right-sidebar' => $url . '2cr.png'
							   )
		);

		$of_options[] = array( "name"    => __( 'Page Layout', 'zorka' ),
							   "desc"    => __( 'Select layout for Page', 'zorka' ),
							   "id"      => "page-layout",
							   "std"     => "right-sidebar",
							   "type"    => "images",
							   "options" => array(
								  /* 'full-content'  => $url . '1col.png',*/
                                   'container-full-content'  => $url . '3cm.png',
                                   'left-sidebar'  => $url . '2cl.png',
								   'right-sidebar' => $url . '2cr.png'
							   )
		);

        $of_options[] = array( 	 "name" 		=> __('Single Portfolio Style','zorka'),
            "desc" 		=> __('Select style for single portfolio page','zorka'),
            "id" 		=> "portfolio-single-style",
            "std" 		=> "fullwidth",
            "type" 		=> "select",
            "options" 	=> array(
                'fullwidth' 	=> 'Full',
                'smallslider' 	=> 'Small Slider',
                'bigslider' 	=> 'Big Slider',
                'sidebar' 	=> 'Side bar',
                'verticalslider' => 'Vertical Slider'
            )
        );


		$of_options[] = array( "name" => __( 'Show Back To Top', 'zorka' ),
							   "id"   => __( 'show-back-to-top', 'zorka' ),
							   "std"  => 1,
							   "type" => "switch",
							   "on"   => "Show",
							   "off"  => "Hide"
		);

        $of_options[] = array( "name" => __( 'Show Loading', 'zorka' ),
            "id"   => __( 'show-loading', 'zorka' ),
            "std"  => 1,
            "type" => "switch",
            "on"   => "Show",
            "off"  => "Hide"
        );


        $of_options[] = array( "name" => __( 'Show Panel Selector Style', 'zorka' ),
            "id"   => __( 'show-panel-selector-style', 'zorka' ),
            "std"  => 0,
            "type" => "switch",
            "on"   => "Show",
            "off"  => "Hide"
        );

        $of_options[] = array( "name" => __( 'Smooth Page Scroll', 'zorka' ),
            "id"   => __( 'smooth-page-scroll', 'zorka' ),
            "std"  => 1,
            "type" => "switch",
            "on"   => "On",
            "off"  => "Off"
        );

        $of_options[] = array( "name" => __( 'Show Breadcrumb', 'zorka' ),
            "id"   => __( 'show-breadcrumb', 'zorka' ),
            "std"  => 1,
            "type" => "switch",
            "on"   => "On",
            "off"  => "Off"
        );

        $page_title_bg = THEME_URL . 'assets/images/float_header_bg.jpg';
        $of_options[] = array( "name" => __( 'Page Title Background', 'zorka' ),
            "desc" => __( "Enter URL or upload an image to set as your heading background with page title", 'zorka' ),
            "id"   => "page-title-background",
            "std"  => $page_title_bg,
            "type" => "media"
        );

		/*Site Top Options*/
		$of_options[] = array( "name" => __( 'Site Top - Header Options', 'zorka' ),
							   "type" => "heading",
							   "icon" => ADMIN_IMAGES . "icon-header.png"
		);

		$of_options[] = array( "name"  => __( 'Show Site Top', 'zorka' ),
							   "desc"  => "",
							   "id"    => "show-site-top",
							   "std"   => 1,
							   "type"  => "switch"
		);

		$of_options[] = array( "name"  => __( 'Show Language Selector', 'zorka' ),
							   "desc"  => "",
							   "id"    => "show-language-selector",
							   "std"   => 1,
							   "type"  => "switch"
		);

		$of_options[] = array( "name"  => __( 'Show Login Link', 'zorka' ),
							   "desc"  => "",
							   "id"    => "show-login-link",
							   "std"   => 1,
							   "type"  => "switch"
		);

		$of_options[] = array( "name"  => __( 'Show Mini Cart', 'zorka' ),
							   "desc"  => "",
							   "id"    => "show-mini-cart",
							   "std"   => 1,
							   "type"  => "switch"
		);

		$of_options[] = array( "name"  => __( 'Show Search Button Mobile', 'zorka' ),
			"desc"  => "",
			"id"    => "show-search-button-mobile",
			"std"   => 1,
			"type"  => "switch"
		);

		$of_options[] = array( "name"  => __( 'Show Mini Cart Mobile', 'zorka' ),
			"desc"  => "",
			"id"    => "show-mini-cart-mobile",
			"std"   => 0,
			"type"  => "switch"
		);

		$of_options[] = array( "name"  => __( 'Enable Header Sticky', 'zorka' ),
			"desc"  => "",
			"id"    => "header-sticky",
			"std"   => 1,
			"type"  => "switch"
		);

		/*Header Options*/
		$of_options[] = array( "name" => __( 'Header Options', 'zorka' ),
							   "type" => "heading",
							   "icon" => ADMIN_IMAGES . "icon-header.png"
		);


		$of_options[] = array( "name"    => __( 'Header Layout', 'zorka' ),
							   "desc"    => __( 'Select layout for Header', 'zorka' ),
							   "id"      => "header-layout",
							   "std"     => "1",
							   "type"    => "images",
							   "options" => array(
								   '1' => $url . 'header/header-1.jpg',
								   '2' => $url . 'header/header-2.jpg',
                                   '3' => $url . 'header/header-3.jpg',
                                   '4' => $url . 'header/header-4.jpg',
                                   '5' => $url . 'header/header-5.jpg',
                                   '6' => $url . 'header/header-6.jpg',
                                   '7' => $url . 'header/header-7.jpg',
                                   '8' => $url . 'header/header-8.jpg',
                                   '9' => $url . 'header/header-9.jpg',
                                   '10' => $url . 'header/header-10.jpg',
								   '11' => $url . 'header/header-11.jpg',

							   )
		);
		$of_options[] = array( "name" => __( 'Custom content for Header', 'zorka' ),
							   "desc" => __( 'Apply only Header-6, Header-7, Header-8', 'zorka' ),
							   "id"   => "header-custom-content",
							   "std"  => '<ul>
<li><i class="fa fa-phone"></i>(+100) 6666 8888</li>
<li><i class="fa fa-envelope-o"></i>info@domain.com</li>
<li><i class="fa fa-map-marker"></i>99 Collins Street, London, UK.</li>
</ul>',
							   "type" => "textarea"
		);


		/*Footer Options*/

        $of_options[] = array( 	"name" 		=> __('Footer Options','zorka'),
            "type" 		=> "heading",
            "icon" 		=> ADMIN_IMAGES . "icon-footer.png"
        );


        $of_options[] = array( "name" => __( 'Enable Parallax Scrolling', 'zorka' ),
            "id"   => __( 'enable-parallax-footer', 'zorka' ),
            "std"  => 0,
            "type" => "switch",
            "on"   => "Enable",
            "off"  => "Disable"
        );


        $of_options[] = array( 	"name" 		=> __('Footer Layout','zorka'),
            "desc" 		=> __('Select layout for Footer','zorka'),
            "id" 		=> "footer-layout",
            "std" 		=> "1",
            "type" 		=> "select",
            "options" 	=> array(
                '1' => __( 'Light', 'zorka' ),
                '2' => __( 'Dark', 'zorka' )
            )
        );


        $of_options[] = array( "name" => __( 'Visa Url', 'zorka' ),
            "id"   => "visa_url",
            "std"  => "http://www.visa.com",
            "type" => "text"
        );

        $of_options[] = array( "name" => __( 'Master Card Url', 'zorka' ),
            "id"   => "mastercard_url",
            "std"  => "https://www.mastercard.us",
            "type" => "text"
        );

        $of_options[] = array( "name" => __( 'Paypal Url', 'zorka' ),
            "id"   => "paypal_url",
            "std"  => "https://www.paypal.com/",
            "type" => "text"
        );
        $of_options[] = array( "name" => __( '2CO Url', 'zorka' ),
            "id"   => "twoCO_url",
            "std"  => "https://www.2co.com/",
            "type" => "text"
        );
        $of_options[] = array( "name" => __( 'American Express Url', 'zorka' ),
            "id"   => "american_express_url",
            "std"  => "https://www.americanexpress.com/",
            "type" => "text"
        );
        $of_options[] = array( "name" => __( 'Skrill Url', 'zorka' ),
            "id"   => "skrill_url",
            "std"  => "https://www.skrill.com/en/home/",
            "type" => "text"
        );
        $of_options[] = array( "name" => __( 'Google Wallet Url', 'zorka' ),
            "id"   => "google_wallet_url",
            "std"  => "https://www.google.com/wallet/",
            "type" => "text"
        );
        $of_options[] = array( "name" => __( 'Western Union Url', 'zorka' ),
            "id"   => "western_union_url",
            "std"  => "https://www.westernunion.com",
            "type" => "text"
        );


		$of_options[] = array( "name" => __( 'Copyright Text', 'zorka' ),
							   "desc" => __( 'You can use the following shortcodes in your footer text: [wp-link] [theme-link] [loginout-link] [blog-title] [blog-link] [the-year]', 'zorka' ),
							   "id"   => "copyright-text",
							   "std"  => "Powered by <a href=\"http://wordpress.org\">WordPress</a>. Built on the <a href=\"http://g5plus.net\">G5Plus</a>.",
							   "type" => "textarea"
		);
		/*Styling Options*/
		$of_options[] = array( "name" => __( 'Styling Options', 'zorka' ),
							   "type" => "heading"
		);

		$of_options[] = array( "name"    => __( 'Layout Style', 'zorka' ),
							   "desc"    => __( 'Select a layout', 'zorka' ),
							   "id"      => "layout-style",
							   "std"     => "wide",
							   "type"    => "radio",
							   "options" => array(
								   'boxed' => 'Boxed',
								   'wide'  => 'Wide',
							   ) );


		$of_options[] = array( "name"  => __( 'Background Images', 'zorka' ),
							   "desc"  => "",
							   "id"    => "use-bg-image",
							   "std"   => 0,
							   "folds" => 1,
							   "type"  => "switch"
		);

		$of_options[] = array( "name"    => __( 'Background Pattern', 'zorka' ),
							   "desc"    => __( 'Select a background pattern.', 'zorka' ),
							   "id"      => "bg-pattern",
							   "type"    => "tiles",
							   "options" => $bg_images,
							   "fold"    => "use-bg-image",
							   "std"     => $bg_images[1]
		);

		$of_options[] = array( "name" => __( 'Upload Background', 'zorka' ),
							   "desc" => __( 'Upload your own background', 'zorka' ),
							   "id"   => "bg-pattern-upload",
							   "std"  => THEME_URL . '/assets/images/bg-images/bg-0.jpg',
							   "type" => "upload",
							   "fold" => "use-bg-image"
		);

		$of_options[] = array( "name"    => __( 'Background Repeat', 'zorka' ),
							   "desc"    => "",
							   "id"      => "bg-repeat",
							   "std"     => "no-repeat",
							   "type"    => "select",
							   "options" => array( 'repeat' => __( 'repeat', 'zorka' ), 'repeat-x' => __( 'repeat-x', 'zorka' ), 'repeat-y' => __( 'repeat-y', 'zorka' ), 'no-repeat' => __( 'no-repeat', 'zorka' ) ),
							   "fold"    => "use-bg-image"
		);
		$of_options[] = array( "name"    => __( 'Background Position', 'zorka' ),
							   "desc"    => "",
							   "id"      => "bg-position",
							   "std"     => "center center",
							   "type"    => "select",
							   "options" => array( 'left top'      => __( 'left top', 'zorka' ),
												   'left center'   => __( 'left center', 'zorka' ),
												   'left bottom'   => __( 'left bottom', 'zorka' ),
												   'right top'     => __( 'right top', 'zorka' ),
												   'right center'  => __( 'right center', 'zorka' ),
												   'right bottom'  => __( 'right bottom', 'zorka' ),
												   'center top'    => __( 'center top', 'zorka' ),
												   'center center' => __( 'center center', 'zorka' ),
												   'center bottom' => __( 'center bottom', 'zorka' )
							   ),
							   "fold"    => "use-bg-image"
		);
		$of_options[] = array( "name"    => __( 'Background Attachment', 'zorka' ),
							   "desc"    => "",
							   "id"      => "bg-attachment",
							   "std"     => "fixed",
							   "type"    => "select",
							   "options" => array( 'scroll'  => __( 'scroll', 'zorka' ),
												   'fixed'   => __( 'fixed', 'zorka' ),
												   'local'   => __( 'local', 'zorka' ),
												   'initial' => __( 'initial', 'zorka' ),
												   'inherit' => __( 'inherit', 'zorka' )
							   ),
							   "fold"    => "use-bg-image"
		);
		$of_options[] = array( "name"    => __( 'Background Size', 'zorka' ),
							   "desc"    => "",
							   "id"      => "bg-size",
							   "std"     => "cover",
							   "type"    => "select",
							   "options" => array( 'auto'    => __( 'auto', 'zorka' ),
												   'cover'   => __( 'cover', 'zorka' ),
												   'contain' => __( 'contain', 'zorka' ),
												   'initial' => __( 'initial', 'zorka' ),
												   'inherit' => __( 'inherit', 'zorka' )
							   ),
							   "fold"    => "use-bg-image"
		);

		$of_options[] = array( "name" => __( 'Primary Color', 'zorka' ),
							   "desc" => __( 'Pick a primary color for the theme.', 'zorka' ),
							   "id"   => "primary-color",
							   "std"  => "#C97178",
							   "type" => "color"
		);

        $of_options[] = array( "name" => __( 'Text Color', 'zorka' ),
            "desc" => __( 'Pick a text color for the theme.', 'zorka' ),
            "id"   => "text-color",
            "std"  => "#868686",
            "type" => "color"
        );

        $of_options[] = array( "name" => __( 'Text Bold Color', 'zorka' ),
            "desc" => __( 'Pick a text bold color for the theme.', 'zorka' ),
            "id"   => "text-bold-color",
            "std"  => "#25282C",
            "type" => "color"
        );





		/*Social Sharing Box*/
		$of_options[] = array( "name" => __( 'Social', 'zorka' ),
							   "type" => "heading",
							   "icon" => ADMIN_IMAGES . "icon-header.png"
		);


		$of_options[] = array( "name"    => __( 'Social Sharing Box', 'zorka' ),
							   "desc"    => __( 'Show the social sharing in blog posts.', 'zorka' ),
							   "id"      => "social-sharing",
							   "type"    => "multicheck",
							   "std"     => array( "sharing-facebook", "sharing-twitter", "sharing-google" ),
							   "options" => array(
                                   "sharing-facebook" => __( 'Facebook', 'zorka' ),
                                   "sharing-twitter" => __( 'Twitter', 'zorka' ),
                                   "sharing-google" => __( 'Google', 'zorka' ),
                                   "sharing-linkedin" => __( 'LinkedIn', 'zorka' ),
                                   "sharing-tumblr" => __( 'Tumblr', 'zorka' ),
                                   "sharing-pinterest" => __( 'Pinterest', 'zorka' ),
                                   "sharing-email" => __( 'Email', 'zorka' )
                               )
		);
		/*Social Link*/
		$of_options[] = array( "name" => __( 'Email Link', 'zorka' ),
							   "id"   => "social-email-link",
							   "std"  => "#",
							   "type" => "text"
		);
		$of_options[] = array( "name" => __( 'LinkedIn Link', 'zorka' ),
							   "id"   => "social-linkedin-link",
							   "std"  => "#",
							   "type" => "text"
		);
		$of_options[] = array( "name" => __( 'Facebook Link', 'zorka' ),
							   "id"   => "social-face-link",
							   "std"  => "#",
							   "type" => "text"
		);

		$of_options[] = array( "name" => __( 'Twitter Link', 'zorka' ),
							   "id"   => "social-twitter-link",
							   "std"  => "#",
							   "type" => "text"
		);
		$of_options[] = array( "name" => __( 'Dribbble Link', 'zorka' ),
							   "id"   => "social-dribbble-link",
							   "std"  => "#",
							   "type" => "text"
		);


		$of_options[] = array( "name" => __( 'Google Link', 'zorka' ),
							   "id"   => "social-google-link",
							   "std"  => "",
							   "type" => "text"
		);

		$of_options[] = array( "name" => __( 'Vimeo Link', 'zorka' ),
							   "id"   => "social-vimeo-link",
							   "std"  => "",
							   "type" => "text"
		);
		$of_options[] = array( "name" => __( 'Pinterest Link', 'zorka' ),
							   "id"   => "social-pinteres-link",
							   "std"  => "",
							   "type" => "text"
		);
		$of_options[] = array( "name" => __( 'Youtube Link', 'zorka' ),
							   "id"   => "social-youtube-link",
							   "std"  => "",
							   "type" => "text"
		);
		$of_options[] = array( "name" => __( 'Instagram Link', 'zorka' ),
							   "id"   => "social-instagram-link",
							   "std"  => "",
							   "type" => "text"
		);

        /*WooCommerce*/
        $of_options[] = array( "name" => __( 'WooCommerce', 'zorka' ),
            "type" => "heading",
            "icon" => ADMIN_IMAGES . "woo_icon.png"
        );

        $of_options[] = array( "name"    => __( 'Archive Product Layout', 'zorka' ),
            "desc"    => __( 'Select layout for Archive Product Page', 'zorka' ),
            "id"      => "product-archive-layout",
            "std"     => "left-sidebar",
            "type"    => "images",
            "options" => array(
                'full-content'  => $url . '1col.png',
                'left-sidebar'  => $url . '2cl.png',
                'right-sidebar' => $url . '2cr.png'
            )
        );

        $of_options[] = array(
            "name"    => __( 'Archive Product Columns', 'zorka' ),
            "desc"    => __( 'Choose the number of columns to display on shop/category pages', 'zorka' ),
            "id"      => "archive-product-columns",
            "std"     => "3",
            "type"    => "select",
            'options' => array(
                '2'		=> '2',
                '3'		=> '3',
                '4'		=> '4'
            ),
        );


        $shop_page_title_bg = THEME_URL . 'assets/images/shop-page-title-bg.jpg';
        $of_options[] = array( "name" => __( 'Shop Page Title Background', 'zorka' ),
            "desc" => __( "Enter URL or upload an image to set as your heading background with page shop title", 'zorka' ),
            "id"   => "shop-page-title-background",
            "std"  => $shop_page_title_bg,
            "type" => "media"
        );

        $of_options[] = array( "name"  => __( 'Enable Quick View', 'zorka' ),
            "desc"  => "",
            "id"    => "enable-quick-view",
            "std"   => 1,
            "folds" => 1,
            "type"  => "switch"
        );


        $of_options[] = array(
            "name"    => __( 'Sale Flash Mode', 'zorka' ),
            "desc"    => __( 'Chose Sale Flash Mode', 'zorka' ),
            "id"      => "product-sale-flash-mode",
            "std"     => "percent",
            "type"    => "select",
            'options' => array(
                'text'		=> 'Text',
                'percent'		=> 'Percent'
            ),
        );

		$of_options[] = array(
			"name" => __('Product Image Hover Effect','zorka'),
			"id" => "archive-product-image-hover-effect",
			"std" => "change-images",
			"type" => "select",
			"options" => array(
				'none'          => __('none','zorka'),
				"change-images" => __('Change images','zorka'),
				"flip-back" => __('Flip back','zorka'),
				"translate-top-to-bottom" => __('Translate Top To Bottom','zorka'),
				"translate-bottom-to-top" => __('Translate Bottom To Top','zorka'),
				"translate-left-to-right" => __('Translate Left To Right','zorka'),
				"translate-right-to-left" => __('Translate Right To Left','zorka'),
			)
		);



		/*Typography*/
		$of_options[] = array( "name" => __( 'Typography', 'zorka' ),
							   "type" => "heading",
							   "icon" => ADMIN_IMAGES . "icon-typography.gif"

		);
		$of_options[] = array( "name" => __( 'Body Font', 'zorka' ),
							   "desc" => __( 'Specify the body font properties', 'zorka' ),
							   "id"   => "body-font",
							   "std"  => array( 'face' => 'Lato', 'size' => '14px', 'weight' => 'normal', 'face-type' => '1' ),
							   "type" => "typography"
		);

		$of_options[] = array( "name" => __( 'Heading Options', 'zorka' ),
							   "desc" => "",
							   "id"   => "heading-font",
							   "std"  => array( 'face' => 'Montserrat', 'face-type' => '1' ),
							   "type" => "typography"
		);

		$of_options[] = array( "name" => __( 'Font H1', 'zorka' ),
							   "desc" => "",
							   "id"   => "h1-font",
							   "std"  => array( 'face' => '', 'size' => '36px', 'style' => 'normal', 'weight' => '400', 'text-transform' => 'none' ),
							   "type" => "typography"
		);
		$of_options[] = array( "name" => __( 'Font H2', 'zorka' ),
							   "desc" => "",
							   "id"   => "h2-font",
							   "std"  => array( 'face' => '', 'size' => '30px', 'style' => 'normal', 'weight' => '400', 'text-transform' => 'none' ),
							   "type" => "typography"
		);
		$of_options[] = array( "name" => __( 'Font H3', 'zorka' ),
							   "desc" => "",
							   "id"   => "h3-font",
							   "std"  => array( 'face' => '', 'size' => '26px', 'style' => 'normal', 'weight' => '400', 'text-transform' => 'none' ),
							   "type" => "typography"
		);
		$of_options[] = array( "name" => __( 'Font H4', 'zorka' ),
							   "desc" => "",
							   "id"   => "h4-font",
							   "std"  => array( 'face' => '', 'size' => '24px', 'style' => 'normal', 'weight' => '400', 'text-transform' => 'none' ),
							   "type" => "typography"
		);
		$of_options[] = array( "name" => __( 'Font H5', 'zorka' ),
							   "desc" => "",
							   "id"   => "h5-font",
							   "std"  => array( 'face' => '', 'size' => '22px', 'style' => 'normal', 'weight' => '400', 'text-transform' => 'none' ),
							   "type" => "typography"
		);
		$of_options[] = array( "name" => __( 'Font H6', 'zorka' ),
							   "desc" => "",
							   "id"   => "h6-font",
							   "std"  => array( 'face' => '', 'size' => '19px', 'style' => 'normal', 'weight' => '400', 'text-transform' => 'none' ),
							   "type" => "typography"
		);

		/*Resources Options*/
		$of_options[] = array( "name" => __( 'Resources Options', 'zorka' ),
							   "type" => "heading",
							   "icon" => ADMIN_IMAGES . "icon-bootstrap.png"
		);
		$of_options[] = array( "name" => __( 'CDN Bootstrap Script', 'zorka' ),
							   "desc" => "Empty using theme resources",
							   "id"   => "bootstrap-js",
							   "std"  => "",
							   "type" => "text"
		);

		$of_options[] = array( "name" => __( 'CDN Bootstrap StyleSheet', 'zorka' ),
							   "desc" => "Empty using theme resources",
							   "id"   => "bootstrap-css",
							   "std"  => "",
							   "type" => "text"
		);

		$of_options[] = array( "name" => __( 'CDN Font Awesome', 'zorka' ),
							   "desc" => "Empty using theme resources",
							   "id"   => "font-awesome",
							   "std"  => "",
							   "type" => "text",
		);

		/*Custom CSS*/
		$of_options[] = array( "name" => __( 'Custom CSS', 'zorka' ),
							   "type" => "heading",
							   "icon" => ADMIN_IMAGES . "css.png"
		);

		$of_options[] = array( "name" => __( 'Custom CSS', 'zorka' ),
							   "desc" => "",
							   "id"   => "css-custom",
							   "std"  => ".class-custom{}",
							   "type" => "textarea"
		);

		/*Backup Options*/
		$of_options[] = array( "name" => __( 'Backup Options', 'zorka' ),
							   "type" => "heading",
							   "icon" => ADMIN_IMAGES . "icon-slider.png"
		);

		$of_options[] = array( "name" => __( 'Backup and Restore Options', 'zorka' ),
							   "id"   => "of-backup",
							   "std"  => "",
							   "type" => "backup",
							   "desc" => __( 'You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.', 'zorka' ),
		);

		$of_options[] = array( "name" => __( 'Transfer Theme Options Data', 'zorka' ),
							   "id"   => "of-transfer",
							   "std"  => "",
							   "type" => "transfer",
							   "desc" => __( 'You can tranfer the saved options data between different installs by copying the text inside the text box. To import data from another install, replace the data in the text box with the one from another install and click "Import Options".', 'zorka' ),
		);

	}
	//End function: of_options()
}//End chack if function exists: of_options()
