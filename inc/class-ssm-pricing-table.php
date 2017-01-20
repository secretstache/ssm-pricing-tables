<?php
/**
 * SSM Pricing Tables
 *
 * @package   SSM_Pricing_Tables
 * @license   GPL-2.0+
 */

/**
 * Registration of CPT and related taxonomies.
 *
 * @since 0.1.0
 */
class SSM_Pricing_Table {

	protected $registration_handler;

	/**
	 * Initialize the plugin by setting localization and new site activation hooks.
	 *
	 * @since 0.1.0
	 */
	public function __construct( $registration_handler ) {

		$this->registration_handler = $registration_handler;

		// Load plugin text domain
		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );;

	}

	/**
	 * Fired for each blog when the plugin is activated.
	 *
	 * @since 0.1.0
	 */
	public function activate() {
		$this->registration_handler->register();
		flush_rewrite_rules();
	}

	/**
	 * Fired for each blog when the plugin is deactivated.
	 *
	 * @since 0.1.0
	 */
	public function deactivate() {
		flush_rewrite_rules();
	}

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since 0.1.0
	 */
	public function load_plugin_textdomain() {
		$domain = PLUGIN_SLUG;
		load_plugin_textdomain( $domain, FALSE, SSM_PRICING_TABLES_DIR . '/languages' );
	}

}