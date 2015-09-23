<?php get_header();?>
    <div class="page-404 content-middle">
        <div class="content-middle-inner">
            <h1><?php echo __('404 ERROR!','zorka') ?></h1>
            <p><?php echo __('The page you are looking for does not exist. Return to the ','zorka') ?><a href="<?php echo esc_url(home_url()); ?>"><?php echo __('home page.','zorka'); ?></a></p>
        </div>
    </div>
<?php get_footer(); ?>