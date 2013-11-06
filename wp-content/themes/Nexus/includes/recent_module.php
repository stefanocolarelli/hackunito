<?php
	$width = (int) apply_filters( 'et_recent_module_image_width', 160 );
	$height = (int) apply_filters( 'et_recent_module_image_height', 160 );
	$title = get_the_title();
	$thumbnail = get_thumbnail( $width, $height, '', $title, $title, false, 'Recent' );
	$thumb = $thumbnail["thumb"];
?>

<div class="recent-post clearfix">
<?php if ( '' !== $thumb ) : ?>
	<div class="et-main-image">
		<a href="<?php the_permalink(); ?>">
			<?php print_thumbnail( $thumb, $thumbnail["use_timthumb"], $title, $width, $height ); ?>
		</a>
	</div>
<?php endif; ?>
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
		<p><?php et_nexus_truncate_post( 77 ); ?></p>
	</div>
</div>