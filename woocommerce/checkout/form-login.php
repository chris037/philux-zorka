<?php
/**
 * Checkout login form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( is_user_logged_in() || 'no' === get_option( 'woocommerce_enable_checkout_login_reminder' ) ) {
	return;
}

$info_message  = apply_filters( 'woocommerce_checkout_login_message', __( 'Returning customer?', 'woocommerce' ) );
$info_message .= ' <a href="#" class="showlogin">' . __( 'Click here to login', 'woocommerce' ) . '</a>';
//wc_print_notice( $info_message, 'notice' );
?>
<div class="panel panel-default">
    <div class="panel-heading" role="tab" id="heading-checkout-method">
        <a data-toggle="collapse" data-parent="#accordion" href="#checkout-method" aria-expanded="true" aria-controls="checkout-method">
            <?php _e("Checkout Method",'zorka'); ?>
        </a>
    </div>
    <div id="checkout-method" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading-checkout-method">
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-6">
                    <div class="checkout-account-type">
                        <h3><?php _e("New Customer",'zorka'); ?></h3>
                        <div class="radio">
                            <label>
                                <input type="radio" name="checkout-method" checked="checked" value="guest"> <?php _e("Checkout as a Guest",'zorka'); ?>
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="checkout-method" value="account"> <?php _e("Create new account",'zorka'); ?>
                            </label>
                        </div>
                        <p class="info-checkout">
                            <?php _e('Register with us for future convenience:','zorka'); ?>
                            <br/>
                            <?php _e('+ Fast and easy checkout.','zorka'); ?>
                            <br/>
                            <?php _e('+ Easy access to your order history and status.','zorka'); ?>
                        </p>
                        <a id="button_create_account_continue" data-toggle="collapse" data-parent="#accordion" href="#billing-address" aria-expanded="false" class="button"><?php _e("Continue",'zorka'); ?></a>
                    </div>

                </div>
                <div class="col-sm-6">
                    <div class="checkout-account-login">
                        <h3><?php _e("Login",'zorka'); ?></h3>
                        <?php
                        woocommerce_login_form(
                            array(
                                'message'  => __( 'If you have shopped with us before, please enter your details in the boxes below. If you are a new customer please proceed to the Billing &amp; Shipping section.', 'woocommerce' ),
                                'redirect' => wc_get_page_permalink( 'checkout' ),
                                'hidden'   => false
                            )
                        );
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

