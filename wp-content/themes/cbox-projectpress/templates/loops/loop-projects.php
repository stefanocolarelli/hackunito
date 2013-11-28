<?php
/**
 * Infinity Theme: loop projects template
 * 
 * The loop that displays posts
 * 
 * @author Fabrizio Zaccaron <bowe@presscrew.com> e Stefano Colarelli <>
 * @link http://infinity.presscrew.com/
 * @copyright Copyright (C) 2010-2011 Bowe Frankema
 * @license http://www.gnu.org/licenses/gpl.html GPLv2 or later
 * @package Infinity
 * @subpackage templates
 * @since 1.0
 */
$temp = $wp_query;
$wp_query= null;
//$wp_query = new WP_Query();
$args = array(
	'post_type' => 'project',
	'posts_per_page' => 8,
	'paged' => $paged,
);
$wp_query = new WP_Query( $args );
//$wp_query->query('posts_per_page=8'.'&paged='.$paged);
while ($wp_query->have_posts()) : $wp_query->the_post();
	// group variables 
	$group_id = get_post_custom_values('_group_node');
	$g_id = $group_id[0];
	$group = groups_get_group( array( 'group_id' => $g_id ) );
?>
		<!-- post -->
		<article class="post" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php
				do_action( 'open_loop_post' );
			?>
			<!-- post-content -->
			<div class="post-content">
			<div id="project-taxonomies" >
							<?php
							if(get_the_terms($post->ID, 'area-of-interest')){
							the_terms( $post->ID, 'area-of-interest','',', ');
								}else{ _e("Nothing [TODO]", "infinity_text_domain"); }
							?>
						</div>
				<!-- post title -->
				<h2 class="post-title">
					<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e( 'Permanent Link to', 'infinity_text_domain'); ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
					<?php edit_post_link(' ✍','',' ');?>
				</h2>
				<!-- show the avatar? -->
				<div class="entry">
				<?php
				infinity_get_template_part( 'templates/parts/post-thumbnail');	
				?>	
				</div>				
				<div>
				<?php
					/* project description */
					the_excerpt();
				?>
				</div>
				
				<?php
				/* groups and project share the same name */
				/* if a group can have more than one project you want to show also the group name */
					// echo '<h3>';
					//$g_name = $group -> name;
					//echo $g_name;
					// echo '</h3>';
				/* group description */
					//$g_description = $group -> description;
					//echo $g_description;
				?>
				
				
				
				
				<div>
					<h5><?php _e('Proposer','infinity_text_domain'); ?></h5>
				<?php
					$g_admins = $group -> admins; // Proposer - only the first
					if(!empty($g_admins)) {
							$a_name = $g_admins[0] -> user_login;
							$a_id = $g_admins[0]->user_id;
							echo bp_core_fetch_avatar (array('item_id' => $a_id, 'width' => 35));
							echo $a_name;
					}
				?>
				</div>
					<span class="idea-comments">
		<?php _e('Comments','infinity_text_domain'); ?>
		<?php
			comments_popup_link(
				__( '0', 'infinity_text_domain' ),
				__( '1', 'infinity_text_domain' ),
				__( '%', 'infinity_text_domain' )
			);
		?>
	</span>
					<span class="project-meta"><?php _e('Followers: ','infinity_text_domain'); ?>
						<span class="group-couter"><?php echo $group -> total_member_count; ?> </span>
					</span>
				
				
				<?php
					$g_mods = $group -> mods; // ARRAY degli amministratori
					if(!empty($g_mods)) { ?>
						<div>
							<h5><?php _e('Controbutors','infinity_text_domain'); ?></h5>
								<ul>
								<?php
								foreach ($g_mods as $mod){
									echo '<li>';
									$m_name = $mod -> user_login;
									$m_id = $mod->user_id;
									echo bp_core_fetch_avatar (array('item_id' => $m_id, 'width' => 35));
									echo $m_name;
									echo '</li>';
								} ?>
								</ul>
						</div>
						<?php
					}
				?>
				<?php
					do_action( 'open_loop_post_content' );
				?>
				<?php
				/* #riqua aggiungere componenti dichiarate sopra, se necessario infinity_get_template_part( 'templates/parts/post-meta-top');	*/
				?>				
				<?php
				do_action( 'before_post_thumb' );
				?>
				<?php
					/* infinity_get_template_part( 'templates/parts/post-meta-bottom');	*/
					
				?>
				<div id="project-need">
							<h5><?php /* #riqua or Open position */ _e("Job - Skills required", "infinity_text_domain"); ?></h5>
							<ul><li>
							<?php
							if(get_the_terms($post->ID, 'need')){
							the_terms( $post->ID, 'need','','</li><li>');
								}else{ _e("Team completed [TODO]", "infinity_text_domain"); }
							?>
							</li></ul>
						</div>
				<?php
					do_action( 'close_loop_post_content' );
				?>
			</div><!-- post-content -->
			<?php
				do_action( 'close_loop_post' );
			?>
		</article><!-- post -->
	<?php
		do_action( 'close_loop' );
		endwhile;
   		infinity_base_paginate();
		$wp_query = null; $wp_query = $temp;
?>