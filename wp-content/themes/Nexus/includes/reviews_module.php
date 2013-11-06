<?php
	$review_rating = get_post_meta( get_the_ID(), '_et_author_rating', true );
?>

<div class="review-post clearfix">
	<div class="et-description">
		<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<p class="post-meta">
		<?php
			printf( __( '<span>%s</span>Posted by %s in %s', 'Nexus' ),
				get_the_time( 'M j' ),
				et_get_the_author_posts_link(),
				get_the_category_list( ', ' )
			);
		?>
		</p>
	</div> <!-- .et-description -->

	<span class="review-rating"><span style="width: <?php echo $review_rating * 33.5; ?>px;"></span></span>
</div> <!-- .review-post -->