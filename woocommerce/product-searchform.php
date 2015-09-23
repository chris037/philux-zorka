<form role="search" class="zorka-search-form" method="get" id="searchform" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
    <input type="text"  placeholder="<?php echo esc_attr_x( 'Search Products&hellip;', 'placeholder', 'woocommerce' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'woocommerce' ); ?>" />
    <button type="submit"><i class="pe-7s-search"></i></button>
    <input type="hidden" name="post_type" value="product" />
</form>
