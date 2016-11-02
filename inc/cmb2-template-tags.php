<?php
/**
 * Custom CMB2 template tags for this theme.
 *
 * @subpackage: seventeen-ldn-ny
 *
 * @link https://github.com/WebDevStudios/CMB2
 */

/**
 * Returns the exhibition date in a pretty format.
 *
 * @since Seventeen 1.0.0
 */
function seventeen_ldn_ny_exhibition_dates() {
	global $post;
	$start_date = get_post_meta($post->ID, '_seventeen_startdate', true);
	$end_date = get_post_meta($post->ID, '_seventeen_enddate', true);

    if ( '' != $start_date ):
        //convert to pretty formats 
        $clean_start_date = date("jS F", $start_date);
        $clean_end_date = date("jS F, Y", $end_date);
        
        //output the date
        $exhibition_date = '';
        $exhibition_date .= $clean_start_date;
        $exhibition_date .= ' - ' . $clean_end_date;
        
        return esc_html( $exhibition_date );
    endif;
}

/**
 * Display or retrieve the exhibition date with optional markup.
 *
 * @since Seventeen 1.0.0
 */
function seventeen_ldn_ny_do_exhibition_dates( $before = '', $after = '', $echo = true ) {
	$exhibition_dates = seventeen_ldn_ny_exhibition_dates();

	if ( strlen($exhibition_dates) == 0 )
        return;

    $exhibition_dates = $before . $exhibition_dates . $after;

    if ( $echo )
        echo $exhibition_dates;
    else
        return $exhibition_dates;
}

/**
 * Returns the private view date in a pretty format.
 *
 * @since Seventeen 1.0.0
 */
function seventeen_ldn_ny_event_dates() {
	global $post;
    if ( 'exhibitions' === get_post_type() ) :
    	$event_date = get_post_meta($post->ID, '_seventeen_private_view', true);

    	if ( '' != $event_date ):
            if ( $event_date <= time() && !is_single() )
                return;

    		$clean_event_date = date("l jS F, ga", $event_date);

    		return esc_html( $clean_event_date );
    	endif;
    endif;

    if ( 'post' === get_post_type() ) :
        $event_date = get_post_meta($post->ID, '_seventeen_event_date', true);
        $event_start_time = get_post_meta($post->ID, '_seventeen_event_start_time', true);
        $event_end_time = get_post_meta($post->ID, '_seventeen_event_end_time', true);

        if ( '' != $event_date ):
            $clean_event_date = date("l jS F", $event_date);

            $event = '';
            $event .= $clean_event_date;

            if ( '' === $event_end_time ):
                $event .= esc_html( ' at ', 'seventeen-ldn-ny' );
            else:
                $event .= esc_html( ', ', 'seventeen-ldn-ny' );
            endif;

            $event .=  $event_start_time;

            if ( '' !== $event_end_time ):
                $event .= esc_html( ' - ', 'seventeen-ldn-ny' );
            endif;

            $event .= $event_end_time;

            return esc_html( $event );
        endif;
    endif;
}

/**
 * Display or retrieve the event date with optional markup.
 *
 * @since Seventeen 1.0.0
 */
function seventeen_ldn_ny_do_event_dates( $before = '', $after = '', $echo = true ) {
	$event_date = seventeen_ldn_ny_event_dates();

	if ( strlen($event_date) == 0 )
        return;

    $event_date = $before . $event_date . $after;

    if ( $echo )
        echo $event_date;
    else
        return $event_date;
}

/**
 * Returns HTML for the Additional artist links added in the post meta.
 * 
 * @since Seventeen 1.0.0
 * TODO: works, but feel logic could be improved
 */
function seventeen_ldn_ny_artist_additional_links() {
    $links = get_post_meta( get_the_ID(), '_seventeen_supplemental_links', true );

    if ( '' === $links ) {
        // Bail if we don't have any links.
        return;
    }

    $additional_link = array();

    foreach ( $links as $link ) {
        if ( isset( $link['text'] ) ) {
            $text = esc_html( $link['text'] );
            if ( isset( $link['blank'] ) ) {
                $target = esc_attr( $link['blank'] );
                $target = $target === 'true' ? 'target="_blank" rel="noopener"' : '';
            }
            if ( isset( $link['url'] ) ) {
                $url = esc_url( $link['url'] );
                $additional_link[] = sprintf( '<a href="%s" rel="bookmark" %s>%s</a>', $url, $target, $text );
            }
        }
    }

    return $additional_link;
}

/**
 * Returns HTML for the Artist Info added in the post meta.
 * 
 * @since Seventeen 1.0.0
 */
function seventeen_ldn_ny_artist_info() {
    global $post;
    $cv = get_post_meta($post->ID, '_seventeen_artist_cv', true);
    $press = get_post_meta($post->ID, '_seventeen_artist_press', true);

    $output = array();

    if ( '' != $cv ) :
        $output['CV'] = $cv;
    endif;

    if ( '' != $press ) :
        $output['Press'] = $press;
    endif;

    return $output;
}

/**
 * Echos HTML for the Artist Info added in the post meta.
 *
 * @since Seventeen 1.0.0
 */
function seventeen_ldn_ny_do_artist_info( $before = '', $after = '', $wrap = false ) {

    $links = seventeen_ldn_ny_artist_info();
    $addtional_links = seventeen_ldn_ny_artist_additional_links();

    if ( '' === $links ) {
        return;
    }

    $output = '';

    if ( $wrap && $links ) {
        $output .= '<ul class="list-unstyled">';
    }

    foreach( $links as $text => $link ){
        $output .= sprintf( '%s<a href="%s">' . get_the_title() . ' ' . '%s</a>%s', $before, $link, $text, $after );
    }

    if ( '' != $addtional_links ) {
        foreach ( $addtional_links as $addtional_link ) {
            $output .= sprintf( '%s' . $addtional_link . '%s', $before, $after );
        }
    }

    if ( $wrap && $links  ) {
        $output .= '</ul>';
    }

    echo $output;
}

/**
 * Returns HTML for the Curator Details added in the post meta.
 * 
 * @since Seventeen 1.0.0
 */
function seventeen_ldn_ny_curator_details() {
    global $post;
    $curator = get_post_meta($post->ID, '_seventeen_curated_by', true);

    if ( '' == $curator ) {
        return;
    }

    return $curator;
}

/**
 * Echos HTML for the Curator Details added in the post meta.
 * 
 * @since Seventeen 1.0.0
 */
function seventeen_ldn_ny_do_curator_details( $before = '', $after = '' ) {
    $curator = seventeen_ldn_ny_curator_details();

    if ( '' == $curator ) {
        return;
    }

    $curator = $before . $curator . $after;

    echo $curator;
}

/**
 * Echos HTML for the featured Oembeds added in the post meta.
 *
 * @since Seventeen 1.0.0
 */
function seventeen_ldn_ny_do_oembed( $before = '', $after = '' ) {
    $embed = esc_url( get_post_meta( get_the_ID(), '_seventeen_news_featured_embed', 1 ) );

    if ( '' == $embed ) {
        return;
    }

    $embed = $before . wp_oembed_get( $embed ) . $after;

    echo $embed;
}

/**
 * Returns HTML for the Artist or Exhibition images added in the post meta.
 * 
 * @since Seventeen 1.0.0
 */
function seventeen_ldn_ny_artist_images() {
    $slides = seventeen_ldn_ny_get_wysiwyg_output( '_seventeen_artist_slide_images' );
    $slides .= seventeen_ldn_ny_get_wysiwyg_output( '_seventeen_exhibition_documentation_images' );

    if ( '' == $slides )
        return;
    
    return $slides;
}

/**
 * Echos HTML for the Artist or Exhibition images added in the post meta.
 *
 * @since Seventeen 1.0.0
 */
function seventeen_ldn_ny_do_artist_images( $before = '', $after = '' ) {
    $slides = seventeen_ldn_ny_artist_images();

    if ( '' == $slides )
        return;

    $slides = $before . $slides . $after;

    echo $slides;
}

/**
 * Returns HTML for the Artist Exhibition Info added in the post meta.
 * 
 * @since Seventeen 1.0.0
 */
function seventeen_ldn_ny_artist_exhibition_info( $before = '', $after = '', $wrap = false ) {
    global $post;

    $exhibitions = get_post_meta( get_the_ID(), '_seventeen_attached_artist_exhibitions', true );

    if ( '' == $exhibitions ) {
        // Bail if we don't have any exhibitions.
        return;
    }

    echo '<h2>' . esc_html( 'Exhibitions', 'seventeen-ldn-ny' ) . '</h2>';

    if ( $wrap && $exhibitions ) {
        echo '<ul class="list-unstyled">';
    }

    foreach ( $exhibitions as $exhibition ) {
        $post = get_post( $exhibition );
        setup_postdata( $post );
        the_title( $before . '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a>' . $after );
    }
    wp_reset_postdata();

    if ( $wrap && $exhibitions ) {
        echo '</ul>';
    }
}

// Helper Functions
//---------------------------------------------------------------------
/**
 * Apply oembed filters and shortcodes to the wysiwyg content
 *
 * @since Seventeen 1.0.0
 */
function seventeen_ldn_ny_get_wysiwyg_output( $meta_key, $post_id = 0 ) {
    global $wp_embed;

    $post_id = $post_id ? $post_id : get_the_id();

    $content = get_post_meta( $post_id, $meta_key, 1 );
    $content = $wp_embed->autoembed( $content );
    $content = $wp_embed->run_shortcode( $content );
    $content = do_shortcode( $content );
    $content = wpautop( $content );

    /**
     * Adds markup to images and videos for display in the fullscreen flickity carousel on artist post-type.
     *
     * @return string
     * @props http://micahjon.com/removing-wrapping-p-tags-around-images-in-wordpress/
     */
    if ( 'artists' === get_post_type() ) {
        $placeholder = 'data:image/gif;base64,R0lGODdhAQABAPAAAP///wAAACwAAAAAAQABAEACAkQBADs=';

        // Images without captions
        $img_pattern = '/<p>\\s*?(<a rel=\"attachment.*?><img([^>]+?)src=[\'"]?([^\'"\s>]+)[\'"]?([^>]*)><\\/a>|<img([^>]+?)src=[\'"]?([^\'"\s>]+)[\'"]?([^>]*)>)?\\s*<\\/p>/s';
        $img_replacement = sprintf( '<div class="flickity-carousel-cell flickity-carousel-lazy"><div class="maintain-aspect-wrap"><div class="maintain-aspect-media wp-captionless"><img${5}src="%s" data-flickity-lazyload="${6}"${7}></div></div></div>', $placeholder );

        // Iframes
        $iframe_pattern = '/(<div[^>]*>?\s*<figure class=)[\'"]?([^\'"\s>]+)[\'"]?(.*?<\/div>)/s';
        $iframe_replacement = '<div class="flickity-carousel-cell flickity-carousel-lazy">${1}"${2} flickity-video-screen"${3}</div>';

        // Images with captions
        // May need to allow for images with links
        $caption_pattern = '/(<figure[^>]+? class=)[\'"]?([^\'">]+)[\'"]?(.*?<img[^>]+? src=)[\'"]?([^\'"\s>]+)[\'"]?(.*?<\/figure>)/si';
        $caption_replacement = sprintf( '<div class="flickity-carousel-cell flickity-carousel-lazy"><div class="maintain-aspect-wrap">${1}"${2} maintain-aspect-media"src=${3}"%s" data-flickity-lazyload="${4}"${5}</div></div>', $placeholder );

        $patterns = array( $img_pattern, $caption_pattern, $iframe_pattern );
        $replacements = array( $img_replacement, $caption_replacement, $iframe_replacement );

        $content = preg_replace( $patterns, $replacements, $content );
    }
    
    return $content;
}
