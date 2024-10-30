<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;


/**
 * Main Listings_Wp Customizer Output Class.
 *
 * @since 1.0.0
 */
class Listings_Wp_Customizer_Output {

	private $opt = '';

	/**
	 * @var Listings_Wp The one true Listings_Wp Customizer Output 
	 * @since 1.0.0
	 */
	protected static $_instance = null;


	/**
	 * @since 1.0.0
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function __construct() {
		$this->init_hooks();
	}

	/**
	 * Hook into actions and filters.
	 * @since  1.0.0
	 */
	private function init_hooks() {
		add_action( 'wp_enqueue_scripts', array( $this, 'add_inline_css' ), 12 );
	}

	/**
	 * Add some inline CSS
	 *
	 */
	public function add_inline_css() {

		$options = $this->get_options();

		if( ! $options )
			return;

		$css = '';

		foreach ( $options as $key => $value ) {
			
			if( $key == 'customizer_icons_color' ) {
				$css .= '[class^="lwp-icon-"], [class*=" lwp-icon-"] { color: ' . esc_html( $value ) . '; }';
			}
			if( $key == 'customizer_sidebar_headings_color' ) {
				$css .= '.listings-wp-single .sidebar h3, .bottom h3 { color: ' . esc_html( $value ) . '; }';
			}
			if( $key == 'customizer_button_bg' ) {
				$css .= '.listings-wp-single .button-primary, #listings-wp-search-form .button { background-color: ' . esc_html( $value ) . '; }';
			}
			if( $key == 'customizer_button_bg_hover' ) {
				$css .= '.listings-wp-single .button-primary:hover, #listings-wp-search-form .button:hover { background-color: ' . esc_html( $value ) . '; }';
			}
			if( $key == 'customizer_button_text_color' ) {
				$css .= '.listings-wp-single .button-primary, #listings-wp-search-form .button { color: ' . esc_html( $value ) . '; }';
			}
			if( $key == 'customizer_button_text_hover' ) {
				$css .= '.listings-wp-single .button-primary:hover, #listings-wp-search-form .button:hover { color: ' . esc_html( $value ) . '; }';
			}
			if( $key == 'customizer_search_bg' ) {
				$css .= '.listings-wp-search-form { background-color: ' . esc_html( $value ) . '; }';
			}
			if( $key == 'customizer_title_color' ) {
				$css .= '.listings-wp-items .title a, .listings-wp-single .title { color: ' . esc_html( $value ) . '; }';
			}
			if( $key == 'customizer_tagline_color' ) {
				$css .= '.listings-wp-items .tagline, .listings-wp-single .tagline { color: ' . esc_html( $value ) . '; }';
			}
			if( $key == 'customizer_address_color' ) {
				$css .= '.listings-wp-items .address, .listings-wp-single .address { color: ' . esc_html( $value ) . '; }';
			}
			if( $key == 'customizer_price_color' ) {
				$css .= '.listings-wp-items .price, .listings-wp-single .price { color: ' . esc_html( $value ) . '; }';
			}
			if( $key == 'customizer_css' ) {
				$css .= esc_html( $value );
			}

		}
		
		//Add the above custom CSS via wp_add_inline_style
		wp_add_inline_style( 'listings-wp', apply_filters( 'listings_wp_customizer_css_output', $css ) ); 

	}

	/**
	 * Check if we have any options
	 * @since  1.0.0
	 */
	private function get_options() {
		
		$options = get_option( 'listings_wp_options' );
		
		$result = array();
		foreach( $options as $key => $value ) {
		    $exp_key = explode('_', $key );
		    if( $exp_key[0] == 'customizer' ) {
		         $result[$key] = $value;
		    }
		}

		return $result;
	}


}

return new Listings_Wp_Customizer_Output();