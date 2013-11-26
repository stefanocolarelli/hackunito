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

// mettere controllo con abspath or die
// Togliere la possibilità di cancellare gruppi, cambiare admin di un gruppo, etc
// CHECH ON http://127.0.0.1/wp-commons/groups/create/step/group-settings/
 
/* Se troviamo codice alternativo a Bp, possiamo metterlo qui sotto */

/*

/*******************
This function handles the mood and listening_to meta tags.
It can be called with an action of update, delete, and get (default)
When called with an action of update, either $mood or $listening_to must be provided.
i.e. mood_music( $post->ID, 'update', 'Happy', 'Bon Jovi - It's My Life' );
function mood_music( $post_id, $action = 'get', $mood = 0, $listening_to = 0 ) {
  
  //Let's make a switch to handle the three cases of 'Action'
  switch ($action) {
    case 'update' :
      if( ! $mood && ! $listening_to )
        //If nothing is given to update, end here
        return false;
      
      //add_post_meta usage:
      //add_post_meta( $post_id, $meta_key, $meta_value, $unique = false )
      
      //If the $mood variable is supplied,
      //add a new key named 'mood', containing that value.
      //If the 'mood' key already exists on this post,
      //this command will simply add another one.
      if( $mood ) {
        add_post_meta( $post_id, 'mood', $mood );
        return true;
        }
      //update_post_meta usage:
      //update_post_meta( $post_id, $meta_key, $meta_value )
      
      //If the $listening_to variable is supplied,
      //add a new key named 'listening_to', containing that value.
      //If the 'listening_to' key already exists on this post,
      //this command will update it to the new value
      if( $listening_to ) {
        add_post_meta( $post_id, 'listening_to', $listening_to, true ) or
          update_post_meta( $post_id, 'listening_to', $listening_to );
        return true;
      }
    case 'delete' :
      //delete_post_meta usage:
      //delete_post_meta( $post_id, $meta_key, $prev_value = ' ' )
    
      //This will delete all instances of the following keys from the given post
      delete_post_meta( $post_id, 'mood' );
      delete_post_meta( $post_id, 'listening_to' );
      
      //To only delete 'mood' if it's value is 'sad':
      //delete_post_meta( $post_id, 'mood', 'sad' );
    break;
    case 'get' :
      //get_post_custom usage:
      //get_post_meta( $post_id, $meta_key, $single value = false )
  
      //$stored_moods will be an array containing all values of the meta key 'mood'
      $stored_moods = get_post_meta( $post_id, 'mood' );
      //$stored_listening_to will be the first value of the key 'listening_to'
      $stored_listening_to = get_post_meta( $post_id, 'listening_to', 'true' );

      //Now we need a nice ouput format, so that
      //the user can implement it how he/she wants:
      //ie. echo mood_music( $post->ID, 'get' );
      
      $return = '<div class='mood-music'>';
      if ( ! empty( $stored_moods ) )
        $return .= '<strong>Current Mood</strong>: ';
      foreach( $stored_moods as $mood )
        $return .= $mood . ', ';
      $return .= '<br/>';

      if ( ! empty( $stored_listening_to ) ) {
        $return .= '<strong>Currently Listening To</strong>: ';
        $return .= $stored_listening_to;
        }
      $return .= '</div>';
      
      return $return;
    default :
      return false;
    break;
  } //end switch
} //end function
*/

?>