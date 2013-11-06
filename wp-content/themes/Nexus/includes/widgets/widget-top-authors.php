<?php class EtTopAuthorsWidget extends WP_Widget
{
	function EtTopAuthorsWidget(){
		$widget_ops = array( 'description' => __( 'Displays Top Authors', 'Nexus' ) );
		$control_ops = array('width' => 400, 'height' => 300);
		parent::WP_Widget( false, $name = __( 'ET Top Authors', 'Nexus' ), $widget_ops, $control_ops );
	}

	/* Displays the Widget in the front-end */
	function widget($args, $instance){
		global $wpdb;
		extract($args);

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Our Top Authors', 'Nexus' ) : esc_html( $instance['title'] ) );

		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;

		echo '<ul class="et-authors">';

		$query_args['fields'] = 'ids';
		$authors = get_users( $query_args );

		foreach ( (array) $wpdb->get_results("SELECT DISTINCT post_author, COUNT(ID) AS count FROM $wpdb->posts WHERE post_type = 'post' AND " . get_private_posts_cap_sql( 'post' ) . " GROUP BY post_author") as $row )
			$author_count[$row->post_author] = $row->count;

		foreach ( $authors as $author_id ) {
			$author = get_userdata( $author_id );

			$posts = isset( $author_count[$author->ID] ) ? $author_count[$author->ID] : 0;
			if ( 0 === $posts ) continue;

			$link = get_author_posts_url( $author->ID, $author->user_nicename );
		?>
			<li>
				<div class="author-avatar">
					<?php echo get_avatar( $author_id, 60 ); ?>
				</div>
				<div class="et-authors-posts">
					<h4><a href="<?php echo esc_url( $link ); ?>"><?php echo esc_html( $author->display_name ); ?></a></h4>
					<span><?php printf( __( '%s Posts', 'Nexus' ), esc_html( $posts ) ); ?></span>
				</div>
			</li>
<?php
		}

		echo '</ul><!-- .et-authors -->';

		echo $after_widget;
	}

	/*Saves the settings. */
	function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['title'] = sanitize_text_field( $new_instance['title'] );

		return $instance;
	}

	/*Creates the form for the widget in the back-end. */
	function form($instance){
		//Defaults
		$instance = wp_parse_args( (array) $instance, array( 'title' => __( 'Our Top Authors', 'Nexus' ) ) );

		$title = esc_attr( $instance['title'] );

		# Title
		echo '<p><label for="' . $this->get_field_id('title') . '">' . 'Title:' . '</label><input class="widefat" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" type="text" value="' . $title . '" /></p>';
	}

}// end EtTopAuthorsWidget class

function EtTopAuthorsWidgetInit() {
	register_widget( 'EtTopAuthorsWidget' );
}

add_action( 'widgets_init', 'EtTopAuthorsWidgetInit' );