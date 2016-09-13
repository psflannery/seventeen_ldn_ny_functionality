<?php
/**
 * Creates the Shortcodes used in the site.
 * 
 * @subpackage: seventeen
 */

/* Legacy block shortcode - keep this so as not to break anything 
add_shortcode('block', 'block');
function block( $atts, $content = null ) {
	return '<div class="block">' . do_shortcode($content) . '</div>';
}
*/

/**
 * Use shortcodes in widgets
 */
add_filter( 'widget_text', 'do_shortcode' );

/*
 * Clean up formatting in shortcodes
 *
function seventeen_ldn_ny_clean_shortcodes($content) {   
	$array = array (
		'<p>[' => '[', 
		']</p>' => ']',
		']<br />' => ']'
	);
	$content = strtr($content, $array);
	return $content;
}
add_filter('the_content', 'seventeen_ldn_ny_clean_shortcodes');
*/

/**
 * Wraps content in a div 
 *
 * Example usage: [block]lorem ipsum[/block]
 */
add_shortcode('block', 'seventeen_block_shortcode');
function seventeen_block_shortcode( $atts, $content = null ) {
	$block = shortcode_atts( array(
		'class' => 'block',
	), $atts );

	return '<div class="' . esc_attr($block['class']) . '">' . $content . '</div>';
}

/**
 * Wraps content in a div and parses an attribute
 *
 * Example usage: div id="foo" class="bar"]
 */
add_shortcode('div', 'seventeen_div_shortcode');
//function seventeen_div_shortcode($atts) {
function seventeen_div_shortcode($atts, $content = null) {
	extract(shortcode_atts(array('class' => '', 'id' => '' ), $atts));
	$return = '<div';
	if (!empty($class)) $return .= ' class="'.$class.'"';
	if (!empty($id)) $return .= ' id="'.$id.'"';
	$return .= '>';
	return $return;
}

add_shortcode('end-div', 'seventeen_end_div_shortcode');
function seventeen_end_div_shortcode($atts) {
	return '</div>';
}

/**
 * Hide email from Spam Bots using a shortcode.
 *
 * Example usage: [email]john.doe@mysite.com[/email]
 *
 * @param array  $atts    Shortcode attributes. Not used.
 * @param string $content The shortcode content. Should be an email address.
 *
 * @return string The obfuscated email address. 
 */
add_shortcode( 'email', 'seventeen_hide_email_shortcode' );
function seventeen_hide_email_shortcode( $atts , $content = null ) {
	if ( ! is_email( $content ) ) {
		return;
	}

	return '<a href="mailto:' . antispambot( $content ) . '">' . antispambot( $content ) . '</a>';
}
