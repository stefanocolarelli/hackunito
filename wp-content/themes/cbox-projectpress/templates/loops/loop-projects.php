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
?>
		<!-- post -->
		<article class="post" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php
				do_action( 'open_loop_post' );
			?>
			<!-- post-content -->
			<div class="post-content">
				<!-- post title -->
				<h2 class="post-title">
					<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e( 'Permanent Link to', infinity_text_domain ) ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
					<?php edit_post_link(' ✍','',' ');?>
				</h2>
				
				<h1>
				<?php
					$group_id = get_post_custom_values('_group_node');
					$g_id = $group_id[0];
					$group = groups_get_group( array( 'group_id' => $g_id ) );
					$g_name = $group -> name;
					echo $g_name;
				?>
				</h1>
				
				<h1>
				<?php
					$g_description = $group -> description;
					echo $g_description;
				?>
				</h1>
				
				<h1>
				<?php
					$g_admins = $group -> admins; // ARRAY degli amministratori
					foreach ($g_admins as $admin){
						$a_name = $admin -> user_nicename;
					    echo $a_name;
					    }
				?>
				</h1>
				
				<div> Membri del gruppo:<br/>
				<?php
				$members = groups_get_group_members( $g_id, false,false,false);
					foreach ($members as $member){
						foreach ($member as $m){
							$name = $m->display_name;
							$id = $m->ID;
							echo $name;
							echo bp_core_fetch_avatar (array('item_id' => $id, 'type' => 'full')).'<br/>';
							}	
					    }
				?>
				</div>
				
				
				<?php
					do_action( 'open_loop_post_content' );
				?>
				<?php
				infinity_get_template_part( 'templates/parts/post-meta-top');	
				?>				
				<?php
				do_action( 'before_post_thumb' );
				?>
				<!-- show the avatar? -->
				<div class="entry">
				<?php
				infinity_get_template_part( 'templates/parts/post-thumbnail');	
				?>	
					<div class="post-author-box">
						<?php
							echo get_avatar( get_the_author_meta( 'user_email' ), '100' );
						?>
					</div>
					<?php
						do_action( 'before_loop_content' );
						the_excerpt( __( 'Read More', infinity_text_domain ) );
						do_action( 'after_loop_content' );
					?>
				</div>
				<?php
					infinity_get_template_part( 'templates/parts/post-meta-bottom');	
				?>
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