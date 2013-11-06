<?php
	$i = 1;

	$featured_args = array(
		'posts_per_page' => is_category() ? 2 : 4,
		'cat'            => (int) get_catId( ( is_category() ? get_query_var( 'cat' ) : et_get_option( 'nexus_feat_posts_cat' ) ) ),
	);

	if ( is_category() ) {
		$sticky_posts = get_option( 'sticky_posts' );

		if ( is_array( $sticky_posts ) ) {
			$featured_args['post__in'] = $sticky_posts;
		} else {
			$featured_args['orderby'] = 'rand';
		}
	}

	$featured_query = new WP_Query( apply_filters( 'et_featured_post_args', $featured_args ) );
?>
<div id="featured">
	<div class="container">
		<div id="et-featured-posts" class="clearfix">
<?php
		while ( $featured_query->have_posts() ) : $featured_query->the_post();
			$post_id = get_the_ID();

			$slide_more_link = get_post_meta( $post_id, '_et_slide_more_link', true );
			$more_link = '' != $slide_more_link ? $slide_more_link : get_permalink();

			$class = 'et-first';
			$truncate_length = 610;

			$width = (int) apply_filters( 'et_slider_image_width', 578 );
			$height = (int) apply_filters( 'et_slider_image_height', 420 );
			$title = get_the_title();

			if ( 2 === $i ) {
				$class = 'et-second';
				$truncate_length = 250;
				$width = (int) apply_filters( 'et_slider_image_medium_width', 578 );
				$height = (int) apply_filters( 'et_slider_image_medium_height', 208 );
			} else if ( 1 !== $i ) {
				$class = 3 === $i ? 'et-third' : 'et-fourth';
				$truncate_length = 75;
				$width = (int) apply_filters( 'et_slider_image_small_width', 287 );
				$height = (int) apply_filters( 'et_slider_image_small_height', 208 );
			}

			if ( is_category() ) {
				$truncate_length = 390;
				$width = (int) apply_filters( 'et_slider_category_image_width', 578 );
				$height = (int) apply_filters( 'et_slider_category_image_height', 280 );
			}

			$thumbnail = get_thumbnail( $width, $height, '', $title, $title, false, 'Featured' );
			$thumb = $thumbnail["thumb"];
?>
			<div class="et-featured-post <?php echo esc_attr( $class ); ?>">
				<?php print_thumbnail( $thumb, $thumbnail["use_timthumb"], $title, $width, $height ); ?>

				<div class="meta-info">
					<div class="meta-date">
						<span class="month"><?php echo get_the_time( 'M' ); ?></span><span><?php echo get_the_time( 'd' ); ?></span>
					</div>

					<span class="featured-comments"><span><?php comments_number( '0', '1', '%' ); ?></span></span>
				</div>

				<div class="post-description">
					<h2><a href="<?php echo esc_url( $more_link ); ?>"><?php the_title(); ?></a></h2>
					<p class="post-meta">
					<?php
						printf( __( 'Posted by %s on %s', 'Nexus' ),
							et_get_the_author_posts_link(),
							get_the_time( et_get_option( 'nexus_date_format', 'M j, Y' ) )
						);
					?>
					</p>
				</div>

				<div class="post-excerpt">
					<div class="excerpt-wrap">
						<a href="<?php echo esc_url( $more_link ); ?>" class="post-title"><?php the_title(); ?></a>
						<p><?php truncate_post( $truncate_length ); ?></p>
					</div>
					<a href="<?php echo esc_url( $more_link ); ?>" class="excerpt-more"><?php esc_html_e( 'Read more', 'Nexus' ); ?></a>
				</div>
			</div> <!-- .et-featured-post -->
<?php
			$i++;
		endwhile;
		wp_reset_postdata();
?>
		</div> <!-- #et-featured-posts -->
	</div> <!-- .container -->
</div> <!-- #featured -->