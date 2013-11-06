<?php

if ( ! isset( $content_width ) ) $content_width = 838;

function et_setup_theme() {
	global $themename, $shortname, $et_store_options_in_one_row, $default_colorscheme;
	$themename = 'Nexus';
	$shortname = 'nexus';
	$et_store_options_in_one_row = true;

	$default_colorscheme = "Default";

	$template_directory = get_template_directory();

	require_once( $template_directory . '/epanel/custom_functions.php' );

	require_once( $template_directory . '/includes/functions/comments.php' );

	require_once( $template_directory . '/includes/functions/sidebars.php' );

	load_theme_textdomain( 'Nexus', $template_directory . '/lang' );

	require_once( $template_directory . '/epanel/core_functions.php' );

	require_once( $template_directory . '/epanel/post_thumbnails_nexus.php' );

	include( $template_directory . '/includes/widgets.php' );

	register_nav_menus( array(
		'primary-menu' => __( 'Primary Menu', 'Nexus' ),
		'footer-menu' => __( 'Footer Menu', 'Nexus' ),
	) );

	add_theme_support( 'post-formats', array( 'video' ) );

	// don't display the empty title bar if the widget title is not set
	remove_filter( 'widget_title', 'et_widget_force_title' );

	add_action( 'wp_enqueue_scripts', 'et_add_responsive_shortcodes_css', 11 );
}
add_action( 'after_setup_theme', 'et_setup_theme' );

if ( ! function_exists( 'et_nexus_fonts_url' ) ) :
function et_nexus_fonts_url() {
	$fonts_url = '';

	/* Translators: If there are characters in your language that are not
	 * supported by Open Sans, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$open_sans = _x( 'on', 'Open Sans font: on or off', 'Nexus' );

	/* Translators: If there are characters in your language that are not
	 * supported by Raleway, translate this to 'off'. Do not translate into your
	 * own language.
	 */
	$raleway = _x( 'on', 'Raleway font: on or off', 'Nexus' );

	if ( 'off' !== $open_sans || 'off' !== $raleway ) {
		$font_families = array();

		if ( 'off' !== $open_sans )
			$font_families[] = 'Open+Sans:300italic,400italic,700italic,800italic,400,300,700,800';

		if ( 'off' !== $raleway )
			$font_families[] = 'Raleway:400,200,100,500,700,800,900';

		$protocol = is_ssl() ? 'https' : 'http';
		$query_args = array(
			'family' => implode( '|', $font_families ),
			'subset' => 'latin,latin-ext',
		);
		$fonts_url = add_query_arg( $query_args, "$protocol://fonts.googleapis.com/css" );
	}

	return $fonts_url;
}
endif;

function et_nexus_load_fonts() {
	$fonts_url = et_nexus_fonts_url();
	if ( ! empty( $fonts_url ) )
		wp_enqueue_style( 'nexus-fonts', esc_url_raw( $fonts_url ), array(), null );
}
add_action( 'wp_enqueue_scripts', 'et_nexus_load_fonts' );

function et_add_home_link( $args ) {
	// add Home link to the custom menu WP-Admin page
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'et_add_home_link' );

function et_nexus_load_scripts_styles(){
	global $wp_styles;

	$template_dir = get_template_directory_uri();

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	wp_enqueue_script( 'superfish', $template_dir . '/js/superfish.js', array( 'jquery' ), '1.0', true );

	wp_enqueue_script( 'nexus-custom-script', $template_dir . '/js/custom.js', array( 'jquery' ), '1.0', true );
	wp_localize_script( 'nexus-custom-script', 'et_custom', array(
		'mobile_nav_text' => esc_html__( 'Navigation Menu', 'Nexus' ),
		'ajaxurl'         => admin_url( 'admin-ajax.php' ),
		'et_hb_nonce'     => wp_create_nonce( 'et_hb_nonce' ),
	) );

	$et_gf_enqueue_fonts = array();
	$et_gf_heading_font = sanitize_text_field( et_get_option( 'heading_font', 'none' ) );
	$et_gf_body_font = sanitize_text_field( et_get_option( 'body_font', 'none' ) );

	if ( 'none' != $et_gf_heading_font ) $et_gf_enqueue_fonts[] = $et_gf_heading_font;
	if ( 'none' != $et_gf_body_font ) $et_gf_enqueue_fonts[] = $et_gf_body_font;

	if ( ! empty( $et_gf_enqueue_fonts ) ) et_gf_enqueue_fonts( $et_gf_enqueue_fonts );

	/*
	 * Loads the main stylesheet.
	 */
	wp_enqueue_style( 'nexus-style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'et_nexus_load_scripts_styles' );

function et_add_mobile_navigation(){
	echo '<div id="et_mobile_nav_menu">' . '<a href="#" class="mobile_nav closed">' . esc_html__( 'Navigation Menu', 'Nexus' ) . '<span class="et_mobile_arrow"></span>' . '</a>' . '</div>';
}
add_action( 'et_header_top', 'et_add_mobile_navigation' );

/**
 * Filters the main query on homepage
 */
function et_home_posts_query( $query = false ) {
	/* Don't proceed if it's not homepage or the main query */
	if ( ! is_home() || ! is_a( $query, 'WP_Query' ) || ! $query->is_main_query() ) return;

	/* Only filter the homepage query if the Blog Style mode is activated */
	if ( 'false' === et_get_option( 'nexus_blog_style', 'false' ) ) return;

	/* Set the amount of posts per page on homepage */
	$query->set( 'posts_per_page', (int) et_get_option( 'nexus_homepage_posts', 8 ) );

	$exclude_categories = et_get_option( 'nexus_exlcats_recent', false, 'category' );

	if ( $exclude_categories ) $query->set( 'category__not_in', array_map( 'intval', $exclude_categories ) );
}
add_action( 'pre_get_posts', 'et_home_posts_query' );

function et_add_viewport_meta(){
	echo '<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />';
}
add_action( 'wp_head', 'et_add_viewport_meta' );

function et_remove_additional_stylesheet( $stylesheet ){
	global $default_colorscheme;
	return $default_colorscheme;
}
add_filter( 'et_get_additional_color_scheme', 'et_remove_additional_stylesheet' );

if ( ! function_exists( 'et_list_pings' ) ) :
function et_list_pings($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
	<li id="comment-<?php comment_ID(); ?>"><?php comment_author_link(); ?> - <?php comment_excerpt(); ?>
<?php }
endif;

if ( ! function_exists( 'et_get_the_author_posts_link' ) ) :
function et_get_the_author_posts_link(){
	global $authordata, $themename;

	$link = sprintf(
		'<a href="%1$s" title="%2$s" rel="author">%3$s</a>',
		esc_url( get_author_posts_url( $authordata->ID, $authordata->user_nicename ) ),
		esc_attr( sprintf( __( 'Posts by %s', $themename ), get_the_author() ) ),
		get_the_author()
	);
	return apply_filters( 'the_author_posts_link', $link );
}
endif;

if ( ! function_exists( 'et_get_comments_popup_link' ) ) :
function et_get_comments_popup_link( $zero = false, $one = false, $more = false ){
	global $themename;

	$id = get_the_ID();
	$number = get_comments_number( $id );

	if ( 0 == $number && !comments_open() && !pings_open() ) return;

	if ( $number > 1 )
		$output = str_replace('%', number_format_i18n($number), ( false === $more ) ? __('% Comments', $themename) : $more);
	elseif ( $number == 0 )
		$output = ( false === $zero ) ? __('No Comments',$themename) : $zero;
	else // must be one
		$output = ( false === $one ) ? __('1 Comment', $themename) : $one;

	return '<span class="comments-number">' . '<a href="' . esc_url( get_permalink() . '#respond' ) . '">' . apply_filters('comments_number', $output, $number) . '</a>' . '</span>';
}
endif;

if ( ! function_exists( 'et_postinfo_meta' ) ) :
function et_postinfo_meta( $postinfo, $date_format, $comment_zero, $comment_one, $comment_more ){
	global $themename;

	$postinfo_meta = esc_html__( 'Posted', $themename );

	if ( in_array( 'author', $postinfo ) && 'project' !== get_post_type() )
		$postinfo_meta .= ' ' . esc_html__('By',$themename) . ' ' . et_get_the_author_posts_link();

	if ( in_array( 'date', $postinfo ) )
		$postinfo_meta .= ' ' . esc_html__('on',$themename) . ' ' . get_the_time( $date_format );

	if ( in_array( 'categories', $postinfo ) && 'project' !== get_post_type() )
		$postinfo_meta .= ' ' . esc_html__('in',$themename) . ' ' . get_the_category_list(', ');

	if ( in_array( 'comments', $postinfo ) )
		$postinfo_meta .= ' | ' . et_get_comments_popup_link( $comment_zero, $comment_one, $comment_more );

	echo $postinfo_meta;
}
endif;

function et_add_post_meta_box() {
	add_meta_box( 'et_settings_meta_box', __( 'ET Settings', 'Nexus' ), 'et_single_settings_meta_box', 'post', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'et_add_post_meta_box' );

if ( ! function_exists( 'et_single_settings_meta_box' ) ) :
function et_single_settings_meta_box( $post ) {
	$post_id = get_the_ID();

	wp_nonce_field( basename( __FILE__ ), 'et_settings_nonce' );
?>
	<p class="et_nexus_video_settings et_nexus_format_setting" style="display: none;">
		<label for="et_post_video_url" style="display: block; font-weight: bold; margin-bottom: 5px;"><?php esc_html_e( 'Video URL', 'Vertex' ); ?>: </label>
		<input id="et_post_video_url" name="et_post_video_url" class="regular-text" type="text" value="<?php echo esc_attr( get_post_meta( $post_id, '_format_video_embed', true ) ); ?>" />
		<br/>
	</p>

	<p id="et-rating" style="overflow: hidden;">
		<label style="min-width: 150px; display: inline-block; margin-bottom: 8px;"><?php esc_html_e( 'Review Rating', 'Nexus' ); ?>: </label>
		<br />
	<?php for ( $increment = 1; $increment <= 5; $increment = $increment+1  ) { ?>
		<input name="et_star" type="radio" class="star" value="<?php echo esc_attr( $increment ); ?>" <?php checked( get_post_meta( $post_id, '_et_author_rating', true ) >= $increment ); ?> />
	<?php } ?>
	</p>

	<p>
		<label for="et_single_bg_image" style="display: inline-block;"><?php esc_html_e( 'Header Image', 'Nexus' ); ?>: </label>
		<input type="text" name="et_single_bg_image" id="et_single_bg_image" class="regular-text" value="<?php echo esc_attr( get_post_meta( $post_id, '_et_single_bg_image', true ) ); ?>" />
		<input class="upload_image_button" type="button" value="<?php esc_html_e( 'Upload Image', 'Nexus' ); ?>" /><br/>
	</p>
<?php
}
endif;

function et_metabox_settings_save_details( $post_id, $post ){
	global $pagenow;

	if ( 'post.php' != $pagenow ) return $post_id;

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
		return $post_id;

	$post_type = get_post_type_object( $post->post_type );
	if ( ! current_user_can( $post_type->cap->edit_post, $post_id ) )
		return $post_id;

	if ( ! isset( $_POST['et_settings_nonce'] ) || ! wp_verify_nonce( $_POST['et_settings_nonce'], basename( __FILE__ ) ) )
		return $post_id;

	if ( isset( $_POST['et_star'] ) ) {
		update_post_meta( $post_id, '_et_author_rating', intval( $_POST['et_star'] ) );
	} else {
		delete_post_meta( $post_id, '_et_author_rating' );
	}

	if ( isset( $_POST['et_single_bg_image'] ) )
		update_post_meta( $post_id, '_et_single_bg_image', esc_url_raw( $_POST['et_single_bg_image'] ) );
	else
		delete_post_meta( $post_id, '_et_single_bg_image' );

	if ( isset( $_POST['et_post_video_url'] ) )
		update_post_meta( $post_id, '_format_video_embed', esc_url_raw( $_POST['et_post_video_url'] ) );
	else
		delete_post_meta( $post_id, '_format_video_embed' );
}
add_action( 'save_post', 'et_metabox_settings_save_details', 10, 2 );

function et_nexus_post_admin_scripts_styles( $hook ) {
	global $typenow;

	if ( ! in_array( $hook, array( 'post-new.php', 'post.php' ) ) ) return;

	if ( ! isset( $typenow ) ) return;

	if ( 'post' === $typenow ) {
		wp_enqueue_script( 'metadata', get_template_directory_uri() . '/js/jquery.MetaData.js', array('jquery'), '4.11', true );
		wp_enqueue_script( 'et-rating', get_template_directory_uri() . '/js/jquery.rating.pack.js', array('jquery'), '4.11', true );
		wp_enqueue_style( 'et-rating', get_template_directory_uri() . '/css/jquery.rating.css' );

		wp_enqueue_script( 'et_image_upload_custom', get_template_directory_uri() . '/js/admin_custom_uploader.js', array( 'jquery' ) );
	}
}
add_action( 'admin_enqueue_scripts', 'et_nexus_post_admin_scripts_styles' );

function et_nexus_customize_register( $wp_customize ) {
	$google_fonts = et_get_google_fonts();

	$font_choices = array();
	$font_choices['none'] = 'Default Theme Font';
	foreach ( $google_fonts as $google_font_name => $google_font_properties ) {
		$font_choices[ $google_font_name ] = $google_font_name;
	}

	$wp_customize->remove_section( 'title_tagline' );
	$wp_customize->remove_section( 'background_image' );

	$wp_customize->add_section( 'et_google_fonts' , array(
		'title'		=> __( 'Fonts', 'Nexus' ),
		'priority'	=> 50,
	) );

	$wp_customize->add_section( 'et_color_schemes' , array(
		'title'       => __( 'Schemes', 'Nexus' ),
		'priority'    => 60,
		'description' => __( 'Note: Color settings set above should be applied to the Default color scheme.', 'Nexus' ),
	) );

	$wp_customize->add_setting( 'et_nexus[link_color]', array(
		'default'		=> '#4bb6f5',
		'type'			=> 'option',
		'capability'	=> 'edit_theme_options',
		'transport'		=> 'postMessage'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'et_nexus[link_color]', array(
		'label'		=> __( 'Link Color', 'Nexus' ),
		'section'	=> 'colors',
		'settings'	=> 'et_nexus[link_color]',
	) ) );

	$wp_customize->add_setting( 'et_nexus[font_color]', array(
		'default'		=> '#333333',
		'type'			=> 'option',
		'capability'	=> 'edit_theme_options',
		'transport'		=> 'postMessage'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'et_nexus[font_color]', array(
		'label'		=> __( 'Main Font Color', 'Nexus' ),
		'section'	=> 'colors',
		'settings'	=> 'et_nexus[font_color]',
	) ) );

	$wp_customize->add_setting( 'et_nexus[accent_color]', array(
		'default'		=> '#a9d300',
		'type'			=> 'option',
		'capability'	=> 'edit_theme_options',
		'transport'		=> 'postMessage'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'et_nexus[accent_color]', array(
		'label'		=> __( 'Accent Color', 'Nexus' ),
		'section'	=> 'colors',
		'settings'	=> 'et_nexus[accent_color]',
	) ) );

	$wp_customize->add_setting( 'et_nexus[menu_link]', array(
		'default'		=> '#333333',
		'type'			=> 'option',
		'capability'	=> 'edit_theme_options',
		'transport'		=> 'postMessage'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'et_nexus[menu_link]', array(
		'label'		=> __( 'Menu Links Color', 'Nexus' ),
		'section'	=> 'colors',
		'settings'	=> 'et_nexus[menu_link]',
	) ) );

	$wp_customize->add_setting( 'et_nexus[menu_link_active]', array(
		'default'		=> '#ffffff',
		'type'			=> 'option',
		'capability'	=> 'edit_theme_options',
		'transport'		=> 'postMessage'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'et_nexus[menu_link_active]', array(
		'label'		=> __( 'Active Menu Link Color', 'Nexus' ),
		'section'	=> 'colors',
		'settings'	=> 'et_nexus[menu_link_active]',
	) ) );

	$wp_customize->add_setting( 'et_nexus[heading_font]', array(
		'default'		=> 'none',
		'type'			=> 'option',
		'capability'	=> 'edit_theme_options'
	) );

	$wp_customize->add_control( 'et_nexus[heading_font]', array(
		'label'		=> __( 'Header Font', 'Nexus' ),
		'section'	=> 'et_google_fonts',
		'settings'	=> 'et_nexus[heading_font]',
		'type'		=> 'select',
		'choices'	=> $font_choices
	) );

	$wp_customize->add_setting( 'et_nexus[body_font]', array(
		'default'		=> 'none',
		'type'			=> 'option',
		'capability'	=> 'edit_theme_options'
	) );

	$wp_customize->add_control( 'et_nexus[body_font]', array(
		'label'		=> __( 'Body Font', 'Nexus' ),
		'section'	=> 'et_google_fonts',
		'settings'	=> 'et_nexus[body_font]',
		'type'		=> 'select',
		'choices'	=> $font_choices
	) );

	$wp_customize->add_setting( 'et_nexus[color_schemes]', array(
		'default'		=> 'none',
		'type'			=> 'option',
		'capability'	=> 'edit_theme_options',
		'transport'		=> 'postMessage'
	) );

	$wp_customize->add_control( 'et_nexus[color_schemes]', array(
		'label'		=> __( 'Color Schemes', 'Nexus' ),
		'section'	=> 'et_color_schemes',
		'settings'	=> 'et_nexus[color_schemes]',
		'type'		=> 'select',
		'choices'	=> array(
			'none'   => __( 'Default', 'Nexus' ),
			'blue'   => __( 'Blue', 'Nexus' ),
			'orange' => __( 'Orange', 'Nexus' ),
			'purple' => __( 'Purple', 'Nexus' ),
			'red'    => __( 'Red', 'Nexus' ),
		),
	) );
}
add_action( 'customize_register', 'et_nexus_customize_register' );

function et_nexus_customize_preview_js() {
	wp_enqueue_script( 'nexus-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), false, true );
}
add_action( 'customize_preview_init', 'et_nexus_customize_preview_js' );

function et_nexus_add_customizer_css(){ ?>
	<style>
		a { color: <?php echo esc_html( et_get_option( 'link_color', '#4bb6f5' ) ); ?>; }

		body { color: <?php echo esc_html( et_get_option( 'font_color', '#333333' ) ); ?>; }

		#top-menu li.current-menu-item > a, #top-menu > li > a:hover, .meta-info, .et-description .post-meta span, .categories-tabs:after, .home-tab-active, .home-tab-active:before, a.read-more, .comment-reply-link, h1.post-heading, .form-submit input, .home-tab-active:before, .et-recent-videos-wrap li:before, .nav li ul, .et_mobile_menu, #top-menu > .sfHover > a { background-color: <?php echo esc_html( et_get_option( 'accent_color', '#a9d300' ) ); ?>; }

		.featured-comments span, #author-info strong, #footer-bottom .current-menu-item a, .featured-comments span { color: <?php echo esc_html( et_get_option( 'accent_color', '#a9d300' ) ); ?>; }
		.entry-content blockquote, .widget li:before, .footer-widget li:before, .et-popular-mobile-arrow-next { border-left-color: <?php echo esc_html( et_get_option( 'accent_color', '#a9d300' ) ); ?>; }

		.et-popular-mobile-arrow-previous { border-right-color: <?php echo esc_html( et_get_option( 'accent_color', '#a9d300' ) ); ?>; }

		#top-menu > li > a { color: <?php echo esc_html( et_get_option( 'menu_link', '#333333' ) ); ?>; }

		#top-menu > li.current-menu-item > a, #top-menu li li a, .et_mobile_menu li a { color: <?php echo esc_html( et_get_option( 'menu_link_active', '#ffffff' ) ); ?>; }

	<?php
		$et_gf_heading_font = sanitize_text_field( et_get_option( 'heading_font', 'none' ) );
		$et_gf_body_font = sanitize_text_field( et_get_option( 'body_font', 'none' ) );

		if ( 'none' != $et_gf_heading_font || 'none' != $et_gf_body_font ) :

			if ( 'none' != $et_gf_heading_font )
				et_gf_attach_font( $et_gf_heading_font, 'h1, h2, h3, h4, h5, h6' );

			if ( 'none' != $et_gf_body_font )
				et_gf_attach_font( $et_gf_body_font, 'body, input, textarea, select' );

		endif;
	?>
	</style>
<?php }
add_action( 'wp_head', 'et_nexus_add_customizer_css' );
add_action( 'customize_controls_print_styles', 'et_nexus_add_customizer_css' );

/*
 * Adds color scheme class to the body tag
 */
function et_customizer_color_scheme_class( $body_class ) {
	$color_scheme        = et_get_option( 'color_schemes', 'none' );
	$color_scheme_prefix = 'et_color_scheme_';

	if ( 'none' !== $color_scheme ) $body_class[] = $color_scheme_prefix . $color_scheme;

	return $body_class;
}
add_filter( 'body_class', 'et_customizer_color_scheme_class' );

function et_load_google_fonts_scripts() {
	wp_enqueue_script( 'et_google_fonts', get_template_directory_uri() . '/epanel/google-fonts/et_google_fonts.js', array( 'jquery' ), '1.0', true );
}
add_action( 'customize_controls_print_footer_scripts', 'et_load_google_fonts_scripts' );

function et_load_google_fonts_styles() {
	wp_enqueue_style( 'et_google_fonts_style', get_template_directory_uri() . '/epanel/google-fonts/et_google_fonts.css', array(), null );
}
add_action( 'customize_controls_print_styles', 'et_load_google_fonts_styles' );

if ( ! function_exists( 'et_nexus_post_meta' ) ) :
function et_nexus_post_meta() {
	$postinfo = is_single() ? et_get_option( 'nexus_postinfo2' ) : et_get_option( 'nexus_postinfo1' );

	if ( $postinfo ) :
		echo '<p class="post-meta">';
		et_postinfo_meta( $postinfo, et_get_option( 'nexus_date_format', 'M j, Y' ), esc_html__( '0 comments', 'Nexus' ), esc_html__( '1 comment', 'Nexus' ), '% ' . esc_html__( 'comments', 'Nexus' ) );
		echo '</p>';
	endif;
}
endif;

if ( ! function_exists( 'et_nexus_truncate_post' ) ){
	function et_nexus_truncate_post( $amount, $echo = true, $post = '' ) {
		global $shortname;

		if ( $post == '' ) global $post;

		$postExcerpt = '';
		$postExcerpt = apply_filters( 'the_excerpt', $post->post_excerpt );

		if (et_get_option($shortname.'_use_excerpt') == 'on' && $postExcerpt <> '') {
			if ($echo) echo $postExcerpt;
			else return $postExcerpt;
		} else {
			$truncate = $post->post_content;

			$truncate = preg_replace('@\[caption[^\]]*?\].*?\[\/caption]@si', '', $truncate);

			if ( strlen($truncate) <= $amount ) $echo_out = ''; else $echo_out = '...';
			$truncate = apply_filters('the_content', $truncate);
			$truncate = preg_replace('@<script[^>]*?>.*?</script>@si', '', $truncate);
			$truncate = preg_replace('@<style[^>]*?>.*?</style>@si', '', $truncate);

			$truncate = strip_tags($truncate);

			if ($echo_out == '...') $truncate = substr($truncate, 0, strrpos(substr($truncate, 0, $amount), ' '));
			else $truncate = substr($truncate, 0, $amount);

			if ($echo) echo $truncate,$echo_out;
			else return ($truncate . $echo_out);
		};
	}
}

function et_nexus_featured_bg() {
	if ( ! is_home() && ! is_category() && ! is_singular() ) return;

	if ( is_singular() && ( ( ( $et_single_image = get_post_meta( get_the_ID(), '_et_single_bg_image', true ) ) && '' != $et_single_image ) || '' != get_the_post_thumbnail() ) ) {

		if ( '' != $et_single_image ) {
			$bg_image = $et_single_image;
		} else {
			$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
			$bg_image = $image[0];
		}

		printf( '<style>.post-thumbnail { background-image: url(%s); }</style>',
			esc_url( $bg_image )
		);

		return;
	}

	$featured_image = ( $featured_bg = et_get_option( 'nexus_featured_bg', '' ) ) && '' !== $featured_bg
		? $featured_bg
		: get_template_directory_uri() . '/images/featured-bg.jpg';

	printf( '<style>#featured { background-image: url(%s); }</style>',
		esc_url( $featured_image )
	);
}
add_action( 'wp_head', 'et_nexus_featured_bg' );

function et_homepage_builder_page() {
	$epanel = basename(__FILE__);

    $builder_page = add_theme_page( esc_html__( 'Nexus Homepage Builder', 'Nexus' ), esc_html__( 'Nexus Homepage Builder', 'Nexus' ), 'switch_themes', 'et_nexus_homepage_builder', 'et_homepage_builder_interface' );

    if ( isset( $_GET['page'] ) && 'et_nexus_homepage_builder' === $_GET['page'] && isset( $_POST['et_hb_action'] ) )
		et_homepage_builder_save_data();

	add_action( "admin_print_scripts-{$builder_page}", 'et_homepage_builder_admin_js' );
	add_action( "admin_print_styles-{$builder_page}", 'et_homepage_builder_admin_css' );
}
add_action( 'admin_menu', 'et_homepage_builder_page' );

if ( ! function_exists( 'et_homepage_builder_admin_js' ) ) :
function et_homepage_builder_admin_js() {
	wp_enqueue_script( 'jquery-ui-sortable' );
	wp_enqueue_script( 'et-homepage-builder-js', get_template_directory_uri() . '/js/et_homepage_builder_admin.js', array( 'jquery' ), '1.0', true );
	wp_localize_script( 'et-homepage-builder-js', 'et_hb_options', array(
		'ajaxurl'     => admin_url( 'admin-ajax.php' ),
		'et_hb_nonce' => wp_create_nonce( 'et_hb_nonce' ),
	) );
}
endif;

if ( ! function_exists( 'et_homepage_builder_admin_css' ) ) :
function et_homepage_builder_admin_css() {
	wp_enqueue_style( 'et-homepage-builder', get_template_directory_uri() . '/css/et_homepage_builder_admin.css' );
}
endif;

function et_nexus_add_module(){
	if ( ! wp_verify_nonce( $_POST['et_hb_nonce'], 'et_hb_nonce' ) )
		die(-1);

	$et_module_type    = sanitize_text_field( $_POST['et_module_type'] );
	$et_modules_number = (int) $_POST['et_modules_number'];
	et_generate_module( $et_module_type, $et_modules_number );

	die();
}
add_action( 'wp_ajax_et_add_module', 'et_nexus_add_module' );

function et_recent_module_add_posts() {
	if ( ! wp_verify_nonce( $_POST['et_hb_nonce'], 'et_hb_nonce' ) )
		die(-1);

	$category = $_POST['category'];
	$posts_number = $_POST['number'];
	$offset = $_POST['offset'];

	$args = array(
		'ignore_sticky_posts' => 1,
		'posts_per_page'      => (int) $posts_number,
		'offset'              => (int) $offset,
		'post_status'         => 'publish',
	);
	if ( 'all' !== $category )
		$args['cat'] = (int) $category;

	$et_recent_posts_query = new WP_Query( apply_filters( 'et_recent_posts_query_args', $args ) );

	if ( $et_recent_posts_query->have_posts() ) :
		while ( $et_recent_posts_query->have_posts() ) : $et_recent_posts_query->the_post();
			get_template_part( 'includes/recent_module', 'home' );
		endwhile;
	endif;
	wp_reset_postdata();

	die();
}
add_action( 'wp_ajax_et_recent_module_add_posts', 'et_recent_module_add_posts' );
add_action( 'wp_ajax_nopriv_et_recent_module_add_posts', 'et_recent_module_add_posts' );

function et_reviews_module_add_posts() {
	if ( ! wp_verify_nonce( $_POST['et_hb_nonce'], 'et_hb_nonce' ) )
		die(-1);

	$category = $_POST['category'];
	$posts_number = $_POST['number'];
	$offset = $_POST['offset'];

	$args = array(
		'ignore_sticky_posts' => 1,
		'posts_per_page'      => (int) $posts_number,
		'offset'              => (int) $offset,
		'meta_key'            => '_et_author_rating',
		'meta_value'          => 0,
		'meta_compare'        => '>',
		'post_status'         => 'publish',
	);
	if ( 'all' !== $category )
		$args['cat'] = (int) $category;

	$et_reviews_query = new WP_Query( apply_filters( 'et_reviews_query_args', $args ) );

	if ( $et_reviews_query->have_posts() ) :
		while ( $et_reviews_query->have_posts() ) : $et_reviews_query->the_post();
			get_template_part( 'includes/reviews_module', 'home' );
		endwhile;
	endif;

	die();
}
add_action( 'wp_ajax_et_reviews_module_add_posts', 'et_reviews_module_add_posts' );
add_action( 'wp_ajax_nopriv_et_reviews_module_add_posts', 'et_reviews_module_add_posts' );

if ( ! function_exists( 'et_nexus_get_modules' ) ) :
function et_nexus_get_modules() {
	$all_categories = get_categories( 'hide_empty=1' );

	$site_cats['all'] = __( 'All Categories', 'Nexus' );

	foreach ( $all_categories as $category ) {
		$site_cats[$category->cat_ID] = $category->cat_name;
		$cats_ids[] = $category->cat_ID;
	}

	$all_categories = $site_cats;
	unset( $all_categories['all'] );

	$modules = array(
		'recent_posts' => array(
			'category' => array(
				'title'      => __( 'Select a Category', 'Nexus' ),
				'type'       => 'select',
				'options'    => $site_cats,
				'validation' => 'number',
			),
			'number' => array(
				'title'      => __( 'Number of posts', 'Nexus' ),
				'type'       => 'input',
				'validation' => 'number',
				'std'        => 3,
			),
		),
		'popular_posts' => array(
			'period' => array(
				'title'      => __( 'Select a Period', 'Nexus' ),
				'type'       => 'select',
				'options'    => array(
					'week'     => __( 'This Week', 'Nexus' ),
					'month'    => __( 'Month', 'Nexus' ),
					'all_time' => __( 'All Time', 'Nexus' ),
				),
				'validation' => 'nohtml',
			),
			'number' => array(
				'title'      => __( 'Number of posts', 'Nexus' ),
				'type'       => 'input',
				'validation' => 'number',
				'std'        => 5,
			),
		),
		'recent_reviews' => array(
			'category' => array(
				'title'      => __( 'Select a Category', 'Nexus' ),
				'type'       => 'select',
				'options'    => $site_cats,
				'validation' => 'number',
			),
			'number' => array(
				'title'      => __( 'Number of posts', 'Nexus' ),
				'type'       => 'input',
				'validation' => 'number',
				'std'        => 3,
			),
		),
		'recent_posts_tabs' => array(
			'category' => array(
				'title'      => __( 'Select Categories', 'Nexus' ),
				'type'       => 'checkboxes',
				'options'    => $all_categories,
				'validation' => 'number',
			),
			'number' => array(
				'title'      => __( 'Number of posts', 'Nexus' ),
				'type'       => 'input',
				'validation' => 'number',
				'std'        => 3,
			),
		),
	);

	return apply_filters( 'et_nexus_homepage_modules', $modules );
}
endif;

if ( ! function_exists( 'et_generate_module' ) ) :
function et_generate_module( $type, $modules_number, $settings = array() ) {
	$options_slug = 'modules[' . $modules_number . ']';

	$et_nexus_modules = et_nexus_get_modules();

	echo '<div class="et_module et_module_' . esc_attr( $type ) . '">';

	if ( 'recent_posts' === $type )
		$et_module_name = __( 'Recent Posts', 'Nexus' );
	else if ( 'popular_posts' === $type )
		$et_module_name = __( 'Popular Posts', 'Nexus' );
	else if ( 'recent_reviews' === $type )
		$et_module_name = __( 'Recent Reviews', 'Nexus' );
	else if ( 'recent_posts_tabs' === $type )
		$et_module_name = __( 'Recent Posts ( Several categories )', 'Nexus' );

	echo '	<h3>' . esc_html( $et_module_name ) . '</h3>';

	echo '	<input type="hidden" name="' . $options_slug . '[type]" value="' . esc_attr( $type ) . '" />';

	foreach( $et_nexus_modules[$type] as $module_key => $module_option ) {
		echo '<h4>' . esc_html( $module_option['title'] ) . '</h4>';

		if ( 'select' === $module_option['type'] ) {
			printf( '<select name="%s">',
				esc_attr( $options_slug . "[{$module_key}]" )
			);

			foreach( $module_option['options'] as $option_key => $option )
				printf( '<option value="%s" %s>%s</option>',
					esc_attr( $option_key ),
					( isset( $settings[$module_key] ) ? selected( $settings[$module_key], $option_key, false ) : '' ),
					esc_html( $option )
				);

			echo '</select>';
		} elseif ( 'input' === $module_option['type'] ) {
			$default = isset( $module_option['std'] ) && ! isset( $settings[$module_key] ) ? $module_option['std'] : '';

			printf( '<input name="%s" type="text" value="%s" />',
				esc_attr( $options_slug . "[{$module_key}]" ),
				( isset( $settings[$module_key] ) ? esc_attr( $settings[$module_key] ) : $default )
			);
		} elseif ( 'checkboxes' === $module_option['type'] ) {
			foreach( $module_option['options'] as $option_key => $option ) {
				printf( '<label class="et_hb_checkboxes"><input name="%s[]" type="checkbox" value="%s" %s /> %s</label>',
					esc_attr( $options_slug . "[{$module_key}]" ),
					esc_attr( $option_key ),
					( isset( $settings[$module_key] ) ? checked( in_array( $option_key, $settings[$module_key] ), true , false ) : '' ),
					esc_html( $option )
				);
			}
		}
	}

	echo '	<a href="#" class="et_delete_module">' . __( 'Delete this module', 'Nexus' ) . '</a>';

	echo '</div> <!-- .et_module -->';
}
endif;

if ( ! function_exists( 'et_homepage_builder_save_data' ) ) :
function et_homepage_builder_save_data() {
	if ( ! current_user_can( 'switch_themes' ) )
		return;

	check_admin_referer( 'et_hb_nonce' );

	if ( isset( $_POST['modules'] ) ) {
		update_option( 'et_homepage_builder_modules', $_POST['modules'] );
		echo '	<div id="setting-error-settings_updated" class="updated settings-error">
					<p><strong>' . __( 'Settings saved.', 'Nexus' ) . '</strong></p></div>';
	} else {
		delete_option( 'et_homepage_builder_modules' );
	}
}
endif;

if ( ! function_exists( 'et_homepage_builder_interface' ) ) :
function et_homepage_builder_interface() {
	$all_modules = get_option( 'et_homepage_builder_modules' );
?>
	<div class="wrap">
		<h2 id="et_page_title"><?php esc_html_e( 'Homepage Builder', 'Nexus' ); ?></h2>

		<div id="et_modules_select">
			<a href="#" data-type="recent_posts"><?php esc_html_e( 'Add Recent Posts', 'Nexus' ); ?></a>
			<a href="#" data-type="popular_posts"><?php esc_html_e( 'Add Popular Posts', 'Nexus' ); ?></a>
			<a href="#" data-type="recent_reviews"><?php esc_html_e( 'Add Recent Reviews', 'Nexus' ); ?></a>
			<a href="#" data-type="recent_posts_tabs"><?php esc_html_e( 'Add Recent Posts From Several Categories', 'Nexus' ); ?></a>
		</div>

		<form id="et_homepage_builder" method="post">
			<div id="et_modules">
			<?php
			if ( $all_modules ) {
				$i = 1;
				foreach ( $all_modules as $module ) {
					et_generate_module( $module['type'], $i, $module );
					$i++;
				}
			}
			?>
			</div>

			<?php submit_button(); ?>

			<input type="hidden" name="et_hb_action" value="save_homepage_layout" />
			<?php wp_nonce_field( 'et_hb_nonce' ); ?>
		</form>
	</div>
<?php }
endif;

function et_nexus_remove_third_column( $classes ) {
	if ( 'false' === et_get_option( 'nexus_3rd_column', 'on' ) )
		$classes[] = 'et-2-column-layout';

	return $classes;
}
add_filter( 'body_class', 'et_nexus_remove_third_column' );