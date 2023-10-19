<?php
/**
* Wixi Admin Page Template
*/


?>

    <div class="wixi-admin-wrapper">
        <div class="container">
            <div class="page-heading">
                <h1 class="page-title"><?php _e( 'Wixi Addons', 'wixi' ); ?></h1>
                <p class="page-description">
                    <?php _e( 'Premium & Advanced Essential Elements for Elementor', 'wixi' ); ?>
                </p>
            </div>
            <form class="wixi-form" method="post">

                <nav>
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-widget-tab" data-toggle="tab" href="#nav-widget" role="tab" aria-controls="nav-widget" aria-selected="false"><?php _e( 'Widgets', 'wixi' ); ?></a>
                        <a class="nav-item nav-link" id="nav-map-tab" data-toggle="tab" href="#nav-map" role="tab" aria-controls="nav-map" aria-selected="true"><?php _e( 'Map', 'wixi' ); ?></a>
                        <a class="nav-item nav-link" id="nav-general-tab" data-toggle="tab" href="#nav-short" role="tab" aria-controls="nav-short" aria-selected="true"><?php _e( 'Shortcodes', 'wixi' ); ?></a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">

                    <div class="tab-pane fade show active" id="nav-widget" role="tabpanel" aria-labelledby="nav-widget-tab">
                        <div class="row widget-row">
                            <?php

                            $list = array(
                                'header-menu',
                                'header-menu-two',
                                'mega-menu',
                                'shape-overlays-menu',
                                'page-hero',
                                'breadcrumbs',
                                'home-slider',
                                'vegas-slider',
                                'vegas-template',
                                'services-item',
                                'projects-slider',
                                'projects-gallery',
                                'justified-gallery',
                                'popup-video',
                                'testimonials-slider',
                                'testimonials-two',
                                'button',
                                'button2',
                                'animated-headline',
                                'blog-grid-two',
                                'brands-board',
                                'team-member',
                                'contact-form-7',
                                'google-map',
                                'onepage',
                                'odometer',
                                'advanced-pricing',
                                'svg-animation',
                                'flip-card',
                                'crossroads-slideshow',
                                'page-flip-layout',
                                'interactive-slider',
                                'block-revealers',
                                'two-block-slider',
                                'svg-pattern',
                                'caption-hover-effects',
                                'image-before-after',
                                'animated-text-background',
                                'post-types-list',
                                'blog-grid',
                                'blog-masonry',
                                'blog-slider2',
                                'circle-progressbar'
                            );

                            foreach ( $list as $widget ) {

                                $option = 'disable_'.str_replace( '-', '_', $widget );
                                $name = mb_strtoupper( str_replace( '-', ' ', $widget ) );

                                add_option( $option, 0 );
                                if ( isset( $_POST[ $option ] ) ) {
                                    update_option( $option, $_POST[ $option ] );
                                }

                                 ?>

                                <div class="col-md-4">
                                    <div class="widget-toggle">
                                        <div class="custom-control custom-switch">
                                            <input type="hidden" name="<?php echo esc_attr( $option ); ?>" value="1">
                                            <input type="checkbox" class="custom-control-input" id="<?php echo esc_attr( $option ); ?>" name="<?php echo esc_attr( $option ); ?>" value="0" <?php checked( 0, get_option( $option ), true ); ?>>
                                            <label class="custom-control-label" for="<?php echo esc_attr( $option ); ?>"><?php echo esc_html( $name ); ?></label>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="nav-map" role="tabpanel" aria-labelledby="nav-map-tab">

                        <div class="row widget-row">
                            <div class="col-lg-6">
                                <div class="widget-toggle">
                                    <?php
                                    add_option( 'wixi_map_api' );
                                    if ( isset( $_POST['wixi_map_api'] ) ) {
                                        $api = sanitize_text_field( $_POST['wixi_map_api'] );
                                        update_option( 'wixi_map_api', $api );
                                    }
                                    ?>
                                    <div class="custom-controll">
                                        <label class="custom-control-labell" for="wixi_map_api"><?php _e( 'Map Api Key', 'wixi' ); ?></label>
                                        <input type="text" id="wixi_map_lat" name="wixi_map_api" value="<?php echo esc_attr( get_option( 'wixi_map_api' )); ?>" placeholder="Api Key">
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="widget-toggle">
                                    <?php
                                    add_option( 'wixi_map_lat' );
                                    if ( isset( $_POST['wixi_map_lat'] ) ) {
                                        $lat = sanitize_text_field( $_POST['wixi_map_lat'] );
                                        update_option( 'wixi_map_lat', $lat );
                                    }
                                    ?>
                                    <div class="custom-controll">
                                        <label class="custom-control-labell" for="wixi_map_lat"><?php _e( 'Lat Cordinate', 'wixi' ); ?></label>
                                        <input type="hidden" name="wixi_map_lat" value="">
                                        <input type="text" id="wixi_map_lat" name="wixi_map_lat" value="<?php echo esc_attr( get_option( 'wixi_map_lat' )); ?>" placeholder="<?php _e( 'Enter latitude', 'wixi' ); ?>">

                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="widget-toggle">
                                    <?php
                                    add_option( 'wixi_map_lng' );
                                    if ( isset( $_POST['wixi_map_lng'] ) ) {
                                        $lng = sanitize_text_field( $_POST['wixi_map_lng'] );
                                        update_option( 'wixi_map_lng', $lng );
                                    }
                                    ?>
                                    <div class="custom-controll">
                                        <label class="custom-control-labell" for="wixi_map_lng"><?php _e( 'Lng Cordinate', 'wixi' ); ?></label>
                                        <input type="hidden" name="wixi_map_lng" value="">
                                        <input type="text" id="wixi_map_lng" name="wixi_map_lng" value="<?php echo esc_attr( get_option( 'wixi_map_lng' )); ?>" placeholder="<?php _e( 'Enter longitude', 'wixi' ); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="nav-short" role="tabpanel" aria-labelledby="nav-short-tab">
                        <div class="row widget-row">
                            <div class="col-md-4">
                                <div class="widget-toggle">
                                    <?php
                                    add_option( 'disable_wixi_list_shortcodes', 0 );
                                    if ( isset( $_POST['disable_wixi_list_shortcodes'] ) ) {
                                        update_option( 'disable_wixi_list_shortcodes', $_POST['disable_wixi_list_shortcodes'] );
                                    }
                                    ?>
                                    <div class="custom-control custom-switch">
                                        <input type="hidden" name="disable_wixi_list_shortcodes" value="1">
                                        <input type="checkbox" class="custom-control-input" id="disable_wixi_list_shortcodes" name="disable_wixi_list_shortcodes" value="0" <?php checked( 0, get_option( 'disable_wixi_list_shortcodes' ), true ); ?>>
                                        <label class="custom-control-label" for="disable_wixi_list_shortcodes"><?php _e( 'Shortcode Creator', 'wixi' ); ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="page-actions">
                    <div class="row">
                        <div class="col-sm-12 submit-container">
                            <?php wp_nonce_field( 'wixi_admin_nonce_field' ); ?>
                            <button type="submit" class="btn btn-primary"><?php _e( 'Save Settings', 'wixi' ); ?></button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
