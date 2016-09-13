<?php
/**
 * Creates the Custom Taxonomies used in the site.
 * 
 * @subpackage: seventeen_ldn_ny
 */

// Register Custom Artist Taxonomy
function seventeen_ldn_ny_custom_tax_artists() {

	$labels = array(
		'name'                       => _x( 'Artists', 'Taxonomy General Name', 'seventeen-ldn-ny' ),
		'singular_name'              => _x( 'Artist', 'Taxonomy Singular Name', 'seventeen-ldn-ny' ),
		'menu_name'                  => __( 'Artists', 'seventeen-ldn-ny' ),
		'all_items'                  => __( 'All artists', 'seventeen-ldn-ny' ),
		'parent_item'                => __( 'Parent Artist', 'seventeen-ldn-ny' ),
		'parent_item_colon'          => __( 'Parent Artist:', 'seventeen-ldn-ny' ),
		'new_item_name'              => __( 'New Artist Name', 'seventeen-ldn-ny' ),
		'add_new_item'               => __( 'Add New Artist', 'seventeen-ldn-ny' ),
		'edit_item'                  => __( 'Edit Artist', 'seventeen-ldn-ny' ),
		'update_item'                => __( 'Update Artist', 'seventeen-ldn-ny' ),
		'view_item'                  => __( 'View Artist', 'seventeen-ldn-ny' ),
		'separate_items_with_commas' => __( 'Separate artist with commas', 'seventeen-ldn-ny' ),
		'add_or_remove_items'        => __( 'Add or remove artists', 'seventeen-ldn-ny' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'seventeen-ldn-ny' ),
		'popular_items'              => __( 'Popular Artists', 'seventeen-ldn-ny' ),
		'search_items'               => __( 'Search Artists', 'seventeen-ldn-ny' ),
		'not_found'                  => __( 'Not Found', 'seventeen-ldn-ny' ),
		'no_terms'                   => __( 'No Artists', 'seventeen-ldn-ny' ),
		'items_list'                 => __( 'Artists list', 'seventeen-ldn-ny' ),
		'items_list_navigation'      => __( 'Artists list navigation', 'seventeen-ldn-ny' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => false,
		'public'                     => false,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'query_var'                  => true,
  		'rewrite'                    => array( 'slug' => 'artists' ),
  		'show_in_rest'               => true,
  		'rest_base'                  => 'artists',
  		'rest_controller_class'      => 'WP_REST_Terms_Controller',
	);
	register_taxonomy( 'artists', array( 'exhibitions', 'post' ), $args );

}
add_action( 'init', 'seventeen_ldn_ny_custom_tax_artists', 0 );

// Register Custom Location Taxonomy
function seventeen_ldn_ny_custom_tax_locations() {

	$labels = array(
		'name'                       => _x( 'Locations', 'Taxonomy General Name', 'seventeen-ldn-ny' ),
		'singular_name'              => _x( 'Location', 'Taxonomy Singular Name', 'seventeen-ldn-ny' ),
		'menu_name'                  => __( 'Locations', 'seventeen-ldn-ny' ),
		'all_items'                  => __( 'All locations', 'seventeen-ldn-ny' ),
		'parent_item'                => __( 'Parent Location', 'seventeen-ldn-ny' ),
		'parent_item_colon'          => __( 'Parent Location:', 'seventeen-ldn-ny' ),
		'new_item_name'              => __( 'New Location Name', 'seventeen-ldn-ny' ),
		'add_new_item'               => __( 'Add New Location', 'seventeen-ldn-ny' ),
		'edit_item'                  => __( 'Edit Location', 'seventeen-ldn-ny' ),
		'update_item'                => __( 'Update Location', 'seventeen-ldn-ny' ),
		'view_item'                  => __( 'View Location', 'seventeen-ldn-ny' ),
		'separate_items_with_commas' => __( 'Separate location with commas', 'seventeen-ldn-ny' ),
		'add_or_remove_items'        => __( 'Add or remove locations', 'seventeen-ldn-ny' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'seventeen-ldn-ny' ),
		'popular_items'              => __( 'Popular Locations', 'seventeen-ldn-ny' ),
		'search_items'               => __( 'Search Locations', 'seventeen-ldn-ny' ),
		'not_found'                  => __( 'Not Found', 'seventeen-ldn-ny' ),
		'no_terms'                   => __( 'No Locations', 'seventeen-ldn-ny' ),
		'items_list'                 => __( 'Locations list', 'seventeen-ldn-ny' ),
		'items_list_navigation'      => __( 'Locations list navigation', 'seventeen-ldn-ny' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'query_var'                  => true,
  		'rewrite'                    => array( 'slug' => 'locations' ),
  		'show_in_rest'               => true,
  		'rest_base'                  => 'locations',
  		'rest_controller_class'      => 'WP_REST_Terms_Controller',
	);
	register_taxonomy( 'location', array( 'exhibitions' ), $args );

}
add_action( 'init', 'seventeen_ldn_ny_custom_tax_locations', 0 );
