<?php

// Exit if accessed directly.
if ( !defined( 'ABSPATH' ) )
	exit;


/**
 * Main Listings_Wp Customizer Class.
 *
 * @since 1.0.0
 */
class Listings_Wp_Customizer_Options {
	
	/**
     * Main constructor
     *
     * @since 1.0.0
     */
    public function __construct() {

        // Hook into actions & filters
        $this->hooks();

    }

    /**
     * Hook in to actions & filters
     *
     * @since 1.0.0
     */
    public function hooks() {
        add_filter( 'listings_wp_admin_options', array( $this, 'tabs' ), 10, 2 );
    }

    /**
     * Add our new options
     *
     * @since 1.0.0
     */
    public function tabs( $options, $cmb ) {
		
		$options['tabs'][] = array(
            'id'    => 'customizer',
            'title' => __( 'Customizer', 'listings-wp-customizer' ),
            'desc'  => '',
            'boxes' => array(
                'customizer_global',
                'customizer_search_box',
                'customizer_listings',
                'customizer_css',
            ),
        );

        // customizer global
        $cmb = new_cmb2_box( array(
            'id'        => 'customizer_global',
            'title'     => __( 'Global Colors', 'listings-wp-customizer' ),
            'show_on'   => array( 'key' => 'options-page', 'value' => array( 'listings_wp_options' ) )
        ));
        $cmb->add_field( array(
            'name' => __( 'Icons', 'listings-wp-customizer' ),
            'id'   => 'customizer_icons_color',
            'type' => 'colorpicker',
            'desc' => __( '', 'listings-wp-customizer' ),
        ) );
        $cmb->add_field( array(
            'name' => __( 'Sidebar Headings', 'listings-wp-customizer' ),
            'id'   => 'customizer_sidebar_headings_color',
            'type' => 'colorpicker',
            'desc' => __( '', 'listings-wp-customizer' ),
        ) );
        $cmb->add_field( array(
            'name' => __( 'Button Background', 'listings-wp-customizer' ),
            'id'   => 'customizer_button_bg',
            'type' => 'colorpicker',
            'desc' => __( '', 'listings-wp-customizer' ),
        ) );
        $cmb->add_field( array(
            'name' => __( 'Button Background Hover', 'listings-wp-customizer' ),
            'id'   => 'customizer_button_bg_hover',
            'type' => 'colorpicker',
            'desc' => __( '', 'listings-wp-customizer' ),
        ) );
        $cmb->add_field( array(
            'name' => __( 'Button Text Color', 'listings-wp-customizer' ),
            'id'   => 'customizer_button_text_color',
            'type' => 'colorpicker',
            'desc' => __( '', 'listings-wp-customizer' ),
        ) );
        $cmb->add_field( array(
            'name' => __( 'Button Text Color Hover', 'listings-wp-customizer' ),
            'id'   => 'customizer_button_text_hover',
            'type' => 'colorpicker',
            'desc' => __( '', 'listings-wp-customizer' ),
        ) );

        $cmb->object_type( 'options-page' );
        $options['boxes'][] = $cmb;

        // customizer setup
        $cmb = new_cmb2_box( array(
            'id'        => 'customizer_search_box',
            'title'     => __( 'Search Box', 'listings-wp-customizer' ),
            'show_on'   => array( 'key' => 'options-page', 'value' => array( 'listings_wp_options' ) )
        ));
        $cmb->add_field( array(
            'name' => __( 'Box Background', 'listings-wp-customizer' ),
            'id'   => 'customizer_search_bg',
            'type' => 'colorpicker',
            'desc' => __( '', 'listings-wp-customizer' ),
        ) );
        
        $cmb->object_type( 'options-page' );
        $options['boxes'][] = $cmb;

        // customizer setup
        $cmb = new_cmb2_box( array(
            'id'        => 'customizer_listings',
            'title'     => __( 'Listings', 'listings-wp-customizer' ),
            'show_on'   => array( 'key' => 'options-page', 'value' => array( 'listings_wp_options' ) )
        ));
        $cmb->add_field( array(
            'name' => __( 'Title Color', 'listings-wp-customizer' ),
            'id'   => 'customizer_title_color',
            'type' => 'colorpicker',
            'desc' => __( '', 'listings-wp-customizer' ),
        ) );
        $cmb->add_field( array(
            'name' => __( 'Tagline Color', 'listings-wp-customizer' ),
            'id'   => 'customizer_tagline_color',
            'type' => 'colorpicker',
            'desc' => __( '', 'listings-wp-customizer' ),
        ) );
        $cmb->add_field( array(
            'name' => __( 'Address Color', 'listings-wp-customizer' ),
            'id'   => 'customizer_address_color',
            'type' => 'colorpicker',
            'desc' => __( '', 'listings-wp-customizer' ),
        ) );
        $cmb->add_field( array(
            'name' => __( 'Price Color', 'listings-wp-customizer' ),
            'id'   => 'customizer_price_color',
            'type' => 'colorpicker',
            'desc' => __( '', 'listings-wp-customizer' ),
        ) );
		
		$cmb->object_type( 'options-page' );
        $options['boxes'][] = $cmb;


        // customizer css
        $cmb = new_cmb2_box( array(
            'id'        => 'customizer_css',
            'title'     => __( 'Custom CSS', 'listings-wp-customizer' ),
            'show_on'   => array( 'key' => 'options-page', 'value' => array( 'listings_wp_options' ) )
        ));
        $cmb->add_field( array(
		    'name' => __( 'Custom CSS', 'listings-wp-customizer' ),
		    'id'   => 'customizer_css',
		    'type' => 'textarea',
		    'desc' => __( '', 'listings-wp-customizer' ),
		) );


		$cmb->object_type( 'options-page' );
        $options['boxes'][] = $cmb;    

        return $options;
	}

	
}

return new Listings_Wp_Customizer_Options();