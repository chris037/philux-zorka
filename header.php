<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <?php
    global $wp_version;
    $arrImages = wp_get_attachment_image_src(get_post_thumbnail_id(),'full');
    $image = $arrImages[0];
    if (version_compare($wp_version,'4.1','<')): ?>
        <title><?php wp_title( '|', true, 'right' ); ?></title>
    <?php endif; ?>

    <meta property="og:title" content="<?php wp_title( '|', true, 'right' ); ?>">
    <meta property="og:url" content="<?php echo esc_url(get_the_permalink())?>" />
    <meta name="robots" content="noindex, follow" />


    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <?php global $zorka_data;
     $favicon = '';
        if (isset($zorka_data['favicon']) && !empty($zorka_data['favicon']) ) {
            $favicon = $zorka_data['favicon'];
        } else {
            $favicon = get_template_directory_uri() . "/assets/images/favicon.ico";
        }
    ?>

    <link rel="shortcut icon" href="<?php echo esc_url($favicon);?>" type="image/x-icon">
    <link rel="icon" href="<?php echo esc_url($favicon);?>" type="image/x-icon">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->
    <?php wp_head(); ?>

    <style type="text/css">

    .zorka-button.style1 {
        color: #ffffff;
        background-color: #7C6E5F;
        border: 1px solid #7C6E5F;
    }

    .product-listing.woocommerce .product-item-wrapper:hover .add_to_cart_button, .product-listing.woocommerce .product-item-wrapper.active .add_to_cart_button, .product-listing.woocommerce .product-item-wrapper:hover .added_to_cart.wc-forward, .product-listing.woocommerce .product-item-wrapper.active .added_to_cart.wc-forward, .product-listing.woocommerce .product-item-wrapper:hover .product_type_external, .product-listing.woocommerce .product-item-wrapper.active .product_type_external, .product-listing.woocommerce .product-item-wrapper:hover .product_type_grouped, .product-listing.woocommerce .product-item-wrapper.active .product_type_grouped, .product-listing.woocommerce .product-item-wrapper:hover .product_type_simple, .product-listing.woocommerce .product-item-wrapper.active .product_type_simple {
    background-color: #7C6E5F;
    border: 1px solid #7C6E5F;
    color: #ffffff;
    }


    .zorka-mailchimp input[type="submit"] {
    
        background-color: #7C6E5F;
        border: 1px solid #7C6E5F;
    
    }

    .gotop i {
         background-color: #7C6E5F;
    }

    .gotop:before{
           border: 1px solid #7C6E5F;
    }

    .gotop i:after{
            box-shadow: 0 0 0 2px #7C6E5F;
    }

    .menu-item-121{
        font-weight: bold;
    }

    .product-listing.woocommerce .product-quick-view {

        background: #FFF;
        color: #666;
    }

    a:hover, .footer_inner a:hover{
        color: #CCC !important;
    }

    .single-product-share > a:hover{
        background: #7C6E5F;
        border: #7C6E5F;
        color: #FFF;

    }

    a.btndps{
        margin-top: 10px;
    }

    .zorka-mailchimp input[type="submit"] {
        background-color: #baa690;
        border: 1px solid #baa690;
    }

    a.button.product_type_simple:hover{
         background-color: #baa690 !important;
        border: 1px solid #baa690 !important;
    }

    .page-id-55 input[type="text"], 
    .page-id-55 input[type="search"], 
    .page-id-55 input[type="email"], 
    .page-id-55 input[type="url"], 
    .page-id-55 input[type="password"], 
    .page-id-55 textarea {
            width: 100%;
    }

    .page-id-55 textarea {
           height: 100px;
    }

    .entry-content input[type="submit"], .comment-text input[type="submit"] {
    background-color: #baa690;
        border: 1px solid #baa690;

    }



    </style>
</head>
<?php
global $zorka_data;

$body_class = array();

$layout_style = get_post_meta(get_the_ID(),'layout-style',true);
if (!isset($layout_style) || empty($layout_style) || $layout_style == 'none'){
    $layout_style = $zorka_data['layout-style'];
}

if ($layout_style == 'boxed') {
    $body_class[] = 'boxed';
}
$show_loading = isset($zorka_data['show-loading']) ? $zorka_data['show-loading'] : 1;


$header_layout = get_post_meta(get_the_ID(),'header-layout',true);
if (!isset($header_layout) || $header_layout == 'none' || $header_layout == '') {
    $header_layout =  $zorka_data['header-layout'];
}
$body_class[] = 'header-' . $header_layout;

$page_title_background = isset($zorka_data['page-title-background']) ? $zorka_data['page-title-background'] : '';

?>
<body <?php body_class($body_class); ?>>
<!-- Document Wrapper
   ============================================= -->
<div id="wrapper" class="clearfix <?php echo esc_attr($show_loading == 1 ? 'animsition' : '');?>">
	<?php get_template_part('templates/header/header','template' ); ?>

	<div id="wrapper-content">


