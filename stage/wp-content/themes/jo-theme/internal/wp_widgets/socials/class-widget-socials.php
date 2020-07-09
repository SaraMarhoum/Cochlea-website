<?php if ( ! defined( 'ABSPATH' ) ) { die( 'Direct access forbidden.' ); }

/*! ===================================
 *  Author: BBDesign & WPHunters
 *  -----------------------------------
 *  Email(support):
 * 	bbdesign_sp@yahoo.com
 *  ===================================
 */

class WPH_JO_Widget_Socials extends WP_Widget {

	function __construct() {
		parent::__construct(
			// base ID of your widget
			'wph_jo_socials',

			// widget name will appear in UI
			esc_html__( 'Social networks widget', 'jo-theme' ),

			// widget description
			array( 'description' => esc_html__( 'Displays list of social network buttons.', 'jo-theme' ) )
		);
	}

	// widget front-end
	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'Find me on', 'jo-theme' );
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		// before and after widget arguments are defined by themes
		echo $args['before_widget'] . $args['before_title'] . $title . $args['after_title'];
		$socials = wph_jo_display_socials( 'options', true );

		// display warn
		if ( ! trim( $socials ) ) {
			echo esc_html__( 'Define your socials theme options settings', 'jo-theme' );
			echo $args['after_widget'];

			return;
		}

		// run code & draw output
		echo '<div class="socials-inner site-socials">' . $socials . '</div>';
		echo $args['after_widget'];
	}


	/**
	 * Handles updating the settings for the current Recent Posts widget instance.
	 *
	 * @since 2.8.0
	 * @access public
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings to save.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		return $instance;
	}


	/**
	 * Outputs the settings form for the Recent Posts widget.
	 *
	 * @since  2.8.0
	 * @access public
	 *
	 * @param array $instance Current settings.
	 *
	 * @return string|void
	 */
	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'jo-theme' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>
		<?php
	}
}