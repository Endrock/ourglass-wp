<?php

// Creating the widget
class Wixi_Add_Gallery_Metabox {
    /**
    * A reference to an instance of this class.
    */
    private static $instance;
    /**
    * The array of templates that this plugin tracks.
    */
    protected $templates;
    /**
    * Returns an instance of this class.
    */
    public static function get_instance() {
        if ( null == self::$instance ) {
            self::$instance = new Wixi_Add_Gallery_Metabox();
        }
        return self::$instance;
    }

    // class constructor
    public function __construct()
    {
        add_action('admin_enqueue_scripts', [ $this, 'wixi_addons_admin_scripts' ]);
        add_action('admin_menu', [ $this, 'wixi_meta_box_add' ]);
        add_action('save_post', [ $this, 'wixi_gallery_metabox_save' ]);

    }

    public function wixi_addons_admin_scripts()
    {
        wp_enqueue_script('jquery-ui-core');
        wp_enqueue_script('jquery-ui-widget');
        wp_enqueue_script('jquery-ui-sortable');
        if ( ! did_action( 'wp_enqueue_media' ) ){
            wp_enqueue_media();
        }
    }
    // add metabox
    public function wixi_meta_box_add()
    {
        add_meta_box( 'gallery_settings', // meta box ID
            esc_html__('More Settings', 'wixi'), // meta box title
            [ $this, 'wixi_print_box' ], // callback function that prints the meta box HTML
            'post', // post type where to add it
            'normal', // priority
            'high' // position
        );
    }

    // save metabox
    public function wixi_gallery_metabox_save( $post_id )
    {

        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
            return $post_id;
        }
        if ( isset( $_POST['wixi_post_gallery'] ) ) {
            update_post_meta( $post_id, 'wixi_post_gallery', $_POST['wixi_post_gallery'] );
        } else {
            delete_post_meta( $post_id, 'wixi_post_gallery' );
        }
    }

    // print metabox
    public function wixi_print_box( $post )
    {
        $meta_key = 'wixi_post_gallery';
        echo $this->wixi_gallery_field( $meta_key, get_post_meta($post->ID, $meta_key, true) );
    }

    // metabox admin field
    public function wixi_gallery_field( $name, $value = '' )
    {
        $html = '<div><ul class="wixi_gallery_mtb">';
        /* array with image IDs for hidden field */
        $hidden = array();
        $images = get_posts(
            array(
                'post_type' => 'attachment',
                'orderby' => 'post__in', /* we have to save the order */
                'order' => 'ASC',
                'post__in' => explode(',',$value), /* $value is the image IDs comma separated */
                'numberposts' => -1,
                'post_mime_type' => 'image'
            )
        );

        if( $images ) {
            foreach( $images as $image ) {
                $hidden[] = $image->ID;
                $image_src = wp_get_attachment_image_src( $image->ID, array( 80, 80 ) );
                $html .= '<li data-id="'.esc_attr($image->ID).'"><span style="background-image:url('.esc_url($image_src[0]).')"></span><a href="#" class="wixi_gallery_remove">×</a></li>';
            }
        }
        $html .= '</ul><div style="clear:both"></div></div>';
        $html .= '<input type="hidden" name="'.esc_attr($name).'" value="'.implode(',',$hidden).'" /><a href="#" class="button wixi_upload_gallery_button">'.esc_html__('Add Images', 'wixi').'</a>';
        return $html;
    }
}
Wixi_Add_Gallery_Metabox::get_instance();
