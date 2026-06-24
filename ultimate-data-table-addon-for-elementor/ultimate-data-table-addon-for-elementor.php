<?php
/*
* Plugin Name: Ultimate Data Table Addon For Elementor
* Plugin URI: https://wordpress.org/plugins/ultimate-data-table-addon-for-elementor/
* Description: Build fully customizable, responsive, and feature-rich data tables in Elementor using DataTables.js. Supports live search, pagination, sorting, rowspan/colspan, custom labels, and full Elementor styling — no coding required.
 * Author: RSTheme
 * Author URI: https://rstheme.com/
* Version: 1.0.2
* Requires at least: 6.3
* Requires PHP: 7.4
* Text Domain: ultimate-data-table-addon-for-elementor
* Domain Path: /languages
* License: GPLv2 or later
* License URI: http://www.gnu.org/licenses/gpl-2.0.html
* Requires Plugins: elementor
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Define constants
define( 'ULTIMATE_DATA_TABLE_FILE', __FILE__ );
define( 'ULTIMATE_DATA_TABLE_DIR_PATH', plugin_dir_path( __FILE__ ) );
define( 'ULTIMATE_DATA_TABLE_DIR_URL', plugin_dir_url( __FILE__ ) );
define( 'ULTIMATE_DATA_TABLE_VERSION', '1.0.2' );

// Check if Elementor is active
function ultimate_data_table_is_elementor_active() {
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

	return is_plugin_active( 'elementor/elementor.php' );
}

// Enqueue scripts only if Elementor is active
function ultimate_data_table_enqueue_scripts() {
	if ( ultimate_data_table_is_elementor_active() ) {
		wp_enqueue_script( 'jquery' );
	}
}

add_action( "wp_enqueue_scripts", "ultimate_data_table_enqueue_scripts" );

// Include the core functionality only if Elementor is active
if ( ultimate_data_table_is_elementor_active() ) {
	require_once ULTIMATE_DATA_TABLE_DIR_PATH . 'base.php';
}
