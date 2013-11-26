/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	wp.customize( 'et_nexus[link_color]', function( value ) {
		value.bind( function( to ) {
			$( 'a' ).css( 'color', to );
		} );
	} );

	wp.customize( 'et_nexus[font_color]', function( value ) {
		value.bind( function( to ) {
			$( 'body' ).css( 'color', to );
		} );
	} );

	wp.customize( 'et_nexus[accent_color]', function( value ) {
		value.bind( function( to ) {
			$( '#top-menu li.current-menu-item > a, #top-menu > li > a:hover, .meta-info, .et-description .post-meta span, .categories-tabs:after, .home-tab-active, .home-tab-active:before, a.read-more, .comment-reply-link, h1.post-heading, .form-submit input, .home-tab-active:before, .et-recent-videos-wrap li:before, .nav li ul, .et_mobile_menu, #top-menu > .sfHover > a' ).css( 'background-color', to );

			$( '.featured-comments span, #author-info strong, #footer-bottom .current-menu-item a, .featured-comments span' ).css( 'color', to );

			$( '.entry-content blockquote, .widget li:before, .footer-widget li:before, .et-popular-mobile-arrow-next' ).css( 'border-left-color', to );

			$( '.et-popular-mobile-arrow-previous' ).css( 'border-right-color', to );
		} );
	} );

	wp.customize( 'et_nexus[menu_link]', function( value ) {
		value.bind( function( to ) {
			$( '#top-menu > li > a' ).css( 'color', to );
		} );
	} );

	wp.customize( 'et_nexus[menu_link_active]', function( value ) {
		value.bind( function( to ) {
			$( '#top-menu > li.current-menu-item > a, #top-menu li li a, .et_mobile_menu li a' ).css( 'color', to );
		} );
	} );

	wp.customize( 'et_nexus[color_schemes]', function( value ) {
		value.bind( function( to ) {
			var $body = $( 'body' ),
				body_classes = $body.attr( 'class' ),
				et_customizer_color_scheme_prefix = 'et_color_scheme_',
				body_class;

			body_class = body_classes.replace( /et_color_scheme_[^\s]+/, '' );
			$body.attr( 'class', $.trim( body_class ) );

			if ( 'none' !== to  )
				$body.addClass( et_customizer_color_scheme_prefix + to );
		} );
	} );
} )( jQuery );