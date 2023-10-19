<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
    return;
}
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );

$id = $product->get_id();
?>

<div <?php wc_product_class( 'col thm-product', $product ); ?>>
    <div class="shop-product_inner">
    	<?php
    	/**
    	 * Hook: woocommerce_before_shop_loop_item.
    	 *
    	 * @hooked woocommerce_template_loop_product_link_open - 10
    	 */
    	do_action( 'woocommerce_before_shop_loop_item' );
        ?>
        <div class="shop-product_thumb">
            <a href="<?php echo get_permalink( $id ) ?>">
                <?php
            	/**
            	 * Hook: woocommerce_before_shop_loop_item_title.
            	 *
            	 * @hooked woocommerce_show_product_loop_sale_flash - 10
            	 * @hooked woocommerce_template_loop_product_thumbnail - 10
            	 */
            	do_action( 'woocommerce_before_shop_loop_item_title' );
                ?>
            </a>
        </div>

        <div class="shop-product_content">

            <h3 class="shop-product_title"><a href="<?php echo get_permalink( $id ) ?>"><?php echo get_the_title( $id ) ?></a></h3>

            <?php

        	/**
        	 * Hook: woocommerce_after_shop_loop_item_title.
        	 *
        	 * @hooked woocommerce_template_loop_rating - 5
        	 * @hooked woocommerce_template_loop_price - 10
        	 */
        	 do_action( 'woocommerce_after_shop_loop_item_title' );
        	 ?>

            <div class="shop-product_actions">
                <?php
            	/**
            	 * Hook: woocommerce_after_shop_loop_item.
            	 *
            	 * @hooked woocommerce_template_loop_product_link_close - 5
            	 * @hooked woocommerce_template_loop_add_to_cart - 10
            	 */
            	do_action( 'woocommerce_after_shop_loop_item' );
        	    ?>
    	    </div>

    	</div>
	</div>

</div>
