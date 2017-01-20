<?php
/**
 * SSM Pricing Tables
 *
 * @package   SSM_Pricing_Tables
 * @license   GPL-2.0+
 */

/**
 * Register post types and taxonomies.
 *
 * @package SSM_Pricing_Tables
 */
class SSM_Pricing_Table_Registrations {

	public $post_type = 'pricing-table';

	public $taxonomies = array( 'pricing-table-category' );

	public function init() {
		// Add the SSM Pricing Tables and taxonomies
		add_action( 'init', array( $this, 'register' ) );
	}

	/**
	 * Initiate registrations of post type and taxonomies.
	 *
	 * @uses SSM_Pricing_Tables_Registrations::register_post_type()
	 * @uses SSM_Pricing_Tables_Registrations::register_taxonomy_category()
	 */
	public function register() {
		$this->register_post_type();
		$this->register_taxonomy_category();
	}

	/**
	 * Register the custom post type.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_post_type
	 */
	protected function register_post_type() {
		$labels = array(
			'name'               => __( 'Pricing Tables', 'ssm-pricing-tables' ),
			'singular_name'      => __( 'Pricing Table', 'ssm-pricing-tables' ),
			'add_new'            => __( 'Add Pricing Table', 'ssm-pricing-tables' ),
			'add_new_item'       => __( 'Add Pricing Table', 'ssm-pricing-tables' ),
			'edit_item'          => __( 'Edit Pricing Table', 'ssm-pricing-tables' ),
			'new_item'           => __( 'New Pricing Table', 'ssm-pricing-tables' ),
			'view_item'          => __( 'View Pricing Table', 'ssm-pricing-tables' ),
			'search_items'       => __( 'Search Pricing Tables', 'ssm-pricing-tables' ),
			'not_found'          => __( 'No pricing tables found', 'ssm-pricing-tables' ),
			'not_found_in_trash' => __( 'No pricing tables in the trash', 'ssm-pricing-tables' ),
		);

		$supports = array(
			'title',
		);

		$args = array(
			'labels'          		=> $labels,
			'supports'        		=> $supports,
			'public'          		=> false,
			'capability_type' 		=> 'page',
			'publicly_queriable'	=> true,
			'show_ui' 						=> true,
			'show_in_nav_menus' 	=> false,
			'rewrite'         		=> false,
			'menu_position'   		=> 30,
			'menu_icon'       		=> 'dashicons-list-view',
			'has_archive'					=> false,
			'exclude_from_search'	=> true,
		);

		$args = apply_filters( 'ssm_pricing_tables_args', $args );

		register_post_type( $this->post_type, $args );
	}

	/**
	 * Register a taxonomy for Project Categories.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
	 */
	protected function register_taxonomy_category() {
		$labels = array(
			'name'                       => __( 'Categories', 'ssm-pricing-tables' ),
			'singular_name'              => __( 'Category', 'ssm-pricing-tables' ),
			'menu_name'                  => __( 'Categories', 'ssm-pricing-tables' ),
			'edit_item'                  => __( 'Edit Category', 'ssm-pricing-tables' ),
			'update_item'                => __( 'Update Category', 'ssm-pricing-tables' ),
			'add_new_item'               => __( 'Add New Category', 'ssm-pricing-tables' ),
			'new_item_name'              => __( 'New Category Name', 'ssm-pricing-tables' ),
			'parent_item'                => __( 'Parent Category', 'ssm-pricing-tables' ),
			'parent_item_colon'          => __( 'Parent Category:', 'ssm-pricing-tables' ),
			'all_items'                  => __( 'All Categories', 'ssm-pricing-tables' ),
			'search_items'               => __( 'Search Categories', 'ssm-pricing-tables' ),
			'popular_items'              => __( 'Popular Categories', 'ssm-pricing-tables' ),
			'separate_items_with_commas' => __( 'Separate categories with commas', 'ssm-pricing-tables' ),
			'add_or_remove_items'        => __( 'Add or remove categories', 'ssm-pricing-tables' ),
			'choose_from_most_used'      => __( 'Choose from the most used categories', 'ssm-pricing-tables' ),
			'not_found'                  => __( 'No categories found.', 'ssm-pricing-tables' ),
		);

		$args = array(
			'labels'            => $labels,
			'public'            => false,
			'show_in_nav_menus' => false,
			'show_ui'           => true,
			'show_tagcloud'     => false,
			'hierarchical'      => true,
			'rewrite'           => false,
			'show_admin_column' => true,
			'query_var'         => true,
		);

		$args = apply_filters( 'ssm_pricing_tables_category_args', $args );

		register_taxonomy( $this->taxonomies[0], $this->post_type, $args );
	}
}