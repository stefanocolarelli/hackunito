<?php if ( 'on' === et_get_option( 'nexus_footer_banner', 'false' ) ) : ?>
	<div class="footer-banner">
	<?php
		printf( '<a href="%s"><img src="%s" alt="%s" /></a>',
			esc_url( et_get_option( 'nexus_footer_banner_url', '#' ) ),
			esc_attr( et_get_option( 'nexus_footer_banner_image' ) ),
			esc_attr( et_get_option( 'nexus_footer_banner_description' ) )
		);
	?>
	</div> <!-- .footer-banner -->
<?php endif; ?>