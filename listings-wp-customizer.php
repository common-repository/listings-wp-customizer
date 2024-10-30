<?php
/**
 * Plugin Name: Listings WP Customizer
 * Plugin URI: http://listings-wp.com
 * Description: Easily customize the appearance of the Listings WP plugin.
 * Author: MyThemeShop
 * Author URI: https://listings-wp.com
 * Version: 1.0.0
 * Text Domain: listings-wp-customizer
 * Domain Path: languages
 *
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;


/**
 * Run the extension after Listings_Wp is loaded.
 */
add_action( 'listings_wp_loaded', 'listings_wp_run_customizer' );
function listings_wp_run_customizer() {
	return Listings_Wp_Customizer::instance();

}

/**
 * Main Listings_Wp Customizer Class.
 *
 * @since 1.0.0
 */
final class Listings_Wp_Customizer {

	/**
	 * @var Listings_Wp The one true Listings_Wp Customizer
	 * @since 1.0.0
	 */
	protected static $_instance = null;

	public $version = '1.0.0';

	/**
	 * Main Listings_Wp Customizer Instance.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Throw error on object clone.
	 *
	 * @since 1.0.0
	 * @access protected
	 * @return void
	 */
	public function __clone() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'listings-wp-customizer' ), '1.0.0' );
	}

	/**
	 * Disable unserializing of the class.
	 *
	 * @since 1.0.0
	 * @access protected
	 * @return void
	 */
	public function __wakeup() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'listings-wp-customizer' ), '1.0.0' );
	}

	public function __construct() {

		$this->define_constants();
		$this->includes();
		$this->init_hooks();

		do_action( 'listings_wp_customizer_loaded' );
	}

	/**
	 * Hook into actions and filters.
	 * @since  1.0.0
	 */
	private function init_hooks() {
		add_action( 'listings_wp_init', array( $this, 'init' ), 0 );
	}

	/**
	 * Define Constants.
	 */
	private function define_constants() {
		$upload_dir = wp_upload_dir();
		$this->define( 'LWP_CUSTOMIZER_PLUGIN_FILE', __FILE__ );
		$this->define( 'LWP_CUSTOMIZER_PLUGIN_DIR',plugin_dir_path( __FILE__ ) );
		$this->define( 'LWP_CUSTOMIZER_PLUGIN_URL',plugin_dir_url( __FILE__ ) );
		$this->define( 'LWP_CUSTOMIZER_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
		$this->define( 'LWP_CUSTOMIZER_VERSION', $this->version );
	}

	/**
	 * Define constant if not already set.
	 *
	 * @param  string $name
	 * @param  string|bool $value
	 */
	private function define( $name, $value ) {
		if ( ! defined( $name ) ) {
			define( $name, $value );
		}
	}

	/**
	 * Include required files.
	 */
	public function includes() {
		include_once( 'includes/class-lwp-customizer-options.php' );
		include_once( 'includes/class-lwp-customizer-output.php' );
	}


	/**
	 * Init Listings_Wp when WordPress Initialises.
	 */
	public function init() {
		// Before init action.
		do_action( 'before_listings_wp_customizer_init' );
		// Set up localisation.
		$this->load_plugin_textdomain();
		// Init action.
		do_action( 'listings_wp_customizer_init' );
	}


	/**
	 * Load Localisation files.
	 * @since 1.0.0
	 */
	public function load_plugin_textdomain() {
		$locale = apply_filters( 'plugin_locale', get_locale(), 'listings-wp-customizer' );

		load_textdomain( 'listings-wp-customizer', WP_LANG_DIR . '/listings-wp-customizer-' . $locale . '.mo' );
		load_plugin_textdomain( 'listings-wp-customizer', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
	}


}