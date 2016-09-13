<?php
/**
 * Custom CMB2 fieldtypes.
 *
 * @subpackage: seventeen-ldn-ny
 *
 * @link https://github.com/WebDevStudios/CMB2
 */

/**
 * Render 'supplemental links' custom field type
 * --------------------------------------------------------------------------------------
 * @since 0.1.0
 *
 * @param array  $field              The passed in `CMB2_Field` object
 * @param mixed  $value              The value of this field escaped.
 *                                   It defaults to `sanitize_text_field`.
 *                                   If you need the unescaped value, you can access it
 *                                   via `$field->value()`
 * @param int    $object_id          The ID of the current object
 * @param string $object_type        The type of object you are working with.
 *                                   Most commonly, `post` (this applies to all post-types),
 *                                   but could also be `comment`, `user` or `options-page`.
 * @param object $field_type_object  The `CMB2_Types` object
 */
function seventeen_ldn_ny_render_link_picker_callback( $field, $value, $object_id, $object_type, $field_type_object ) {
	
	// make sure we specify each part of the value we need.
	$value = wp_parse_args( $value, array(
		'text' => '',
		'url'  => '',
		'blank' => 'false',
	) );

	$blank_options = '';
	$blank_options .= '<option value="false" '. selected( $value['blank'], 'false', false ) .'>Opens in same</option>';
	$blank_options .= '<option value="true" '. selected( $value['blank'], 'true', false ) .'>Opens in new</option>';
	?>

	<div class="seventeen-ldn-ny-link-picker">
		<div class="seventeen-ldn-ny-text">
			<p>
				<label for="<?php echo $field_type_object->_id( '_text' ); ?>"><?php echo esc_html( $field_type_object->_text( 'link_picker_text', 'Text' ) ); ?></label>
			</p>
			<?php echo $field_type_object->input( array(
				'class' => 'cmb_text',
				'name'  => $field_type_object->_name( '[text]' ),
				'id'    => $field_type_object->_id( '_text' ),
				'value' => $value['text'],
				'desc'  => '',
			) ); ?>
		</div>
		<div class="seventeen-ldn-ny-url">
			<p>
				<label for="<?php echo $field_type_object->_id( '_url' ); ?>'"><?php echo esc_html( $field_type_object->_text( 'link_picker_url', 'URL' ) ); ?></label>
			</p>
			<?php echo $field_type_object->input( array(
				'class' => 'cmb_text_url',
				'name'  => $field_type_object->_name( '[url]' ),
				'id'    => $field_type_object->_id( '_url' ),
				'value' => $value['url'],
				'type'  => 'url',
				'desc'  => '',
			) ); ?>
		</div>
		<div class="seventeen-ldn-ny-blank">
			<p>
				<label for="<?php echo $field_type_object->_id( '_blank' ); ?>'"><?php echo esc_html( $field_type_object->_text( 'link_picker_blank', 'Tab' ) ); ?></label>
			</p>
			<?php echo $field_type_object->select( array(
				'class'   => 'cmb_checkbox',
				'name'    => $field_type_object->_name( '[blank]' ),
				'id'      => $field_type_object->_id( '_blank' ),
				'options' => $blank_options,
				'desc'    => '',
			) ); ?>
		</div>
		<div class="choose">
			<p>
				<label>Choose</label>
			</p>
			<button class="dashicons dashicons-admin-links js-insert-link button button-primary" title="<?php esc_html_e( 'Insert Link', 'seventeen-ldn-ny' ); ?>">
				<span class="screen-reader-text"><?php esc_html_e( 'Choose Link', 'seventeen-ldn-ny' ); ?></span>
			</button>
		</div>
	</div>
	<p class="clear">
		<?php echo $field_type_object->_desc();?>
	</p>
	<?php
}
add_filter( 'cmb2_render_link_picker', 'seventeen_ldn_ny_render_link_picker_callback', 10, 5 );

/**
 * Optionally save the Link values into separate fields
 */
function seventeen_ldn_ny_split_supplemental_link_values( $override_value, $value, $object_id, $field_args ) {
	if ( ! isset( $field_args['split_values'] ) || ! $field_args['split_values'] ) {
		
		// Don't do the override
		return $override_value;
	}
	$link_keys = array( 
		'text', 
		'url',
		'blank'
	);
	foreach ( $link_keys as $key ) {
		if ( ! empty( $value[ $key ] ) ) {
			update_post_meta( $object_id, $field_args['id'] . '_' . $key, $value[ $key ] );
		}
	}
	
	// Tell CMB2 we already did the update
	return true;
}
add_filter( 'cmb2_sanitize_link_picker', 'seventeen_ldn_ny_split_supplemental_link_values', 12, 4 );

/**
 * The following snippets are required for allowing the review field
 * to work as a repeatable field, or in a repeatable group
 *
 * @link https://github.com/WebDevStudios/CMB2/issues/373
 */
function seventeen_ldn_ny_sanitize_supplemental_field( $check, $meta_value, $object_id, $field_args, $sanitize_object ) {
	
	// if not repeatable, bail out.
	if ( ! is_array( $meta_value ) || ! $field_args['repeatable'] ) {
		return $check;
	}

	foreach ( $meta_value as $key => $val ) {
		$meta_value[ $key ] =  null;
		if( ! empty( $val['url'] ) ) {
			$meta_value[ $key ] = array_filter( array_map( 'sanitize_text_field', $val ) );
		}
	}

	//return $meta_value;
	return array_filter($meta_value);
}
add_filter( 'cmb2_sanitize_link_picker', 'seventeen_ldn_ny_sanitize_supplemental_field', 10, 5 );

function seventeen_ldn_ny_types_esc_supplemental_field( $check, $meta_value, $field_args, $field_object ) {
	
	// if not repeatable, bail out.
	if ( ! is_array( $meta_value ) || ! $field_args['repeatable'] ) {
		return $check;
	}

	foreach ( $meta_value as $key => $val ) {
		$meta_value[ $key ] =  null;
		if( ! empty( $val['url'] ) ) {
			$meta_value[ $key ] = array_filter( array_map( 'esc_attr', $val ) );
		}
	}

	//return $meta_value;
	return array_filter($meta_value);
}
add_filter( 'cmb2_types_esc_link_picker', 'seventeen_ldn_ny_types_esc_supplemental_field', 10, 4 );


/**
 * Enqueue scripts and styles.
 */
function seventeen_ldn_ny_cmb2_fieldtypes_scripts() {

	global $post_id;

	define( 'SEVENTEEN_LDN_NY_FIELDTYPES_ROOT', __FILE__ );
	//define( 'SEVENTEEN_LDN_NY_LP_TEXT_DOMAIN', 'seventeen-ldn-ny' );

	// CSS
	$plugin_css_url = plugins_url( 'css/link-picker.css', SEVENTEEN_LDN_NY_FIELDTYPES_ROOT );
	wp_enqueue_style( 'seventeen-ldn-ny', $plugin_css_url );

	// Media
	if ( isset( $post_id ) ) {
		wp_enqueue_media( array( 'post' => $post_id ) );
	}

	// Scripts
	$plugin_js_url = plugins_url( 'js/link-picker.js', SEVENTEEN_LDN_NY_FIELDTYPES_ROOT );
	wp_enqueue_script( 'seventeen-ldn-ny', $plugin_js_url, array( 'jquery', 'jquery-ui-core', 'jquery-ui-draggable', 'jquery-ui-droppable', 'thickbox', 'wpdialogs' ), '1.0.0', true );
}
add_action( 'admin_enqueue_scripts', 'seventeen_ldn_ny_cmb2_fieldtypes_scripts' );
