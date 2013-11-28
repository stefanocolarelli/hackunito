<?php
/**
 * Infinity Theme: Post Meta Top Template
 *
 * @author Bowe Frankema <bowe@presscrew.com>
 * @link http://infinity.presscrew.com/
 * @copyright Copyright (C) 2010-2011 Bowe Frankema
 * @license http://www.gnu.org/licenses/gpl.html GPLv2 or later
 * @package Infinity
 * @subpackage templates
 * @since 1.0
 *
 * This template display the post meta date attached to a post. You can hook into this section 
 * to add your own stuff as well!
 */
?>
<div class="post-meta-data post-top">
<?php
	do_action( 'open_loop_post_meta_data_top' );
		
					$group_id = get_post_custom_values('_group_node');					
					$g_id = $group_id[0];
					$group = groups_get_group( array( 'group_id' => $g_id ) );
					$n_members = $group -> total_member_count;
					$last_activity = $group -> last_activity;
					$g_description = $group -> description;
					?>
					<span class="project-meta"><?php _e('Last update: ','infinity_text_domain'); ?>
						<span class="group-couter"><?php 
							$last_activity = $group -> last_activity; 
							$newDate = date(__('H:i d/m/Y','infinity_text_domain'), strtotime($last_activity));
							echo $newDate;
						?> </span>
					</span>
					<!-- <?php bp_group_join_button(); ?> -->
					<div>
						<p>Utenti interessati: <?php echo $n_members; ?></p>
					</div>		
<?php
	do_action( 'close_loop_post_meta_data_top' );
?>
</div>