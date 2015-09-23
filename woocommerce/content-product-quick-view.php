<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 3/31/15
 * Time: 3:19 PM
 */
$suffix               = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
$assets_path          = str_replace( array( 'http:', 'https:' ), '', WC()->plugin_url() ) . '/assets/';
$frontend_script_path = $assets_path . 'js/frontend/';
?>

<div id="popup-product-quick-view-wrapper" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog"  aria-hidden="true">
    <a class="popup-close" data-dismiss="modal" href="javascript:;"><i class="pe-7s-close"></i></a>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <div class="single-product-info">
                        <div class="row">
                            <div class="col-md-6 col-lg-6 col-sm-6">
                                <div class="single-product-left-wrapper">
                                    <?php
                                    /**
                                     * woocommerce_before_single_product_summary hook
                                     *
                                     * @hooked woocommerce_show_product_sale_flash - 10
                                     * @hooked woocommerce_show_product_images_quick_view - 20
                                     */
                                    do_action( 'woocommerce_before_single_product_quick_view_summary' );
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 col-sm-6">
                                <div class=" summary-product entry-summary">
                                    <?php
                                    /**
                                     * woocommerce_single_product_summary hook
                                     *
                                     * @hooked woocommerce_template_single_title - 5
                                     * @hooked woocommerce_template_single_rating - 10
                                     * @hooked woocommerce_template_single_price - 10
                                     * @hooked woocommerce_template_single_excerpt - 20
                                     * @hooked woocommerce_template_single_add_to_cart - 30
                                     * @hooked woocommerce_template_single_meta - 40
                                     * @hooked woocommerce_template_single_sharing - 50
                                     */
                                    do_action( 'woocommerce_single_product_summary' );
                                    ?>
                                </div>
                            </div><!-- .summary -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="<?php echo esc_url($frontend_script_path); ?>add-to-cart<?php echo $suffix;  ?>.js"></script>
    <script type="text/javascript" src="<?php echo esc_url($frontend_script_path); ?>add-to-cart-variation<?php echo $suffix;  ?>.js"></script>
    <script>
        (function($) {
            "use strict";
            $('.variations_form' ).wc_variation_form();
            $('.variations_form .variations select' ).change();
        })(jQuery);
    </script>
</div>
