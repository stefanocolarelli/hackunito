<?php class ETTabbedWidget extends WP_Widget
{
	function ETTabbedWidget(){
		$widget_ops = array( 'description' => __( 'Displays recent, popular, random posts', 'Nexus' ) );
		$control_ops = array( 'width' => 400, 'height' => 300 );
		parent::WP_Widget( false, $name = __( 'ET Tabbed Widget', 'Nexus' ), $widget_ops, $control_ops );
	}

  /* Displays the Widget in the front-end */
	function widget($args, $instance){
		extract($args);
		$et_popular_posts_number = empty($instance['et_popular_posts_number']) ? '' : (int) $instance['et_popular_posts_number'];
		$et_recent_posts_number = empty($instance['et_recent_posts_number']) ? '' : (int) $instance['et_recent_posts_number'];
		$et_random_posts_number = empty($instance['et_random_posts_number']) ? '' : (int) $instance['et_random_posts_number'];

		echo $before_widget;
?>
		<ul class="categories-tabs">
			<li class="home-tab-active"><a href="#"><?php esc_html_e( 'Recent', 'Nexus' ); ?></a></li>
			<li><a href="#"><?php esc_html_e( 'Popular', 'Nexus' ); ?></a></li>
			<li><a href="#"><?php esc_html_e( 'Random', 'Nexus' ); ?></a></li>
		</ul>

		<div class="et-tabbed-all-tabs">
			<div class="recent-tabbed">
			<?php
				$et_recent_query = new WP_Query( apply_filters( 'et_recent_query_args', array(
					'posts_per_page'      => (int) $et_recent_posts_number,
					'ignore_sticky_posts' => 1,
				) ) );

				echo '<ul>';

				if ( $et_recent_query->have_posts() ) :
					while ( $et_recent_query->have_posts() ) : $et_recent_query->the_post();
						get_template_part( 'includes/widget_tabbed_content' );
					endwhile;
				endif;
				wp_reset_postdata();

				echo '</ul>';
			?>
			</div> <!-- .recent-tabbed -->

			<div class="popular-tabbed">
			<?php
				$et_popular_query = new WP_Query( apply_filters( 'et_popular_query_args', array(
					'orderby'             => 'comment_count',
					'posts_per_page'      => (int) $et_popular_posts_number,
					'ignore_sticky_posts' => 1,
				) ) );

				if ( $et_popular_query->have_posts() ) :
					while ( $et_popular_query->have_posts() ) : $et_popular_query->the_post();
						get_template_part( 'includes/widget_tabbed_content' );
					endwhile;
				endif;
				wp_reset_postdata();
			?>
			</div> <!-- .popular-tabbed -->

			<div class="random-tabbed">
			<?php
				$et_random_query = new WP_Query( apply_filters( 'et_random_query_args', array(
					'orderby'             => 'rand',
					'ignore_sticky_posts' => 1,
					'posts_per_page'      => (int) $et_random_posts_number,
				) ) );
				if ( $et_random_query->have_posts() ) :
					while ($et_random_query->have_posts()) : $et_random_query->the_post();
						get_template_part( 'includes/widget_tabbed_content' );
					endwhile;
				endif;
				wp_reset_postdata();
			?>
			</div> <!-- .random-tabbed -->
		</div> <!-- .et-tabbed-all-tabs -->
<?php
		echo $after_widget;
	}

	function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['et_popular_posts_number'] = (int) $new_instance['et_popular_posts_number'];
		$instance['et_recent_posts_number'] = (int) $new_instance['et_recent_posts_number'];
		$instance['et_random_posts_number'] = (int) $new_instance['et_random_posts_number'];

		return $instance;
	}

	function form($instance){
		//Defaults
		$instance = wp_parse_args( (array) $instance, array('et_popular_posts_number'=>'4', 'et_recent_posts_number'=>'4', 'et_random_posts_number'=>'4') );

		$et_popular_posts_number = (int) $instance['et_popular_posts_number'];
		$et_recent_posts_number = (int) $instance['et_recent_posts_number'];
		$et_random_posts_number = (int) $instance['et_random_posts_number'];

		# Number Of Posts
		echo '<p><label for="' . esc_attr( $this->get_field_id('et_popular_posts_number') ) . '">' . 'Number of Popular Posts:' . '</label><input class="widefat" id="' . esc_attr( $this->get_field_id('et_popular_posts_number') ) . '" name="' . esc_attr( $this->get_field_name('et_popular_posts_number')  ). '" type="text" value="' . esc_attr( $et_popular_posts_number ) . '" /></p>';

		echo '<p><label for="' . esc_attr( $this->get_field_id('et_recent_posts_number') ) . '">' . 'Number of Recent Posts:' . '</label><input class="widefat" id="' . esc_attr( $this->get_field_id('et_recent_posts_number') ) . '" name="' . esc_attr( $this->get_field_name('et_recent_posts_number')  ). '" type="text" value="' . esc_attr( $et_recent_posts_number ) . '" /></p>';

		echo '<p><label for="' . esc_attr( $this->get_field_id('et_random_posts_number') ) . '">' . 'Number of Random Posts:' . '</label><input class="widefat" id="' . esc_attr( $this->get_field_id('et_random_posts_number') ) . '" name="' . esc_attr( $this->get_field_name('et_random_posts_number')  ). '" type="text" value="' . esc_attr( $et_random_posts_number ) . '" /></p>';
	}

}// end ETTabbedWidget class

function ETTabbedWidgetInit() {
	register_widget( 'ETTabbedWidget' );
}

add_action( 'widgets_init', 'ETTabbedWidgetInit' );