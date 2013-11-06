<?php
/*
Template Name: Sitemap Page
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

						<div id="sitemap" class="responsive">
							<div class="sitemap-col">
								<h2><?php esc_html_e('Pages','Nexus'); ?></h2>
								<ul id="sitemap-pages"><?php wp_list_pages('title_li='); ?></ul>
							</div> <!-- end .sitemap-col -->

							<div class="sitemap-col">
								<h2><?php esc_html_e('Categories','Nexus'); ?></h2>
								<ul id="sitemap-categories"><?php wp_list_categories('title_li='); ?></ul>
							</div> <!-- end .sitemap-col -->

							<div class="sitemap-col<?php if (!$fullwidth) echo ' last'; ?>">
								<h2><?php esc_html_e('Tags','Nexus'); ?></h2>
								<ul id="sitemap-tags">
									<?php $tags = get_tags();
									if ($tags) {
										foreach ($tags as $tag) {
											echo '<li><a href="' . esc_url( get_tag_link( $tag->term_id ) ) . '">' . esc_html( $tag->name ) . '</a></li> ';
										}
									} ?>
								</ul>
							</div> <!-- end .sitemap-col -->

							<?php if (!$fullwidth) { ?>
								<div class="clear"></div>
							<?php } ?>

							<div class="sitemap-col<?php if ($fullwidth) echo ' last'; ?>">
								<h2><?php esc_html_e('Authors','Nexus'); ?></h2>
								<ul id="sitemap-authors" ><?php wp_list_authors('show_fullname=1&optioncount=1&exclude_admin=0'); ?></ul>
							</div> <!-- end .sitemap-col -->
						</div> <!-- end #sitemap -->

						<div class="clear"></div>

					</article> <!-- .entry -->

				<?php endwhile; ?>

				</div> 	<!-- end #left-area -->
			</div> <!-- #content -->

			<?php if ( ! $fullwidth ) get_sidebar(); ?>
		</div> <!-- .main-content-wrap -->

		<?php get_template_part( 'includes/footer-banner', 'page' ); ?>
	</div> <!-- #main-content -->

<?php get_footer(); ?>