<?php
/*
Template Name: Search Page
*/
?>
<?php
	$et_ptemplate_settings = array();
	$et_ptemplate_settings = maybe_unserialize( get_post_meta(get_the_ID(),'et_ptemplate_settings',true) );

	$fullwidth = isset( $et_ptemplate_settings['et_fullwidthpage'] ) ? (bool) $et_ptemplate_settings['et_fullwidthpage'] : false;
?>
<?php get_header(); ?>

<?php
$featured_image = false;

if ( '' != get_the_post_thumbnail() ) :
	$featured_image = true;
?>
<div class="post-thumbnail">
	<div class="container">
		<h1 class="post-heading"><?php the_title(); ?></h1>
	</div> <!-- .container -->
</div> <!-- .post-thumbnail -->
<?php endif; ?>

<div class="page-wrap container<?php if ( $fullwidth ) echo ' fullwidth'; ?>">
	<div id="main-content">
		<div class="main-content-wrap clearfix">
			<div id="content">
				<?php get_template_part( 'includes/breadcrumbs', 'index' ); ?>

				<div id="left-area">

				<?php while ( have_posts() ) : the_post(); ?>

					<article class="entry-content clearfix">
					<?php if ( ! $featured_image ) : ?>
						<h1 class="main-title"><?php the_title(); ?></h1>
					<?php endif; ?>
					<?php
						the_content();

						wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'Nexus' ), 'after' => '</div>' ) );
					?>
						<div id="et-search" class="responsive">
							<div id="et-search-inner" class="clearfix">
								<p id="et-search-title"><span><?php esc_html_e('search this website','Nexus'); ?></span></p>
								<form action="<?php echo esc_url( home_url() ); ?>" method="get" id="et_search_form">
									<div id="et-search-left">
										<p id="et-search-word"><input type="text" id="et-searchinput" name="s" value="<?php esc_attr_e('search this site...','Nexus'); ?>" /></p>

										<p id="et_choose_posts"><label><input type="checkbox" id="et-inc-posts" name="et-inc-posts" /> <?php esc_html_e('Posts','Nexus'); ?></label></p>
										<p id="et_choose_pages"><label><input type="checkbox" id="et-inc-pages" name="et-inc-pages" /> <?php esc_html_e('Pages','Nexus'); ?></label></p>
										<p id="et_choose_date">
											<select id="et-month-choice" name="et-month-choice">
												<option value="no-choice"><?php esc_html_e('Select a month','Nexus'); ?></option>
												<?php
													global $wpdb, $wp_locale;

													$selected = '';
													$arcresults = $wpdb->get_results(
														$wpdb->prepare( "SELECT YEAR(post_date) AS %s, MONTH(post_date) AS %s, count(ID) as posts FROM $wpdb->posts GROUP BY YEAR(post_date), MONTH(post_date) ORDER BY post_date DESC", 'year', 'month' )
													);

													foreach ( (array) $arcresults as $arcresult ) {
														if ( isset($_POST['et-month-choice']) && ( $_POST['et-month-choice'] == ($arcresult->year . $arcresult->month) ) ) {
															$selected = ' selected="selected"';
														}
														echo "<option value='{$arcresult->year}{$arcresult->month}'{$selected}>{$wp_locale->get_month($arcresult->month)}" . ", {$arcresult->year}</option>";
														if ( $selected <> '' ) $selected = '';
													}
												?>
											</select>
										</p>

										<p id="et_choose_cat"><?php wp_dropdown_categories('show_option_all=Choose a Category&show_count=1&hierarchical=1&id=et-cat&name=et-cat'); ?></p>
									</div> <!-- #et-search-left -->

									<div id="et-search-right">
										<input type="hidden" name="et_searchform_submit" value="et_search_proccess" />
										<input class="et_search_submit" type="submit" value="<?php esc_attr_e('Submit','Nexus'); ?>" id="et_search_submit" />
									</div> <!-- #et-search-right -->
								</form>
							</div> <!-- end #et-search-inner -->
						</div> <!-- end #et-search -->

						<div class="clear"></div>

					</article> <!-- .entry -->

				<?php endwhile; ?>

				</div> 	<!-- end #left-area -->
			</div> <!-- #content -->

			<?php if ( ! $fullwidth ) get_sidebar(); ?>
		</div> <!-- .main-content-wrap -->

		<?php get_template_part( 'includes/footer-banner', 'page' ); ?>
	</div> <!-- #main-content -->

<?php get_footer(); ?>