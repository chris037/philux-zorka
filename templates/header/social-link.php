<?php
global $zorka_data;
$count_social_link = 0;
$social_link_fields = array(
	'social-email-link' => array('fa fa-envelope-o', __('Email','zorka'),1),
	'social-linkedin-link' => array('fa fa-linkedin', __('Linked In','zorka'),2),
	'social-face-link' => array('fa fa-facebook', __('Facebook','zorka'),2),
	'social-twitter-link' => array('fa fa-twitter ', __('Twitter','zorka'),2),
	'social-dribbble-link' => array('fa fa-dribbble', __('Dribbble','zorka'),2),
	'social-google-link' => array('fa fa-google-plus', __('Google Plus','zorka'),2),
	'social-vimeo-link' => array('fa fa-vimeo-square', __('Vimeo','zorka'),2),
	'social-pinteres-link' => array('fa fa-pinterest', __('Pinterest','zorka'),2),
	'social-youtube-link' => array('fa fa-youtube', __('Youtube','zorka'),2),
	'social-instagram-link' => array('fa fa-instagram', __('Instagram','zorka'),2),
);
foreach ( $social_link_fields as $key => $value ) {
	if ( isset( $zorka_data[$key] ) && ! empty( $zorka_data[$key] ) ) {
		$count_social_link ++;
	}
}
?>
<?php if ($count_social_link > 0):?>
	<ul class="social-link" style="text-align: right;">
		<?php foreach ( $social_link_fields as $key => $value ): ?>
			<?php if ( isset( $zorka_data[$key] ) && ! empty( $zorka_data[$key] ) ):?>
                <?php if ($value[2] == 1) : ?>
                    <li><a href="mailto:<?php echo esc_attr($zorka_data[$key]) ?>" target="_top" data-toggle="tooltip" title="<?php echo esc_attr($value[1]) ?>"><i class="<?php echo esc_attr($value[0]) ?>"></i></a></li>
                 <?php else: ?>
                    <li><a target="_blank" href="<?php echo esc_url($zorka_data[$key]) ?>" data-toggle="tooltip" title="<?php echo esc_attr($value[1]) ?>"><i class="<?php echo esc_attr($value[0]) ?>"></i></a></li>
                <?php endif; ?>
			<?php endif;?>
		<?php endforeach;?>
	</ul>
<?php endif;?>