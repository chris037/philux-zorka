<?php
/**
 * G5Plus Theme Framework includes
 *
 * The $g5plus_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link http://g5plus.net
 */

define( 'HOME_URL', trailingslashit( home_url() ) );
define( 'THEME_DIR', trailingslashit( get_template_directory() ) );
define( 'THEME_URL', trailingslashit( get_template_directory_uri() ) );



zorka_include_one();
// include lib for theme framework
function zorka_include_one() {
	$zorka_includes = array(
		'lib/install-demo/install-demo.php',
        'admin/index.php', // SMOF theme options
		'lib/common-lib.php', // Common functions
        'lib/tax-meta.php', // tax-meta
		'lib/widgets.php', // Utility functions
		'lib/sidebar.php', // Register Sidebar
        'lib/breadcrumb.php', // Register Sidebar
		'lib/ajax-action/search-ajax-action.php', // search ajax action
		'lib/ajax-action/search-product-ajax-action.php', // search ajax action
        'lib/ajax-action/register-ajax-action.php', // search ajax action
		'lib/ajax-action/login-link-action.php', // search ajax action
        'lib/template-tags.php', // Plugin installation and activation for WordPress themes
        'lib/filter.php', // register filter
        'lib/woocommerce-lib.php', // Plugin installation and activation for WordPress themes
        'lib/inc-functions/theme-setup.php', // Plugin installation and activation for WordPress themes
        'lib/inc-functions/register-require-plugin.php', // Plugin installation and activation for WordPress themes
        'lib/inc-functions/enqueue-script-css.php', // Plugin installation and activation for WordPress themes
        'lib/inc-functions/use-less-js.php', // Plugin installation and activation for WordPress themes
        'lib/inc-functions/resize.php',
        'lib/meta-box.php'
	);

	foreach ( $zorka_includes as $file ) {
		if ( ! $filepath = locate_template( $file ) ) {
			trigger_error( sprintf( __( 'Error locating %s for inclusion', 'zorka' ), $file ), E_USER_ERROR );
		}
		require_once $filepath;
	}
	unset( $file, $filepath );
}
function zorka_vc_remove_wp_admin_bar_button() {
    remove_action( 'admin_bar_menu', array( vc_frontend_editor(), 'adminBarEditLink' ), 1000 );
}
add_action( 'vc_after_init', 'zorka_vc_remove_wp_admin_bar_button' );


if(!function_exists('zorka_template_loop_product_thumbnail')){
    function zorka_template_loop_product_thumbnail($width=330, $height=440){
        global $post;
        if ( has_post_thumbnail() ) {
            $post_thumbnail_id = get_post_thumbnail_id($post->ID);
            $arrImages = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );
            if(count($arrImages)>0){
                $resize = matthewruddy_image_resize($arrImages[0], $width, $height);
                if($resize!=null ){
                    echo sprintf('<img src="%s" width="%s" height="%s" alt="%s" />',$resize['url'], $width, $height, $post->post_title);
                }
            }
        } elseif ( wc_placeholder_img_src() ) {
            return wc_placeholder_img( 'shop_thumbnail' );
        }
    }
}
