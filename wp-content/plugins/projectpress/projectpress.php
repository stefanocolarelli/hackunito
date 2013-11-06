<?php /*
Plugin Name: ProjectPress
Plugin URI: http://github etc etc
Description: Transform Buddypress in Project Repositary website 
Version: 0.1
Requires at least: WordPress 3.6 / BuddyPress 1.8
License: GNU/GPL 2
Author: Stefano Colarelli, #hackUniTO team
Author URI: http://hackunito.it
*/
 
/* Load condizionale a bp */
function projectpress_init() {
	require( dirname( __FILE__ ) . '/loader.php' );
	require( dirname( __FILE__ ) . '/group_node.php' );
	}
add_action( 'bp_include', 'projectpress_init' );
 
/* Se troviamo codice alternativo a Bp, possiamo metterlo qui sotto */

?>