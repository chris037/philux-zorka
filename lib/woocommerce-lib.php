<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 3/26/15
 * Time: 10:59 AM
 */
global $zorka_product_layout;
if (!function_exists('zorka_woocommerce_reset_loop')) {
	/**
	 * Reset the loop's index and columns when we're done outputting a product loop.
	 *
	 * @subpackage    Loop
	 */
	function zorka_woocommerce_reset_loop()
	{
		global $zorka_product_layout;
		$zorka_product_layout = '';
	}
}

add_filter('loop_shop_per_page', 'zorka_show_products_per_page');
function zorka_show_products_per_page()
{
	$page_size = isset($_GET['page_size']) ? wc_clean($_GET['page_size']) : 12;
	return $page_size;
}

if (!function_exists('woocommerce_template_loop_product_thumbnail')) :
	/**
	 * Get the product thumbnail for the loop.
	 *
	 * @access public
	 * @subpackage    Loop
	 * @return void
	 */
	function woocommerce_template_loop_product_thumbnail()
	{
		global $product, $zorka_data;
		$archive_product_image_hover_effect = isset($zorka_data['archive-product-image-hover-effect']) ? $zorka_data['archive-product-image-hover-effect'] : 'translate-top-to-bottom';
		$attachment_ids = $product->get_gallery_attachment_ids();
		$secondary_image = '';
		$class_arr = array('product-images-hover');
		$class_arr[] = $archive_product_image_hover_effect;

		if ($attachment_ids) {
			$secondary_image_id = $attachment_ids['0'];
			$secondary_image = wp_get_attachment_image($secondary_image_id, apply_filters('shop_catalog', 'shop_catalog'));
		}
		?>
		<?php if (has_post_thumbnail()) : ?>
		<?php if (empty($secondary_image) || ($archive_product_image_hover_effect == 'none')) : ?>
			<div class="product-thumb-one">
				<?php echo woocommerce_get_product_thumbnail(); ?>
			</div>
		<?php else: ?>
			<div class="<?php echo join(' ',$class_arr); ?>">
				<div class="product-thumb-primary">
					<?php echo woocommerce_get_product_thumbnail(); ?>
				</div>
				<div class="product-thumb-secondary">
					<?php echo wp_kses_post($secondary_image); ?>
				</div>
			</div>
		<?php endif; ?>
	<?php endif; ?>
	<?php
	}
endif;


/*Add meta New*/
// Display Fields
add_action('woocommerce_product_options_general_product_data', 'zorka_woocommerce_add_custom_general_fields');

function zorka_woocommerce_add_custom_general_fields()
{
	echo '<div class="options_group">';
	woocommerce_wp_checkbox(
		array(
			'id' => 'zorka_product_new',
			'label' => __('Product New', 'zorka')
		)
	);
	echo '</div>';
}


// Save Fields
add_action('woocommerce_process_product_meta', 'zorka_woo_add_custom_general_fields_save');
function zorka_woo_add_custom_general_fields_save($post_id)
{
	//product-new
	$zorka_product_new = isset($_POST['zorka_product_new']) ? 'yes' : 'no';
	update_post_meta($post_id, 'zorka_product_new', $zorka_product_new);
}


//Add custom column into Product Page
add_filter('manage_edit-product_columns', 'zorka_columns_into_product_list');
function zorka_columns_into_product_list($defaults)
{
	$defaults['zorka_product_new'] = 'New';
	return $defaults;
}

//Add rows value into Product Page
add_action('manage_product_posts_custom_column', 'zorka_column_into_product_list', 10, 2);
function zorka_column_into_product_list($column, $post_id)
{
	switch ($column) {
		case 'zorka_product_new':
			echo get_post_meta($post_id, 'zorka_product_new', true);
			break;
	}
}


add_filter("manage_edit-product_sortable_columns", "zorka_sortable_columns");
// Make these columns sortable
function zorka_sortable_columns()
{
	return array(
		'zorka_product_new' => 'zorka_product_new'
	);
}

add_action('pre_get_posts', 'zorka_event_column_orderby');
function zorka_event_column_orderby($query)
{
	if (!is_admin())
		return;
	$orderby = $query->get('orderby');
	if ('zorka_product_new' == $orderby) {
		$query->set('meta_key', 'zorka_product_new');
		$query->set('orderby', 'meta_value_num');
	}
}

/*Add meta Hot end*/

add_filter('woocommerce_get_price_html_from_to', 'zorka_woocommerce_get_price_html_from_to', 10, 4);
function zorka_woocommerce_get_price_html_from_to($price, $from, $to, $this)
{
	$price = '<ins>' . ((is_numeric($to)) ? wc_price($to) : $to) . '</ins> <del>' . ((is_numeric($from)) ? wc_price($from) : $from) . '</del>';
	return $price;
}

function zorka_product_search_form($form)
{
	$form = '<form role="search" class="zorka-search-form" method="get" id="searchform" action="' . home_url('/') . '">
                <input type="text" value="' . get_search_query() . '" name="s" id="s"  placeholder="' . __('Search for products', 'woocommerce') . '">
                <button type="submit"><i class="pe-7s-search"></i></button>
                <input type="hidden" name="post_type" value="product" />
     		</form>';
	return $form;
}

add_filter('get_product_search_form', 'zorka_product_search_form');


/*check out*/
remove_action('woocommerce_before_checkout_form', 'woocommerce_checkout_login_form', 10);
add_action('woocommerce_checkout_login_form', 'woocommerce_checkout_login_form', 10);

add_filter('body_class', 'zorka_body_class');
function zorka_body_class($classes)
{
	$classes[] = 'woocommerce';
	$action = isset($_GET['action']) ? $_GET['action'] : '';
	if (isset($action)) {
		switch ($action) {
			case 'yith-woocompare-view-table':
				$classes[] = 'woocommerce-compare-page';
				break;
		}
	}
	return $classes;
}

add_filter('woocommerce_output_related_products_args', 'zorka_related_products_args');
function zorka_related_products_args($args)
{

	$args['posts_per_page'] = 8; // 4 related products
	return $args;
}

add_action('woocommerce_before_single_product_quick_view_summary', 'woocommerce_show_product_sale_flash', 10);
add_action('woocommerce_before_single_product_quick_view_summary', 'woocommerce_show_product_images_quick_view', 20);

if (!function_exists('woocommerce_show_product_images_quick_view')) {

	/**
	 * Output the product image before the single product summary.
	 *
	 * @subpackage    Product
	 */
	function woocommerce_show_product_images_quick_view()
	{
		wc_get_template('single-product/product-image-quick-view.php');
	}
}

/*cart*/
remove_action('woocommerce_cart_collaterals', 'woocommerce_cart_totals');

/*quick-view*/
if (!function_exists('zorka_woocommerce_template_loop_quick_view')) {
	function zorka_woocommerce_template_loop_quick_view()
	{
		wc_get_template('loop/quick-view.php');
	}

	add_action('woocommerce_before_shop_loop_item_title', 'zorka_woocommerce_template_loop_quick_view', 15);
}

if (!function_exists('zorka_woocommerce_template_loop_link')) {
	function zorka_woocommerce_template_loop_link()
	{
		wc_get_template('loop/link.php');
	}

	add_action('woocommerce_before_shop_loop_item_title', 'zorka_woocommerce_template_loop_link', 20);
}


