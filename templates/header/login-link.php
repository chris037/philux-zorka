<?php
	global $zorka_data;
	$show_login_link = isset($zorka_data['show-login-link']) ? $zorka_data['show-login-link'] : 0;
?>
<?php if ($show_login_link):?>
	<div class="zorka-login-link">
			<?php if ( !is_user_logged_in() ):?>
				<?php _e('Welcome Guest!','xmenu');?>
				<a class="zorka-login-link-sign-in" href="#"><?php _e('Log In','zorka'); ?></a>
				<?php _e('Or','xmenu');?>
				<a class="zorka-login-link-sign-up" href="#"><?php _e('Register','zorka'); ?></a>
			<?php else:?>
				<?php _e('Welcome ','xmenu');?>
				<?php
					$current_user = wp_get_current_user();
					echo esc_html($current_user->user_login) . '!';
				?>
				<a href="<?php echo esc_url(wp_logout_url(is_home()? home_url() : get_permalink()) ); ?>"><i class="fa fa-power-off"></i> <?php _e('Logout','zorka'); ?></a>
			<?php endif;?>
	</div>
<?php endif;?>