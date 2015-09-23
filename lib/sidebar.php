<?php
function g5plus_register_sidebar() {
	register_sidebar( array(
		'name'          => __("Primary Widget Area",'zorka'),
		'id'            => 'primary-sidebar',
		'description'   => __("Primary Widget Area",'zorka'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title"><span>',
		'after_title'   => '</span></h4>',
	) );

    register_sidebar( array(
        'name'          => __("Shop Widget Area",'zorka'),
        'id'            => 'shop-sidebar',
        'description'   => __("Shop Widget Area",'zorka'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h4 class="widget-title"><span>',
        'after_title'   => '</span></h4>',
    ) );

    register_sidebar( array(
        'name'          => __("Home Shop Widget Area",'zorka'),
        'id'            => 'home-shop-sidebar',
        'description'   => __("Home Shop Widget Area",'zorka'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h4 class="widget-title"><span>',
        'after_title'   => '</span></h4>',
    ) );

    register_sidebar( array(
        'name'          => __("Footer 1 Sidebar",'zorka'),
        'id'            => 'footer-1',
        'description'   => __("Footer 1 Sidebar",'zorka'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h4 class="widget-title"><span>',
        'after_title'   => '</span></h4>',
    ) );

    register_sidebar( array(
        'name'          => __("Footer 2 Sidebar",'zorka'),
        'id'            => 'footer-2',
        'description'   => __("Footer 2 Sidebar",'zorka'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h4 class="widget-title"><span>',
        'after_title'   => '</span></h4>',
    ) );

    register_sidebar( array(
        'name'          => __("Footer 3 Sidebar",'zorka'),
        'id'            => 'footer-3',
        'description'   => __("Footer 3 Sidebar",'zorka'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h4 class="widget-title"><span>',
        'after_title'   => '</span></h4>',
    ) );

    register_sidebar( array(
        'name'          => __("Footer 4 Sidebar",'zorka'),
        'id'            => 'footer-4',
        'description'   => __("Footer 4 Sidebar",'zorka'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h4 class="widget-title"><span>',
        'after_title'   => '</span></h4>',
    ) );
}

add_action( 'widgets_init', 'g5plus_register_sidebar' );