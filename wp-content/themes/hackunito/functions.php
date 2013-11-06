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
		jQuery("#field_3").chosen();
	</script>

<?php
}
add_action( 'wp_footer',    'chosen_init_js', 100 );
// add_action( 'wp_head',    'chosen_init_js', 100 );