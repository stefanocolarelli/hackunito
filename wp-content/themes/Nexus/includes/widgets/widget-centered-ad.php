<?php class ETCenteredAdWidget extends WP_Widget
{
    function ETCenteredAdWidget(){
		$widget_ops = array( 'description' => __( 'Displays Centered Advertisement', 'Nexus' ) );
		$control_ops = array( 'width' => 400, 'height' => 300 );
		parent::WP_Widget( false, $name = __( 'ET Centered Ad', 'Nexus' ), $widget_ops, $control_ops );
	}

  /* Displays the Widget in the front-end */
    function widget($args, $instance){
		extract($args);
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Adverisiment', 'Nexus' ) : esc_html( $instance['title'] ) );
		$new_window = isset($instance['new_window']) ? $instance['new_window'] : false;
		$banner_path = empty($instance['bannerOnePath']) ? '' : esc_attr($instance['bannerOnePath']);
		$banner_url = empty($instance['bannerOneUrl']) ? '' : esc_url($instance['bannerOneUrl']);
		$banner_title = empty($instance['bannerOneTitle']) ? '' : esc_attr($instance['bannerOneTitle']);
		$banner_alt = empty($instance['bannerOneAlt']) ? '' : esc_attr($instance['bannerOneAlt']);

		echo $before_widget;

		if ( $title )
			echo $before_title . $title . $after_title;
?>
		<div class="et-centered-ad">
			<a href="<?php echo $banner_url; ?>" <?php if ( $new_window == 1 ) echo 'target="_blank"'; ?>><img src="<?php echo $banner_path; ?>" alt="<?php echo $banner_alt; ?>" title="<?php echo $banner_title; ?>" /></a>
		</div>
<?php
		echo $after_widget;
	}

  /*Saves the settings. */
    function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['title'] = stripslashes($new_instance['title']);
		$instance['new_window'] = 0;
		if ( isset($new_instance['new_window']) ) $instance['new_window'] = 1;
		$instance['bannerOnePath'] = esc_attr($new_instance['bannerOnePath']);
		$instance['bannerOneUrl'] = esc_url($new_instance['bannerOneUrl']);
		$instance['bannerOneTitle'] = esc_attr($new_instance['bannerOneTitle']);
		$instance['bannerOneAlt'] = esc_attr($new_instance['bannerOneAlt']);

		return $instance;
	}

  /*Creates the form for the widget in the back-end. */
    function form($instance){
		//Defaults
		$instance = wp_parse_args( (array) $instance, array( 'title' => __( 'Advertisement', 'Nexus' ), 'new_window' => true, 'bannerOnePath'=>'', 'bannerOneUrl'=>'', 'bannerOneTitle'=>'', 'bannerOneAlt'=>'' ) );

		$title = esc_html($instance['title']);
		$banner_path = esc_attr($instance['bannerOnePath']);
		$banner_url = esc_url($instance['bannerOneUrl']);
		$banner_title = esc_attr($instance['bannerOneTitle']);
		$banner_alt = esc_attr($instance['bannerOneAlt']);

		# Title
		echo '<p><label for="' . $this->get_field_id('title') . '">' . 'Title:' . '</label><input class="widefat" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '" /></p>'; ?>

		<input class="checkbox" type="checkbox" <?php checked($instance['new_window'], true) ?> id="<?php echo $this->get_field_id('new_window'); ?>" name="<?php echo $this->get_field_name('new_window'); ?>" />
		<label for="<?php echo $this->get_field_id('new_window'); ?>">Open in a new window</label><br /><br />

		<?php	# Banner #1 Image
		echo '<p><label for="' . $this->get_field_id('bannerOnePath') . '">' . 'Banner Image:' . '</label><input class="widefat" id="' . $this->get_field_id('bannerOnePath') . '" name="' . $this->get_field_name('bannerOnePath') . '" type="text" value="' . $banner_path . '" /></p>';
		# Banner #1 Url
		echo '<p><label for="' . $this->get_field_id('bannerOneUrl') . '">' . 'Banner Url:' . '</label><input class="widefat" id="' . $this->get_field_id('bannerOneUrl') . '" name="' . $this->get_field_name('bannerOneUrl') . '" type="text" value="' . $banner_url . '" /></p>';
		# Banner #1 Title
		echo '<p><label for="' . $this->get_field_id('bannerOneTitle') . '">' . 'Banner Title:' . '</label><input class="widefat" id="' . $this->get_field_id('bannerOneTitle') . '" name="' . $this->get_field_name('bannerOneTitle') . '" type="text" value="' . $banner_title . '" /></p>';
		# Banner #1 Alt
		echo '<p><label for="' . $this->get_field_id('bannerOneAlt') . '">' . 'Banner Description:' . '</label><input class="widefat" id="' . $this->get_field_id('bannerOneAlt') . '" name="' . $this->get_field_name('bannerOneAlt') . '" type="text" value="' . $banner_alt . '" /></p>';
	}

}// end ETCenteredAdWidget class

function ETCenteredAdWidgetInit() {
	register_widget( 'ETCenteredAdWidget' );
}

add_action('widgets_init', 'ETCenteredAdWidgetInit');

?>