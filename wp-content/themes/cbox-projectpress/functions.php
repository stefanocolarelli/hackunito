<?php
function theme_name_scripts() {
	wp_enqueue_style( 'chosen-css', get_stylesheet_directory_uri() . '/chosen/chosen.min.css' );
	wp_enqueue_script( 'chosen', get_stylesheet_directory_uri() . '/chosen/chosen.jquery.min.js', array(), '1.0.0', true );
}

add_action( 'wp_enqueue_scripts', 'theme_name_scripts' );


// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

function chosen_init_js() {
//wp_enqueue_style( 'chosen-css', get_stylesheet_directory() . 'chosen/chosen.min.css' );
//wp_enqueue_script( 'chosen', get_stylesheet_directory() . '/chosen/chosen.jquery.min.js', array(), '1.0.0', true );
	if ( !wp_script_is( 'jquery' ) )
		wp_enqueue_script( 'jquery' );

	if ( !wp_script_is( 'jquery', 'done' ) )
		wp_print_scripts( 'jquery' );
?>
	<script type="text/javascript">
		jQuery("#field_2").chosen();
	</script>

<?php
}
add_action( 'wp_footer',    'chosen_init_js', 100 );

class HackTweets_Widget extends WP_Widget {

	function HackTweets_Widget() {
		$widget_ops = array( 'description' => __( 'Displays a random HackTweet.'  ), 'classname' => 'hacktweets_widget' );
		$this->WP_Widget( 'hacktweets_widget', __( 'HackTweet' ), $widget_ops );
	}

	function widget( $args, $instance ) {
    	extract( $args );

    	$title = ( $instance['title'] != '' ) ? esc_attr( $instance['title'] ) : __( 'hackTweet: 140 characters to introduce #hackUniTO','responsive' );

		echo $before_widget;
		echo $before_title . $title . $after_title;

		$hacktweet = new WP_Query( array( 'post_type' => 'hacktweet', 'post_status' => 'publish', 'orderby' => 'rand', 'showposts' => 1 ) );

		if ( $hacktweet->have_posts() ) : while ( $hacktweet->have_posts() ) : $hacktweet->the_post();
			echo '<div class="claim-widget">';
			the_content();
			echo '</div>';
		endwhile; endif;
		
		echo '<a href="https://twitter.com/intent/tweet?text='.urlencode(get_the_content()).'" class="twitter-hashtag-button" data-lang="it">Condividi su Twitter</a>';
		echo '<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>';
		if(is_user_logged_in()):
			echo '<a class="button" href="'.bloginfo('url').'/hackerare-comunicazione/" title="Inserisci il tuo HackTweet">'.__( "Write your hackTweet", "responsive" ).'</a>';
		endif;
		echo $after_widget;
	}

	function form( $instance ) {
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : __( 'HackTweets' );
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>
		<?php
 	}

	function update( $new_instance, $old_instance ){
		$instance          = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}
}

// register widget
function register_hacktweet_widget() {
    register_widget( 'HackTweets_Widget' );
}
add_action( 'widgets_init', 'register_hacktweet_widget' );


add_action( 'init', 'ste_register_hacktweet', 0 );
function ste_register_hacktweet() {
    $args = array(
        'public' => true,
        'query_var' => 'hacktweet',
        'rewrite' => array(
            'slug' => 'hacktweets',
            'with_front' => false
        ),
        'supports' => array(
            'title',
            'editor',
            'author',
            'thumbnail',
            'revisions'
        ),
        'labels' => array(
            'name' => 'HackTweets',
            'singular_name' => 'HackTweet',
            'add_new' => 'Add New HackTweet',
            'add_new_item' => 'Add New HackTweet',
            'edit_item' => 'Edit HackTweet',
            'new_item' => 'New HackTweet',
            'view_item' => 'View HackTweet',
            'search_items' => 'Search HackTweet',
            'not_found' => 'No hacktweets found',
            'not_found_in_trash' => 'No hacktweets found in Trash',
        ),
    );
    register_post_type( 'hacktweet', $args );
}
// add_action( 'wp_head',    'chosen_init_js', 100 );
function my_bp_activity_is_favorite($activity_id) {
global $bp, $activities_template;
return apply_filters( 'bp_get_activity_is_favorite', in_array( $activity_id, (array)$activities_template->my_favs ) );
}

function my_bp_activity_favorite_link($activity_id) {
global $activities_template;
echo apply_filters( 'bp_get_activity_favorite_link', wp_nonce_url( site_url( BP_ACTIVITY_SLUG . '/favorite/' . $activity_id . '/' ), 'mark_favorite' ) );
}

function my_bp_activity_unfavorite_link($activity_id) {
global $activities_template;
echo apply_filters( 'bp_get_activity_unfavorite_link', wp_nonce_url( site_url( BP_ACTIVITY_SLUG . '/unfavorite/' . $activity_id . '/' ), 'unmark_favorite' ) );
}