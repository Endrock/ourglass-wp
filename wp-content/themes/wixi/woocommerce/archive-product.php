<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

get_header();

do_action("wixi_before_woo_shop_page");

$sidebar = is_active_sidebar( 'shop-page-sidebar' );
$shop_layout = wixi_settings( 'shop_layout', 'right-sidebar' );
$container_width = wixi_settings( 'shop_container_width', '' );
$column = 'full-width' != $shop_layout && $sidebar ? 'col-lg-9 shop-has-sidebar' : 'col-lg-12';
?>

<!-- Woo shop page general div -->
<div id="nt-shop-page" class="nt-shop-page">

    <!-- Hero section - this function using on all inner pages -->
    <?php wixi_woo_hero_section(); ?>

    <div class="nt-theme-inner-container section-padding">
        <div class="container<?php echo esc_attr( $container_width ); ?>">
            <div class="row">

                <?php
                if ( 'left-sidebar' == $shop_layout && $sidebar ) {
                    echo '<div id="nt-sidebar" class="col-lg-3">';
                        echo '<div class="blog-sidebar nt-sidebar-inner">';
                            dynamic_sidebar( 'shop-page-sidebar' );
                        echo '</div>';
                    echo '</div>';
                }
                ?>

                <!-- Content column -->
                <div class="<?php echo esc_attr( $column ); ?>">

                    <?php

                    woocommerce_product_loop_start();

                    if ( woocommerce_product_loop() ) {
                        echo '<div class="col product_item notices--wrapper">';
                        /**
                        * Hook: woocommerce_before_shop_loop.
                        *
                        * @hooked woocommerce_output_all_notices - 10
                        * @hooked woocommerce_result_count - 20
                        * @hooked woocommerce_catalog_ordering - 30
                        */
                        do_action( 'woocommerce_before_shop_loop' );
                        echo '</div>';

                        if ( wc_get_loop_prop( 'total' ) ) {
                            while ( have_posts() ) {
                                the_post();

                                /**
                                * Hook: woocommerce_shop_loop.
                                */
                                do_action( 'woocommerce_shop_loop' );

                                wc_get_template_part( 'content', 'product' );
                            }
                        }

                        woocommerce_product_loop_end();

                        wixi_index_loop_pagination();

                    } else {
                        /**
                        * Hook: woocommerce_no_products_found.
                        *
                        * @hooked wc_no_products_found - 10
                        */
                        do_action( 'woocommerce_no_products_found' );
                    }
                    ?>
                </div>
                <!-- End sidebar + content -->

                <!-- Right sidebar -->
                <?php
                if ( 'right-sidebar' == $shop_layout && $sidebar ) {
                    echo '<div id="nt-sidebar" class="col-lg-3">';
                        echo '<div class="blog-sidebar nt-sidebar-inner">';
                            dynamic_sidebar( 'shop-page-sidebar' );
                        echo '</div>';
                    echo '</div>';
                }
                ?>

            </div><!-- End row -->
        </div><!-- End container -->
    </div><!-- End #blog -->
</div><!-- End woo shop page general div -->

<?php

    do_action("wixi_after_woo_shop_page");

    get_footer();

?>
