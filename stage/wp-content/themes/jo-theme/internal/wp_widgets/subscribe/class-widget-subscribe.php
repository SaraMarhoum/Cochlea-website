<?php
/*! ===================================
 *  Author: BBDesign & WPHunters
 *  -----------------------------------
 *  Email(support):
 * 	bbdesign_sp@yahoo.com
 *  ===================================
 */

class WPH_JO_Widget_Subscribe extends WP_Widget {

	function __construct() {
		parent::__construct(
			// Base ID of your widget
			'wph_jo_mailchimp',

			// Widget name will appear in UI
			__('Mailchimp subscription form', 'jo-theme'),

			// Widget description
			array( 'description' => __( 'Displays mailchimp subscription form.', 'jo-theme' ) )
		);
	}

	// Creating widget front-end
	// This is where the action happens
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );

		$form_url = '';
		if ( isset( $instance['form_url'] ) ) {
			$form_url = $instance['form_url'];
		}

		// before and after widget arguments are defined by themes
		echo $args['before_widget'];
		if ( ! empty( $title ) )
			echo $args['before_title'] . $title . $args['after_title'];

		// This is where you run the code and display the output
		?>
		<form action="<?php echo esc_url($form_url) ?>" method="post" target="_blank">
			<div class="fl-input-container">
				<input type="text" id="email_field" name="EMAIL" class="fl-input accent-color" required autocomplete="off" spellcheck="false" />
				<label for="email_field"><?php echo __('Enter your email', 'jo-theme') ?></label>
			</div>

            <button class="btn btn-link accent-color"><?php echo __('Subscribe', 'jo-theme') ?></button>
		</form>
		<?php echo $args['after_widget'];
	}

	// Widget Backend
	public function form( $instance ) {

		$title = __( 'Subscribe to our newsletter', 'jo-theme' );
		if ( isset( $instance['title'] ) ) {
			$title = $instance['title'];
		}

		$form_url = '';
		if ( isset( $instance['form_url'] ) ) {
			$form_url = $instance['form_url'];
		}

		// Widget admin form
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'jo-theme' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'form_url' ); ?>"><?php _e( 'Signup form URL:', 'jo-theme' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'form_url' ); ?>" name="<?php echo $this->get_field_name( 'form_url' ); ?>" type="text" value="<?php echo esc_attr( $form_url ); ?>" />
			<div><?php echo __('Full URL required. Example: <br/>', 'jo-theme'). ' <i><small>http://bbdesign.us9.list-manage1.com/subscribe?u=1388c223b42d831e481262a9c&id=1b32f188b7</small></i>' ?></div>
		</p>
	<?php
	}

	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance             = array();
		$instance['title']    = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['form_url'] = ( ! empty( $new_instance['form_url'] ) ) ? strip_tags( $new_instance['form_url'] ) : '';

		return $instance;
	}
}