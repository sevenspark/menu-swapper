<?php
/*
Plugin Name: Menu Swapper
Plugin URI: https://sevenspark.com
Description: Register custom theme locations and swap menus on each Post or Page
Author: Chris Mavricos, SevenSpark
Author URI: https://sevenspark.com
Version: 1.1.1
Text Domain: menuswap
*/

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

if ( !class_exists( 'Menu_Swapper' ) ) :


final class Menu_Swapper {
	/** Singleton *************************************************************/

	private static $instance;

	public static function instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new Menu_Swapper;
			self::$instance->setup_constants();
			self::$instance->includes();
			self::$instance->load_textdomain();
		}
		return self::$instance;
	}

	/**
	 * Setup plugin constants
	 *
	 */
	private function setup_constants() {
		// Plugin version

		if( ! defined( 'MSWP_VERSION' ) )
			define( 'MSWP_VERSION', '1.1.1' );

		// Plugin Folder URL
		if( ! defined( 'MSWP_PLUGIN_URL' ) )
			define( 'MSWP_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

		// Plugin Folder Path
		if( ! defined( 'MSWP_PLUGIN_DIR' ) )
			define( 'MSWP_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

		// Plugin Root File
		if( ! defined( 'MSWP_PLUGIN_FILE' ) )
			define( 'MSWP_PLUGIN_FILE', __FILE__ );

		define( 'MSWP_LOC_POST_META' , 'mswp-swap-loc' );
		define( 'MSWP_TARGET_POST_META' , 'mswp-target-loc' );
		define( 'MSWP_THEME_LOC_OPTION' , 'mswp_theme_locations' );
	}

	/**
	 * Include required files
	 *
	 * @since 1.4
	 * @access private
	 * @uses is_admin() If in WordPress admin, load additional file
	 */
	private function includes() {

		//require_once MSWP_PLUGIN_DIR . 'includes/post-types.php';
		require_once MSWP_PLUGIN_DIR . 'includes/functions.php';
		//require_once MSWP_PLUGIN_DIR . 'includes/template-tags.php';

		if( is_admin() ) {
			require_once MSWP_PLUGIN_DIR . 'includes/admin-page.php';
			require_once MSWP_PLUGIN_DIR . 'includes/meta-box.php';

		} else {
			//require_once KB_PLUGIN_DIR . 'includes/process-download.php';
		}
	}


	/**
	 * Loads the plugin language files
	 *
	 * @since 1.0
	 */
	public function load_textdomain() {
		load_plugin_textdomain( 'menuswap', false );
	}
}

endif; // End if class_exists check



function MSWP() {
	return Menu_Swapper::instance();
}

MSWP();
