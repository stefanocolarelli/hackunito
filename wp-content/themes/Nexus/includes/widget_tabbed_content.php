<?php
	$thumb = '';
	$width = (int) apply_filters( 'et_index_image_width', 60 );
	$height = (int) apply_filters( 'et_index_image_height', 60 );
	$classtext = '';
	$titletext = get_the_title();
	$thumbnail = get_thumbnail( $width, $height, $classtext, $titletext, $titletext, false, 'Tabbed' );
	$thumb = $thumbnail["thumb"];
?>

<li class="clearfix<?php if ( '' === $thumb ) echo ' no-thumb'; ?>">
<?php if ( '' !== $thumb ) : ?>
	<div class="smallthumb">
		<a href="<?php the_permalink(); ?>">
			<?php print_thumbnail( $thumb, $thumbnail["use_timthumb"], $titletext, $width, $height ); ?>
		</a>
	</div>
<?php endif; ?>

	<div class="post-metainfo">
		<span class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>

		<span class="postinfo"><?php echo get_the_time( et_get_option( 'nexus_date_format', 'M j, Y' ) ); ?></span>
	</div>
</li>