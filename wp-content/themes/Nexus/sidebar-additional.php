<?php if ( is_active_sidebar( 'sidebar-additional' ) && 'on' === et_get_option( 'nexus_3rd_column', 'on' ) ) : ?>
	<div id="additional-sidebar">
		<?php dynamic_sidebar( 'sidebar-additional' ); ?>
	</div> <!-- #additional-sidebar -->
<?php endif; ?>