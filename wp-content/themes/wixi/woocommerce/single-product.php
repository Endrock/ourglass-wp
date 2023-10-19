<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6.4
 */

get_header();

do_action("wixi_before_woo_single");

$sidebar = is_active_sidebar( 'shop-single-sidebar' );
$product_layout = wixi_settings( 'single_shop_layout', 'full-width' );
$column = 'full-width' != $product_layout && $sidebar ? 'col-lg-8 shop-has-sidebar' : 'col-lg-10';
?>

<!-- WooCommerce product page container -->
<div id="nt-woo-single" class="nt-woo-single ">

    <!-- Hero section - this function using on all inner pages -->
    <?php wixi_woo_hero_section(); ?>

    <div class="nt-theme-inner-container section-padding">
        <div class="container">
            <div class="row justify-content-center">

                <!-- Left sidebar -->
                <?php 
                if ( 'left-sidebar' == $product_layout && $sidebar ) {
                    echo '<div class="col-lg-4">';
                        dynamic_sidebar( 'shop-single-sidebar' );
                    echo '</div>';
                }
                ?>

                <div class="<?php echo esc_attr( $column ); ?>">
                    <div class="content-container">
                    
                        <?php woocommerce_content(); ?>
                        
                    </div>
                </div>
                <!-- End sidebar + content -->

                    <!-- Right sidebar -->
                    <?php 
                    if ( 'right-sidebar' == $product_layout && $sidebar ) {
                        echo '<div class="col-lg-4">';
                            dynamic_sidebar( 'shop-single-sidebar' );
                        echo '</div>';
                    }
                    ?>

                </div><!-- End row -->
            </div><!-- End #container -->
        </div><!-- End #blog -->
    </div><!-- End woo shop page general div -->

<?php

do_action("wixi_after_woo_single");

get_footer();

?>
