<?php
/**
 * Miscellaneous housekeeping and extras used throughout the site.
 * ...mainly just a bit of tidy up.
 * 
 * @subpackage: opening times
 *
 * Much of the content here is taken from Bill Erikson's Core Functionality Plugin. Details below.
 */

/**
 * Don't Update Plugin
 * 
 * This prevents you being prompted to update if there's a public plugin
 * with the same name.
 *
 * @author Mark Jaquith
 * @link http://markjaquith.wordpress.com/2009/12/14/excluding-your-plugin-or-theme-from-update-checks/
 *
 * @param array $r, request arguments
 * @param string $url, request url
 * @return array request arguments
 *
 * @since 1.0.0
 */
function seventeenldn_ny_core_functionality_hidden( $r, $url ) {
	if ( 0 !== strpos( $url, 'http://api.wordpress.org/plugins/update-check' ) )
		return $r; // Not a plugin update request. Bail immediately.
	$plugins = unserialize( $r['body']['plugins'] );
	unset( $plugins->plugins[ plugin_basename( __FILE__ ) ] );
	unset( $plugins->active[ array_search( plugin_basename( __FILE__ ), $plugins->active ) ] );
	$r['body']['plugins'] = serialize( $plugins );
	return $r;
}
add_filter( 'http_request_args', 'seventeenldn_ny_core_functionality_hidden', 5, 2 );

/**
 * Remove Menu Items
 * @since 1.0.0
 *
 * Remove unused menu items by adding them to the array.
 * See the commented list of menu items for reference.
 *
 */
function seventeen_ldn_ny_remove_menus () {
	global $menu;
	$restricted = array(__('Comments'));
	// Example:
	//$restricted = array(__('Dashboard'), __('Posts'), __('Media'), __('Links'), __('Pages'), __('Appearance'), __('Tools'), __('Users'), __('Settings'), __('Comments'), __('Plugins'));
	end ($menu);
	while (prev($menu)){
		$value = explode(' ',$menu[key($menu)][0]);
		if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){unset($menu[key($menu)]);}
	}
}
add_action( 'admin_menu', 'seventeen_ldn_ny_remove_menus' );

/**
 * Remove the comments links from the admin bar
 */
function seventeen_ldn_ny_filter_admin_bar() {
	if( is_admin_bar_showing() ) {
		remove_action( 'admin_bar_menu', 'wp_admin_bar_comments_menu', 60 );	// WP 3.3
	}
}
add_action( 'template_redirect', 'seventeen_ldn_ny_filter_admin_bar' );
add_action( 'admin_init', 'seventeen_ldn_ny_filter_admin_bar' );

/**
 * Don't let WPSEO metabox be high priority
 */
add_filter( 'wpseo_metabox_prio', function(){ return 'low'; } );

/**
 * Remove WPSEO Notifications
 */
function ea_remove_wpseo_notifications() {
	if( ! class_exists( 'Yoast_Notification_Center' ) )
		return;
		
	remove_action( 'admin_notices', array( Yoast_Notification_Center::get(), 'display_notifications' ) );
	remove_action( 'all_admin_notices', array( Yoast_Notification_Center::get(), 'display_notifications' ) );
}
add_action( 'init', 'ea_remove_wpseo_notifications' );

/**
 * Remove Yoast SEO Columns 
 */
function seventeen_ldn_ny_remove_columns( $columns ) {
	// remove the Yoast SEO columns
	unset( $columns['wpseo-score'] );
	unset( $columns['wpseo-title'] );
	unset( $columns['wpseo-metadesc'] );
	unset( $columns['wpseo-focuskw'] );
 
	return $columns;
}
add_filter ( 'manage_edit-post_columns', 'seventeen_ldn_ny_remove_columns' );
add_filter ( 'manage_edit-page_columns', 'seventeen_ldn_ny_remove_columns' );

/*
 * Add super and sub script buttons to tinymce. Disabled by default.
 */
function seventeen_ldn_ny_mce_buttons_2($buttons) {	
	$buttons[] = 'superscript';
	$buttons[] = 'subscript';

	return $buttons;
}
add_filter('mce_buttons_2', 'seventeen_ldn_ny_mce_buttons_2');

/*
 * Hide the Github Updater settings page.
 */
add_filter( 'github_updater_hide_settings', '__return_true' );
