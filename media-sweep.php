<?php
/**
 * Plugin Name:       Media Sweep
 * Plugin URI:        https://github.com/sapthesh/Media-Sweep-WP/
 * Description:       A powerful scanning utility to find and remove orphaned media files. Scans posts, meta, and options.
 * Version:           1.1.0
 * Author:            Your Name
 * Author URI:        https://github.com/sapthesh/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       media-sweep
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'MEDIA_SWEEP_VERSION', '1.1.0' );
define( 'MEDIA_SWEEP_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

/**
 * The core plugin class.
 */
final class Media_Sweep_Core {

	/**
	 * The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Main an instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Constructor.
	 */
	private function __construct() {
		$this->includes();
		$this->init_hooks();
	}

	/**
	 * Include required files.
	 */
	private function includes() {
		require_once MEDIA_SWEEP_PLUGIN_DIR . 'includes/class-media-sweep-admin.php';
		require_once MEDIA_SWEEP_PLUGIN_DIR . 'includes/class-media-sweep-scanner.php';
		require_once MEDIA_SWEEP_PLUGIN_DIR . 'includes/class-media-sweep-file-ops.php';
	}

	/**
	 * Initialize hooks.
	 */
	private function init_hooks() {
		add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );

		$admin = new Media_Sweep_Admin();
		add_action( 'admin_menu', array( $admin, 'add_plugin_page' ) );
		add_action( 'admin_enqueue_scripts', array( $admin, 'enqueue_scripts' ) );

		$scanner = new Media_Sweep_Scanner();
		add_action( 'wp_ajax_media_sweep_scan', array( $scanner, 'ajax_scan' ) );
	}

	/**
	 * Load plugin textdomain.
	 */
	public function load_textdomain() {
		load_plugin_textdomain( 'media-sweep', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}
}

/**
 * Begins execution of the plugin.
 */
function run_media_sweep() {
	return Media_Sweep_Core::instance();
}

run_media_sweep();
