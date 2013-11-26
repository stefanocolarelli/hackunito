<?php
/**
 * Infinity Theme: loop single template
 *
 * The loop that displays single posts
 * 
 * @author Bowe Frankema <bowe@presscrew.com>
 * @link http://infinity.presscrew.com/
 * @copyright Copyright (C) 2010-2011 Bowe Frankema
 * @license http://www.gnu.org/licenses/gpl.html GPLv2 or later
 * @package Infinity
 * @subpackage templates
 * @since 1.0
 */

	if ( have_posts()):
		while ( have_posts() ):
			the_post();
			do_action( 'open_loop' );
?>
			<!-- the post -->
			<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
				<div class="post-content">
					<?php
					do_action( 'open_loop_single' );
					?>
					<!-- show the post thumb? -->
					<?php
					infinity_get_template_part( 'templates/parts/post-thumbnail');	
					?>			
					<h1 class="post-title">
						<?php the_title(); ?>
						<?php edit_post_link(' ✍','',' ');?>
					</h1>	
					<?php
					infinity_get_template_part( 'templates/parts/post-meta-top');	
					?>
					<?php
					$group_id = get_post_custom_values('_group_node');
					$g_id = $group_id[0];
					$group = groups_get_group( array( 'group_id' => $g_id ) );
					$n_members = $group -> total_member_count;
					$last_activity = $group -> last_activity;
					$g_description = $group -> description;
					?>
					<div>
						<p>Aggiornato al</p>
						<p><?php echo substr($last_activity, 0, -8); ?></p>
					</div>
					<?php bp_group_join_button(); ?>
					<div>
						<p>Utenti interessati: <?php echo $n_members; ?></p>
					</div>							
					<?php
						do_action( 'before_single_entry' )
					?>
					<div class="entry">
						<p><?php 
							$p_idea_progetto_group_extension_setting = groups_get_groupmeta( $g_id, $meta_key = 'idea_progetto_group_extension_setting');
							$p_idea_progetto_group_extension_setting2 = groups_get_groupmeta( $g_id, $meta_key = 'idea_progetto_group_extension_setting2');
							$p_impatto_progetto_group_extension_setting = groups_get_groupmeta( $g_id, $meta_key ='impatto_progetto_group_extension_setting');
						echo $g_description;
						 ?></p> 
					   	<div>Groupmeta:
					   	<ul>
					   	<li><?php echo $p_idea_progetto_group_extension_setting;?></li>
					   	<li><?php echo $p_idea_progetto_group_extension_setting2;?></li>
					   	<li><?php echo $p_impatto_progetto_group_extension_setting;?></li>
					   	</ul>
					   	</div>
						<?php
							do_action( 'open_single_entry' );
							// the_content( __( 'Read the rest of this entry &rarr;', infinity_text_domain ) );
							the_terms( $post->ID, 'area-of-interest');
					   	?>
						<div style="clear: both;"></div>
						<!-- SIDEBAR -->
						<h2>SIDEBAR</h2>
						<div>Proponenti:
						<ul>
						<?php 
							$g_admins = $group -> admins;
							foreach($g_admins as $admin){
								$a_id = $admin -> user_id;
								echo '<li>'.get_avatar($a_id, 35);
								echo $admin -> user_login.'</li>';
							}
							$g_mods = $group -> mods;
							foreach($g_mods as $mod){
								$m_id = $mod -> user_id;
								echo '<li>'.get_avatar($m_id, 35);
								echo $mod -> user_login.'</li>';
							}
							//var_dump($group);
						?>
						</ul></div>
						<?php
							wp_link_pages( array(
								'before' => __( '<p><strong>Pages:</strong> ', infinity_text_domain ),
								'after' => '</p>', 'next_or_number' => 'number')
							);
							do_action( 'close_single_entry' );
						?>
					</div>
					<?php 
						do_action('after_single_entry');
					?>
					<?php
						infinity_get_template_part('templates/parts/post-meta-bottom'); 
						infinity_get_template_part( 'templates/parts/author-box');	
					?>
				</div>
				<?php
					do_action( 'close_loop_single' );
				?>
			</div>
<?php
			comments_template('', true);
			do_action( 'close_loop' );
		endwhile;
	else: ?>
		<h1>
			<?php _e( 'Sorry, no posts matched your criteria.', infinity_text_domain ) ?>
		</h1>
<?php
		do_action( 'loop_not_found' );
	endif;
?>