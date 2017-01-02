<?php
/**
 * Define the metabox and field configurations.
 *
 * @subpackage: seventeen-ldn-ny
 *
 * @link https://github.com/WebDevStudios/CMB2
 */

/**
 * Localise any date picker form in CMB2.
 * See http://api.jqueryui.com/datepicker/ for more info.
 * Refer to the CMB Field Types Wiki entry
 * if you wish to implement a different date format
 * per meta field using date_format.
 */
add_filter( 'cmb2_localized_data', 'seventeen_ldn_ny_cmb_set_date_format' );
function seventeen_ldn_ny_cmb_set_date_format( $l10n ) {
	$l10n['defaults']['date_picker']['dateFormat'] = 'dd-mm-yy';
	return $l10n;
}

// Exhibitions
//---------------------------------------------------------------------

// Slides
add_action( 'cmb2_admin_init', 'seventeen_ldn_ny_register_exhibition_images' );
function seventeen_ldn_ny_register_exhibition_images() {
	$prefix = '_seventeen_';

	$exhibition_images = new_cmb2_box( array(
		'id'           => $prefix . 'exhibition_images',
		'title'        => __( 'Exhibition Images', 'seventeen-ldn-ny' ),
		'object_types' => array( 'exhibitions', ),
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true,
	) );

	$exhibition_images->add_field( array(
		'id'      => $prefix . 'exhibition_documentation_images',
		'name'    => esc_html__( 'Images', 'seventeen-ldn-ny' ),
		'desc'    => esc_html__( 'Add images and videos to document the exhibition here.', 'seventeen-ldn-ny' ),
		'type'    => 'wysiwyg',
		'sanitization_cb' => 'seventeen_ldn_ny_sanitize_wysiwyg', // function should return a sanitized value
		'options' => array( 
			'textarea_rows' => 25,
			'teeny'         => true,
		),
	) );
}

add_action( 'cmb2_admin_init', 'seventeen_ldn_ny_register_exhibition_dates' );
function seventeen_ldn_ny_register_exhibition_dates() {
	$prefix = '_seventeen_';

	$exhibition_dates = new_cmb2_box( array(
		'id'           => $prefix . 'exhibition_dates',
		'title'        => __( 'Exhibition Dates', 'seventeen-ldn-ny' ),
		'object_types' => array( 'exhibitions', ),
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true,
	) );

	/*
	$exhibition_dates->add_field( array(
		'name' => 'Time zone',
		'id'   => $prefix . 'exhibition_timezone',
		'type' => 'select_timezone',
	) );
	*/

	$exhibition_dates->add_field( array(
		'name'        => __( 'Private View', 'seventeen-ldn-ny' ),
		'desc'        => __( 'The date and time of the private view', 'seventeen-ldn-ny' ),
		'id'          => $prefix . 'private_view',
		'type'        => 'text_datetime_timestamp',
		//'timezone_meta_key' => '_seventeen_exhibition_timezone',
		'date_format' => __( 'd-m-Y', 'seventeen-ldn-ny' ), 
	) );
	
	$exhibition_dates->add_field( array(
		'name'        => __( 'Start Date', 'seventeen-ldn-ny' ),
		'desc'        => __( 'The date the exhibition opens', 'seventeen-ldn-ny' ),
		'id'          => $prefix . 'startdate',
		'type'        => 'text_date_timestamp',
		//'timezone_meta_key' => '_seventeen_exhibition_timezone',
		'date_format' => __( 'd-m-Y', 'seventeen-ldn-ny' ), 
	) );
	
	$exhibition_dates->add_field( array(
		'name'        => __( 'End Date', 'seventeen-ldn-ny' ),
		'desc'        => __( 'The date and time the exhibition closes', 'seventeen-ldn-ny' ),
		'id'          => $prefix . 'enddate',
		'type'        => 'text_datetime_timestamp',
		//'timezone_meta_key' => '_seventeen_exhibition_timezone',
		'date_format' => __( 'd-m-Y', 'seventeen-ldn-ny' ), 
	) );

	$exhibition_dates->add_field( array(
		'name'        => __( 'End Date', 'seventeen-ldn-ny' ),
		'id'          => $prefix . 'endtdate_timezone',
		'type'        => 'text_datetime_timestamp_timezone',
		'date_format' => __( 'd-m-Y', 'seventeen-ldn-ny' ), 
	) );
}

add_action( 'cmb2_admin_init', 'seventeen_ldn_ny_register_curator_details' );
function seventeen_ldn_ny_register_curator_details() {
	$prefix = '_seventeen_';

	$curator_details = new_cmb2_box( array(
		'id'           => $prefix . 'curator_details',
		'title'        => __( 'Curator Details', 'seventeen-ldn-ny' ),
		'object_types' => array( 'exhibitions', ),
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true,
	) );

	$curator_details->add_field( array(
		'name'        => __( 'Curator/Organiser', 'seventeen-ldn-ny' ),
		'desc'        => __( 'Add details of the person who curated or organised the show. (Optional).', 'seventeen-ldn-ny' ),
		'id'          => $prefix . 'curated_by',
		'type'        => 'text',
	) );
}

add_action( 'cmb2_admin_init', 'seventeen_ldn_ny_register_offsite_location' );
function seventeen_ldn_ny_register_offsite_location() {
	$prefix = '_seventeen_';

	$offsite_location = new_cmb2_box( array(
		'id'           => $prefix . 'offsite_location',
		'title'        => __( 'Offsite Location', 'seventeen-ldn-ny' ),
		'object_types' => array( 'exhibitions', ),
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true,
	) );

	$offsite_location->add_field( array(
		'name'        => __( 'Location', 'seventeen-ldn-ny' ),
		'desc'        => __( 'Add details of the exhibition location. (Optional).', 'seventeen-ldn-ny' ),
		'id'          => $prefix . 'location',
		'type'        => 'text',
	) );
}


add_action( 'cmb2_admin_init', 'seventeen_ldn_ny_register_exhibition_download' );
function seventeen_ldn_ny_register_exhibition_download() {
	$prefix = '_seventeen_';

	$exhibition_download_group = new_cmb2_box( array(
		'id'           => $prefix . 'exhibition_downloads',
		'title'        => __( 'Downloads', 'seventeen-ldn-ny' ),
		'object_types' => array( 'exhibitions', ),
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true,
	) );

	$exhibition_download_group_field_id = $exhibition_download_group->add_field( array(
		'id'          => $prefix . 'exhibition_download',
		'type'        => 'group',
		'desc'        => __( 'Add a file or files that you want to make available for download. (Optional).', 'seventeen-ldn-ny' ),
		'options'     => array(
			'group_title'   => esc_html__( 'Download {#}', 'seventeen-ldn-ny' ), // {#} gets replaced by row number
			'add_button'    => esc_html__( 'Add Another Item', 'seventeen-ldn-ny' ),
			'remove_button' => esc_html__( 'Remove Item', 'seventeen-ldn-ny' ),
			'sortable'      => true,
		),
	) );

	$exhibition_download_group->add_group_field( $exhibition_download_group_field_id, array(
		'name' => esc_html__( 'Text', 'seventeen-ldn-ny' ),
		'id'   => 'exhibition_download_text',
		'type' => 'text',
	) );

	$exhibition_download_group->add_group_field( $exhibition_download_group_field_id, array(
		'name' => esc_html__( 'File', 'seventeen-ldn-ny' ),
		'id'   => 'exhibition_download_file',
		'type' => 'file',
	) );
}


// Artists
//---------------------------------------------------------------------

// Slides
add_action( 'cmb2_admin_init', 'seventeen_ldn_ny_register_artist_slides' );
function seventeen_ldn_ny_register_artist_slides() {
	$prefix = '_seventeen_';

	$artist_full_screen_slides = new_cmb2_box( array(
		'id'           => $prefix . 'artist_slides',
		'title'        => __( 'Artist Slides', 'seventeen-ldn-ny' ),
		'object_types' => array( 'artists', ),
		'context'      => 'normal',
		'priority'     => 'high',
		'show_names'   => true,
	) );

	$artist_full_screen_slides->add_field( array(
		'id'      => $prefix . 'artist_slide_images',
		'name'    => esc_html__( 'Full Screen Images', 'seventeen-ldn-ny' ),
		'desc'    => esc_html__( 'Add images and videos for the full screen slide-show here.', 'seventeen-ldn-ny' ),
		'type'    => 'wysiwyg',
		'sanitization_cb' => 'seventeen_ldn_ny_sanitize_wysiwyg', // function should return a sanitized value
		'options' => array( 
			'textarea_rows' => 25,
			'teeny'         => true,
		),
	) );
}

// Info
add_action( 'cmb2_admin_init', 'seventeen_ldn_ny_register_artist_info' );
function seventeen_ldn_ny_register_artist_info() {
	$prefix = '_seventeen_';

	$artist_info = new_cmb2_box( array(
		'id'            => $prefix . 'artist_info',
		'title'         => __( 'Artist Info', 'seventeen-ldn-ny' ),
		'object_types'  => array( 'artists', ),
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true,
	) );

	$artist_info->add_field( array(
		'name'        => __( 'CV', 'seventeen-ldn-ny' ),
		'desc'        => __( 'Upload a PDF or enter a URL.', 'seventeen-ldn-ny' ),
		'id'          => $prefix . 'artist_cv',
		'type'        => 'file',
	) );

	$artist_info->add_field( array(
		'name'        => __( 'Press', 'seventeen-ldn-ny' ),
		'desc'        => __( 'Upload a PDF or enter a URL.', 'seventeen-ldn-ny' ),
		'id'          => $prefix . 'artist_press',
		'type'        => 'file',
	) );

	$artist_info->add_field( array( 
		'name'		   => __( 'Additional Links', 'seventeen-ldn-ny' ),
		'desc'		   => __( 'Enter the URL and the text for any addtional links you wish to display. Click the "Choose" button to select from an existing page on the site. Links are added to the end of the CV and Press list.', 'seventeen-ldn-ny' ),
		'id'		   => $prefix . 'supplemental_links',
		'type'		   => 'link_picker',
		'options'      => array(
        	'add_row_text' => __( 'Add Another Link', 'seventeen-ldn-ny' ),
    	),
		'repeatable'   => 'true',
	) );
}


// News (Posts)
//---------------------------------------------------------------------
add_action( 'cmb2_admin_init', 'seventeen_ldn_ny_register_news_events' );
function seventeen_ldn_ny_register_news_events() {
	$prefix = '_seventeen_';

	$news_events = new_cmb2_box( array(
		'id'            => $prefix . 'news_events',
		'title'         => __( 'Event Details', 'seventeen-ldn-ny' ),
		'object_types'  => array( 'post', ),
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true,
	) );

	$news_events->add_field( array(
		'name'        => __( 'Event Start Date', 'seventeen-ldn-ny' ),
		'desc'        => __( 'The date of the event.', 'seventeen-ldn-ny' ),
		'id'          => $prefix . 'event_date',
		'type'        => 'text_date_timestamp',
		'date_format' => __( 'd-m-Y', 'seventeen-ldn-ny' ), 
	) );

	$news_events->add_field( array(
		'name' => esc_html__( 'Event Start Time', 'seventeen-ldn-ny' ),
		'desc' => esc_html__( 'The time the event starts.', 'seventeen-ldn-ny' ),
		'id'   => $prefix . 'event_start_time',
		'type' => 'text_time',
		'time_format' => 'g.ia',
	) );

	$news_events->add_field( array(
		'name' => esc_html__( 'Event End Time', 'seventeen-ldn-ny' ),
		'desc' => esc_html__( 'The time the event ends (optional).', 'seventeen-ldn-ny' ),
		'id'   => $prefix . 'event_end_time',
		'type' => 'text_time',
		'time_format' => 'g.ia',
	) );

}

add_action( 'cmb2_admin_init', 'seventeen_ldn_ny_register_news_featured_video' );
function seventeen_ldn_ny_register_news_featured_video() {
	$prefix = '_seventeen_';

	$news_feaured_video = new_cmb2_box( array(
		'id'            => $prefix . 'news_feaured_video',
		'title'         => __( 'Featured Video', 'seventeen-ldn-ny' ),
		'object_types'  => array( 'post', ),
		'context'       => 'normal',
		'priority'      => 'high',
		'show_names'    => true,
	) );

	$news_feaured_video->add_field( array(
		'name' => esc_html__( 'URL', 'seventeen-ldn-ny' ),
		'desc' => sprintf(
			/* translators: %s: link to codex.wordpress.org/Embeds */
			esc_html__( 'Enter a youtube, vimeo, twitter, or instagram URL. Supports services listed at %s.', 'seventeen-ldn-ny' ),
			'<a href="https://codex.wordpress.org/Embeds" target="_blank" rel="noopener">codex.wordpress.org/Embeds</a>'
		),
		'id'   => $prefix . 'news_featured_embed',
		'type' => 'oembed',
	) );
}


// Page - Information
//---------------------------------------------------------------------

add_action( 'cmb2_admin_init', 'seventeen_ldn_ny_register_team_info_metabox' );
function seventeen_ldn_ny_register_team_info_metabox() {
	$prefix = '_seventeen_';

	/**
	 * Repeatable Field Groups
	 */
	$team_info_group = new_cmb2_box( array(
		'id'           => $prefix . 'team_info',
		'title'        => esc_html__( 'The Seventeen Team', 'seventeen-ldn-ny' ),
		'object_types' => array( 'page', ),
		'show_on'      => array( 'key' => 'page-template', 'value' => 'page-templates/info-page.php' ),
	) );

	// $team_info_group_field_id is the field id string, so in this case: $prefix . 'team_contact_info'
	$team_info_group_field_id = $team_info_group->add_field( array(
		'id'          => $prefix . 'team_contact_info',
		'type'        => 'group',
		'description' => esc_html__( 'Add details and contact info for the Seventeen team.', 'seventeen-ldn-ny' ),
		'options'     => array(
			'group_title'   => esc_html__( 'Person {#}', 'seventeen-ldn-ny' ), // {#} gets replaced by row number
			'add_button'    => esc_html__( 'Add Another Person', 'seventeen-ldn-ny' ),
			'remove_button' => esc_html__( 'Remove Person', 'seventeen-ldn-ny' ),
			'sortable'      => true, // beta
		),
	) );

	/**
	 * Group fields works the same, except ids only need
	 * to be unique to the group. Prefix is not needed.
	 *
	 * The parent field's id needs to be passed as the first argument.
	 */
	$team_info_group->add_group_field( $team_info_group_field_id, array(
		'name'       => esc_html__( 'Name', 'seventeen-ldn-ny' ),
		'id'         => 'name',
		'type'       => 'text',
	) );
	$team_info_group->add_group_field( $team_info_group_field_id, array(
		'name'        => esc_html__( 'Title', 'seventeen-ldn-ny' ),
		'description' => esc_html__( 'Optional', 'seventeen-ldn-ny' ),
		'id'          => 'title',
		'type'        => 'text',
	) );
	$team_info_group->add_group_field( $team_info_group_field_id, array(
		'name'        => esc_html__( 'Phone', 'seventeen-ldn-ny' ),
		'description' => esc_html__( 'Optional', 'seventeen-ldn-ny' ),
		'id'          => 'phone',
		'type'        => 'text',
	) );
	$team_info_group->add_group_field( $team_info_group_field_id, array(
		'name'        => esc_html__( 'Email', 'seventeen-ldn-ny' ),
		'description' => esc_html__( 'Optional', 'seventeen-ldn-ny' ),
		'id'          => 'email',
		'type'        => 'text_email',
	) );
	$team_info_group->add_group_field( $team_info_group_field_id, array(
	    'name'             => esc_html__( 'Location', 'seventeen-ldn-ny' ),
	    'description'      => esc_html__( 'Select a Location', 'seventeen-ldn-ny' ),
	    'id'               => 'location_select',
	    'type'             => 'select',
	    'show_option_none' => true,
	    'default'          => 'none',
	    'options'          => array(
	        'London'   => __( 'London', 'seventeen-ldn-ny' ),
	        'New York' => __( 'New York', 'seventeen-ldn-ny' ),
	        'Both'     => __( 'Both', 'seventeen-ldn-ny' ),
	    ),
	) );
}


// Layout
//---------------------------------------------------------------------

//Add some custom styles so that the repoistioned metabox matches WP core
add_action('admin_head', 'seventeen_ldn_ny_custom_styles');
function seventeen_ldn_ny_custom_styles() {
	echo '<style type="text/css">
			#_seventeen_supplemental_links_repeat .cmb-td,
			#_seventeen_supplemental_links_repeat input,
			#_seventeen_supplemental_links_repeat textarea {
				width: 100%;
			}
			.cmb2-id--seventeen-supplemental-links .cmb2-metabox-description {
				margin-top: 5px;
			}
		</style>';
	/*
	echo '<style type="text/css">
		.cmb2-id--seventeen-artist-slide-images .cmb-th {
			float: none;
			width: 100%;
		}
		.cmb2-id--seventeen-artist-slide-images .cmb-th label {
			border-bottom: 1px solid;
		}
		.cmb2-id--seventeen-artist-slide-images label {
 			font-size: 23px;
    		font-weight: normal;
		}
		.cmb2-id--seventeen-artist-slide-images .cmb-td {
			padding-left: 0;
			padding-right: 0;
			width: 100%;
		}

		</style>';
	*/
}

/**
 * Display Artsit Slide metabox below main editor
 *
 * @link https://github.com/WebDevStudios/CMB2-Snippet-Library/blob/master/misc/outputting-forms-outside-metaboxes.php
 *
function seventeen_ldn_ny_output_custom_mb_location() {
	$cmb = cmb2_get_metabox( '_seventeen_artist_slides' );

	if ( in_array( get_post_type(), $cmb->prop( 'object_types' ), 1 ) ) {
		$cmb->show_form();
	}
}
add_action( 'edit_form_after_editor', 'seventeen_ldn_ny_output_custom_mb_location' );
*/


// Sanitization
//---------------------------------------------------------------------

/**
 * Sanitizes WYSIWYG fields like WordPress does for post_content fields.
 *
 * @link https://github.com/WebDevStudios/CMB2/wiki/Field-Parameters#sanitization_cb
 */
function seventeen_ldn_ny_sanitize_wysiwyg( $content ) {
    return apply_filters( 'content_save_pre', $content );
}
