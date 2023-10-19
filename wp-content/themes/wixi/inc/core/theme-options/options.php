<?php

    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if (! class_exists('Redux' )) {
        return;
    }

    // This is your option name where all the Redux data is stored.
    $wixi_pre = "wixi";

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $wixi_theme = wp_get_theme(); // For use with some settings. Not necessary.

    $wixi_options_args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name' => $wixi_pre,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name' => $wixi_theme->get('Name' ),
        // Name that appears at the top of your panel
        'display_version' => $wixi_theme->get('Version' ),
        // Version that appears at the top of your panel
        'menu_type' => 'submenu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu' => false,
        // Show the sections below the admin menu item or not
        'menu_title' => esc_html__( 'Theme Options', 'wixi' ),
        'page_title' => esc_html__( 'Theme Options', 'wixi' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key' => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography' => false,
        // Use a asynchronous font on the front end or font string
        'admin_bar' => false,
        // Show the panel pages on the admin bar
        'admin_bar_icon' => 'dashicons-admin-generic',
        // Choose an icon for the admin bar menu
        'admin_bar_priority' => 50,
        // Choose an priority for the admin bar menu
        'global_variable' => 'wixi',
        // Set a different name for your global variable other than the wixi_pre
        'dev_mode' => false,
        // Show the time the page took to load, etc
        'update_notice' => false,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer' => true,
        // Enable basic customizer support

        // OPTIONAL -> Give you extra features
        'page_priority' => 99,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent' => apply_filters( 'ninetheme_parent_slug', 'themes.php' ),
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions' => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon' => '',
        // Specify a custom URL to an icon
        'last_tab' => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon' => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug' => '',
        // Page slug used to denote the panel, will be based off page title then menu title then wixi_pre if not provided
        'save_defaults' => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show' => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark' => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export' => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time' => 60 * MINUTE_IN_SECONDS,
        'output' => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag' => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database' => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'use_cdn' => true,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

        // HINTS
        'hints' => array(
            'icon' => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color' => 'lightgray',
            'icon_size' => 'normal',
            'tip_style' => array(
                'color' => 'dark',
                'shadow' => true,
                'rounded' => false,
                'style' => '',
            ),
            'tip_position' => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect' => array(
                'show' => array(
                    'effect' => 'slide',
                    'duration' => '500',
                    'event' => 'mouseover',
                ),
                'hide' => array(
                    'effect' => 'slide',
                    'duration' => '500',
                    'event' => 'click mouseleave',
                ),
            ),
        )
    );

    // ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
    $wixi_options_args['admin_bar_links'][] = array(
        'id' => 'ninetheme-wixi-docs',
        'href' => 'https://ninetheme.com/support/',
        'title' => esc_html__( 'wixi Documentation', 'wixi' ),
    );
    $wixi_options_args['admin_bar_links'][] = array(
        'id' => 'ninetheme-support',
        'href' => 'https://9theme.ticksy.com/',
        'title' => esc_html__( 'Support', 'wixi' ),
    );
    $wixi_options_args['admin_bar_links'][] = array(
        'id' => 'ninetheme-portfolio',
        'href' => 'https://themeforest.net/user/ninetheme/portfolio',
        'title' => esc_html__( 'NineTheme Portfolio', 'wixi' ),
    );

    // Add content after the form.
    $wixi_options_args['footer_text'] = esc_html__( 'If you need help please read docs and open a ticket on our support center.', 'wixi' );

    Redux::setArgs($wixi_pre, $wixi_options_args);

    /* END ARGUMENTS */

    /* START SECTIONS */


    /*************************************************
    ## MAIN SETTING SECTION
    *************************************************/
    Redux::setSection($wixi_pre, array(
        'title' => esc_html__( 'Main Setting', 'wixi' ),
        'id' => 'basic',
        'desc' => esc_html__( 'These are main settings for general theme!', 'wixi' ),
        'customizer_width' => '400px',
        'icon' => 'el el-cog',
    ));
    //BREADCRUMBS SETTINGS SUBSECTION
    Redux::setSection($wixi_pre, array(
        'title' => esc_html__( 'Theme Color', 'wixi' ),
        'id' => 'themebreadcrumbssubsection',
        'icon' => 'el el-brush',
        'subsection' => true,
        'customizer_width' => '450px',
        'fields' => array(
            array(
                'title' => esc_html__( 'Theme Skin Type', 'wixi' ),
                'id' => 'theme_skin',
                'type' => 'select',
                'customizer' => true,
                'options' => array(
                    'dark' => esc_html__( 'Dark', 'wixi' ),
                    'light' => esc_html__( 'Light', 'wixi' ),
                ),
                'default' => 'dark',
            ),
            array(
                'title' => esc_html__( 'Theme Main Color', 'wixi' ),
                'subtitle' => esc_html__( 'Add theme main color.', 'wixi' ),
                'id' => 'theme_main_clr',
                'type' => 'color',
                'default' => ''
            ),
            array(
                'title' => esc_html__( 'Theme Dark Button Main Color', 'wixi' ),
                'subtitle' => esc_html__( 'Add theme main color for the dark style button.', 'wixi' ),
                'id' => 'theme_main_dark_btnclr',
                'type' => 'color',
                'default' => ''
            ),
            array(
                'title' => esc_html__( 'Theme Light Button Main Color', 'wixi' ),
                'subtitle' => esc_html__( 'Add theme main color for the light style button.', 'wixi' ),
                'id' => 'theme_main_light_btnclr',
                'type' => 'color',
                'default' => ''
            ),
        )
    ));
    //BREADCRUMBS SETTINGS SUBSECTION
    Redux::setSection($wixi_pre, array(
        'title' => esc_html__( 'Breadcrumbs', 'wixi' ),
        'id' => 'thememaincolorsubsection',
        'icon' => 'el el-brush',
        'subsection' => true,
        'customizer_width' => '450px',
        'fields' => array(
            array(
                'title' => esc_html__( 'Breadcrumbs', 'wixi' ),
                'subtitle' => esc_html__( 'If enabled, adds breadcrumbs navigation to bottom of page title.', 'wixi' ),
                'id' => 'breadcrumbs_visibility',
                'type' => 'switch',
                'default' => true
            ),
            array(
                'title' => esc_html__( 'Breadcrumbs Typography', 'wixi' ),
                'id' => 'breadcrumbs_typo',
                'type' => 'typography',
                'font-backup' => false,
                'letter-spacing' => true,
                'text-transform' => true,
                'all_styles' => true,
                'output' => array( '.nt-breadcrumbs, .nt-breadcrumbs .nt-breadcrumbs-list' ),

                'required' => array( 'breadcrumbs_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Breadcrumbs Current Color', 'wixi' ),
                'id' => 'breadcrumbs_current',
                'type' => 'color',
                'default' => '#fff',
                'output' => array( '.nt-breadcrumbs .nt-breadcrumbs-list li.active' ),
                'required' => array( 'breadcrumbs_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Breadcrumbs Icon Color', 'wixi' ),
                'id' => 'breadcrumbs_icon',
                'type' => 'color',
                'default' => '#fff',
                'output' => array( '.nt-breadcrumbs .nt-breadcrumbs-list i' ),
                'required' => array( 'breadcrumbs_visibility', '=', '1' )
            )
        )
    ));
    //PRELOADER SETTINGS SUBSECTION
    Redux::setSection($wixi_pre, array(
        'title' => esc_html__( 'Preloader', 'wixi' ),
        'id' => 'themepreloadersubsection',
        'icon' => 'el el-brush',
        'subsection' => true,
        'fields' => array(
            array(
                'title' => esc_html__( 'Preloader', 'wixi' ),
                'subtitle' => esc_html__( 'If enabled, adds preloader.', 'wixi' ),
                'id' => 'preloader_visibility',
                'type' => 'switch',
                'default' => true
            ),
            array(
                'title' => esc_html__( 'Preloader Type', 'wixi' ),
                'subtitle' => esc_html__( 'Select your preloader type.', 'wixi' ),
                'id' => 'pre_type',
                'type' => 'select',
                'customizer' => true,
                'options' => array(
                    'default' => esc_html__( 'Default', 'wixi' ),
                    '01' => esc_html__( 'Type 1', 'wixi' ),
                    '02' => esc_html__( 'Type 2', 'wixi' ),
                    '03' => esc_html__( 'Type 3', 'wixi' ),
                    '04' => esc_html__( 'Type 4', 'wixi' ),
                    '05' => esc_html__( 'Type 5', 'wixi' ),
                    '06' => esc_html__( 'Type 6', 'wixi' ),
                    '07' => esc_html__( 'Type 7', 'wixi' ),
                    '08' => esc_html__( 'Type 8', 'wixi' ),
                    '09' => esc_html__( 'Type 9', 'wixi' ),
                    '10' => esc_html__( 'Type 10', 'wixi' ),
                    '11' => esc_html__( 'Type 11', 'wixi' ),
                    '12' => esc_html__( 'Type 12', 'wixi' ),
                ),
                'default' => 'default',
            ),
            array(
                'title' => esc_html__( 'Preloader Text', 'wixi' ),
                'subtitle' => esc_html__( 'Add preloader text here.', 'wixi' ),
                'id' => 'preloader_text',
                'type' => 'text',
                'default' => 'Loading',
                'required' => array(
                    array( 'preloader_visibility', '=', '1' ),
                    array( 'pre_type', '=', 'default' )
                )
            ),
            array(
                'title' => esc_html__( 'Preloader Text Color', 'wixi' ),
                'subtitle' => esc_html__( 'Add preloader text color.', 'wixi' ),
                'id' => 'pre_text_clr',
                'type' => 'color',
                'default' => '#000',
                'output' => array( '.loading-text' ),
                'required' => array(
                    array( 'preloader_visibility', '=', '1' ),
                    array( 'pre_type', '=', 'default' )
                )
            ),
            array(
                'title' => esc_html__( 'Preloader Background Color', 'wixi' ),
                'subtitle' => esc_html__( 'Add preloader background color.', 'wixi' ),
                'id' => 'pre_bg',
                'type' => 'color',
                'default' => '#f1f1f1',
                'required' => array(
                    array( 'preloader_visibility', '=', '1' )
                ),
            ),
            array(
                'title' => esc_html__( 'Preloader Spin Color', 'wixi' ),
                'subtitle' => esc_html__( 'Add preloader spin color.', 'wixi' ),
                'id' => 'pre_spin',
                'type' => 'color',
                'default' => '#000',
                'required' => array( 'preloader_visibility', '=', '1' )
            )
    )));
    //PRELOADER SETTINGS SUBSECTION
    Redux::setSection($wixi_pre, array(
        'title' => esc_html__( 'Cursor', 'wixi' ),
        'id' => 'themecursorsubsection',
        'icon' => 'el el-brush',
        'subsection' => true,
        'fields' => array(
            array(
                'title' => esc_html__( 'Theme Cursor Type', 'wixi' ),
                'subtitle' => esc_html__( 'Select your cursor type.', 'wixi' ),
                'id' => 'theme_cursor',
                'type' => 'select',
                'customizer' => true,
                'options' => array(
                    'none' => esc_html__( 'None', 'wixi' ),
                    '1' => esc_html__( 'Type 1', 'wixi' ),
                    '2' => esc_html__( 'Type 2', 'wixi' ),
                    '3' => esc_html__( 'Type 3', 'wixi' ),
                    '4' => esc_html__( 'Custom Image', 'wixi' ),
                ),
                'default' => '3',
            ),
            array(
                'title' => esc_html__( 'Custom Cursor Image', 'wixi' ),
                'subtitle' => esc_html__( 'Upload your custom cursor. If left blank theme will use site default cursor.', 'wixi' ),
                'id' => 'theme_custom_cursor',
                'type' => 'media',
                'url' => true,
                'customizer' => true,
                'required' => array( 'theme_cursor', '=', '4' )
            ),
            array(
                'title' => esc_html__( 'Custom Cursor Image Size', 'wixi' ),
                'id' => 'cursor4_width',
                'type' => 'dimensions',
                'output' => array('.cursor4 img'),
                'units' => array('px'),
                'all' => false,
                'width' => true,
                'height' => false,
                'default' => array(
                    'width' => '100',
                    'width' => '100',
                    'units' => 'px'
                ),
                'required' => array( 'theme_cursor', '=', '4' )
            ),
            //
            array(
                'title' => esc_html__( 'Cursor Color', 'wixi' ),
                'id' => 'cursor1_clr',
                'type' => 'color_rgba',
                'mode' => 'background-color',
                'options'=> array(
                    'show_input' => true,
                    'show_initial' => true,
                    'show_alpha' => true,
                    'show_palette' => true,
                    'show_palette_only' => false,
                    'show_selection_palette' => true,
                    'max_palette_size' => 10,
                    'allow_empty' => true,
                    'clickout_fires_change' => false,
                    'choose_text' => 'Choose',
                    'cancel_text' => 'Cancel',
                    'show_buttons' => true,
                    'use_extended_classes' => true,
                    'palette' => null,
                ),
                'output' => array( '.cursor1::after, .cursor-inner, .cursor-inner.cursor-hover' ),
                'required' => array(
                    array( 'theme_cursor', '!=', 'none' ),
                    array( 'theme_cursor', '!=', '2' ),
                )
            ),
            array(
                'title' => esc_html__( 'Cursor Width', 'wixi' ),
                'id' => 'cursor1_width',
                'type' => 'dimensions',
                'output' => array('.cursor1'),
                'units' => array('px'),
                'all' => false,
                'width' => true,
                'height' => false,
                'default' => array(
                    'width' => '15',
                    'units' => 'px'
                ),
                'required' => array( 'theme_cursor', '=', '1' )
            ),
            //
            array(
                'title' => esc_html__( 'Cursor Border Color', 'wixi' ),
                'id' => 'cursor3_brdclr',
                'type' => 'color',
                'mode' => 'border-color',
                'default' => '#555555',
                'output' => array( '.cursor-outer,.cursor2::after' ),
                'required' => array(
                    array( 'theme_cursor', '!=', 'none' ),
                    array( 'theme_cursor', '!=', '1' ),
                )
            ),
            array(
                'title' => esc_html__( 'Hide Cursor Arrow', 'wixi' ),
                'desc' => esc_html__( 'Hide or show arrow', 'wixi' ),
                'id' => 'arrow_visibility',
                'type' => 'switch',
                'required' => array( 'theme_cursor', '=', '1' ),
                'default' => true
            ),
            array(
                'title' => esc_html__( 'Cursor Border Width', 'wixi' ),
                'id' => 'cursor3_brd_width',
                'type' => 'dimensions',
                'output' => array('.cursor-outer'),
                'units' => array('px'),
                'all' => false,
                'height' => false,
                'mode' => 'border-width',
                'default' => array(
                    'width' => '1',
                    'units' => 'px'
                ),
                'required' => array( 'theme_cursor', '=', '3' )
            )
        )
    ));
    //MAIN THEME TYPOGRAPHY SUBSECTION
    Redux::setSection($wixi_pre, array(
    'title' => esc_html__( 'Typograhy General', 'wixi' ),
    'id' => 'themetypographysection',
    'icon' => 'el el-fontsize',
    'subsection' => true,
    'fields' => array(
        array(
            'title' => esc_html__( 'Use Elementor Style Kit', 'wixi' ),
            'subtitle' => esc_html__( 'This option applies styles created with Elementor to pages not created with Elementor.', 'wixi' ),
            'id' => 'use_elementor_style_kit',
            'type' => 'switch',
            'default' => false
        ),
        array(
            'title' => esc_html__( 'H1 Headings', 'wixi' ),
            'subtitle' => esc_html__("Choose Size and Style for h1", 'wixi' ),
            'id' => 'font_h1',
            'type' => 'typography',
            'font-backup' => false,
            'letter-spacing' => true,
            'text-transform' => true,
            'all_styles' => true,
            'output' => array( 'h1' ),
            'default' => array(
                'color' => '',
                'font-style' => '',
                'font-family' => '',
                'google' => true,
                'font-size' => '',
                'line-height' => ''
            ),
            'required' => array( 'use_elementor_style_kit', '!=', '1' )
        ),
        array(
            'title' => esc_html__( 'H2 Headings', 'wixi' ),
            'subtitle' => esc_html__("Choose Size and Style for h2", 'wixi' ),
            'id' => 'font_h2',
            'type' => 'typography',
            'font-backup' => false,
            'letter-spacing' => true,
            'text-transform' => true,
            'all_styles' => true,
            'output' => array( 'h2' ),
            'default' => array(
                'color' => '',
                'font-style' => '',
                'font-family' => '',
                'google' => true,
                'font-size' => '',
                'line-height' => ''
            ),
            'required' => array( 'use_elementor_style_kit', '!=', '1' )
        ),
        array(
            'title' => esc_html__( 'H3 Headings', 'wixi' ),
            'subtitle' => esc_html__("Choose Size and Style for h3", 'wixi' ),
            'id' => 'font_h3',
            'type' => 'typography',
            'font-backup' => false,
            'letter-spacing' => true,
            'text-transform' => true,
            'all_styles' => true,
            'output' => array( 'h3' ),
            'default' => array(
                'color' => '',
                'font-style' => '',
                'font-family' => '',
                'google' => true,
                'font-size' => '',
                'line-height' => ''
            ),
            'required' => array( 'use_elementor_style_kit', '!=', '1' )
        ),
        array(
            'title' => esc_html__( 'H4 Headings', 'wixi' ),
            'subtitle' => esc_html__("Choose Size and Style for h4", 'wixi' ),
            'id' => 'font_h4',
            'type' => 'typography',
            'font-backup' => false,
            'letter-spacing' => true,
            'text-transform' => true,
            'all_styles' => true,
            'output' => array( 'h4' ),
            'default' => array(
                'color' => '',
                'font-style' => '',
                'font-family' => '',
                'google' => true,
                'font-size' => '',
                'line-height' => ''
            ),
            'required' => array( 'use_elementor_style_kit', '!=', '1' )
        ),
        array(
            'title' => esc_html__( 'H5 Headings', 'wixi' ),
            'subtitle' => esc_html__("Choose Size and Style for h5", 'wixi' ),
            'id' => 'font_h5',
            'type' => 'typography',
            'font-backup' => false,
            'letter-spacing' => true,
            'text-transform' => true,
            'all_styles' => true,
            'output' => array( 'h5' ),
            'default' => array(
                'color' => '',
                'font-style' => '',
                'font-family' => '',
                'google' => true,
                'font-size' => '',
                'line-height' => ''
            ),
            'required' => array( 'use_elementor_style_kit', '!=', '1' )
        ),
        array(
            'title' => esc_html__( 'H6 Headings', 'wixi' ),
            'subtitle' => esc_html__("Choose Size and Style for h6", 'wixi' ),
            'id' => 'font_h6',
            'type' => 'typography',
            'font-backup' => false,
            'letter-spacing' => true,
            'text-transform' => true,
            'all_styles' => true,
            'output' => array( 'h6' ),
            'units' => 'px',
            'default' => array(
                'color' => '',
                'font-style' => '',
                'font-family' => '',
                'google' => true,
                'font-size' => '',
                'line-height' => ''
            ),
            'required' => array( 'use_elementor_style_kit', '!=', '1' )
        ),
        array(
            'id' =>'info_body_font',
            'type' => 'info',
            'customizer' => false,
            'desc' => esc_html__( 'Body Font Options', 'wixi' )
        ),
        array(
            'title' => esc_html__( 'Body', 'wixi' ),
            'subtitle' => esc_html__("Choose Size and Style for Body", 'wixi' ),
            'id' => 'font_body',
            'type' => 'typography',
            'font-backup' => false,
            'letter-spacing' => true,
            'text-transform' => true,
            'all_styles' => true,
            'output' => array( 'body' ),
            'default' => array(
                'font-family' =>'',
                'color' =>"",
                'font-style' =>'',
                'font-size' =>'',
                'line-height' =>''
            ),
            'required' => array( 'use_elementor_style_kit', '!=', '1' )
        ),
        array(
            'title' => esc_html__( 'Paragraph', 'wixi' ),
            'subtitle' => esc_html__("Choose Size and Style for paragraph", 'wixi' ),
            'id' => 'font_p',
            'type' => 'typography',
            'font-backup' => false,
            'letter-spacing' => true,
            'text-transform' => true,
            'all_styles' => true,
            'output' => array( 'p, body.has-paragraph-style p' ),
            'default' => array(
                'font-family' =>'',
                'color' =>"",
                'font-style' =>'',
                'font-size' =>'',
                'line-height' =>''
            ),
            'required' => array( 'use_elementor_style_kit', '!=', '1' )
        ),
        array(
            'title' => esc_html__( 'Make paragraph settings priority', 'wixi' ),
            'subtitle' => esc_html__( 'Use this option if you want these settings to take priority for the paragraph', 'wixi' ),
            'id' => 'font_p_important',
            'type' => 'switch',
            'default' => false,
            'required' => array( 'use_elementor_style_kit', '!=', '1' )
        ),
    )));
    //BACKTOTOP BUTTON SUBSECTION
    Redux::setSection($wixi_pre, array(
    'title' => esc_html__( 'Back-to-top Button', 'wixi' ),
    'id' => 'backtotop',
    'icon' => 'el el-brush',
    'subsection' => true,
    'fields' => array(
        array(
            'title' => esc_html__( 'Back-to-top', 'wixi' ),
            'subtitle' => esc_html__( 'Switch On-off', 'wixi' ),
            'desc' => esc_html__( 'If enabled, adds back to top.', 'wixi' ),
            'id' => 'backtotop_visibility',
            'type' => 'switch',
            'default' => true
        ),
        array(
            'title' => esc_html__( 'Bottom Offset', 'wixi' ),
            'subtitle' => esc_html__( 'Set custom bottom offset for the back-to-top button', 'wixi' ),
            'id' => 'backtotop_top_offset',
            'type' => 'spacing',
            'output' => array('.backtotop-wrap'),
            'mode' => 'absolute',
            'units' => array('px'),
            'all' => false,
            'top' => false,
            'right' => true,
            'bottom' => true,
            'left' => false,
            'default' => array(
                'right' => '30',
                'bottom' => '30',
                'units' => 'px'
            ),
            'required' => array( 'backtotop_visibility', '=', '1' )
        ),
        array(
            'title' => esc_html__( 'Back-to-top Progress Wrap Color', 'wixi' ),
            'id' => 'backtotop_bg1',
            'type' => 'color_rgba',
            'default'   => array(
                'color' => '#828282',
                'alpha' => 0.2
            ),
            'options'=> array(
                'show_input' => true,
                'show_initial' => true,
                'show_alpha' => true,
                'show_palette' => true,
                'show_palette_only' => false,
                'show_selection_palette' => true,
                'max_palette_size' => 10,
                'allow_empty' => true,
                'clickout_fires_change' => false,
                'choose_text' => 'Choose',
                'cancel_text' => 'Cancel',
                'show_buttons' => true,
                'use_extended_classes' => true,
                'palette' => null,
            ),
            'required' => array( 'backtotop_visibility', '=', '1' )
        ),
        array(
            'title' => esc_html__( 'Back-to-top Progress Color', 'wixi' ),
            'id' => 'backtotop_bg',
            'type' => 'color',
            'default' =>  '#6c6d6d',
            'required' => array( 'backtotop_visibility', '=', '1' )
        ),
        array(
            'title' => esc_html__( 'Back-to-top Arrow Color', 'wixi' ),
            'id' => 'backtotop_arrow',
            'type' => 'color',
            'default' =>  '#6c6d6d',
            'required' => array( 'backtotop_visibility', '=', '1' )
        )
    )));

    // THEME PAGINATION SUBSECTION
    Redux::setSection($wixi_pre, array(
    'title' => esc_html__( 'Pagination', 'wixi' ),
    'desc' => esc_html__( 'These are main settings for general theme!', 'wixi' ),
    'id' => 'pagination',
    'subsection' => true,
    'icon' => 'el el-link',
    'fields' => array(
        array(
            'title' => esc_html__( 'Pagination', 'wixi' ),
            'subtitle' => esc_html__( 'Switch On-off', 'wixi' ),
            'desc' => esc_html__( 'If enabled, adds pagination.', 'wixi' ),
            'id' => 'pagination_visibility',
            'type' => 'switch',
            'default' => true
        ),
        array(
            'title' => esc_html__( 'Pagination Type', 'wixi' ),
            'subtitle' => esc_html__( 'Select type.', 'wixi' ),
            'id' => 'pag_type',
            'type' => 'select',
            'customizer' => true,
            'options' => array(
                'default' => esc_html__( 'Default', 'wixi' ),
                'outline' => esc_html__( 'Outline', 'wixi' )
            ),
            'default' => 'default',
            'required' => array( 'pagination_visibility', '=', '1' )
        ),
        array(
            'title' => esc_html__( 'Pagination size', 'wixi' ),
            'subtitle' => esc_html__( 'Select size.', 'wixi' ),
            'id' => 'pag_size',
            'type' => 'select',
            'customizer' => true,
            'options' => array(
                'small' => esc_html__( 'small', 'wixi' ),
                'medium' => esc_html__( 'medium', 'wixi' ),
                'large' => esc_html__( 'large', 'wixi' )
            ),
            'default' => 'medium',
            'required' => array( 'pagination_visibility', '=', '1' )
        ),
        array(
            'title' => esc_html__( 'Pagination group', 'wixi' ),
            'subtitle' => esc_html__( 'Select group.', 'wixi' ),
            'id' => 'pag_group',
            'type' => 'select',
            'customizer' => true,
            'options' => array(
                'yes' => esc_html__( 'Yes', 'wixi' ),
                'no' => esc_html__( 'No', 'wixi' )
            ),
            'default' => 'no',
            'required' => array( 'pagination_visibility', '=', '1' )
        ),
        array(
            'title' => esc_html__( 'Pagination corner', 'wixi' ),
            'subtitle' => esc_html__( 'Select corner type.', 'wixi' ),
            'id' => 'pag_corner',
            'type' => 'select',
            'customizer' => true,
            'options' => array(
                'square' => esc_html__( 'square', 'wixi' ),
                'rounded' => esc_html__( 'rounded', 'wixi' ),
                'circle' => esc_html__( 'circle', 'wixi' )
            ),
            'default' => 'square',
            'required' => array( 'pagination_visibility', '=', '1' )
        ),
        array(
            'title' => esc_html__( 'Pagination align', 'wixi' ),
            'subtitle' => esc_html__( 'Select align.', 'wixi' ),
            'id' => 'pag_align',
            'type' => 'select',
            'customizer' => true,
            'options' => array(
                'left' => esc_html__( 'left', 'wixi' ),
                'right' => esc_html__( 'right', 'wixi' ),
                'center' => esc_html__( 'center', 'wixi' )
            ),
            'default' => 'center',
            'required' => array( 'pagination_visibility', '=', '1' )
        ),
        array(
            'title' => esc_html__( 'Pagination default/outline color', 'wixi' ),
            'id' => 'pag_clr',
            'type' => 'color',
            'mode' => 'color',
            'required' => array( 'pagination_visibility', '=', '1' )
        ),
        array(
            'title' => esc_html__( 'Active and Hover pagination color', 'wixi' ),
            'id' => 'pag_hvrclr',
            'type' => 'color',
            'mode' => 'color',
            'required' => array( 'pagination_visibility', '=', '1' )
        ),
        array(
            'title' => esc_html__( 'Pagination number color', 'wixi' ),
            'id' => 'pag_nclr',
            'type' => 'color',
            'mode' => 'color',
            'required' => array( 'pagination_visibility', '=', '1' )
        ),
        array(
            'title' => esc_html__( 'Active and Hover pagination number color', 'wixi' ),
            'id' => 'pag_hvrnclr',
            'type' => 'color',
            'mode' => 'color',
            'required' => array( 'pagination_visibility', '=', '1' )
        )
    )));
    //BREADCRUMBS SETTINGS SUBSECTION
    Redux::setSection($wixi_pre, array(
        'title' => esc_html__( 'Split Text Animation', 'wixi' ),
        'id' => 'themeanimationsubsection',
        'icon' => 'el el-brush',
        'subsection' => true,
        'customizer_width' => '450px',
        'fields' => array(
            array(
                'title' => esc_html__( 'Split Text Animation', 'wixi' ),
                'subtitle' => esc_html__( 'This option is general.Use this option if you want to turn off text split animations on pages.', 'wixi' ),
                'id' => 'split_text_animation_visibility',
                'type' => 'switch',
                'default' => true
            )
        )
    ));
    //BREADCRUMBS SETTINGS SUBSECTION
    Redux::setSection($wixi_pre, array(
        'title' => esc_html__( 'Theme Form', 'wixi' ),
        'id' => 'themesearchformsubsection',
        'icon' => 'el el-brush',
        'subsection' => true,
        'customizer_width' => '450px',
        'fields' => array(
            array(
                'title' => esc_html__( 'Header Search Form Input Placeholder', 'wixi' ),
                'id' => 'searchform_placeholder1',
                'type' => 'text',
                'default' => 'Search...',
            ),
            array(
                'title' => esc_html__( 'Sidebar Search Form Input Placeholder', 'wixi' ),
                'id' => 'searchform_placeholder2',
                'type' => 'text',
                'default' => 'Search for...',
            ),
            array(
                'title' => esc_html__( 'Password Form Input Placeholder', 'wixi' ),
                'id' => 'searchform_placeholder3',
                'type' => 'text',
                'default' => 'Enter Password',
            ),
        )
    ));
    //BREADCRUMBS SETTINGS SUBSECTION
    Redux::setSection($wixi_pre, array(
        'title' => esc_html__( 'Smooth Scrollbar', 'wixi' ),
        'id' => 'themesmoothscrollbarsubsection',
        'icon' => 'el el-brush',
        'subsection' => true,
        'customizer_width' => '450px',
        'fields' => array(
            array(
                'title' => esc_html__( 'Smooth Scrollbar', 'wixi' ),
                'id' => 'smoothscrollbar_visibility',
                'type' => 'switch',
                'default' => false
            ),
            array(
                'title' => esc_html__( 'Elementor Canvas Page Smooth Scrollbar', 'wixi' ),
                'id' => 'canvas_smoothscrollbar_visibility',
                'type' => 'switch',
                'default' => false,
                'required' => array( 'smoothscrollbar_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Scrollbar Thumb Color', 'wixi' ),
                'id' => 'smoothscrollbar_thumb',
                'type' => 'color',
                'mode' => 'background',
                'default' =>  '',
                'output' => array('.has-custom--scrollbar::-webkit-scrollbar-thumb'),
                'required' => array( 'smoothscrollbar_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Scrollbar Thumb Color ( Hover )', 'wixi' ),
                'id' => 'smoothscrollbar_hvrthumb',
                'type' => 'color',
                'mode' => 'background',
                'default' =>  '',
                'output' => array('.has-custom--scrollbar::-webkit-scrollbar-thumb:hover '),
                'required' => array( 'smoothscrollbar_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Scrollbar Track Color', 'wixi' ),
                'id' => 'smoothscrollbar_track',
                'type' => 'color',
                'mode' => 'background',
                'default' =>  '',
                'output' => array('.has-custom--scrollbar::-webkit-scrollbar-track'),
                'required' => array( 'smoothscrollbar_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Scrollbar Width', 'wixi' ),
                'id' => 'smoothscrollbar_width',
                'type' => 'dimensions',
                'output' => array('.has-custom--scrollbar::-webkit-scrollbar'),
                'units' => array('px'),
                'all' => false,
                'width' => true,
                'height' => false,
                'default' => array(
                    'width' => '8',
                    'units' => 'px'
                ),
                'required' => array( 'smoothscrollbar_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Animation Time', 'wixi' ),
                'id' => 'scrollbar_animationtime',
                'type' => 'spinner',
                "default" => 1000,
                "min" => 50,
                "step" => 50,
                "max" => 10000,
                'display_value' => 'label',
                'required' => array( 'smoothscrollbar_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Step Size', 'wixi' ),
                'id' => 'scrollbar_stepsize',
                'type' => 'spinner',
                "default" => 100,
                "min" => 1,
                "step" => 1,
                "max" => 1000,
                'required' => array( 'smoothscrollbar_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Acceleration Delta', 'wixi' ),
                'id' => 'scrollbar_accelerationdelta',
                'type' => 'spinner',
                "default" => 50,
                "min" => 1,
                "step" => 10,
                "max" => 5000,
                'required' => array( 'smoothscrollbar_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Acceleration Maximum', 'wixi' ),
                'id' => 'scrollbar_accelerationmax',
                'type' => 'spinner',
                "default" => 3,
                "min" => 1,
                "step" => 1,
                "max" => 100,
                'required' => array( 'smoothscrollbar_visibility', '=', '1' )
            ),
        )
    ));
    /*************************************************
    ## LOGO SECTION
    *************************************************/
    Redux::setSection($wixi_pre, array(
        'title' => esc_html__( 'Logo', 'wixi' ),
        'desc' => esc_html__( 'These are main settings for general theme!', 'wixi' ),
        'id' => 'logosection',
        'customizer_width' => '400px',
        'icon' => 'el el-star-empty',
        'fields' => array(
            array(
                'title' => esc_html__( 'Logo Switch', 'wixi' ),
                'subtitle' => esc_html__( 'You can select logo on or off.', 'wixi' ),
                'id' => 'logo_visibility',
                'type' => 'switch',
                'default' => true
            ),
            array(
                'title' => esc_html__( 'Logo Type', 'wixi' ),
                'subtitle' => esc_html__( 'Select your logo type.', 'wixi' ),
                'id' => 'logo_type',
                'type' => 'select',
                'customizer' => true,
                'options' => array(
                    'img' => esc_html__( 'Image Logo', 'wixi' ),
                    'sitename' => esc_html__( 'Site Name', 'wixi' ),
                    'customtext' => esc_html__( 'Custom HTML', 'wixi' )
                ),
                'default' => 'sitename',
                'required' => array( 'logo_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Custom text for logo', 'wixi' ),
                'desc' => esc_html__( 'Text entered here will be used as logo', 'wixi' ),
                'id' => 'text_logo',
                'type' => 'editor',
                'args'   => array(
                    'teeny' => false,
                    'textarea_rows' => 10
                ),
                'required' => array(
                    array( 'logo_visibility', '=', '1' ),
                    array( 'logo_type', '=', 'customtext' )
                ),
            ),
            array(
                'title' => esc_html__( 'Sitename or Custom Text Logo Font', 'wixi' ),
                'desc' => esc_html__("Choose size and style your sitename, if you don't use an image logo.", 'wixi' ),
                'id' =>'logo_style',
                'type' => 'typography',
                'font-family' => true,
                'google' => true, // Disable google fonts. Won't work if you haven't defined your google api key
                'font-backup' => false, // Select a backup non-google font in addition to a google font
                'font-style' => true, // Includes font-style and weight. Can use font-style or font-weight to declare
                'subsets' => true, // Only appears if google is true and subsets not set to false
                'font-size' => true,
                'line-height' => true,
                'text-transform' => true,
                'text-align' => false,
                'customizer' => true,
                'color' => true,
                'preview' => true, // Disable the previewer
                'output' => array('#nt-logo.logo-type-customtext,#nt-logo.logo-type-text,#nt-logo.logo-type-customtext>*, #nt-logo.logo-type-sitename, #nt-logo.logo-type-sitename>*' ),
                'default' => array(
                    'font-family' =>'',
                    'color' =>"",
                    'font-style' =>'',
                    'font-size' =>'',
                    'line-height' =>''
                ),
                'required' => array(
                    array( 'logo_visibility', '=', '1' ),
                    array( 'logo_type', '!=', 'img' )
                )
            ),
            array(
                'title' => esc_html__( 'Hover Logo Color', 'wixi' ),
                'desc' => esc_html__( 'Set your own hover color for the text logo.', 'wixi' ),
                'id' => 'text_logo_hvr',
                'type' => 'color',
                'output' => array( '#nt-logo.logo-type-text:hover .header-text-logo' ),
                'required' => array(
                    array( 'logo_visibility', '=', '1' ),
                    array( 'logo_type', '!=', 'img' )
                )
            ),
            array(
                'title' => esc_html__( 'Background Color', 'wixi' ),
                'desc' => esc_html__( 'Set your own hover color for the text logo.', 'wixi' ),
                'id' => 'text_logo_bg',
                'type' => 'color',
                'mode' => 'background-color',
                'output' => array( '#nt-logo.logo-type-text' ),
                'required' => array(
                    array( 'logo_visibility', '=', '1' ),
                    array( 'logo_type', '!=', 'img' )
                )
            ),
            array(
                'title' => esc_html__( 'Hover Background Color', 'wixi' ),
                'desc' => esc_html__( 'Set your own hover color for the text logo.', 'wixi' ),
                'id' => 'text_logo_hvrbg',
                'type' => 'color',
                'mode' => 'background-color',
                'output' => array( '#nt-logo.logo-type-text:after' ),
                'required' => array(
                    array( 'logo_visibility', '=', '1' ),
                    array( 'logo_type', '!=', 'img' )
                )
            ),
            array(
                'id' => 'text_logo_brdclr',
                'type' => 'border',
                'title' => esc_html__( 'Border', 'wixi' ),
                'output' => array( '#nt-logo.logo-type-text' ),
                'all' => false,
                'required' => array(
                    array( 'logo_visibility', '=', '1' ),
                    array( 'logo_type', '!=', 'img' )
                )
            ),
            array(
                'title' => esc_html__( 'Hover Border', 'wixi' ),
                'id' => 'text_logo_hvrbrdclr',
                'type' => 'border',
                'output' => array( '#nt-logo.logo-type-text:hover' ),
                'all' => false,
                'required' => array(
                    array( 'logo_visibility', '=', '1' ),
                    array( 'logo_type', '!=', 'img' )
                )
            ),
            array(
                'title' => esc_html__( 'Logo Padding', 'wixi' ),
                'id' => 'text_logo_pad',
                'type' => 'spacing',
                'mode' => 'padding',
                'all' => false,
                'units' => array( 'em', 'px', '%' ),
                'units_extended' => 'true',
                'output' => array( '#nt-logo.logo-type-text' ),
                'default' => array(
                    'margin-top' => '',
                    'margin-right' => '',
                    'margin-bottom' => '',
                    'margin-left' => ''
                ),
                'required' => array(
                    array( 'logo_visibility', '=', '1' ),
                    array( 'logo_type', '!=', 'img' )
                )
            ),
            array(
                'title' => esc_html__( 'Logo image', 'wixi' ),
                'subtitle' => esc_html__( 'Upload your Logo. If left blank theme will use site default logo.', 'wixi' ),
                'id' => 'img_logo',
                'type' => 'media',
                'url' => true,
                'customizer' => true,
                'required' => array(
                    array( 'logo_visibility', '=', '1' ),
                    array( 'logo_type', '=', 'img' ),
                    array( 'logo_type', '!=', '' )
                )
            ),
            array(
                'title' => esc_html__( 'Logo Dimensions', 'wixi' ),
                'subtitle' => esc_html__( 'Set the logo width and height of the image.', 'wixi' ),
                'id' => 'img_logo_dimensions',
                'type' => 'dimensions',
                'customizer' => true,
                'output' => array('#nt-logo img' ),
                'required' => array(
                    array( 'logo_visibility', '=', '1' ),
                    array( 'logo_type', '=', 'img' ),
                    array( 'logo_type', '!=', '' )
                )
            ),
            array(
                'title' => esc_html__( 'Sticky Logo', 'wixi' ),
                'subtitle' => esc_html__( 'if you want to use a different logo on scroll, you can use this option.', 'wixi' ),
                'id' => 'img_logo_sticky',
                'type' => 'media',
                'url' => true,
                'customizer' => true,
                'required' => array(
                    array( 'logo_visibility', '=', '1' ),
                    array( 'logo_type', '=', 'img' ),
                    array( 'logo_type', '!=', '' )
                )
            ),
            array(
                'title' => esc_html__( 'Sticky Logo Dimensions', 'wixi' ),
                'subtitle' => esc_html__( 'Set the sticky logo width and height of the image.', 'wixi' ),
                'id' => 'img_sticky_logo_dimensions',
                'type' => 'dimensions',
                'customizer' => true,
                'output' => array('#nt-logo.has-sticky-logo img.sticky-logo' ),
                'required' => array(
                    array( 'logo_visibility', '=', '1' ),
                    array( 'logo_type', '=', 'img' ),
                    array( 'logo_type', '!=', '' )
                )
            ),
            array(
                'title' => esc_html__( 'Mobile Logo ( for Mobile Device )', 'wixi' ),
                'subtitle' => esc_html__( 'if you want to use a different logo on mobile devices, you can use this option.', 'wixi' ),
                'id' => 'img_logo_mobile',
                'type' => 'media',
                'url' => true,
                'customizer' => true,
                'required' => array(
                    array( 'logo_visibility', '=', '1' ),
                    array( 'logo_type', '=', 'img' ),
                    array( 'logo_type', '!=', '' )
                )
            ),
            array(
                'title' => esc_html__( 'Mobile Logo Dimensions', 'wixi' ),
                'subtitle' => esc_html__( 'Set the logo width and height of the image.', 'wixi' ),
                'id' => 'img_mobile_logo_dimensions',
                'type' => 'dimensions',
                'customizer' => true,
                'output' => array('#nt-logo.has-mobile-logo img.mobile-logo' ),
                'required' => array(
                    array( 'logo_visibility', '=', '1' ),
                    array( 'logo_type', '=', 'img' ),
                    array( 'logo_type', '!=', '' )
                )
            )
    )));

    /*************************************************
    ## HEADER & NAV SECTION
    *************************************************/
    Redux::setSection($wixi_pre, array(
        'title' => esc_html__( 'Header', 'wixi' ),
        'id' => 'headersection',
        'icon' => 'fa fa-bars',
    ));
    //HEADER MENU
    Redux::setSection($wixi_pre, array(
        'title' => esc_html__( 'General', 'wixi' ),
        'id' => 'headernavgeneralsection',
        'subsection' => true,
        'icon' => 'fa fa-cog',
        'fields' => array(
            array(
                'title' => esc_html__( 'Header Display', 'wixi' ),
                'subtitle' => esc_html__( 'You can enable or disable the site navigation.', 'wixi' ),
                'id' => 'nav_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off'
            ),
            array(
                'title' => esc_html__( 'Header Template', 'wixi' ),
                'subtitle' => esc_html__( 'Select your header template.', 'wixi' ),
                'id' => 'header_template',
                'type' => 'select',
                'customizer' => true,
                'options' => array(
                    'default' => esc_html__( 'Deafult Site Header', 'wixi' ),
                    'elementor' => esc_html__( 'Elementor Templates', 'wixi' ),
                    'sidebarmenu' => esc_html__( 'Sidebar Menu', 'wixi' ),
                ),
                'default' => 'sidebarmenu',
                'required' => array( 'nav_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Elementor Templates', 'wixi' ),
                'subtitle' => esc_html__( 'Select a template from elementor templates.', 'wixi' ),
                'id' => 'header_elementor_templates',
                'type' => 'select',
                'customizer' => true,
                'options' => wixi_get_elementorTemplates(),
                'required' => array(
                    array( 'nav_visibility', '=', '1' ),
                    array( 'header_template', '=', 'elementor' )
                )
            ),
            // SIDEBAR MENU START
            array(
                'id' => 'sidebarmenu_start',
                'type' => 'section',
                'title' => esc_html__('Header Sidebar Options', 'wixi'),
                'indent' => true,
                'required' => array(
                    array( 'nav_visibility', '=', '1' ),
                    array( 'header_template', '=', 'sidebarmenu' )
                )
            ),
            array(
                'title' => esc_html__( 'Position', 'wixi' ),
                'subtitle' => esc_html__( 'Select position menu', 'wixi' ),
                'id' => 'sidebarmenu_position',
                'type' => 'select',
                'customizer' => true,
                'options' => array(
                    'left' => esc_html__( 'Left', 'wixi' ),
                    'right' => esc_html__( 'Right', 'wixi' ),
                ),
                'default' => 'left',
            ),
            array(
                'title' => esc_html__( 'Sidebar Menu Social Icons', 'wixi' ),
                'id' => 'sidebarmenu_social',
                'type' => 'textarea',
                'default' => '<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
<li><a href="#"><i class="fab fa-twitter"></i></a></li>
<li><a href="#"><i class="fab fa-youtube"></i></a></li>',
            ),
            array(
                'title' => esc_html__( 'Social Icon Color', 'wixi' ),
                'id' => 'nav_sidebarmenu_social_clr',
                'type' => 'color',
                'mode' => 'color',
                'output' => array( '.sidebarmenu--main-side .sidebarmenu--social-media li a' ),
            ),
            array(
                'title' => esc_html__( 'Social Icon Color ( Hover )', 'wixi' ),
                'id' => 'nav_sidebarmenu_social_hvrclr',
                'type' => 'color',
                'mode' => 'color',
                'output' => array( '.sidebarmenu--main-side .sidebarmenu--social-media li a:hover' ),
            ),
            array(
                'title' => esc_html__( 'Mobile Toggle Bar Color', 'wixi' ),
                'id' => 'nav_sidebarmenu_togglebar_clr',
                'type' => 'color',
                'mode' => 'background',
                'output' => array( '.sidebarmenu--hamburger-menu.mobile--hamburger span' ),
            ),
            array(
                'title' => esc_html__( 'Sidebar Background Color', 'wixi' ),
                'id' => 'nav_sidebarmenu_bg',
                'type' => 'color_rgba',
                'mode' => 'background',
                'options'=> array(
                    'show_input' => true,
                    'show_initial' => true,
                    'show_alpha' => true,
                    'show_palette' => true,
                    'show_palette_only' => false,
                    'show_selection_palette' => true,
                    'max_palette_size' => 10,
                    'allow_empty' => true,
                    'clickout_fires_change' => false,
                    'choose_text' => 'Choose',
                    'cancel_text' => 'Cancel',
                    'show_buttons' => true,
                    'use_extended_classes' => true,
                    'palette' => null,
                ),
                'output' => array( '.sidebarmenu--main-side' ),
            ),
            array(
                'title' => esc_html__( 'Sidebar Border Color', 'wixi' ),
                'id' => 'nav_sidebarmenu_brdleft_bg',
                'type' => 'color',
                'mode' => 'border-right-color',
                'output' => array( '.sidebarmenu--main-side' ),
            ),
            array(
                'title' => esc_html__( 'Menu Background Color', 'wixi' ),
                'id' => 'nav_sidebarmenu_menu_bg',
                'type' => 'color_rgba',
                'mode' => 'background',
                'options'=> array(
                    'show_input' => true,
                    'show_initial' => true,
                    'show_alpha' => true,
                    'show_palette' => true,
                    'show_palette_only' => false,
                    'show_selection_palette' => true,
                    'max_palette_size' => 10,
                    'allow_empty' => true,
                    'clickout_fires_change' => false,
                    'choose_text' => 'Choose',
                    'cancel_text' => 'Cancel',
                    'show_buttons' => true,
                    'use_extended_classes' => true,
                    'palette' => null,
                ),
                'output' => array( '.sidebarmenu--navigation,.sidebarmenu--search-box' ),
            ),
            array(
                'title' => esc_html__( 'Header Search Form Display', 'wixi' ),
                'subtitle' => esc_html__( 'You can enable or disable the site navigation search form.', 'wixi' ),
                'id' => 'nav_search_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off',
            ),
            array(
                'title' => esc_html__( 'Search Overlay Background Color', 'wixi' ),
                'id' => 'nav_sidebarmenu_search_bg',
                'type' => 'color_rgba',
                'mode' => 'background',
                'options'=> array(
                    'show_input' => true,
                    'show_initial' => true,
                    'show_alpha' => true,
                    'show_palette' => true,
                    'show_palette_only' => false,
                    'show_selection_palette' => true,
                    'max_palette_size' => 10,
                    'allow_empty' => true,
                    'clickout_fires_change' => false,
                    'choose_text' => 'Choose',
                    'cancel_text' => 'Cancel',
                    'show_buttons' => true,
                    'use_extended_classes' => true,
                    'palette' => null,
                ),
                'output' => array( '.sidebarmenu--search-box' ),
            ),
            array(
                'title' => esc_html__( 'Search Icon Color', 'wixi' ),
                'id' => 'nav_sidebarmenu_search_clr',
                'type' => 'color',
                'mode' => 'fill',
                'output' => array( '.sidebarmenu--main-side .sidebarmenu--search svg' ),
            ),
            array(
                'title' => esc_html__( 'Search Overlay Title Font and Color', 'wixi' ),
                'id' => 'nav_sidebarmenu_search_typo',
                'type' => 'typography',
                'font-backup' => false,
                'letter-spacing' => true,
                'text-transform' => true,
                'all_styles' => true,
                'output' => array( '.sidebarmenu--search-box.open h2' ),
                'default' => array(
                    'color' => '',
                    'font-style' => '',
                    'font-family' => '',
                    'google' => true,
                    'font-size' => '',
                    'line-height' => ''
                ),
            ),
            array(
                'title' => esc_html__( 'Mobile Header Background Color', 'wixi' ),
                'id' => 'nav_sidebarmenu_mobmenu_bg',
                'type' => 'color_rgba',
                'mode' => 'background',
                'options'=> array(
                    'show_input' => true,
                    'show_initial' => true,
                    'show_alpha' => true,
                    'show_palette' => true,
                    'show_palette_only' => false,
                    'show_selection_palette' => true,
                    'max_palette_size' => 10,
                    'allow_empty' => true,
                    'clickout_fires_change' => false,
                    'choose_text' => 'Choose',
                    'cancel_text' => 'Cancel',
                    'show_buttons' => true,
                    'use_extended_classes' => true,
                    'palette' => null,
                ),
                'output' => array( '.nt-mobile .sidebarmenu--headertop.mobile--header' ),
            ),
            array(
                'title' => esc_html__( 'Mobile Sticky Header Background Color', 'wixi' ),
                'id' => 'nav_sidebarmenu_mobmenu_sticky_bg',
                'type' => 'color_rgba',
                'mode' => 'background',
                'options'=> array(
                    'show_input' => true,
                    'show_initial' => true,
                    'show_alpha' => true,
                    'show_palette' => true,
                    'show_palette_only' => false,
                    'show_selection_palette' => true,
                    'max_palette_size' => 10,
                    'allow_empty' => true,
                    'clickout_fires_change' => false,
                    'choose_text' => 'Choose',
                    'cancel_text' => 'Cancel',
                    'show_buttons' => true,
                    'use_extended_classes' => true,
                    'palette' => null,
                ),
                'output' => array( '.nt-mobile.scroll-start .sidebarmenu--headertop.mobile--header' ),
            ),
            // DEFAULT HEADER OPTIONS
            array(
                'id' => 'defaultmenu_start',
                'type' => 'section',
                'title' => esc_html__('Header Overlay Options', 'wixi'),
                'indent' => true,
                'required' => array(
                    array( 'nav_visibility', '=', '1' ),
                    array( 'header_template', '=', 'default' )
                )
            ),
            array(
                'title' => esc_html__( 'Menu Button Type', 'wixi' ),
                'subtitle' => esc_html__( 'Select your header template.', 'wixi' ),
                'id' => 'burger_type',
                'type' => 'select',
                'customizer' => true,
                'options' => array(
                    'default' => esc_html__( 'Deafult', 'wixi' ),
                    'hamburger--slider' => esc_html__( 'Slider', 'wixi' ),
                    'hamburger--squeeze' => esc_html__( 'Squeeze', 'wixi' ),
                    'hamburger--arrow' => esc_html__( 'Arrow', 'wixi' ),
                    'hamburger--arrowalt' => esc_html__( 'Arrow Alt', 'wixi' ),
                    'hamburger--arrowturn' => esc_html__( 'Arrow Turn', 'wixi' ),
                    'hamburger--spin' => esc_html__( 'Spin', 'wixi' ),
                    'hamburger--elastic' => esc_html__( 'Elastic', 'wixi' ),
                    'hamburger--emphatic' => esc_html__( 'Emphatic', 'wixi' ),
                    'hamburger--collapse' => esc_html__( 'Collapse', 'wixi' ),
                    'hamburger--vortex' => esc_html__( 'Vortex', 'wixi' ),
                    'hamburger--stand' => esc_html__( 'Stand', 'wixi' ),
                    'hamburger--spring' => esc_html__( 'Spring', 'wixi' ),
                    'hamburger--minus' => esc_html__( 'Minus', 'wixi' ),
                    'hamburger--3dx' => esc_html__( '3DX', 'wixi' ),
                    'hamburger--3dy' => esc_html__( '3DY', 'wixi' ),
                    'hamburger--3dxy' => esc_html__( '3DXY', 'wixi' ),
                    'hamburger--boring' => esc_html__( 'Boring', 'wixi' ),
                ),
                'default' => 'default',
            ),
            array(
                'title' => esc_html__( 'Menu Title', 'wixi' ),
                'id' => 'nav_menu_title',
                'type' => 'text',
                'default' => 'Menu',
            ),
            array(
                'title' => esc_html__( 'Close Title', 'wixi' ),
                'id' => 'nav_close_title',
                'type' => 'text',
                'default' => 'Close',
            ),
            array(
                'title' => esc_html__( 'Open and Close Title Color', 'wixi' ),
                'id' => 'nav_open_close_text',
                'type' => 'color',
                'mode' => 'color',
                'output' => array( '.overlaynav .menu-toggle .text,.overlaynav .menu-toggle .text:after' ),
            ),
            array(
                'title' => esc_html__( 'Toggle Bar Color', 'wixi' ),
                'id' => 'nav_togglebar_bg',
                'type' => 'color_rgba',
                'mode' => 'background',
                'options'=> array(
                    'show_input' => true,
                    'show_initial' => true,
                    'show_alpha' => true,
                    'show_palette' => true,
                    'show_palette_only' => false,
                    'show_selection_palette' => true,
                    'max_palette_size' => 10,
                    'allow_empty' => true,
                    'clickout_fires_change' => false,
                    'choose_text' => 'Choose',
                    'cancel_text' => 'Cancel',
                    'show_buttons' => true,
                    'use_extended_classes' => true,
                    'palette' => null,
                ),
                'output' => array( '.overlaynav .menu-toggle .icon i, .sidebarmenu--hamburger-menu span' ),
            ),
            array(
                'title' => esc_html__( 'Header Height', 'wixi' ),
                'id' => 'nav_top_height',
                'type' => 'dimensions',
                'output' => array(
                    '.main-overlaymenu .menu-header{padding:0;}.main-overlaymenu .menu-header'
                ),
                'units' => array('px'),
                'all' => false,
                'width' => false,
                'height' => true,
                'required' => array(
                    array( 'nav_visibility', '=', '1' ),
                    array( 'header_template', '=', 'default' )
                )
            ),
            array(
                'title' => esc_html__( 'Header Background Color', 'wixi' ),
                'id' => 'nav_top_bg',
                'type' => 'color_rgba',
                'mode' => 'background',
                'options'=> array(
                    'show_input' => true,
                    'show_initial' => true,
                    'show_alpha' => true,
                    'show_palette' => true,
                    'show_palette_only' => false,
                    'show_selection_palette' => true,
                    'max_palette_size' => 10,
                    'allow_empty' => true,
                    'clickout_fires_change' => false,
                    'choose_text' => 'Choose',
                    'cancel_text' => 'Cancel',
                    'show_buttons' => true,
                    'use_extended_classes' => true,
                    'palette' => null,
                ),
                'output' => array( '.main-overlaymenu .menu-header' ),
            ),
            array(
                'title' => esc_html__( 'Header Overlay Background Color', 'wixi' ),
                'id' => 'nav_bg',
                'type' => 'color_rgba',
                'mode' => 'background',
                'options'=> array(
                    'show_input' => true,
                    'show_initial' => true,
                    'show_alpha' => true,
                    'show_palette' => true,
                    'show_palette_only' => false,
                    'show_selection_palette' => true,
                    'max_palette_size' => 10,
                    'allow_empty' => true,
                    'clickout_fires_change' => false,
                    'choose_text' => 'Choose',
                    'cancel_text' => 'Cancel',
                    'show_buttons' => true,
                    'use_extended_classes' => true,
                    'palette' => null,
                ),
                'output' => array( 'div.main-overlaymenu .overlaymenu-content' ),
            ),
            array(
                'title' => esc_html__( 'Overlay Menu Background Image', 'wixi' ),
                'id' => 'nav_top_bg_img',
                'type' => 'background',
                'preview' => true,
                'preview_media' => true,
                'output' => array( '.main-overlaymenu .overlaymenu-content' ),
                'default' => array(
                    'background-position' => 'center'
                ),
            ),
            array(
                'title' => esc_html__( 'Sticky Header Display', 'wixi' ),
                'id' => 'nav_sticky_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off',
            ),
            array(
                'title' => esc_html__( 'Sticky Header Background Color', 'wixi' ),
                'id' => 'nav_top_sticky_bg',
                'type' => 'color_rgba',
                'mode' => 'background',
                'options'=> array(
                    'show_input' => true,
                    'show_initial' => true,
                    'show_alpha' => true,
                    'show_palette' => true,
                    'show_palette_only' => false,
                    'show_selection_palette' => true,
                    'max_palette_size' => 10,
                    'allow_empty' => true,
                    'clickout_fires_change' => false,
                    'choose_text' => 'Choose',
                    'cancel_text' => 'Cancel',
                    'show_buttons' => true,
                    'use_extended_classes' => true,
                    'palette' => null,
                ),
                'output' => array( '.scroll-start .main-overlaymenu:not(.sticky-header-off) .menu-header' ),
                'required' => array( 'nav_sticky_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Sticky Header Height', 'wixi' ),
                'id' => 'nav_top_sticky_height',
                'type' => 'dimensions',
                'output' => array(
                    '.scroll-start .main-overlaymenu:not(.sticky-header-off) .menu-header{padding:0;}.scroll-start .main-overlaymenu:not(.sticky-header-off) .menu-header'
                ),
                'units' => array('px'),
                'all' => false,
                'width' => false,
                'height' => true,
                'required' => array( 'nav_sticky_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Header Contact Area Display', 'wixi' ),
                'subtitle' => esc_html__( 'You can enable or disable the site navigation contact area.', 'wixi' ),
                'id' => 'nav_contact_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off',
            ),
            array(
                'title' => esc_html__( 'Header Contact Area', 'wixi' ),
                'id' => 'nav_contact',
                'type' => 'editor',
                'default' => '<div class="item"><h6>Phone :</h6><p>+0 762-2367-723</p></div>
                <div class="item"><h6>Address :</h6><p>541 Melville Ave, Palo Alto, CA 94301</p></div>
                <div class="item"><h6>Email :</h6><p>Wixi_website@gmail.com</p></div>',
                'args'   => array(
                    'teeny' => false,
                    'textarea_rows' => 10
                ),
                'required' => array( 'nav_contact_visibility', '=', '1' )

            ),
            array(
                'title' => esc_html__( 'Header Copyright Text', 'wixi' ),
                'subtitle' => esc_html__( 'HTML allowed (wp_kses)', 'wixi' ),
                'desc' => esc_html__( 'Enter your header copyright text here.', 'wixi' ),
                'id' => 'header_copyright',
                'type' => 'textarea',
                'validate' => 'html',
                'default' => sprintf( '<p>&copy; %1$s, <a class="theme" href="%2$s">%3$s</a> Theme. %4$s <a class="dev" href="https://ninetheme.com/contact/">%5$s</a></p>',
                    date( 'Y' ),
                    esc_url( home_url( '/' ) ),
                    get_bloginfo( 'name' ),
                    esc_html__( 'Made with passion by', 'wixi' ),
                    esc_html__( 'Ninetheme.', 'wixi' )
                ),
            ),
            array(
                'title' => esc_html__( 'Header Copyright Text Color', 'wixi' ),
                'desc' => esc_html__( 'Set your own color for the navigation menu item.', 'wixi' ),
                'id' => 'nav_copyright_color',
                'type' => 'color',
                'output' => array( '.main-overlaymenu .item.header-footer' ),
            ),
            array(
                'title' => esc_html__( 'Header Copyright Background Color', 'wixi' ),
                'desc' => esc_html__( 'Set your own color for the navigation menu item.', 'wixi' ),
                'id' => 'nav_copyright_bgcolor',
                'type' => 'color',
                'mode' => 'background-color',
                'output' => array( '.main-overlaymenu .item.header-footer' ),
            ),
            array(
                'title' => esc_html__( 'Header Lang Select Display', 'wixi' ),
                'subtitle' => esc_html__( 'You can enable or disable the site header language area.', 'wixi' ),
                'id' => 'nav_lang_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off',
            ),
            array(
                'title' => esc_html__( 'Lang Color', 'wixi' ),
                'desc' => esc_html__( 'Set your own color for the header language item.', 'wixi' ),
                'id' => 'nav_lang_color',
                'type' => 'color',
                'output' => array( '.main-overlaymenu .lang-select .uppercase' ),
            ),
            array(
                'title' => esc_html__( 'Sub Lang Background Color', 'wixi' ),
                'desc' => esc_html__( 'Set your own color for the header language item.', 'wixi' ),
                'id' => 'nav_sublang_bgcolor',
                'type' => 'color',
                'mode' => 'background-color',
                'output' => array( '.main-overlaymenu .sub-lang-item a:before' ),
            ),
            array(
                'id' => 'menu_start',
                'type' => 'section',
                'title' => esc_html__('Menu Options', 'wixi'),
                'indent' => true,
                'required' => array(
                    array( 'nav_visibility', '=', '1' ),
                    array( 'header_template', '!=', 'elementor' ),
                )
            ),
            array(
                'title' => esc_html__( 'Menu Item Font and Color', 'wixi' ),
                'subtitle' => esc_html__('Choose Size and Style for primary menu', 'wixi' ),
                'id' => 'nav_a_typo',
                'type' => 'typography',
                'font-backup' => false,
                'letter-spacing' => true,
                'text-transform' => true,
                'all_styles' => true,
                'output' => array( '.main-overlaymenu .main-menu > li, .has-sidebar-menu .main-overlaymenu .main-menu > li' ),
                'default' => array(
                    'color' => '',
                    'font-style' => '',
                    'font-family' => '',
                    'google' => true,
                    'font-size' => '',
                    'line-height' => ''
                ),
            ),
            array(
                'title' => esc_html__( 'Menu Item Color ( Hover and Active )', 'wixi' ),
                'desc' => esc_html__( 'Set your own hover color for the navigation menu item.', 'wixi' ),
                'id' => 'nav_hvr_a',
                'type' => 'color',
                'output' => array( '.main-overlaymenu .menu-wrapper .link:hover, .main-overlaymenu .menu-wrapper .main-menu .goback a:hover, .main-overlaymenu .menu-wrapper .is--active .link' ),
            ),
            array(
                'title' => esc_html__( 'Menu Item Bottom Line Display', 'wixi' ),
                'subtitle' => esc_html__( 'You can enable or disable the site header menu item bottom line.', 'wixi' ),
                'id' => 'nav_a_line_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off',
            ),
            array(
                'title' => esc_html__( 'Menu Item Bottom Line Color', 'wixi' ),
                'desc' => esc_html__( 'Set your own color for the header navigation menu item.', 'wixi' ),
                'id' => 'nav_a_line',
                'type' => 'color',
                'mode' => 'background-color',
                'output' => array( '.main-overlaymenu .link:after,.main-overlaymenu .menu-wrapper .main-menu > li span.nm' ),
                'required' => array( 'nav_a_line_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Menu Item Bottom Line Color 2', 'wixi' ),
                'desc' => esc_html__( 'Set your own color for the header navigation menu item.', 'wixi' ),
                'id' => 'nav_hvr_a_line',
                'type' => 'color',
                'mode' => 'background-color',
                'output' => array( '.main-overlaymenu .link:before' ),
                'required' => array( 'nav_a_line_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Go Back Font and Color', 'wixi' ),
                'subtitle' => esc_html__( 'Choose Size and Style for primary menu', 'wixi' ),
                'id' => 'nav_back_typo',
                'type' => 'typography',
                'font-backup' => false,
                'letter-spacing' => true,
                'text-transform' => true,
                'all_styles' => true,
                'output' => array( '.main-overlaymenu .menu-wrapper .main-menu .goback a' ),
                'default' => array(
                    'color' => '',
                    'font-style' => '',
                    'font-family' => '',
                    'google' => true,
                    'font-size' => '',
                    'line-height' => ''
                ),
                'required' => array(
                    array( 'nav_visibility', '=', '1' ),
                    array( 'header_template', '=', 'default' )
                )
            ),
            array(
                'title' => esc_html__( 'Go Back Color ( Hover )', 'wixi' ),
                'desc' => esc_html__( 'Set your own color for the header navigation menu item.', 'wixi' ),
                'id' => 'nav_back_hvrcolor',
                'type' => 'color',
                'output' => array( '.main-overlaymenu .menu-wrapper .main-menu .goback a:hover' ),
            ),
            array(
                'title' => esc_html__( 'Theme Overlay Menu Transition', 'wixi' ),
                'id' => 'overlay_menu_transition',
                'type' => 'text',
                'default' => '',
                'required' => array( 'nav_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Theme Overlay Menu Item Transition', 'wixi' ),
                'id' => 'overlay_menuitem_transition',
                'type' => 'text',
                'default' => '',
                'required' => array( 'nav_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Theme Overlay Submenu Transition Delay', 'wixi' ),
                'id' => 'overlay_submenu_transitiondelay',
                'type' => 'text',
                'default' => '',
                'required' => array( 'nav_visibility', '=', '1' )
            ),
            //information on-off
            array(
                'id' =>'info_nav0',
                'type' => 'info',
                'style' => 'success',
                'title' => esc_html__( 'Success!', 'wixi' ),
                'icon' => 'el el-info-circle',
                'customizer' => false,
                'desc' => sprintf(esc_html__( '%s is disabled on the site. Please activate to view options.', 'wixi' ), '<b>Navigation</b>' ),
                'required' => array( 'nav_visibility', '=', '0' )
            )
    )));


    /*************************************************
    ## SIDEBARS SECTION
    *************************************************/
    Redux::setSection($wixi_pre, array(
        'title' => esc_html__( 'Sidebars', 'wixi' ),
        'id' => 'sidebarssection',
        'customizer_width' => '400px',
        'icon' => 'fa fa-th-list',
    ));
    // SIDEBAR LAYOUT SUBSECTION
    Redux::setSection($wixi_pre, array(
        'title' => esc_html__( 'Sidebars Layout', 'wixi' ),
        'desc' => esc_html__( 'You can change the below default layout type.', 'wixi' ),
        'id' => 'sidebarslayoutsection',
        'subsection' => true,
        'icon' => 'el el-cogs',
        'fields' => array(
            array(
                'title' => esc_html__( 'Sidebar type', 'wixi' ),
                'subtitle' => esc_html__( 'Select sidebar type.', 'wixi' ),
                'id' => 'sidebar_type',
                'type' => 'select',
                'customizer' => true,
                'options' => array(
                    '' => esc_html__( 'Select type', 'wixi' ),
                    'default' => esc_html__( 'default', 'wixi' ),
                    'bordered' => esc_html__( 'bordered', 'wixi' )
                ),
                'default' => 'default',
            ),
            array(
                'title' => esc_html__( 'Default Page Layout', 'wixi' ),
                'subtitle' => esc_html__( 'Choose the default page layout.', 'wixi' ),
                'id' => 'page_layout',
                'type' => 'image_select',
                'options' => array(
                    'full-width' => array(
                        'alt' => 'Left Sidebar',
                        'img' => get_template_directory_uri() . '/inc/core/theme-options/img/2cl.png'
                    ),
                    'full-width' => array(
                        'alt' => 'Full Width',
                        'img' => get_template_directory_uri() . '/inc/core/theme-options/img/1col.png'
                    ),
                    'right-sidebar' => array(
                        'alt' => 'Right Sidebar',
                        'img' => get_template_directory_uri() . '/inc/core/theme-options/img/2cr.png'
                    )
                ),
                'default' => 'full-width'
            ),
            array(
                'title' => esc_html__( 'Blog Page Layout', 'wixi' ),
                'subtitle' => esc_html__( 'Choose the blog index page layout.', 'wixi' ),
                'id' => 'index_layout',
                'type' => 'image_select',
                'options' => array(
                    'left-sidebar' => array(
                        'alt' => 'Left Sidebar',
                        'img' => get_template_directory_uri() . '/inc/core/theme-options/img/2cl.png'
                    ),
                    'full-width' => array(
                        'alt' => 'Full Width',
                        'img' => get_template_directory_uri() . '/inc/core/theme-options/img/1col.png'
                    ),
                    'right-sidebar' => array(
                        'alt' => 'Right Sidebar',
                        'img' => get_template_directory_uri() . '/inc/core/theme-options/img/2cr.png'
                    )
                ),
                'default' => 'right-sidebar'
            ),
            array(
                'title' => esc_html__( 'Single Page Layout', 'wixi' ),
                'subtitle' => esc_html__( 'Choose the single post page layout.', 'wixi' ),
                'id' => 'single_layout',
                'type' => 'image_select',
                'options' => array(
                    'left-sidebar' => array(
                        'alt' => 'Left Sidebar',
                        'img' => get_template_directory_uri() . '/inc/core/theme-options/img/2cl.png'
                    ),
                    'full-width' => array(
                        'alt' => 'Full Width',
                        'img' => get_template_directory_uri() . '/inc/core/theme-options/img/1col.png'
                    ),
                    'right-sidebar' => array(
                        'alt' => 'Right Sidebar',
                        'img' => get_template_directory_uri() . '/inc/core/theme-options/img/2cr.png'
                    )
                ),
                'default' => 'full-width'
            ),
            array(
                'title' => esc_html__( 'Search Page Layout', 'wixi' ),
                'subtitle' => esc_html__( 'Choose the search page layout.', 'wixi' ),
                'id' => 'search_layout',
                'type' => 'image_select',
                'options' => array(
                    'left-sidebar' => array(
                        'alt' => 'Left Sidebar',
                        'img' => get_template_directory_uri() . '/inc/core/theme-options/img/2cl.png'
                    ),
                    'full-width' => array(
                        'alt' => 'Full Width',
                        'img' => get_template_directory_uri() . '/inc/core/theme-options/img/1col.png'
                    ),
                    'right-sidebar' => array(
                        'alt' => 'Right Sidebar',
                        'img' => get_template_directory_uri() . '/inc/core/theme-options/img/2cr.png'
                    )
                ),
                'default' => 'full-width'
            ),
            array(
                'title' => esc_html__( 'Archive Page Layout', 'wixi' ),
                'subtitle' => esc_html__( 'Choose the archive page layout.', 'wixi' ),
                'id' => 'archive_layout',
                'type' => 'image_select',
                'options' => array(
                    'left-sidebar' => array(
                        'alt' => 'Left Sidebar',
                        'img' => get_template_directory_uri() . '/inc/core/theme-options/img/2cl.png'
                    ),
                    'full-width' => array(
                        'alt' => 'Full Width',
                        'img' => get_template_directory_uri() . '/inc/core/theme-options/img/1col.png'
                    ),
                    'right-sidebar' => array(
                        'alt' => 'Right Sidebar',
                        'img' => get_template_directory_uri() . '/inc/core/theme-options/img/2cr.png'
                    )
                ),
                'default' => 'full-width'
            )
    )));
    // SIDEBAR COLORS SUBSECTION
    Redux::setSection($wixi_pre, array(
        'title' => esc_html__( 'Sidebar Customize', 'wixi' ),
        'desc' => esc_html__( 'These are main settings for general theme!', 'wixi' ),
        'id' => 'sidebarsgenaralsection',
        'subsection' => true,
        'icon' => 'el el-brush',
        'fields' => array(
            array(
                'title' => esc_html__( 'Sidebar Background', 'wixi' ),
                'id' => 'sdbr_bg',
                'type' => 'color',
                'mode' => 'background',
                'output' => array( '.nt-sidebar' )
            ),
            array(
                'id' => 'sdbr_brd',
                'type' => 'border',
                'title' => esc_html__( 'Sidebar Border', 'wixi' ),
                'output' => array( '.nt-sidebar' ),
                'all' => false
            ),
            array(
                'title' => esc_html__( 'Sidebar Padding', 'wixi' ),
                'id' => 'sdbr_pad',
                'type' => 'spacing',
                'mode' => 'padding',
                'all' => false,
                'units' => array( 'em', 'px', '%' ),
                'units_extended' => 'true',
                'output' => array( '.nt-sidebar' ),
                'default' => array(
                    'margin-top' => '',
                    'margin-right' => '',
                    'margin-bottom' => '',
                    'margin-left' => ''
                )
            ),
            array(
                'title' => esc_html__( 'Sidebar Margin', 'wixi' ),
                'id' => 'sdbr_mar',
                'type' => 'spacing',
                'mode' => 'margin',
                'all' => false,
                'units' => array( 'em', 'px', '%' ),
                'units_extended' => 'true',
                'output' => array( '.nt-sidebar' ),
                'default' => array(
                    'margin-top' => '',
                    'margin-right' => '',
                    'margin-bottom' => '',
                    'margin-left' => ''
                )
            ),
    )));
    // SIDEBAR WIDGET COLORS SUBSECTION
    Redux::setSection($wixi_pre, array(
        'title' => esc_html__( 'Widget Customize', 'wixi' ),
        'desc' => esc_html__( 'These are main settings for general theme!', 'wixi' ),
        'id' => 'sidebarwidgetsection',
        'subsection' => true,
        'icon' => 'el el-brush',
        'fields' => array(
            array(
                'title' => esc_html__( 'Sidebar Widgets Background Color', 'wixi' ),
                'id' => 'sdbr_w_bg',
                'type' => 'color',
                'mode' => 'background',
                'output' => array( '.nt-sidebar .nt-sidebar-inner-widget' )
            ),
            array(
                'title' => esc_html__( 'Widgets Border', 'wixi' ),
                'id' => 'sdbr_w_brd',
                'type' => 'border',
                'output' => array( '.nt-sidebar .nt-sidebar-inner-widget' ),
                'all' => false
            ),
            array(
                'title' => esc_html__( 'Widget Title Color', 'wixi' ),
                'desc' => esc_html__( 'Set your own colors for the widgets.', 'wixi' ),
                'id' => 'sdbr_wt',
                'type' => 'color',
                'output' => array( '#nt-sidebar .widget-title' )
            ),
            array(
                'title' => esc_html__( 'Widget Text Color', 'wixi' ),
                'desc' => esc_html__( 'Set your own colors for the widgets.', 'wixi' ),
                'id' => 'sdbr_wp',
                'type' => 'color',
                'output' => array( '.nt-sidebar .nt-sidebar-inner-widget, .nt-sidebar .nt-sidebar-inner-widget p' )
            ),
            array(
                'title' => esc_html__( 'Widget Link Color', 'wixi' ),
                'desc' => esc_html__( 'Set your own colors for the widgets.', 'wixi' ),
                'id' => 'sdbr_a',
                'type' => 'color',
                'output' => array( '.nt-sidebar .nt-sidebar-inner-widget a' )
            ),
            array(
                'title' => esc_html__( 'Widget Hover Link Color', 'wixi' ),
                'desc' => esc_html__( 'Set your own hover colors for the widgets.', 'wixi' ),
                'id' => 'sdbr_hvr_a',
                'type' => 'color',
                'output' => array( '.nt-sidebar .nt-sidebar-inner-widget a:hover' )
            ),
            array(
                'title' => esc_html__( 'Widget Padding', 'wixi' ),
                'id' => 'sdbr_w_pad',
                'type' => 'spacing',
                'mode' => 'padding',
                'all' => false,
                'units' => array( 'em', 'px', '%' ),
                'units_extended' => 'true',
                'output' => array( '.nt-sidebar .nt-sidebar-inner-widget' ),
                'default' => array(
                    'margin-top' => '',
                    'margin-right' => '',
                    'margin-bottom' => '',
                    'margin-left' => ''
                )
            ),
            array(
                'title' => esc_html__( 'Widget Margin', 'wixi' ),
                'id' => 'sdbr_w_mar',
                'type' => 'spacing',
                'mode' => 'margin',
                'all' => false,
                'units' => array( 'em', 'px', '%' ),
                'units_extended' => 'true',
                'output' => array( '.nt-sidebar .nt-sidebar-inner-widget' ),
                'default' => array(
                    'margin-top' => '',
                    'margin-right' => '',
                    'margin-bottom' => '',
                    'margin-left' => ''
                )
            )
    )));
    /*************************************************
    ## DEFAULT PAGE SECTION
    *************************************************/
    Redux::setSection($wixi_pre, array(
        'title' => esc_html__( 'Default Page', 'wixi' ),
        'id' => 'defaultpagesection',
        'icon' => 'el el-home',
    ));
    // BLOG HERO SUBSECTION
    Redux::setSection($wixi_pre, array(
        'title' => esc_html__( 'Page Hero', 'wixi' ),
        'desc' => esc_html__( 'These are default page hero text settings!', 'wixi' ),
        'id' => 'pageherosubsection',
        'subsection' => true,
        'icon' => 'el el-brush',
        'fields' => array(
            array(
                'title' => esc_html__( 'Hero Display', 'wixi' ),
                'subtitle' => esc_html__( 'You can enable or disable the site blog index page hero section with switch option.', 'wixi' ),
                'id' => 'page_hero_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off'
            ),
            array(
                'title' => esc_html__( 'Hero Background', 'wixi' ),
                'id' => 'page_hero_bg',
                'type' => 'background',
                'preview' => true,
                'preview_media' => true,
                'output' => array( '.nt-page-layout .page-header' ),
                'default' => array(
                    'background-position' => 'center'
                ),
                'required' => array( 'page_hero_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Page Title Typography', 'wixi' ),
                'id' => 'page_title_typo',
                'type' => 'typography',
                'font-backup' => false,
                'letter-spacing' => true,
                'text-transform' => true,
                'all_styles' => true,
                'output' => array( '.nt-page-layout .nt-hero-title' ),
                'default' => array(
                    'color' => '',
                    'font-style' => '',
                    'font-family' => '',
                    'google' => true,
                    'font-size' => '',
                    'line-height' => ''
                ),
                'required' => array( 'page_hero_visibility', '=', '1' ),
            ),
            array(
                'title' => esc_html__( 'Page Big Title Typography', 'wixi' ),
                'id' => 'page_stroke_title_typo',
                'type' => 'typography',
                'font-backup' => false,
                'letter-spacing' => true,
                'text-transform' => true,
                'all_styles' => true,
                'output' => array( '.nt-page-layout .page-header .text-bg' ),
                'default' => array(
                    'color' => '',
                    'font-style' => '',
                    'font-family' => '',
                    'google' => true,
                    'font-size' => '',
                    'line-height' => ''
                ),
                'required' => array( 'page_hero_visibility', '=', '1' ),
            ),
            array(
                'title' => esc_html__( 'Big Title Stroke Color', 'wixi' ),
                'desc' => esc_html__( 'Set your own colors for the big title.', 'wixi' ),
                'id' => 'page_big_title_stroke_clr',
                'type' => 'color',
                'mode' => '-webkit-text-stroke-color',
                'output' => array( '.nt-page-layout .page-header .text-bg' ),
                'required' => array( 'page_hero_visibility', '=', '1' ),
            ),
            array(
                'title' => esc_html__( 'Big Title Top Offset', 'wixi' ),
                'subtitle' => esc_html__( 'You can control page big title top offset.', 'wixi' ),
                'id' => 'page_big_title_top_pos',
                'type' => 'spacing',
                'output' => array('.nt-page-layout .page-header .text-bg'),
                'mode' => 'absolute',
                'units' => array('px'),
                'all' => false,
                'top' => true,
                'right' => false,
                'bottom' => false,
                'left' => false,
                'default' => array(
                    'top' => '60',
                    'units' => 'px'
                ),
                'required' => array( 'page_hero_visibility', '=', '1' ),
            ),
    )));
    /*************************************************
    ## BLOG PAGE SECTION
    *************************************************/
    Redux::setSection($wixi_pre, array(
        'title' => esc_html__( 'Blog Page', 'wixi' ),
        'id' => 'blogsection',
        'icon' => 'el el-home',
    ));
    // BLOG HERO SUBSECTION
    Redux::setSection($wixi_pre, array(
        'title' => esc_html__( 'Blog Hero', 'wixi' ),
        'desc' => esc_html__( 'These are blog index page hero text settings!', 'wixi' ),
        'id' => 'blogherosubsection',
        'subsection' => true,
        'icon' => 'el el-brush',
        'fields' => array(
            array(
                'title' => esc_html__( 'Blog Hero Display', 'wixi' ),
                'subtitle' => esc_html__( 'You can enable or disable the site blog index page hero section with switch option.', 'wixi' ),
                'id' => 'blog_hero_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off'
            ),
            array(
                'title' => esc_html__( 'Blog Hero Background', 'wixi' ),
                'id' => 'blog_hero_bg',
                'type' => 'background',
                'preview' => true,
                'preview_media' => true,
                'output' => array( '#nt-index .page-header' ),
                'default' => array(
                    'background-position' => 'center'
                ),
                'required' => array( 'blog_hero_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Blog Big Title Typography', 'wixi' ),
                'id' => 'blog_stroke_title_typo',
                'type' => 'typography',
                'font-backup' => false,
                'letter-spacing' => true,
                'text-transform' => true,
                'all_styles' => true,
                'output' => array( '#nt-index .page-header .text-bg' ),
                'default' => array(
                    'color' => '',
                    'font-style' => '',
                    'font-family' => '',
                    'google' => true,
                    'font-size' => '',
                    'line-height' => ''
                ),
                'required' => array( 'blog_hero_visibility', '=', '1' ),
            ),
            array(
                'title' => esc_html__( 'Big Title Stroke Color', 'wixi' ),
                'desc' => esc_html__( 'Set your own colors for the big title.', 'wixi' ),
                'id' => 'blog_big_title_stroke_clr',
                'type' => 'color',
                'mode' => '-webkit-text-stroke-color',
                'output' => array( '#nt-index .page-header .text-bg' ),
                'required' => array( 'blog_hero_visibility', '=', '1' ),
            ),
            array(
                'title' => esc_html__( 'Big Title Top Offset', 'wixi' ),
                'subtitle' => esc_html__( 'You can control blog big title top offset.', 'wixi' ),
                'id' => 'blog_big_title_top_pos',
                'type' => 'spacing',
                'output' => array('#nt-index .page-header .text-bg'),
                'mode' => 'absolute',
                'units' => array('px'),
                'all' => false,
                'top' => true,
                'right' => false,
                'bottom' => false,
                'left' => false,
                'default' => array(
                    'top' => '60',
                    'units' => 'px'
                ),
                'required' => array( 'blog_hero_visibility', '=', '1' ),
            ),
            array(
                'title' => esc_html__( 'Blog Title', 'wixi' ),
                'subtitle' => esc_html__( 'Add your blog index page title here.', 'wixi' ),
                'id' => 'blog_title',
                'type' => 'text',
                'default' => 'BLOG',
                'required' => array( 'blog_hero_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Blog Title Typography', 'wixi' ),
                'id' => 'blog_title_typo',
                'type' => 'typography',
                'font-backup' => false,
                'letter-spacing' => true,
                'text-transform' => true,
                'all_styles' => true,
                'output' => array( '#nt-index .nt-hero-title' ),
                'default' => array(
                    'color' => '',
                    'font-style' => '',
                    'font-family' => '',
                    'google' => true,
                    'font-size' => '',
                    'line-height' => ''
                ),
                'required' => array( 'blog_hero_visibility', '=', '1' ),
            ),
            array(
                'title' => esc_html__( 'Blog Site Title', 'wixi' ),
                'subtitle' => esc_html__( 'Add your blog index page site title here.', 'wixi' ),
                'id' => 'blog_site_title',
                'type' => 'textarea',
                'default' => get_bloginfo('name' ),
                'required' => array( 'blog_hero_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Blog Site Title Typography', 'wixi' ),
                'id' => 'blog_site_title_typo',
                'type' => 'typography',
                'font-backup' => false,
                'letter-spacing' => true,
                'text-transform' => true,
                'all_styles' => true,
                'output' => array( '#nt-index .nt-hero-desc' ),
                'default' => array(
                    'color' => '',
                    'font-style' => '',
                    'font-family' => '',
                    'google' => true,
                    'font-size' => '',
                    'line-height' => ''
                ),
                'required' => array( 'blog_hero_visibility', '=', '1' )
            )
    )));
    // BLOG LAYOUT AND POST COLUMN STYLE
    Redux::setSection($wixi_pre, array(
        'title' => esc_html__( 'Blog Content', 'wixi' ),
        'id' => 'blogcontentsubsection',
        'subsection' => true,
        'icon' => 'el el-brush',
        'fields' => array(
            array(
                'title' => esc_html__( 'Blog page type', 'wixi' ),
                'subtitle' => esc_html__( 'Select blog page layout type.', 'wixi' ),
                'id' => 'index_type',
                'type' => 'select',
                'customizer' => true,
                'options' => array(
                    '' => esc_html__( 'Select type', 'wixi' ),
                    'default' => esc_html__( 'default', 'wixi' ),
                    'grid' => esc_html__( 'grid', 'wixi' ),
                ),
                'default' => 'default'
            ),
            array(
                'title' => esc_html__( 'Blog page container width type', 'wixi' ),
                'subtitle' => esc_html__( 'Select blog page container width type.', 'wixi' ),
                'id' => 'index_container_type',
                'type' => 'select',
                'customizer' => true,
                'options' => array(
                    '' => esc_html__( 'Select type', 'wixi' ),
                    'boxed' => esc_html__( 'Default Boxed', 'wixi' ),
                    'fluid' => esc_html__( 'Fluid', 'wixi' ),
                ),
                'default' => 'boxed'
            ),
            array(
                'title' => esc_html__( 'Blog page post column width', 'wixi' ),
                'subtitle' => esc_html__( 'Select a column number.', 'wixi' ),
                'id' => 'index_post_column',
                'type' => 'select',
                'customizer' => true,
                'options' => array(
                    '' => esc_html__( 'Select type', 'wixi' ),
                    'col-lg-6' => esc_html__( '2 column', 'wixi' ),
                    'col-lg-4' => esc_html__( '3 column', 'wixi' )
                ),
                'default' => 'col-lg-6',
                'required' => array( 'index_type', '=', 'grid' )
            ),
            array(
                'title' => esc_html__( 'Blog Post Title Display', 'wixi' ),
                'subtitle' => esc_html__( 'You can enable or disable the site blog index page post title with switch option.', 'wixi' ),
                'id' => 'post_title_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off'
            ),
            array(
                'title' => esc_html__( 'Blog Post Author Display', 'wixi' ),
                'subtitle' => esc_html__( 'You can enable or disable the site blog index page post author with switch option.', 'wixi' ),
                'id' => 'post_author_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off'
            ),
            array(
                'title' => esc_html__( 'Blog Post Tags Display', 'wixi' ),
                'subtitle' => esc_html__( 'You can enable or disable the site blog index page post tags with switch option.', 'wixi' ),
                'id' => 'post_tags_visibility',
                'type' => 'switch',
                'default' => 0,
                'on' => 'On',
                'off' => 'Off'
            ),
            array(
                'title' => esc_html__( 'Blog Post Date Display', 'wixi' ),
                'subtitle' => esc_html__( 'You can enable or disable the site blog index page post date with switch option.', 'wixi' ),
                'id' => 'post_date_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off',
            ),
            array(
                'title' => esc_html__( 'Blog Post Excerpt Display', 'wixi' ),
                'subtitle' => esc_html__( 'You can enable or disable the site blog index page post meta with switch option.', 'wixi' ),
                'id' => 'post_excerpt_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off'
            ),
            array(
                'title' => esc_html__( 'Post Excerpt Size (max word count)', 'wixi' ),
                'subtitle' => esc_html__( 'You can control blog post excerpt size with this option.', 'wixi' ),
                'id' => 'excerptsz',
                'type' => 'slider',
                'default' => 70,
                'min' => 0,
                'step' => 1,
                'max' => 100,
                'display_value' => 'text',
                'required' => array( 'post_excerpt_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Blog Post Button Display', 'wixi' ),
                'subtitle' => esc_html__( 'You can enable or disable the site blog index page post read more button wityh switch option.', 'wixi' ),
                'id' => 'post_button_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off'
            ),
            array(
                'title' => esc_html__( 'Blog Post Button Title', 'wixi' ),
                'subtitle' => esc_html__( 'Add your blog post read more button title here.', 'wixi' ),
                'id' => 'post_button_title',
                'type' => 'text',
                'default' => esc_html__( 'Read More', 'wixi' ),
                'required' => array( 'post_button_visibility', '=', '1' )
            )
    )));

    /*************************************************
    ## SINGLE PAGE SECTION
    *************************************************/
    Redux::setSection($wixi_pre, array(
        'title' => esc_html__( 'Single Page', 'wixi' ),
        'id' => 'singlesection',
        'icon' => 'el el-home-alt',
    ));
    // SINGLE HERO SUBSECTION
    Redux::setSection($wixi_pre, array(
        'title' => esc_html__( 'Single Hero', 'wixi' ),
        'desc' => esc_html__( 'These are single page hero section settings!', 'wixi' ),
        'id' => 'singleherosubsection',
        'subsection' => true,
        'icon' => 'el el-brush',
        'fields' => array(
            array(
                'title' => esc_html__( 'Single Hero display', 'wixi' ),
                'subtitle' => esc_html__( 'You can enable or disable the site single page hero section with switch option.', 'wixi' ),
                'id' => 'single_hero_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off',
            ),
            array(
                'title' => esc_html__( 'Use Elementor Template For Single Hero?', 'wixi' ),
                'subtitle' => esc_html__( 'Please open this option, If you want to use elementor template instead of the default single hero section.', 'wixi' ),
                'id' => 'use_elementor_for_single_hero',
                'type' => 'switch',
                'default' => 0,
                'on' => 'On',
                'off' => 'Off',
            ),
            array(
                'title' => esc_html__( 'Elementor Templates', 'wixi' ),
                'subtitle' => esc_html__( 'Select a template from elementor templates.', 'wixi' ),
                'id' => 'single_hero_elementor_templates',
                'type' => 'select',
                'customizer' => true,
                'options' => wixi_get_elementorTemplates(),
                'required' => array(
                    array( 'single_hero_visibility', '=', '1' ),
                    array( 'use_elementor_for_single_hero', '=', '1' )
                )
            ),
            array(
                'title' => esc_html__( 'Single Hero Background', 'wixi' ),
                'id' => 'single_hero_bg',
                'type' => 'background',
                'output' => array( '#nt-single .page-header' ),
                'required' => array(
                    array( 'single_hero_visibility', '=', '1' ),
                    array( 'use_elementor_for_single_hero', '=', '0' )
                )
            ),
            array(
                'title' => esc_html__( 'Single Title Typography', 'wixi' ),
                'id' => 'single_title_typo',
                'type' => 'typography',
                'font-backup' => false,
                'letter-spacing' => true,
                'text-transform' => true,
                'all_styles' => true,
                'output' => array( '#nt-single .page-header h2' ),
                'units' => 'px',
                'default' => array(
                    'color' => '',
                    'font-style' => '',
                    'font-family' => '',
                    'google' => true,
                    'font-size' => '',
                    'line-height' => ''
                ),
                'required' => array(
                    array( 'single_hero_visibility', '=', '1' ),
                    array( 'use_elementor_for_single_hero', '=', '0' )
                )
            ),
            array(
                'title' => esc_html__( 'Hero Post Meta Display', 'wixi' ),
                'subtitle' => esc_html__( 'You can enable or disable the site single page post meta tags with switch option.', 'wixi' ),
                'id' => 'single_hero_postmeta_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off',
                'required' => array(
                    array( 'single_hero_visibility', '=', '1' ),
                    array( 'use_elementor_for_single_hero', '=', '0' )
                )
            ),
            array(
                'title' => esc_html__( 'Hero Post Meta Typography', 'wixi' ),
                'id' => 'single_site_meta_typo',
                'type' => 'typography',
                'font-backup' => false,
                'letter-spacing' => true,
                'text-transform' => true,
                'all_styles' => true,
                'output' => array( '#nt-single .cont-inner .info p,#nt-single .cont-inner .info a' ),
                'default' => array(
                    'color' => '',
                    'font-style' => '',
                    'font-family' => '',
                    'google' => true,
                    'font-size' => '',
                    'line-height' => ''
                ),
                'required' => array(
                    array( 'single_hero_visibility', '=', '1' ),
                    array( 'use_elementor_for_single_hero', '=', '0' ),
                    array( 'single_hero_postmeta_visibility', '=', '1' )
                )
            )
    )));
    // SINGLE CONTENT SUBSECTION
    Redux::setSection($wixi_pre, array(
        'title' => esc_html__( 'Single Content', 'wixi' ),
        'id' => 'singlecontentsubsection',
        'subsection' => true,
        'icon' => 'el el-brush',
        'fields' => array(
            array(
                'title' => esc_html__( 'Single Post Tags Display', 'wixi' ),
                'subtitle' => esc_html__( 'You can enable or disable the site single page post meta tags with switch option.', 'wixi' ),
                'id' => 'single_postmeta_tags_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off'
            ),
            array(
                'title' => esc_html__( 'Single Post Authorbox', 'wixi' ),
                'subtitle' => esc_html__( 'You can enable or disable the site single page post authorbox with switch option.', 'wixi' ),
                'id' => 'single_post_author_box_visibility',
                'type' => 'switch',
                'default' => 0,
                'on' => 'On',
                'off' => 'Off'
            ),
            array(
                'title' => esc_html__( 'Single Post Pagination Display', 'wixi' ),
                'subtitle' => esc_html__( 'You can enable or disable the site single page post next and prev pagination with switch option.', 'wixi' ),
                'id' => 'single_navigation_visibility',
                'type' => 'switch',
                'default' => 0,
                'on' => 'On',
                'off' => 'Off'
            ),
            array(
                'title' => esc_html__( 'Single Related Post Display', 'wixi' ),
                'subtitle' => esc_html__( 'You can enable or disable the site single page related post with switch option.', 'wixi' ),
                'id' => 'single_related_visibility',
                'type' => 'switch',
                'default' => 0,
                'on' => 'On',
                'off' => 'Off'
            ),
            array(
                'id' => 'related_section_heading_start',
                'type' => 'section',
                'title' => esc_html__('Section Heading', 'wixi'),
                'indent' => true
            ),
            array(
                'title' => esc_html__( 'Related Section Subtitle', 'wixi' ),
                'subtitle' => esc_html__( 'Add your single page related post section subtitle here.', 'wixi' ),
                'id' => 'related_subtitle',
                'type' => 'text',
                'default' => esc_html__( 'Awesome Work', 'wixi' ),
                'required' => array( 'single_related_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Subtitle Tag', 'wixi' ),
                'id' => 'related_subtitle_tag',
                'type' => 'select',
                'customizer' => true,
                'options' => array(
                    '' => esc_html__( 'Select type', 'wixi' ),
                    'h1' => esc_html__( 'H1', 'wixi' ),
                    'h2' => esc_html__( 'H2', 'wixi' ),
                    'h3' => esc_html__( 'H3', 'wixi' ),
                    'h4' => esc_html__( 'H4', 'wixi' ),
                    'h5' => esc_html__( 'H5', 'wixi' ),
                    'h6' => esc_html__( 'H6', 'wixi' ),
                    'p' => esc_html__( 'p', 'wixi' ),
                    'div' => esc_html__( 'div', 'wixi' ),
                    'span' => esc_html__( 'span', 'wixi' ),
                ),
                'default' => 'h6',
                'required' => array(
                    array( 'single_related_visibility', '=', '1' ),
                    array( 'related_subtitle', '!=', '' )
                ),
            ),
            array(
                'title' => esc_html__( 'Subtitle Typography', 'wixi' ),
                'id' => 'related_subtitle_typo',
                'type' => 'typography',
                'font-backup' => false,
                'letter-spacing' => true,
                'text-transform' => true,
                'all_styles' => true,
                'output' => array( '.nt-related-post .section-head .subtitle' ),
                'default' => array(
                    'color' => '',
                    'font-style' => '',
                    'font-family' => '',
                    'google' => true,
                    'font-size' => '',
                    'line-height' => ''
                ),
                'required' => array(
                    array( 'single_related_visibility', '=', '1' ),
                    array( 'related_subtitle', '!=', '' )
                ),
            ),
            array(
                'title' => esc_html__( 'Related Section Title', 'wixi' ),
                'subtitle' => esc_html__( 'Add your single page related post section title here.', 'wixi' ),
                'id' => 'related_title',
                'type' => 'text',
                'default' => esc_html__( 'Related Post', 'wixi' ),
                'required' => array( 'single_related_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Title Tag', 'wixi' ),
                'id' => 'related_title_tag',
                'type' => 'select',
                'customizer' => true,
                'options' => array(
                    '' => esc_html__( 'Select type', 'wixi' ),
                    'h1' => esc_html__( 'H1', 'wixi' ),
                    'h2' => esc_html__( 'H2', 'wixi' ),
                    'h3' => esc_html__( 'H3', 'wixi' ),
                    'h4' => esc_html__( 'H4', 'wixi' ),
                    'h5' => esc_html__( 'H5', 'wixi' ),
                    'h6' => esc_html__( 'H6', 'wixi' ),
                    'p' => esc_html__( 'p', 'wixi' ),
                    'div' => esc_html__( 'div', 'wixi' ),
                    'span' => esc_html__( 'span', 'wixi' ),
                ),
                'default' => 'h3',
                'required' => array(
                    array( 'single_related_visibility', '=', '1' ),
                    array( 'related_title', '!=', '' )
                ),
            ),
            array(
                'title' => esc_html__( 'Title Typography', 'wixi' ),
                'id' => 'related_title_typo',
                'type' => 'typography',
                'font-backup' => false,
                'letter-spacing' => true,
                'text-transform' => true,
                'all_styles' => true,
                'output' => array( '.nt-related-post .section-head .title' ),
                'default' => array(
                    'color' => '',
                    'font-style' => '',
                    'font-family' => '',
                    'google' => true,
                    'font-size' => '',
                    'line-height' => ''
                ),
                'required' => array(
                    array( 'single_related_visibility', '=', '1' ),
                    array( 'related_title', '!=', '' )
                ),
            ),
            array(
                'id' => 'related_section_heading_end',
                'type' => 'section',
                'indent' => false
            ),
            array(
                'id' => 'related_section_posts_start',
                'type' => 'section',
                'title' => esc_html__('Post Options', 'wixi'),
                'indent' => true
            ),
            array(
                'title' => esc_html__( 'Posts Perpage', 'wixi' ),
                'subtitle' => esc_html__( 'You can control related post count with this option.', 'wixi' ),
                'id' => 'related_perpage',
                'type' => 'slider',
                'default' => 3,
                'min' => 1,
                'step' => 1,
                'max' => 24,
                'display_value' => 'text',
                'required' => array( 'single_related_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Post Image Size', 'wixi' ),
                'id' => 'related_imgsize',
                'type' => 'select',
                'data' => 'image_sizes',
                'required' => array( 'single_related_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Custom Post Image Size', 'wixi' ),
                'id'       => 'related_custom_imgsize',
                'type'     => 'dimensions',
                'units'    => false,
                'required' => array(
                    array( 'single_related_visibility', '=', '1' ),
                    array( 'related_imgsize', '=', '' )
                ),
            ),
            array(
                'title' => esc_html__( 'Post Excerpt Display', 'wixi' ),
                'id' => 'related_excerpt_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off',
                'required' => array( 'single_related_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Post Excerpt Limit', 'wixi' ),
                'subtitle' => esc_html__( 'You can control related post excerpt word limit.', 'wixi' ),
                'id' => 'related_excerpt_limit',
                'type' => 'slider',
                'default' => 30,
                'min' => 0,
                'step' => 1,
                'max' => 100,
                'display_value' => 'text',
                'required' => array(
                    array( 'single_related_visibility', '=', '1' ),
                    array( 'related_excerpt_visibility', '=', '1' ),
                )
            ),
            array(
                'title' => esc_html__( 'Post Button Title', 'wixi' ),
                'id' => 'related_btntitle',
                'type' => 'text',
                'default' => esc_html__( 'Read More', 'wixi' ),
                'required' => array( 'single_related_visibility', '=', '1' )
            ),
            array(
                'id' => 'related_section_posts_end',
                'type' => 'section',
                'indent' => false
            ),
            array(
                'id' => 'related_section_slider_start',
                'type' => 'section',
                'title' => esc_html__('Slider Options', 'wixi'),
                'indent' => true
            ),
            array(
                'title' => esc_html__( 'Perview ( Min 1200px )', 'wixi' ),
                'subtitle' => esc_html__( 'You can control related post slider item count for big device with this option.', 'wixi' ),
                'id' => 'related_perview',
                'type' => 'slider',
                'default' => 5,
                'min' => 1,
                'step' => 1,
                'max' => 10,
                'display_value' => 'text',
                'required' => array( 'single_related_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Slider Perview ( Min 992px )', 'wixi' ),
                'subtitle' => esc_html__( 'You can control related post slider item count for big device with this option.', 'wixi' ),
                'id' => 'related_mdperview',
                'type' => 'slider',
                'default' => 3,
                'min' => 1,
                'step' => 1,
                'max' => 10,
                'display_value' => 'text',
                'required' => array( 'single_related_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Perview ( Min 768px )', 'wixi' ),
                'subtitle' => esc_html__( 'You can control related post slider item count for big device with this option.', 'wixi' ),
                'id' => 'related_smperview',
                'type' => 'slider',
                'default' => 3,
                'min' => 1,
                'step' => 1,
                'max' => 10,
                'display_value' => 'text',
                'required' => array( 'single_related_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Perview ( Min 480px )', 'wixi' ),
                'subtitle' => esc_html__( 'You can control related post slider item count for big device with this option.', 'wixi' ),
                'id' => 'related_xsperview',
                'type' => 'slider',
                'default' => 2,
                'min' => 1,
                'step' => 1,
                'max' => 10,
                'display_value' => 'text',
                'required' => array( 'single_related_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Speed', 'wixi' ),
                'subtitle' => esc_html__( 'You can control related post slider item gap.', 'wixi' ),
                'id' => 'related_speed',
                'type' => 'slider',
                'default' => 1000,
                'min' => 100,
                'step' => 1,
                'max' => 10000,
                'display_value' => 'text',
                'required' => array( 'single_related_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Gap', 'wixi' ),
                'subtitle' => esc_html__( 'You can control related post slider item gap.', 'wixi' ),
                'id' => 'related_gap',
                'type' => 'slider',
                'default' => 30,
                'min' => 0,
                'step' => 1,
                'max' => 100,
                'display_value' => 'text',
                'required' => array( 'single_related_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Centered', 'wixi' ),
                'id' => 'related_centered',
                'type' => 'switch',
                'default' => 0,
                'on' => 'On',
                'off' => 'Off',
                'required' => array( 'single_related_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Autoplay', 'wixi' ),
                'id' => 'related_autoplay',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off',
                'required' => array( 'single_related_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Loop', 'wixi' ),
                'id' => 'related_loop',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off',
                'required' => array( 'single_related_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Mousewheel', 'wixi' ),
                'id' => 'related_mousewheel',
                'type' => 'switch',
                'default' => 0,
                'on' => 'On',
                'off' => 'Off',
                'required' => array( 'single_related_visibility', '=', '1' )
            ),
            array(
                'id' => 'related_section_slider_end',
                'type' => 'section',
                'indent' => false
            ),
    )));
    /*************************************************
    ## ARCHIVE PAGE SECTION
    *************************************************/
    Redux::setSection($wixi_pre, array(
        'title' => esc_html__( 'Archive Page', 'wixi' ),
        'id' => 'archivesection',
        'icon' => 'el el-folder-open',
    ));
    // ARCHIVE PAGE SECTION
    Redux::setSection($wixi_pre, array(
        'title' => esc_html__( 'Archive Hero', 'wixi' ),
        'desc' => esc_html__( 'These are archive page hero settings!', 'wixi' ),
        'id' => 'archiveherosubsection',
        'subsection' => true,
        'icon' => 'el el-brush',
        'fields' => array(
            array(
                'title' => esc_html__( 'Archive Hero display', 'wixi' ),
                'subtitle' => esc_html__( 'You can enable or disable the site archive page hero section with switch option.', 'wixi' ),
                'id' => 'archive_hero_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off',
            ),
            array(
                'title' => esc_html__( 'Archive Hero Background', 'wixi' ),
                'id' => 'archive_hero_bg',
                'type' => 'background',
                'output' => array( '#nt-archive .page-header' ),
                'required' => array( 'archive_hero_visibility', '=', '1' ),
            ),
            array(
                'title' => esc_html__( 'Custom Archive Title', 'wixi' ),
                'subtitle' => esc_html__( 'Add your custom archive page title here.', 'wixi' ),
                'id' => 'archive_title',
                'type' => 'text',
                'default' => esc_html__( 'ARCHIVE', 'wixi' ),
                'required' => array( 'archive_hero_visibility', '=', '1' ),
            ),
            array(
                'title' => esc_html__( 'Archive Title Typography', 'wixi' ),
                'id' => 'archive_title_typo',
                'type' => 'typography',
                'font-backup' => false,
                'letter-spacing' => true,
                'text-transform' => true,
                'all_styles' => true,
                'output' => array( '#nt-archive .nt-hero-title' ),
                'default' => array(
                    'color' => '',
                    'font-style' => '',
                    'font-family' => '',
                    'google' => true,
                    'font-size' => '',
                    'line-height' => ''
                ),
                'required' => array( 'archive_hero_visibility', '=', '1' ),
            ),
            array(
                'title' => esc_html__( 'Archive Site Title', 'wixi' ),
                'subtitle' => esc_html__( 'Add your archive page site title here.', 'wixi' ),
                'id' => 'archive_site_title',
                'type' => 'textarea',
                'default' => get_bloginfo('name' ),
                'required' => array( 'archive_hero_visibility', '=', '1' ),
            ),
            array(
                'title' => esc_html__( 'Archive Site Title Typography', 'wixi' ),
                'id' => 'archive_site_title_typo',
                'type' => 'typography',
                'font-backup' => false,
                'letter-spacing' => true,
                'text-transform' => true,
                'all_styles' => true,
                'output' => array( '#nt-archive .nt-hero-desc' ),
                'default' => array(
                    'color' => '',
                    'font-style' => '',
                    'font-family' => '',
                    'google' => true,
                    'font-size' => '',
                    'line-height' => ''
                ),
                'required' => array( 'archive_hero_visibility', '=', '1' ),
            )
    )));
    /*************************************************
    ## 404 PAGE SECTION
    *************************************************/
    Redux::setSection($wixi_pre, array(
        'title' => esc_html__( '404 Page', 'wixi' ),
        'id' => 'errorsection',
        'icon' => 'el el-error',
        'fields' => array(
            array(
                'title' => esc_html__( '404 Type', 'wixi' ),
                'subtitle' => esc_html__( 'Select your 404 page type.', 'wixi' ),
                'id' => 'error_page_type',
                'type' => 'select',
                'customizer' => true,
                'options' => array(
                    'default' => esc_html__( 'Deafult', 'wixi' ),
                    'elementor' => esc_html__( 'Elementor Templates', 'wixi' ),
                ),
                'default' => 'default'
            ),
            array(
                'title' => esc_html__( 'Elementor Templates', 'wixi' ),
                'subtitle' => esc_html__( 'Select a template from elementor templates.', 'wixi' ),
                'id' => 'error_page_elementor_templates',
                'type' => 'select',
                'customizer' => true,
                'options' => wixi_get_elementorTemplates(),
                'required' => array( 'error_page_type', '=', 'elementor' )
            ),
            array(
                'title' => esc_html__( '404 Background', 'wixi' ),
                'id' => 'error_content_bg_img',
                'type' => 'background',
                'output' => array( '#nt-404 .call-action:before' ),
                'required' => array( 'error_page_type', '=', 'default' )
            ),
            array(
                'title' => esc_html__( 'Content Title Display', 'wixi' ),
                'subtitle' => esc_html__( 'You can enable or disable the site 404 page content title with switch option.', 'wixi' ),
                'id' => 'error_content_subtitle_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off',
                'required' => array( 'error_page_type', '=', 'default' )
            ),
            array(
                'title' => esc_html__( 'Content Subtitle', 'wixi' ),
                'subtitle' => esc_html__( 'Add your 404 page content subtitle here.', 'wixi' ),
                'id' => 'error_content_subtitle',
                'type' => 'textarea',
                'default' => '<h6>page not found</h6>',
                'required' => array(
                    array( 'error_page_type', '=', 'default' ),
                    array( 'error_content_subtitle_visibility', '=', '1' ),
                )
            ),
            array(
                'title' => esc_html__( 'Subtitle Typography', 'wixi' ),
                'id' => 'error_content_subtitle_typo',
                'type' => 'typography',
                'font-backup' => false,
                'letter-spacing' => true,
                'text-transform' => true,
                'all_styles' => true,
                'output' => array( '#nt-404 .content h6' ),
                'default' => array(
                    'color' => '',
                    'font-style' => '',
                    'font-family' => '',
                    'google' => true,
                    'font-size' => '',
                    'line-height' => ''
                ),
                'required' => array(
                    array( 'error_page_type', '=', 'default' ),
                    array( 'error_content_subtitle_visibility', '=', '1' ),
                )
            ),
            array(
                'title' => esc_html__( 'Content Title Display', 'wixi' ),
                'subtitle' => esc_html__( 'You can enable or disable the site 404 page content title with switch option.', 'wixi' ),
                'id' => 'error_content_title_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off',
                'required' => array( 'error_page_type', '=', 'default' )
            ),
            array(
                'title' => esc_html__( 'Content Title', 'wixi' ),
                'subtitle' => esc_html__( 'Add your 404 page content title here.', 'wixi' ),
                'id' => 'error_content_title',
                'type' => 'textarea',
                'default' => '<h2>404 <b>Page</b> .</h2>',
                'required' => array(
                    array( 'error_page_type', '=', 'default' ),
                    array( 'error_content_title_visibility', '=', '1' ),
                )
            ),
            array(
                'title' => esc_html__( 'Title Typography', 'wixi' ),
                'id' => 'error_content_title_typo',
                'type' => 'typography',
                'font-backup' => false,
                'letter-spacing' => true,
                'text-transform' => true,
                'all_styles' => true,
                'output' => array( '#nt-404 .content h2' ),
                'default' => array(
                    'color' => '',
                    'font-style' => '',
                    'font-family' => '',
                    'google' => true,
                    'font-size' => '',
                    'line-height' => ''
                ),
                'required' => array(
                    array( 'error_page_type', '=', 'default' ),
                    array( 'error_content_title_visibility', '=', '1' ),
                )
            ),
            array(
                'title' => esc_html__( 'Content Description Display', 'wixi' ),
                'subtitle' => esc_html__( 'You can enable or disable the site 404 page content description with switch option.', 'wixi' ),
                'id' => 'error_content_desc_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off',
                'required' => array( 'error_page_type', '=', 'default' )
            ),
            array(
                'title' => esc_html__( 'Content Description', 'wixi' ),
                'subtitle' => esc_html__( 'Add your 404 page content description here.', 'wixi' ),
                'id' => 'error_content_desc',
                'type' => 'textarea',
                'default' => 'Sorry, but the page you are looking for does not exist or has been removed',
                'required' => array(
                    array( 'error_page_type', '=', 'default' ),
                    array( 'error_content_desc_visibility', '=', '1' ),
                )
            ),
            array(
                'title' =>esc_html__( 'Description Typography', 'wixi' ),
                'id' => 'error_page_content_desc_typo',
                'type' => 'typography',
                'font-backup' => false,
                'letter-spacing' => true,
                'text-transform' => true,
                'all_styles' => true,
                'output' => array( '#nt-404 .content p' ),
                'default' => array(
                    'color' =>'',
                    'font-style' => '',
                    'font-family' => '',
                    'google' => true,
                    'font-size' => '',
                    'line-height' => ''
                ),
                'required' => array(
                    array( 'error_page_type', '=', 'default' ),
                    array( 'error_content_desc_visibility', '=', '1' ),
                )
            ),
            array(
                'title' => esc_html__( 'Button Display', 'wixi' ),
                'subtitle' => esc_html__( 'You can enable or disable the site 404 page content back to home button with switch option.', 'wixi' ),
                'id' => 'error_content_btn_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off',
                'required' => array( 'error_page_type', '=', 'default' )
            ),
            array(
                'title' => esc_html__( 'Button Title', 'wixi' ),
                'subtitle' => esc_html__( 'Add your 404 page content back to home button title here.', 'wixi' ),
                'id' => 'error_content_btn_title',
                'type' => 'text',
                'default' => 'Go to home page',
                'required' => array(
                    array( 'error_page_type', '=', 'default' ),
                    array( 'error_content_btn_visibility', '=', '1' ),
                )
            ),
            array(
                'title' => esc_html__( 'Search Form Display', 'wixi' ),
                'subtitle' => esc_html__( 'You can enable or disable the site 404 page content search form with switch option.', 'wixi' ),
                'id' => 'error_content_form_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off',
                'required' => array( 'error_page_type', '=', 'default' )
            ),
    )));
    /*************************************************
    ## SEARCH PAGE SECTION
    *************************************************/
    Redux::setSection($wixi_pre, array(
        'title' => esc_html__( 'Search Page', 'wixi' ),
        'id' => 'searchsection',
        'icon' => 'el el-search',
    ));
    //SEARCH PAGE SECTION
    Redux::setSection($wixi_pre, array(
        'title' => esc_html__( 'Search Hero', 'wixi' ),
        'id' => 'searchherosubsection',
        'desc' => esc_html__( 'These are main settings for general theme!', 'wixi' ),
        'icon' => 'el el-brush',
        'subsection' => true,
        'fields' => array(
            array(
                'title' => esc_html__( 'Search Hero display', 'wixi' ),
                'subtitle' => esc_html__( 'You can enable or disable the site search page hero section with switch option.', 'wixi' ),
                'id' => 'search_hero_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off'
            ),
            array(
                'title' => esc_html__( 'Search Hero Background', 'wixi' ),
                'id' =>'search_hero_bg',
                'type' => 'background',
                'output' => array( '#nt-search .page-header' ),
                'required' => array( 'search_hero_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Search Title', 'wixi' ),
                'subtitle' => esc_html__( 'Add your search page title here.', 'wixi' ),
                'id' => 'search_title',
                'type' => 'text',
                'default' => esc_html__( 'Search results for :', 'wixi' ),
                'required' => array( 'search_hero_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Search Title Typography', 'wixi' ),
                'id' => 'search_title_typo',
                'type' => 'typography',
                'font-backup' => false,
                'letter-spacing' => true,
                'text-transform' => true,
                'all_styles' => true,
                'output' => array( '#nt-search .nt-hero-title' ),
                'default' => array(
                    'color' => '',
                    'font-style' => '',
                    'font-family' => '',
                    'google' => true,
                    'font-size' => '',
                    'line-height' => ''
                ),
                'required' => array( 'search_hero_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Search Site Title', 'wixi' ),
                'subtitle' => esc_html__( 'Add your search page site title here.', 'wixi' ),
                'id' => 'search_site_title',
                'type' => 'textarea',
                'default' => get_bloginfo('name' ),
                'required' => array( 'search_hero_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Search Site Title Typography', 'wixi' ),
                'id' => 'search_site_title_typo',
                'type' => 'typography',
                'font-backup' => false,
                'letter-spacing' => true,
                'text-transform' => true,
                'all_styles' => true,
                'output' => array( '#nt-search .nt-hero-desc' ),
                'default' => array(
                    'color' => '',
                    'font-style' => '',
                    'font-family' => '',
                    'google' => true,
                    'font-size' => '',
                    'line-height' => ''
                ),
                'required' => array( 'search_hero_visibility', '=', '1' )
            )
    )));
    //FOOTER SECTION
    Redux::setSection($wixi_pre, array(
        'title' => esc_html__( 'Footer', 'wixi' ),
        'desc' => esc_html__( 'These are main settings for general theme!', 'wixi' ),
        'id' => 'footersection',
        'icon' => 'el el-photo',
        'fields' => array(
            array(
                'title' => esc_html__( 'Footer Section Display', 'wixi' ),
                'subtitle' => esc_html__( 'You can enable or disable the site footer copyright and footer widget area on the site with switch option.', 'wixi' ),
                'id' => 'footer_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off'
            ),
            array(
                'title' => esc_html__( 'Footer Type', 'wixi' ),
                'subtitle' => esc_html__( 'Select your footer type.', 'wixi' ),
                'id' => 'footer_type',
                'type' => 'select',
                'customizer' => true,
                'options' => array(
                    'default' => esc_html__( 'Deafult Site Footer', 'wixi' ),
                    'elementor' => esc_html__( 'Elementor Templates', 'wixi' ),
                ),
                'default' => 'default',
                'required' => array( 'footer_visibility', '=', '1' )
            ),
            array(
                'title' => esc_html__( 'Elementor Templates', 'wixi' ),
                'subtitle' => esc_html__( 'Select a template from elementor templates.', 'wixi' ),
                'id' => 'footer_elementor_templates',
                'type' => 'select',
                'customizer' => true,
                'options' => wixi_get_elementorTemplates(),
                'required' => array(
                    array( 'footer_visibility', '=', '1' ),
                    array( 'footer_type', '=', 'elementor' )
                )
            ),
            array(
                'title' => esc_html__( 'Copyright Left Section Display', 'wixi' ),
                'subtitle' => esc_html__( 'You can enable or disable the site footer left section on the site with switch option.', 'wixi' ),
                'id' => 'footer_copyright_left_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off',
                'required' => array(
                    array( 'footer_visibility', '=', '1' ),
                    array( 'footer_type', '=', 'default' )
                )
            ),
            array(
                'title' => esc_html__( 'Copyright Left Text', 'wixi' ),
                'subtitle' => esc_html__( 'HTML allowed (wp_kses)', 'wixi' ),
                'desc' => esc_html__( 'Enter your site copyright left text here.', 'wixi' ),
                'id' => 'footer_copyright_left',
                'type' => 'textarea',
                'validate' => 'html',
                'default' => esc_html__( 'All rights reserved by', 'wixi' ),
                'required' => array(
                    array( 'footer_visibility', '=', '1' ),
                    array( 'footer_copyright_left_visibility', '=', '1' ),
                    array( 'footer_type', '=', 'default' )
                )
            ),
            array(
                'title' => esc_html__( 'Copyright Right Section Display', 'wixi' ),
                'subtitle' => esc_html__( 'You can enable or disable the site footer left section on the site with switch option.', 'wixi' ),
                'id' => 'footer_copyright_right_visibility',
                'type' => 'switch',
                'default' => 1,
                'on' => 'On',
                'off' => 'Off',
                'required' => array(
                    array( 'footer_visibility', '=', '1' ),
                    array( 'footer_type', '=', 'default' )
                )
            ),
            array(
                'title' => esc_html__( 'Copyright Right Text', 'wixi' ),
                'subtitle' => esc_html__( 'HTML allowed (wp_kses)', 'wixi' ),
                'desc' => esc_html__( 'Enter your site copyright right text here.', 'wixi' ),
                'id' => 'footer_copyright_right',
                'type' => 'textarea',
                'validate' => 'html',
                'default' => sprintf( '<p>&copy; %1$s, <a class="theme" href="%2$s">%3$s</a> Theme. %4$s <a class="dev" href="https://ninetheme.com/contact/">%5$s</a></p>',
                    date( 'Y' ),
                    esc_url( home_url( '/' ) ),
                    get_bloginfo( 'name' ),
                    esc_html__( 'Made with passion by', 'wixi' ),
                    esc_html__( 'Ninetheme.', 'wixi' )
                ),
                'required' => array(
                    array( 'footer_visibility', '=', '1' ),
                    array( 'footer_copyright_right_visibility', '=', '1' ),
                    array( 'footer_type', '=', 'default' )
                )
            ),
            array(
                'title' => esc_html__( 'Text Alignment', 'wixi' ),
                'id' => 'footer_copyright_left_align',
                'type' => 'select',
                'default' => 'text-left',
                'customizer' => true,
                'options' => array(
                    '' => esc_html__( 'Select a option', 'wixi' ),
                    'text-left' => esc_html__( 'left', 'wixi' ),
                    'text-center' => esc_html__( 'center', 'wixi' ),
                    'text-right' => esc_html__( 'right', 'wixi' ),
                ),
                'required' => array(
                    array( 'footer_visibility', '=', '1' ),
                    array( 'footer_copyright_left_visibility', '=', '1' ),
                    array( 'footer_copyright_right_visibility', '=', '0' ),
                    array( 'footer_type', '=', 'default' )
                )
            ),
            array(
                'title' => esc_html__( 'Text Alignment', 'wixi' ),
                'id' => 'footer_copyright_right_align',
                'type' => 'select',
                'default' => 'text-right',
                'customizer' => true,
                'options' => array(
                    '' => esc_html__( 'Select a option', 'wixi' ),
                    'text-left' => esc_html__( 'left', 'wixi' ),
                    'text-center' => esc_html__( 'center', 'wixi' ),
                    'text-right' => esc_html__( 'right', 'wixi' ),
                ),
                'required' => array(
                    array( 'footer_visibility', '=', '1' ),
                    array( 'footer_copyright_left_visibility', '=', '0' ),
                    array( 'footer_copyright_right_visibility', '=', '1' ),
                    array( 'footer_type', '=', 'default' )
                )
            ),
            //information on-off
            array(
                'id' =>'info_f0',
                'type' => 'info',
                'style' => 'success',
                'title' => esc_html__( 'Success!', 'wixi' ),
                'icon' => 'el el-info-circle',
                'customizer' => false,
                'desc' => sprintf(esc_html__( '%s section is disabled on the site.Please activate to view subsection options.', 'wixi' ), '<b>Site Main Footer</b>' ),
                'required' => array( 'footer_visibility', '=', '0' )
            )
    )));
    //FOOTER SECTION
    Redux::setSection($wixi_pre, array(
        'title' => esc_html__( 'Footer Style', 'wixi' ),
        'desc' => esc_html__( 'These are main settings for general theme!', 'wixi' ),
        'id' => 'footerstylesubsection',
        'icon' => 'el el-photo',
        'subsection' => true,
        'fields' => array(
            array(
                'id' =>'footer_color_customize',
                'type' => 'info',
                'icon' => 'el el-brush',
                'customizer' => false,
                'desc' => sprintf(esc_html__( '%s', 'wixi' ), '<h2>Footer Color Customize</h2>' ),
                'required' => array(
                    array( 'footer_visibility', '=', '1' ),
                    array( 'footer_type', '=', 'default' )
                )
            ),
            array(
                'title' => esc_html__( 'Footer Padding', 'wixi' ),
                'subtitle' => esc_html__( 'You can set the top spacing of the site main footer.', 'wixi' ),
                'id' => 'footer_pad',
                'type' => 'spacing',
                'output' => array('#nt-footer.footer-sm' ),
                'mode' => 'padding',
                'units' => array('em', 'px' ),
                'units_extended' => 'false',
                'default' => array(
                    'padding-top' => '',
                    'padding-right' => '',
                    'padding-bottom' => '',
                    'padding-left' => '',
                    'units' => 'px'
                ),
                'required' => array(
                    array( 'footer_visibility', '=', '1' ),
                    array( 'footer_type', '=', 'default' )
                )
            ),
            array(
                'title' => esc_html__( 'Footer Background Color', 'wixi' ),
                'desc' => esc_html__( 'Set your own colors for the footer.', 'wixi' ),
                'id' => 'footer_bg_clr',
                'type' => 'color',
                'mode' => 'background-color',
                'output' => array( '#nt-footer.footer-sm' ),
                'required' => array(
                    array( 'footer_visibility', '=', '1' ),
                    array( 'footer_type', '=', 'default' )
                )
            ),
            array(
                'title' => esc_html__( 'Copyright Text Color', 'wixi' ),
                'desc' => esc_html__( 'Set your own colors for the copyright.', 'wixi' ),
                'id' => 'footer_copy_clr',
                'type' => 'color',
                'transparent' => false,
                'output' => array( '#nt-footer.footer-sm, #nt-footer.footer-sm p' ),
                'required' => array(
                    array( 'footer_visibility', '=', '1' ),
                    array( 'footer_type', '=', 'default' )
                )
            ),
            array(
                'title' => esc_html__( 'Link Color', 'wixi' ),
                'desc' => esc_html__( 'Set your own colors for the copyright.', 'wixi' ),
                'id' => 'footer_link_clr',
                'type' => 'color',
                'transparent' => false,
                'output' => array( '#nt-footer.footer-sm a' ),
                'required' => array(
                    array( 'footer_visibility', '=', '1' ),
                    array( 'footer_type', '=', 'default' )
                )
            ),
            array(
                'title' => esc_html__( 'Link Color ( Hover )', 'wixi' ),
                'desc' => esc_html__( 'Set your own colors for the copyright.', 'wixi' ),
                'id' => 'footer_link_hvr_clr',
                'type' => 'color',
                'transparent' => false,
                'output' => array( '#nt-footer.footer-sm a:hover' ),
                'required' => array(
                    array( 'footer_visibility', '=', '1' ),
                    array( 'footer_type', '=', 'default' )
                )
            ),
            //information on-off
            array(
                'id' =>'info_fc0',
                'type' => 'info',
                'style' => 'success',
                'title' => esc_html__( 'Success!', 'wixi' ),
                'icon' => 'el el-info-circle',
                'customizer' => false,
                'desc' => sprintf(esc_html__( '%s section is disabled on the site.Please activate to view subsection options.', 'wixi' ), '<b>Site Main Footer</b>' ),
                'required' => array( 'footer_visibility', '=', '0' )
            )
    )));

    Redux::setSection($wixi_pre, array(
        'id' => 'inportexport_settings',
        'title' => esc_html__( 'Import / Export', 'wixi' ),
        'desc' => esc_html__( 'Import and Export your Theme Options from text or URL.', 'wixi' ),
        'icon' => 'fa fa-download',
        'fields' => array(
            array(
                'id' => 'opt-import-export',
                'type' => 'import_export',
                'title' => '',
                'customizer' => false,
                'subtitle' => '',
                'full_width' => true
            )
    )));
    Redux::setSection($wixi_pre, array(
    'id' => 'nt_support_settings',
    'title' => esc_html__( 'Support', 'wixi' ),
    'icon' => 'el el-idea',
    'fields' => array(
        array(
            'id' => 'support',
            'type' => 'raw',
            'markdown' => true,
            'class' => 'theme_support',
            'content' => '<div class="support-section">
            <h5>'.esc_html__( 'DO YOU NEED HELP?', 'wixi' ).'</h5>
            <h2><i class="el el-adult"></i> '.esc_html__( 'SUPPORT CENTER & DOCUMENTATION', 'wixi' ).'</h2>
            <a target="_blank" class="button" href="https://ninetheme.com/support/">'.esc_html__( 'GET SUPPORT', 'wixi' ).'</a>
            </div>'
        ),
        array(
            'id' => 'portfolio',
            'type' => 'raw',
            'markdown' => true,
            'class' => 'theme_support',
            'content' => '<div class="support-section">
            <h5>'.esc_html__( 'SEE MORE THE NINETHEME WORDPRESS THEMES', 'wixi' ).'</h5>
            <h2><i class="el el-picture"></i> '.esc_html__( 'NINETHEME PORTFOLIO', 'wixi' ).'</h2>
            <a target="_blank" class="button" href="https://ninetheme.com/themes/">'.esc_html__( 'SEE MORE', 'wixi' ).'</a>
            </div>'
        ),
        array(
            'id' => 'like',
            'type' => 'raw',
            'markdown' => true,
            'class' => 'theme_support',
            'content' => '<div class="support-section">
            <h5>'.esc_html__( 'WOULD YOU LIKE TO REWARD OUR EFFORT?', 'wixi' ).'</h5>
            <h2><i class="el el-thumbs-up"></i> '.esc_html__( 'PLEASE RATE US!', 'wixi' ).'</h2>
            <a target="_blank" class="button" href="https://themeforest.net/downloads/">'.esc_html__( 'GET STARS', 'wixi' ).'</a>
            </div>'
        )
    )));
    /*
     * <--- END SECTIONS
     */


    /** Action hook examples **/

    function wixi_remove_demo()
    {
        // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
        if (class_exists('ReduxFrameworkPlugin' )) {
            // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
            remove_action('admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ));
        }
    }
    function wixi_newIconFont() {
        wp_register_style(
            'redux-font-awesome',
            '//stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css',
            array(),
            time(),
            'all'
        );
        wp_enqueue_style( 'redux-font-awesome' );
    }
    add_action( 'redux/page/wixi/enqueue', 'wixi_newIconFont' );
