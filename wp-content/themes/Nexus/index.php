<?php get_header(); ?>

<?php
if ( is_category() && 'on' === et_get_option( 'nexus_category_featured', 'on' ) )
	get_template_part( 'includes/featured' );
?>

<div class="page-wrap container">
	<div id="main-content">
		<div class="main-content-wrap clearfix">
			<div id="content">
				<?php get_template_part( 'includes/breadcrumbs', 'index' ); ?>

				<div id="left-area">
		<?php
			if ( have_posts() ) :
				while ( have_posts() ) : the_post();
					$thumb = '';
					$width = (int) apply_filters( 'et_index_image_width', 240 );
					$height = (int) apply_filters( 'et_index_image_height', 240 );
					$classtext = '';
					$titletext = get_the_title();
					$thumbnail = get_thumbnail( $width, $height, $classtext, $titletext, $titletext, false, 'Blogimage' );
					$thumb = $thumbnail["thumb"];
		?>
					<div class="recent-post clearfix">
					<?php if ( '' !== $thumb ) : ?>
						<div class="et-main-image">
							<a href="<?php the_permalink(); ?>">
								<?php print_thumbnail( $thumb, $thumbnail["use_timthumb"], $titletext, $width, $height ); ?>
							</a>

							<div class="meta-info">
								<div class="meta-date">
									<span class="month"><?php echo get_the_time( 'M' ); ?></span><span><?php echo get_the_time( 'd' ); ?></span>
								</div>
							</div>
						</div>
					<?php endif; ?>

						<div class="et-description">
							<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

						<?php if ( ( $review_rating = get_post_meta( get_the_ID(), '_et_author_rating', true ) ) && '' !== $review_rating ) : ?>
							<span class="review-rating"><span style="width: <?php echo $review_rating * 33.5; ?>px;"></span></span>
						<?php endif; ?>

							<?php et_nexus_post_meta(); ?>
					<?php
						if ( 'on' === et_get_option( 'nexus_blog_style', 'false' ) )
							the_content('');
						else
							echo '<p>' . truncate_post( 440, false ) . '</p>';
					?>
						</div> <!-- .et-description -->

						<a href="<?php the_permalink(); ?>" class="read-more"><span><?php esc_html_e( 'Read More', 'Nexus' ); ?></span></a>
					</div> <!-- .recent-post -->
<?php
				endwhile;

				if ( function_exists( 'wp_pagenavi' ) )
					wp_pagenavi();
				else
					get_template_part( 'includes/navigation', 'index' );
			else :
				get_template_part( 'includes/no-results', 'index' );
			endif;
?>
				</div> 	<!-- end #left-area -->
			</div> <!-- #content -->

			<?php get_sidebar(); ?>
		</div> <!-- .main-content-wrap -->

		<?php get_template_part( 'includes/footer-banner', 'index' ); ?>
	</div> <!-- #main-content -->

	<?php get_footer(); ?>