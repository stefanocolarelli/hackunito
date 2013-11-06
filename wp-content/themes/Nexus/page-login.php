<?php
/*
Template Name: Login Page
*/
?>
<?php
	$et_ptemplate_settings = array();
	$et_ptemplate_settings = maybe_unserialize( get_post_meta(get_the_ID(),'et_ptemplate_settings',true) );

	$fullwidth = isset( $et_ptemplate_settings['et_fullwidthpage'] ) ? (bool) $et_ptemplate_settings['et_fullwidthpage'] : false;
?>
<?php get_header(); ?>

<?php
$featured_image = false;

if ( '' != get_the_post_thumbnail() ) :
	$featured_image = true;
?>
<div class="post-thumbnail">
	<div class="container">
		<h1 class="post-heading"><?php the_title(); ?></h1>
	</div> <!-- .container -->
</div> <!-- .post-thumbnail -->
<?php endif; ?>

<div class="page-wrap container<?php if ( $fullwidth ) echo ' fullwidth'; ?>">
	<div id="main-content">
		<div class="main-content-wrap clearfix">
			<div id="content">
				<?php get_template_part( 'includes/breadcrumbs', 'index' ); ?>

				<div id="left-area">

				<?php while ( have_posts() ) : the_post(); ?>

					<article class="entry-content clearfix">
					<?php if ( ! $featured_image ) : ?>
						<h1 class="main-title"><?php the_title(); ?></h1>
					<?php endif; ?>
					<?php
						the_content();

						wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'Nexus' ), 'after' => '</div>' ) );
					?>

						<div id="et-login" class="responsive">
							<div class='et-protected'>
								<div class='et-protected-form'>
									<?php $scheme = apply_filters( 'et_forms_scheme', null ); ?>

									<form action='<?php echo esc_url( home_url( '', $scheme ) ); ?>/wp-login.php' method='post'>
										<p><label><span><?php esc_html_e('Username','Nexus'); ?>: </span><input type='text' name='log' id='log' value='<?php echo esc_attr($user_login); ?>' size='20' /><span class='et_protected_icon'></span></label></p>
										<p><label><span><?php esc_html_e('Password','Nexus'); ?>: </span><input type='password' name='pwd' id='pwd' size='20' /><span class='et_protected_icon et_protected_password'></span></label></p>
										<input type='submit' name='submit' value='Login' class='etlogin-button' />
									</form>
								</div> <!-- .et-protected-form -->
							</div> <!-- .et-protected -->
						</div> <!-- end #et-login -->
					</article> <!-- .entry -->

				<?php endwhile; ?>

				</div> 	<!-- end #left-area -->
			</div> <!-- #content -->

			<?php if ( ! $fullwidth ) get_sidebar(); ?>
		</div> <!-- .main-content-wrap -->

		<?php get_template_part( 'includes/footer-banner', 'page' ); ?>
	</div> <!-- #main-content -->

<?php get_footer(); ?>