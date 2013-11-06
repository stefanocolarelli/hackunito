<?php get_header(); ?>

<div class="page-wrap container">
	<div id="main-content">
		<div class="main-content-wrap clearfix">
			<div id="content">
				<?php get_template_part( 'includes/breadcrumbs', '404' ); ?>

				<div id="left-area">
					<div class="recent-post">
						<?php get_template_part( 'includes/no-results', '404' ); ?>
					</div> <!-- end .recent-post -->
				</div> <!-- end #left-area -->
			</div> <!-- #content -->

			<?php get_sidebar(); ?>
		</div> <!-- .main-content-wrap -->

		<?php get_template_part( 'includes/footer-banner', '404' ); ?>
	</div> <!-- #main-content -->

	<?php get_footer(); ?>