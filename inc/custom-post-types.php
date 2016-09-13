<?php
/**
 * Creates the Custom Post Types used in the site.
 * 
 * @subpackage: seventeen_ldn_ny
 */
 
// Add the Artists Post Type
add_action( 'init', 'register_cpt_artists' );
function register_cpt_artists() {
    $labels = array( 
        'name' => esc_html__( 'Artists', 'seventeen-ldn-ny' ),
        'singular_name' => esc_html__( 'Artist', 'seventeen-ldn-ny' ),
        'add_new' => esc_html__( 'Add New', 'seventeen-ldn-ny' ),
        'add_new_item' => esc_html__( 'Add New Artist', 'seventeen-ldn-ny' ),
        'edit_item' => esc_html__( 'Edit Artist', 'seventeen-ldn-ny' ),
        'new_item' => esc_html__( 'New Artist', 'seventeen-ldn-ny' ),
        'view_item' => esc_html__( 'View Artist', 'seventeen-ldn-ny' ),
        'search_items' => esc_html__( 'Search Artists', 'seventeen-ldn-ny' ),
        'not_found' => esc_html__( 'No artists found', 'seventeen-ldn-ny' ),
        'not_found_in_trash' => esc_html__( 'No artists found in Trash', 'seventeen-ldn-ny' ),
        'parent_item_colon' => esc_html__( 'Parent Artist:', 'seventeen-ldn-ny' ),
        'menu_name' => esc_html__( 'Artists', 'seventeen-ldn-ny' ),
    );
	$args = array( 
		'labels' => $labels,
		'hierarchical' => true,
		'description' => 'The artist post type - to host the artist home page',
		'supports' => array( 
			'title', 
			'editor',
			'thumbnail',
			'revisions',
			'page-attributes'
		 ),
		//'taxonomies' => array( 'category', 'post_tag' ),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_rest' => true,
		'menu_position' => 5,
		'menu_icon' => 'dashicons-art',
		'show_in_nav_menus' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'has_archive' => true,
		'query_var' => true,
		'can_export' => true,
		'rewrite' => array(
			'slug'       => 'artists',
			'with_front' => false,
			'feeds'      => true,
			'pages'      => true,
		),
		'capability_type' => 'page'
	);
	register_post_type( 'artists', $args );
}

/* Add the Exhibitions Post Type */
add_action( 'init', 'register_cpt_exhibitions' );
function register_cpt_exhibitions() {
    $labels = array( 
        'name' => esc_html__( 'Exhibitions', 'seventeen-ldn-ny' ),
        'singular_name' => esc_html__( 'Exhibition', 'seventeen-ldn-ny' ),
        'add_new' => esc_html__( 'Add New', 'seventeen-ldn-ny' ),
        'add_new_item' => esc_html__( 'Add New Exhibition', 'seventeen-ldn-ny' ),
        'edit_item' => esc_html__( 'Edit Exhibition', 'seventeen-ldn-ny' ),
        'new_item' => esc_html__( 'New Exhibition', 'seventeen-ldn-ny' ),
        'view_item' => esc_html__( 'View Exhibition', 'seventeen-ldn-ny' ),
        'search_items' => esc_html__( 'Search Exhibitions', 'seventeen-ldn-ny' ),
        'not_found' => esc_html__( 'No exhibitions found', 'seventeen-ldn-ny' ),
        'not_found_in_trash' => esc_html__( 'No exhibitions found in Trash', 'seventeen-ldn-ny' ),
        'parent_item_colon' => esc_html__( 'Parent Exhibition:', 'seventeen-ldn-ny' ),
        'menu_name' => esc_html__( 'Exhibitions', 'seventeen-ldn-ny' ),
    );
	$args = array( 
		'labels' => $labels,
		'hierarchical' => false,
		'description' => 'The exhibition post type - to host the exhibition home page',
		'supports' => array( 
			'title', 
			'editor', 
			'thumbnail', 
			'revisions' 
		),
		'taxonomies' => array( 
			//'category', 
			//'post_tag',
			//'artists'
		),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_rest' => true,
		'menu_position' => 5,
		'menu_icon' => 'dashicons-images-alt2',
		'show_in_nav_menus' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'has_archive' => true,
		'query_var' => true,
		'can_export' => true,
		'rewrite' => array(
			'slug'       => 'exhibitions',
			'with_front' => false,
			'feeds'      => true,
			'pages'      => true,
		),
		'capability_type' => 'post'
	);
	register_post_type( 'exhibitions', $args );
}

/* Add the News Post Type *
add_action( 'init', 'register_cpt_news' );
function register_cpt_news() {
    $labels = array( 
        'name' => _x( 'News', 'news' ),
        'singular_name' => _x( 'News', 'news' ),
        'add_new' => _x( 'Add New', 'news' ),
        'add_new_item' => _x( 'Add New News Item', 'news' ),
        'edit_item' => _x( 'Edit News Item', 'news' ),
        'new_item' => _x( 'New News Item', 'news' ),
        'view_item' => _x( 'View News Item', 'news' ),
        'search_items' => _x( 'Search News Items', 'news' ),
        'not_found' => _x( 'No news items found', 'news' ),
        'not_found_in_trash' => _x( 'No news items found in Trash', 'news' ),
        'parent_item_colon' => _x( 'Parent News Item:', 'news' ),
        'menu_name' => _x( 'News Items', 'news' ),
    );
	$args = array( 
		'labels' => $labels,
		'hierarchical' => false,
		'description' => 'The news post type - to host the news home page',
		'supports' => array( 'title', 'editor', 'thumbnail', 'revisions', 'page-attributes' ),
		'taxonomies' => array( 'category', 'post_tag' ),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 5,
		'menu_icon' => 'dashicons-megaphone',
		'show_in_nav_menus' => true,
		'publicly_queryable' => true,
		'exclude_from_search' => false,
		'has_archive' => true,
		'query_var' => true,
		'can_export' => true,
		'rewrite' => true,
		'capability_type' => 'post'
	);
	register_post_type( 'news', $args );
}
*/
