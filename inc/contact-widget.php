<?php

/**
 * Contact widget
 *
 * @since 1.1.0
 */
class SEVENTEEN_Contact_Details_Widget extends WP_Widget {

	/**
	 * Holds widget settings defaults, populated in constructor.
	 *
	 * @since 1.1.0
	 * @var array
	 */
	protected $defaults;

	/**
	 * Constructor
	 *
	 * @since 1.1.0
	 */
	function __construct() {
		// widget defaults
		$this->defaults = array(
			'title'     => '',
			'street'    => '',
			'city'      => '',
			'post_code' => '',
			'phone'     => '',
			'email'     => '',
			'map'       => '',
		);
		
		// Widget Slug
		$widget_slug = 'seventeen-contact-address';

		// widget basics
		$widget_ops = array(
			'classname'   => $widget_slug,
			'description' => 'A widget to diplay the gallery address and contact details.'
		);

		// widget controls
		$control_ops = array(
			'id_base' => $widget_slug,
			//'width'   => '400',
		);

		// load widget
		parent::__construct( $widget_slug, 'Contact Details', $widget_ops, $control_ops );		
	}


	/**
	 * Outputs the HTML for this widget.
	 *
	 * @since 1.1.0
	 * @param array $args An array of standard parameters for widgets in this theme 
	 * @param array $instance An array of settings for this widget instance 
	 */
	function widget( $args, $instance ) {
		extract( $args );

		// Merge with defaults
		$instance = wp_parse_args( (array) $instance, $this->defaults );

		echo $before_widget;
			
			// Title
			if ( !empty( $instance['title'] ) ) { 
				echo $before_title . apply_filters( 'widget_title', $instance['title'] ) . $after_title;
			}

			echo '<div class="site-info vcard">';

			if( !empty ( $instance['street'] ) || !empty ( $instance['city'] ) || !empty ( $instance['postcode'] ) ) {
				echo '<p class="adr">';

				// Map - open anchor
				if ( !empty( $instance['map'] ) ) {
					echo '<a href="' . esc_url( $instance['map'] )  . '"" target="_blank" rel="noopener" class="link-text-color">';
				}
				
				// Street
				if ( !empty( $instance['street'] ) ) {
					echo '<span class="street-address info-item">' . esc_html( $instance['street'] ) . '</span>';
				}
				
				// City
				if ( !empty( $instance['city'] ) ) {
					echo '<span class="region info-item">' . esc_html( $instance['city'] ) . '</span>';
				}
				
				// Post Code
				if ( !empty( $instance['post_code'] ) ) {
					echo '<span class="postal-code info-item">' . esc_html( $instance['post_code'] ) . '</span>';
				}
				
				// Map - close anchor
				if ( !empty( $instance['map'] ) ) {
					echo '</a>';
				}

				echo '</p>';
			}
			
			// Phone
			if ( !empty( $instance['phone'] ) ) {
				echo '<span itemprop="telephone" class="tel info-item">' . esc_html( $instance['phone'] ) . '</span>';
			}
			
			// Email
			if ( !empty( $instance['email'] ) ) {
				echo '<span class="email info-item"><a href="mailto:' . antispambot( sanitize_email( $instance['email'] ) ) . '" target="_blank" class="link-text-color">' . antispambot( sanitize_email( $instance['email'] ) ) . '</a></span>';
			}

			echo '</div>';

		echo $after_widget;
	}

	/**
	 * Deals with the settings when they are saved by the admin. Here is
	 * where any validation should be dealt with.
	 *
	 * @since 1.1.0
	 * @param array $new_instance An array of new settings as submitted by the admin
	 * @param array $old_instance An array of the previous settings 
	 * @return array The validated and (if necessary) amended settings
	 */
	function update( $new_instance, $old_instance ) {
		$new_instance['title']     = strip_tags( $new_instance['title'] );
		$new_instance['street']    = esc_html( $new_instance['street'] );
		$new_instance['city']      = esc_html( $new_instance['city'] );
		$new_instance['post_code'] = esc_html( $new_instance['post_code'] );
		$new_instance['phone']     = esc_html( $new_instance['phone'] );
		$new_instance['email']     = sanitize_email( $new_instance['email'] );
		$new_instance['map']       = esc_url( $new_instance['map'] );
		return $new_instance;
	}

	/**
	 * Displays the form for this widget on the Widgets page of the WP Admin area.
	 *
	 * @since 1.1.0
	 * @param array $instance An array of the current settings for this widget
	 */
	function form( $instance ) {
		// Merge with defaults
		$instance = wp_parse_args( (array) $instance, $this->defaults );
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'street' ); ?>">Street:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'street' ); ?>" name="<?php echo $this->get_field_name( 'street' ); ?>" value="<?php echo esc_attr( $instance['street'] ); ?>" class="widefat" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'city' ); ?>">City:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'city' ); ?>" name="<?php echo $this->get_field_name( 'city' ); ?>" value="<?php echo esc_attr( $instance['city'] ); ?>" class="widefat" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'post_code' ); ?>">Post Code:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'post_code' ); ?>" name="<?php echo $this->get_field_name( 'post_code' ); ?>" value="<?php echo esc_attr( $instance['post_code'] ); ?>" class="widefat" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'phone' ); ?>">Phone:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'phone' ); ?>" name="<?php echo $this->get_field_name( 'phone' ); ?>" value="<?php echo esc_attr( $instance['phone'] ); ?>" class="widefat" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'email' ); ?>">Email:</label>
			<input type="email" id="<?php echo $this->get_field_id( 'email' ); ?>" name="<?php echo $this->get_field_name( 'email' ); ?>" value="<?php echo esc_attr( $instance['email'] ); ?>" class="widefat" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'map' ); ?>">Map:</label>
			<input type="url" id="<?php echo $this->get_field_id( 'map' ); ?>" name="<?php echo $this->get_field_name( 'map' ); ?>" value="<?php echo esc_attr( $instance['map'] ); ?>" class="widefat" />
		</p>
		<?php
	}
}
add_action( 'widgets_init', create_function( '', "register_widget('SEVENTEEN_Contact_Details_Widget');" ) );
