<?php
/**
 * SSM Pricing Tables
 *
 * @package   SSM_Pricing_Tables
 * @license   GPL-2.0+
 *
 * @wordpress-plugin
 * Plugin Name: SSM Pricing Tables
 * Plugin URI:  http://secretstache.com
 * Description: A pricing table plugin that uses advanced custom fields.
 * Version:     0.1.1
 * Author:      Secret Stache Media
 * Author URI:  http://secretstache.com
 * Text Domain: ssm-pricing-tables
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Define Constants
 *
 * @since   SSM Pricing Tables  0.1.0
 */
define( 'SSM_PRICING_TABLES_VERSION', '0.1.1' );
define( 'PLUGIN_SLUG', 'ssm-pricing-tables' );
define( 'SSM_PRICING_TABLES_URL', plugin_dir_url( __FILE__ ) );
define( 'SSM_PRICING_TABLES_DIR', plugin_dir_path( __FILE__ ) );
define( 'SSM_PRICING_TABLES_BASENAME', plugin_basename( __FILE__ ) );

define( 'SSM_PRICING_TABLES_DIR_INC', trailingslashit ( SSM_PRICING_TABLES_DIR . 'inc' ) );
define( 'SSM_PRICING_TABLES_DIR_LIB', trailingslashit ( SSM_PRICING_TABLES_DIR . 'lib' ) );
// define( 'SSM_PRICING_TABLES_DIR_OPTIONS', trailingslashit ( SSM_PRICING_TABLES_DIR . 'options' ) );

// Required files for registering the post type and taxonomies.
require SSM_PRICING_TABLES_DIR_INC . 'dependency-check.php';
require SSM_PRICING_TABLES_DIR_INC . 'class-post-type.php';
require SSM_PRICING_TABLES_DIR_INC . 'class-post-type-registrations.php';
require SSM_PRICING_TABLES_DIR_INC . 'acf.php';

// Instantiate registration class, so we can add it as a dependency to main plugin class.
$post_type_registrations = new SSM_Pricing_Tables_Registrations;

// Instantiate main plugin file, so activation callback does not need to be static.
$post_type = new SSM_Pricing_Tables( $post_type_registrations );

// Register callback that is fired when the plugin is activated.
register_activation_hook( __FILE__, array( $post_type, 'activate' ) );

// Initialize registrations for post-activation requests.
$post_type_registrations->init();

/**
 * Adds styling to the dashboard for the post type and adds Project posts
 * to the "At a Glance" metabox.
 */
if ( is_admin() ) {

	// Loads for users viewing the WordPress dashboard
	if ( ! class_exists( 'Dashboard_Glancer' ) ) {
		require SSM_PRICING_TABLES_DIR_INC . 'class-dashboard-glancer.php';  // WP 3.8
	}

	require SSM_PRICING_TABLES_DIR_INC . 'class-post-type-admin.php';

	$post_type_admin = new SSM_Pricing_Tables_Admin( $post_type_registrations );
	$post_type_admin->init();

}


require SSM_PRICING_TABLES_DIR_INC . '/plugin_update_check.php';

$MyUpdateChecker = new PluginUpdateChecker_2_0 (
    'https://kernl.us/api/v1/updates/5881908e9c386122fd738262/',
    __FILE__,
    'ssm-pricing-tables',
    1
);