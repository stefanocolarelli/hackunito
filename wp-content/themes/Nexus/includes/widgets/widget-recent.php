<?php class EtRecentFromWidget extends WP_Widget
{
	function EtRecentFromWidget(){
		$widget_ops = array( 'description' => __( 'Displays recent posts', 'Nexus' ) );
		$control_ops = array( 'width' => 400, 'height' => 300 );
		parent::WP_Widget( false, $name = __( 'ET Recent Posts Widget', 'Nexus' ), $widget_ops, $control_ops );
	}

	/* Displays the Widget in the front-end */
	function widget($args, $instance){
		extract($args);

		$posts_number = empty($instance['posts_number']) ? '' : (int) $instance['posts_number'];
		$blog_category = empty($instance['blog_category']) ? '' : (int) $instance['blog_category'];

		echo $before_widget;

		$title = sprintf( __( 'Recent From <span>%s</span>', 'Nexus' ), get_cat_name( $blog_category ) );

		echo $before_title . $title . $after_title;
?>
		<div class="et-tabbed-all-tabs">
			<?php
				$i = 1;

				$et_recent_query = new WP_Query( apply_filters( 'et_recent_from_query_args', array(
					'posts_per_page'      => (int) $posts_number,
					'cat'                 => (int) $blog_category,
					'ignore_sticky_posts' => 1,
				) ) );

				if ( $et_recent_query->have_posts() ) :
					echo '<ul>';
					while ( $et_recent_query->have_posts() ) : $et_recent_query->the_post();
						if ( $i === 1 ) {
							$thumb = '';
							$width = (int) apply_filters( 'et_recent_from_image_width', 321 );
							$height = (int) apply_filters( 'et_recent_from_image_height', 214 );
							$classtext = '';
							$titletext = get_the_title();
							$thumbnail = get_thumbnail( $width, $height, $classtext, $titletext, $titletext, false, 'Recent' );
							$thumb = $thumbnail["thumb"];

							if ( '' === $thumb ) {
								$i++;
								continue;
							}

							echo '<li>';
							echo '	<div class="et-recent-featured-post">';
							print_thumbnail( $thumb, $thumbnail["use_timthumb"], $titletext, $width, $height );
							echo '		<div class="et-main-description">';
							echo '			<span class="main-title">' . '<a href="' . get_permalink() . '">' . get_the_title() . '</a>' . '</span>';
							echo '			<span class="postinfo">' . get_the_time( et_get_option( 'nexus_date_format', 'M j, Y' ) ) . '</span>';
							echo '		</div> <!-- .et-main-description -->';
							echo '	</div> <!-- .et-recent-featured-post -->';
							echo '</li>';
						} else {
							get_template_part( 'includes/widget_tabbed_content' );
						}

						$i++;
					endwhile;
					echo '</ul>';
				endif;
				wp_reset_postdata();
			?>
		</div> <!-- .et-tabbed-all-tabs -->
<?php
		echo $after_widget;
	}

	function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['posts_number'] = (int) $new_instance['posts_number'];
		$instance['blog_category'] = (int) $new_instance['blog_category'];

		return $instance;
	}

	function form($instance){
		//Defaults
		$instance = wp_parse_args( (array) $instance, array( 'posts_number' => '4', 'blog_category' => '') );

		$posts_number = (int) $instance['posts_number'];
		$blog_category = (int) $instance['blog_category'];

		$cats_array = get_categories( 'hide_empty=0' );

		# Number Of Posts
		echo '<p><label for="' . $this->get_field_id('posts_number') . '">' . 'Number of Posts:' . '</label><input class="widefat" id="' . $this->get_field_id('posts_number') . '" name="' . $this->get_field_name('posts_number') . '" type="text" value="' . $posts_number . '" /></p>';
		# Category ?>
		<p>
			<label for="<?php echo $this->get_field_id('blog_category'); ?>">Category</label>
			<select name="<?php echo $this->get_field_name('blog_category'); ?>" id="<?php echo $this->get_field_id('blog_category'); ?>" class="widefat">
				<?php foreach( $cats_array as $category ) { ?>
					<option value="<?php echo $category->cat_ID; ?>"<?php selected( $instance['blog_category'], $category->cat_ID ); ?>><?php echo $category->cat_name; ?></option>
				<?php } ?>
			</select>
		</p>
		<?php
	}

}// end EtRecentFromWidget class

function EtRecentFromWidgetInit() {
	register_widget( 'EtRecentFromWidget' );
}

add_action( 'widgets_init', 'EtRecentFromWidgetInit' );