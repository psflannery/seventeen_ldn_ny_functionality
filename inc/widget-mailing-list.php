<?php

/**
 * Mailing List widget
 *
 * @since 1.0
 */
class SEVENTEEN_Mailing_List_Widget extends WP_Widget {
    
    /**
     * Holds widget settings defaults, populated in constructor.
     *
     * @since 1.0
     * @var array
     */
    protected $defaults;

    /**
     * Constructor
     *
     * @since 1.0
     */
    function __construct() {
        // widget defaults
        $this->defaults = array(
            'title'    => '',
            'uniqueID' => '',
        );
        
        // Widget Slug
        $widget_slug = 'seventeen-mailing-list';

        // widget basics
        $widget_ops = array(
            'classname'   => $widget_slug,
            'description' => 'A widget to diplay the mailing list sign-up form.'
        );

        // widget controls
        $control_ops = array(
            'id_base' => $widget_slug,
            //'width'   => '400',
        );

        // load widget
        parent::__construct( $widget_slug, 'Mailing List', $widget_ops, $control_ops );      
    }

    /**
     * Outputs the HTML for this widget.
     *
     * @since 1.0
     * @param array $args An array of standard parameters for widgets in this theme 
     * @param array $instance An array of settings for this widget instance 
     */
    function widget( $args, $instance ) {
        extract( $args );

        // Merge with defaults
        $instance = wp_parse_args( (array) $instance, $this->defaults );

        echo $before_widget;

        echo '<div class="contact-form vr-contact-form">'; ?>

        <form class="form-horizontal" method="post" action="http://oi.vresp.com?fid=<?php esc_html_e( $uniqueID ); ?>" target="vr_optin_popup" onsubmit="window.open( 'http://www.verticalresponse.com', 'vr_optin_popup', 'scrollbars=yes,width=600,height=450' ); return true;">
            <fieldset>
                <?php
                    // Title
                    if ( !empty( $instance['title'] ) ) { 
                        echo '<legend>' . $instance['title'] . '</legend>';
                    }
                ?>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="control-group">
                            <!--<label class="control-label" for="email_address" ><?php //esc_html_e( 'Email Address:', 'seventeen-ldn-ny' ); ?></label>-->
                            <div class="controls">
                                <input id="email" name="email_address" type="email" placeholder="Email" class="form-control" required tabindex="1">
                            </div>
                        </div>
                        <div class="control-group">
                            <!--<label class="control-label" for="first_name"><?php //esc_html_e( 'First Name:', 'seventeen-ldn-ny' ); ?></label>-->
                            <div class="controls">
                                <input id="first-name" name="first_name" type="text" placeholder="First Name" class="form-control" required tabindex="2">
                            </div>
                        </div>
                        <div class="control-group">
                            <!--<label class="control-label" for="last_name"><?php //esc_html_e( 'Last Name:', 'seventeen-ldn-ny' ); ?></label>-->
                            <div class="controls">
                                <input id="last-name" name="last_name" type="text" placeholder="Last Name" class="form-control" required tabindex="3">
                            </div>
                        </div>
                    </div>
                    <div class="controls col-sm-12">
                        <input type="submit" value="Join Now" tabindex="4" class="btn-link link-text-color btn-right btn-form">
                    </div>
                </div>
            </fieldset>
        </form>

        <?php
        echo '</div>';

        echo $after_widget;
    }

    /**
     * Deals with the settings when they are saved by the admin. Here is
     * where any validation should be dealt with.
     *
     * @since 1.0
     * @param array $new_instance An array of new settings as submitted by the admin
     * @param array $old_instance An array of the previous settings 
     * @return array The validated and (if necessary) amended settings
     */
    function update( $new_instance, $old_instance ) {
        $new_instance['title']    = strip_tags( $new_instance['title'] );
        $new_instance['uniqueID'] = esc_html( $new_instance['uniqueID'] );
        return $new_instance;
    }

    /**
     * Displays the form for this widget on the Widgets page of the WP Admin area.
     *
     * @since 1.0
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
            <label for="<?php echo $this->get_field_id( 'uniqueID' ); ?>">Unique ID:</label>
            <input type="text" id="<?php echo $this->get_field_id( 'uniqueID' ); ?>" name="<?php echo $this->get_field_name( 'uniqueID' ); ?>" value="<?php echo esc_attr( $instance['uniqueID'] ); ?>" class="widefat" />
        </p>
        <?php
    }
}
add_action( 'widgets_init', create_function( '', "register_widget('SEVENTEEN_Mailing_List_Widget');" ) );
