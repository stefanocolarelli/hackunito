<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title><?php elegant_titles(); ?></title>
	<?php elegant_description(); ?>
	<?php elegant_keywords(); ?>
	<?php elegant_canonical(); ?>

	<?php do_action( 'et_head_meta' ); ?>

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<?php $template_directory_uri = get_template_directory_uri(); ?>
	<!--[if lt IE 9]>
	<script src="<?php echo esc_url( $template_directory_uri . '/js/html5.js"' ); ?>" type="text/javascript"></script>
	<![endif]-->

	<script type="text/javascript">
		document.documentElement.className = 'js';
	</script>

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<header id="main-header">
		<div class="container">
			<div id="top-info" class="clearfix">
			<?php if ( 'on' === et_get_option( 'nexus_header_banner', 'false' ) ) : ?>
				<div class="header-banner">
				<?php
					printf( '<a href="%s"><img src="%s" alt="%s" /></a>',
						esc_url( et_get_option( 'nexus_header_banner_url', '#' ) ),
						esc_attr( et_get_option( 'nexus_header_banner_image' ) ),
						esc_attr( et_get_option( 'nexus_header_banner_description' ) )
					);
				?>
				</div> <!-- .header-banner -->
			<?php endif; ?>

			<?php
				$logo = ( $user_logo = et_get_option( 'nexus_logo' ) ) && '' != $user_logo
					? $user_logo
					: $template_directory_uri . '/images/logo.png';
			?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<img src="<?php echo esc_attr( $logo ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" id="logo" />
				</a>
			</div>

			<div id="top-navigation" class="clearfix">
				<?php do_action( 'et_header_top' ); ?>

				<nav>
				<?php
					$menuClass = 'nav';
					if ( 'on' == et_get_option( 'nexus_disable_toptier' ) ) $menuClass .= ' et_disable_top_tier';
					$primaryNav = '';

					$primaryNav = wp_nav_menu( array( 'theme_location' => 'primary-menu', 'container' => '', 'fallback_cb' => '', 'menu_class' => $menuClass, 'menu_id' => 'top-menu', 'echo' => false ) );

					if ( '' == $primaryNav ) :
				?>
					<ul id="top-menu" class="<?php echo esc_attr( $menuClass ); ?>">
						<?php if ( 'on' == et_get_option( 'nexus_home_link' ) ) { ?>
							<li <?php if ( is_home() ) echo( 'class="current_page_item"' ); ?>><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home','Nexus' ); ?></a></li>
						<?php }; ?>

						<?php show_page_menu( $menuClass, false, false ); ?>
						<?php show_categories_menu( $menuClass, false ); ?>
					</ul>
				<?php
					else :
						echo( $primaryNav );
					endif;
				?>
				</nav>

				<ul id="et-social-icons">
					<?php if ( 'on' === et_get_option( 'nexus_show_twitter_icon', 'on' ) ) : ?>
					<li class="twitter">
						<a href="<?php echo esc_url( et_get_option( 'nexus_twitter_url', '#' ) ); ?>">
							<span class="et-social-normal"><?php esc_html_e( 'Follow us on Twitter', 'Nexus' ); ?></span>
							<span class="et-social-hover"></span>
						</a>
					</li>
					<?php endif; ?>

					<?php if ( 'on' === et_get_option( 'nexus_show_facebook_icon', 'on' ) ) : ?>
					<li class="facebook">
						<a href="<?php echo esc_url( et_get_option( 'nexus_facebook_url', '#' ) ); ?>">
							<span class="et-social-normal"><?php esc_html_e( 'Follow us on Facebook', 'Nexus' ); ?></span>
							<span class="et-social-hover"></span>
						</a>
					</li>
					<?php endif; ?>

					<?php if ( 'on' === et_get_option( 'nexus_show_rss_icon', 'on' ) ) : ?>
					<li class="rss">
						<?php $et_rss_url = '' !== et_get_option( 'nexus_rss_url' ) ? et_get_option( 'nexus_rss_url' ) : get_bloginfo( 'comments_rss2_url' ); ?>
						<a href="<?php echo esc_url( $et_rss_url ); ?>">
							<span class="et-social-normal"><?php esc_html_e( 'Subscribe To Rss Feed', 'Nexus' ); ?></span>
							<span class="et-social-hover"></span>
						</a>
					</li>
					<?php endif; ?>

					<?php if ( 'on' === et_get_option( 'nexus_show_google_icon', 'on' ) ) : ?>
					<li class="google">
						<a href="<?php echo esc_url( et_get_option( 'nexus_google_url', '#' ) ); ?>">
							<span class="et-social-normal"><?php esc_html_e( 'Follow Us On Google+', 'Nexus' ); ?></span>
							<span class="et-social-hover"></span>
						</a>
					</li>
					<?php endif; ?>
				</ul>
			</div> <!-- #top-navigation -->
		</div> <!-- .container -->
	</header> <!-- #main-header -->