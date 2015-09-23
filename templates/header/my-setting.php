<?php
/**
 * Created by PhpStorm.
 * User: hoantv
 * Date: 2015-04-15
 * Time: 10:22 AM
 */

if ( !class_exists( 'WooCommerce' ) ) {
	return;
}
global $woocommerce;
?>
<ul class="my-setting">
	<li>
		<span><?php _e('My Settings','zorka') ?> <i class="fa fa-angle-down"></i></span>
		<ul>
			<?php if (class_exists( 'YITH_WCWL' ) ):?>
				<li><a href="<?php echo esc_url(YITH_WCWL::get_instance()->get_wishlist_url())?>"><i class="fa fa-heart"></i> <?php _e('Wish List','zorka') ?></a></li>
			<?php endif;?>
			<li><a href="<?php echo esc_url($woocommerce->cart->get_cart_url()) ?>"><i class="fa fa-shopping-cart"></i> <?php _e('Shopping Cart','zorka'); ?></a></li>
			<li><a href="<?php echo esc_url($woocommerce->cart->get_checkout_url()) ?>"><i class="fa fa-share"></i> <?php _e('Checkout','zorka'); ?></a></li>
		</ul>
	</li>
</ul>