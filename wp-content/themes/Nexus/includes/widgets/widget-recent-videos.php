<?php class EtRecentVideosWidget extends WP_Widget
{
	function EtRecentVideosWidget(){
		$widget_ops = array( 'description' => __( 'Displays Recent Videos', 'Nexus' ) );
		$control_ops = array('width' => 400, 'height' => 300);
		parent::WP_Widget( false, $name = __( 'ET Recent Videos', 'Nexus' ), $widget_ops, $control_ops );
	}

	/* Displays the Widget in the front-end */
	function widget($args, $instance){
		global $wpdb, $wp_embed;
		extract($args);

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Recent Videos', 'Nexus' ) : esc_html( $instance['title'] ) );
		$et_recent_posts_number = empty($instance['et_recent_posts_number']) ? '' : (int) $instance['et_recent_posts_number'];

		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;

		$et_recent_videos_query = new WP_Query( apply_filters( 'et_recent_videos_args', array(
			'posts_per_page'      => (int) $et_recent_posts_number,
			'ignore_sticky_posts' => 1,
			'tax_query' => array(
				array(
					'taxonomy' => 'post_format',
					'field' => 'slug',
					'terms' => 'post-format-video',
				)
			),
		) ) );

		$slider_output = $tabs_output = $et_videos_output = '';

		ob_start();

		if ( $et_recent_videos_query->have_posts() ) :
			$i = 1;
			while ( $et_recent_videos_query->have_posts() ) : $et_recent_videos_query->the_post();
				$tabs_output .= sprintf(
					'<li%s>
						<h4>%s</h4>
						<p class="post-meta">%s</p>
					</li>',
					( $i === 1 ? ' class="et-video-active"' : '' ),
					get_the_title(),
					get_the_time( et_get_option( 'nexus_date_format', 'M j, Y' ) )
				);

				$et_videolink = get_post_meta( get_the_ID(), '_format_video_embed', true );
				$et_video_id = 'et_video_post_' . get_the_ID();

				$et_videos_output .= '<div id="'. esc_attr( $et_video_id ) .'">' . $wp_embed->shortcode( '', esc_url( $et_videolink ) ) . '</div>';

				$thumb = '';
				$width = (int) apply_filters( 'et_recent_from_image_width', 321 );
				$height = (int) apply_filters( 'et_recent_from_image_height', 214 );
				$classtext = '';
				$titletext = get_the_title();
				$thumbnail = get_thumbnail( $width, $height, $classtext, $titletext, $titletext, false, 'Recent' );
				$thumb = $thumbnail["thumb"]; ?>
				<div class="et-recent-video">
					<?php print_thumbnail( $thumb, $thumbnail["use_timthumb"], $titletext, $width, $height ); ?>
					<a href="<?php echo esc_attr( '#' . $et_video_id ); ?>" class="et-recent-video-play fancybox"></a>
				</div>
<?php
				$i++;
			endwhile;
		endif;
		wp_reset_postdata();

		$slider_output = ob_get_clean();
?>
		<div class="recent-video-slides">
			<?php echo $slider_output; ?>
		</div>

		<div class="et-recent-videos-content">
			<div class="et-recent-video-scroll">
				<a href="#" class="et-scroll-video-top"><?php esc_html_e( 'Previous', 'Nexus' ); ?></a>
				<a href="#" class="et-scroll-video-bottom"><?php esc_html_e( 'Next', 'Nexus' ); ?></a>
			</div>

			<div class="et-recent-videos-wrap">
				<ul><?php echo $tabs_output; ?></ul>
			</div> <!-- .et-recent-videos-wrap -->
		</div> <!-- .et-recent-videos-content -->
<?php
			if ( '' != $et_videos_output ) echo '<div class="et_embedded_videos">' . $et_videos_output . '</div>';
		echo $after_widget;
	}

	/*Saves the settings. */
	function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['et_recent_posts_number'] = (int) $new_instance['et_recent_posts_number'];

		return $instance;
	}

	/*Creates the form for the widget in the back-end. */
	function form($instance){
		//Defaults
		$instance = wp_parse_args( (array) $instance, array( 'title' => __( 'Recent Videos', 'Nexus' ), 'et_recent_posts_number' => 4 ) );

		$title = esc_attr( $instance['title'] );
		$et_recent_posts_number = (int) $instance['et_recent_posts_number'];

		# Title
		echo '<p><label for="' . $this->get_field_id('title') . '">' . 'Title:' . '</label><input class="widefat" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '" /></p>';

		echo '<p><label for="' . esc_attr( $this->get_field_id('et_recent_posts_number') ) . '">' . 'Number of Recent Posts:' . '</label><input class="widefat" id="' . esc_attr( $this->get_field_id('et_recent_posts_number') ) . '" name="' . esc_attr( $this->get_field_name('et_recent_posts_number')  ). '" type="text" value="' . esc_attr( $et_recent_posts_number ) . '" /></p>';
	}

}// end EtRecentVideosWidget class

function EtRecentVideosWidgetInit() {
	register_widget( 'EtRecentVideosWidget' );
}

add_action( 'widgets_init', 'EtRecentVideosWidgetInit' );