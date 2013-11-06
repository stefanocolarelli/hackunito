<?php
if ( is_front_page() && is_page() ) {
	include( get_page_template() );
	return;
}

if ( 'on' === et_get_option( 'nexus_blog_style', 'false' ) ) {
	get_template_part( 'index' );
	return;
}
?>

<?php get_header(); ?>

<?php
if ( 'on' === et_get_option( 'nexus_featured', 'on' ) )
	get_template_part( 'includes/featured' );
?>

<div class="page-wrap container">
	<div id="main-content">
		<div class="main-content-wrap clearfix">
			<div id="content">

<?php
$all_modules = get_option( 'et_homepage_builder_modules' );

if ( $all_modules ) :
	foreach ( $all_modules as $module ) {
		switch ( $module['type'] ) {
			case 'recent_posts' : ?>
				<section class="recent-module">
					<h1 class="module-title">
					<?php
						$et_category = 'all' === $module['category']
							? __( 'All Categories', 'Nexus' )
							: get_cat_name( $module['category'] );

						printf( __( 'Recent Posts From <span>%s</span>', 'Nexus' ),
							$et_category
						);
					?>
					</h1>

					<div class="module-content">
				<?php
					$args = array(
						'ignore_sticky_posts' => 1,
						'posts_per_page'      => (int) $module['number'],
					);
					if ( 'all' !== $module['category'] )
						$args['cat'] = (int) $module['category'];

					$et_recent_posts_query = new WP_Query( apply_filters( 'et_recent_posts_query_args', $args ) );

					if ( $et_recent_posts_query->have_posts() ) :
						while ( $et_recent_posts_query->have_posts() ) : $et_recent_posts_query->the_post();
							get_template_part( 'includes/recent_module', 'home' );
						endwhile;
					endif;
					wp_reset_postdata();
				?>
					</div> <!-- .module-content -->

				<?php if ( $et_recent_posts_query->max_num_pages > 1 ) : ?>
					<div class="load-more">
						<a href="#" data-category="<?php echo esc_attr( $module['category'] ); ?>" data-number="<?php echo esc_attr( $module['number'] ); ?>"><?php esc_html_e( 'Load More Posts', 'Nexus' ); ?></a>
					</div>
				<?php endif; ?>
				</section> <!-- .recent-module -->
<?php
				break;
			case 'recent_reviews' :
?>
				<section class="recent-reviews">
					<h1 class="module-title">
					<?php
						$et_category = 'all' === $module['category']
							? __( 'All Categories', 'Nexus' )
							: get_cat_name( $module['category'] );

						printf( __( 'Recent Reviews From <span>%s</span>', 'Nexus' ),
							$et_category
						);
					?>
					</h1>

					<div class="reviews-content">
				<?php
					$args = array(
						'ignore_sticky_posts' => 1,
						'posts_per_page'      => (int) $module['number'],
						'meta_key'            => '_et_author_rating',
						'meta_value'          => 0,
						'meta_compare'        => '>',
					);
					if ( 'all' !== $module['category'] )
						$args['cat'] = (int) $module['category'];

					$et_reviews_query = new WP_Query( apply_filters( 'et_reviews_query_args', $args ) );

					if ( $et_reviews_query->have_posts() ) :
						while ( $et_reviews_query->have_posts() ) : $et_reviews_query->the_post();
							get_template_part( 'includes/reviews_module', 'home' );
						endwhile;
					endif;
					wp_reset_postdata();
				?>
					</div> <!-- .reviews-content -->

				<?php if ( $et_reviews_query->max_num_pages > 1 ) : ?>
					<div class="load-more">
						<a href="#" data-category="<?php echo esc_attr( $module['category'] ); ?>" data-number="<?php echo esc_attr( $module['number'] ); ?>"><?php esc_html_e( 'Load More Posts', 'Nexus' ); ?></a>
					</div>
				<?php endif; ?>
				</section> <!-- .recent-reviews -->
<?php
				break;
			case 'recent_posts_tabs' :
?>
				<section class="categories-tabs-module">
					<ul class="categories-tabs">
					<?php
						$i = 1;
						foreach ( $module['category'] as $category ) {
							printf( '<li%s>%s</li>',
								( $i === 1 ? ' class="home-tab-active"' : '' ),
								get_cat_name( $category )
							);
							$i++;
						}
					?>
					</ul>

					<div class="all-tabs">
					<?php
						foreach ( $module['category'] as $category ) {
							$args = array(
								'ignore_sticky_posts' => 1,
								'posts_per_page'      => (int) $module['number'],
								'cat'                 => (int) $category,
							);

							$et_recent_posts_tabs_query = new WP_Query( apply_filters( 'et_recent_posts_tabs_query_args', $args ) );

							if ( $et_recent_posts_tabs_query->have_posts() ) :
								echo '<div class="et-tabs">';
								echo '	<div class="et-tabs-wrap">';
								while ( $et_recent_posts_tabs_query->have_posts() ) : $et_recent_posts_tabs_query->the_post();
									get_template_part( 'includes/recent_module', 'home' );
								endwhile;
								echo '	</div> <!-- .et-tabs-wrap -->';

								if ( $et_recent_posts_tabs_query->max_num_pages > 1 ) {
					?>
								<div class="load-more">
									<a href="#" data-category="<?php echo esc_attr( $category ); ?>" data-number="<?php echo esc_attr( $module['number'] ); ?>"><?php esc_html_e( 'Load More Posts', 'Nexus' ); ?></a>
								</div>
							<?php
								}

								echo '</div> <!-- .et-tabs -->';
							endif;
							wp_reset_postdata();
						}
					?>
					</div> <!-- .all-tabs -->
				</section> <!-- .categories-tabs-module -->
<?php
				break;
			case 'popular_posts' :
?>
				<section class="popular-module clearfix">
					<h1 class="module-title">
					<?php
						$period = __( 'All Time', 'Nexus' );
						if ( 'week' === $module['period'] )
							$period = __( 'This Week', 'Nexus' );
						if ( 'month' === $module['period'] )
							$period = __( 'This Month', 'Nexus' );

						printf( __( 'Popular Posts <span>%s</span>', 'Nexus' ),
							esc_html( $period )
						);
					?>
					</h1>

				<?php
					$args = array(
						'ignore_sticky_posts' => 1,
						'posts_per_page'      => (int) $module['number'],
						'orderby'             => 'comment_count',
						'order'               => 'DESC',
					);

					if ( in_array( $module['period'], array( 'week', 'month' ) ) ) {
						$args['year'] = date( 'Y' );

						if ( 'week' === $module['period'] )
							$args['w'] = date( 'W' );

						if ( 'month' === $module['period'] )
							$args['monthnum'] = date( 'm' );
					}

					$et_popular_tabs_output = $et_popular_tabs_content = '';

					$et_popular_posts_tabs_query = new WP_Query( apply_filters( 'et_popular_posts_tabs_query_args', $args ) );

					ob_start();

					if ( $et_popular_posts_tabs_query->have_posts() ) :
						$i = 1;
						while ( $et_popular_posts_tabs_query->have_posts() ) : $et_popular_posts_tabs_query->the_post();
							$width = (int) apply_filters( 'et_popular_module_image_width', ( 'on' === et_get_option( 'nexus_3rd_column', 'on' ) ? 319 : 639 ) );
							$height = (int) apply_filters( 'et_popular_module_image_height', 160 );
							$title = get_the_title();
							$thumbnail = get_thumbnail( $width, $height, '', $title, $title, false, 'Popular' );
							$thumb = $thumbnail["thumb"];

							$et_popular_tabs_output .= sprintf(
								'<li%s>
									<span class="popular-tab-title">%s</span>
									<p class="post-meta">%s</p>
								</li>',
								( $i === 1 ? ' class="popular-active"' : '' ),
								get_the_title(),
								get_the_time( et_get_option( 'nexus_date_format', 'M j, Y' ) )
							);
				?>
							<div class="popular-post">
							<?php if ( '' !== $thumb ) : ?>
								<div class="main-tab-image">
									<a href="<?php the_permalink(); ?>">
										<?php print_thumbnail( $thumb, $thumbnail["use_timthumb"], $title, $width, $height ); ?>
									</a>

									<div class="meta-info">
										<div class="meta-date">
											<span class="month"><?php echo get_the_time( 'M' ); ?></span><span><?php echo get_the_time( 'd' ); ?></span>
										</div>
									</div>
								</div>
							<?php endif; ?>

								<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

								<p class="post-meta">
								<?php
									printf( __( 'Posted by %s on %s in %s', 'Nexus' ),
										et_get_the_author_posts_link(),
										get_the_time( 'n-d-y' ),
										get_the_category_list( ', ' )
									);
								?>
								</p>

								<p><?php truncate_post( 200 ); ?></p>
							</div> <!-- .popular-post -->
				<?php
							$i++;
						endwhile;
						wp_reset_postdata();

						$et_popular_tabs_content = ob_get_clean();
					endif;
				?>

					<div class="popular-posts-wrap clearfix">
				<?php
					if ( '' !== $et_popular_tabs_output ) : ?>
						<div class="popular-tabs">
							<div class="et-popular-tabs-content">
								<div class="et-scroll-arrows">
									<a href="#" class="et-scroll-arrows-top"><?php esc_html_e( 'Previous', 'Nexus' ); ?></a>
									<a href="#" class="et-scroll-arrows-bottom"><?php esc_html_e( 'Next', 'Nexus' ); ?></a>
								</div>
								<div class="et-popular-tabs-wrap">
									<ul>
										<?php echo $et_popular_tabs_output; ?>
									</ul>
								</div> <!-- .et-popular-tabs-wrap -->
							</div> <!-- .et-popular-tabs-content -->
						</div> <!-- .popular-tabs -->
				<?php
					endif;

					if ( '' !== $et_popular_tabs_content ) :
				?>
						<div class="popular-posts">
							<?php echo $et_popular_tabs_content; ?>
						</div> <!-- .popular-posts -->
					<?php
						endif;
					?>
					</div> <!-- .popular-posts-wrap -->
				</section> <!-- .popular-module -->
<?php
				break;
		}
	}

elseif ( current_user_can( 'publish_posts' ) ) : // if no modules set ?>
	<p class="add-modules-notice"><?php printf( __( 'Please, add several homepage modules. <a href="%1$s">Click here to start</a>.', 'Nexus' ), esc_url( admin_url( 'themes.php?page=et_nexus_homepage_builder' ) ) ); ?></p>
<?php
endif;
?>
			</div> <!-- #content -->

			<?php get_sidebar( 'additional' ); ?>

			<?php get_sidebar(); ?>

		</div> <!-- .main-content-wrap -->

		<?php get_template_part( 'includes/footer-banner', 'home' ); ?>
	</div> <!-- #main-content -->

	<?php get_footer(); ?>