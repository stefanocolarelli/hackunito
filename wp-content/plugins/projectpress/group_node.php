<?php
function groupnode_init() {
	  $labels_aggregation = array(
    'name' => _x( 'Aggregation', 'taxonomy general name' ),
    'singular_name' => _x( 'Aggregation', 'taxonomy singular name' ),
    'menu_name' => __( 'Aggregation' ),
  ); 
  register_taxonomy('aggregation',array('places'), array(
    'hierarchical' => true,
    'labels' => $labels_aggregation,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'groupnode' ),
	'show_admin_column' => true,
  ));
  
 // qui finisce la parte della tax e inizia il post_type. Se hai bisogno solo del primo, cancella tutto questo  
    $args = array(
        'public' => true,
        'query_var' => 'groupnode',
        'rewrite' => array(
            'slug' => 'groupnode',
            'with_front' => false
        ),
        'supports' => array(
            'title',
            'editor',
            'author',
            'thumbnail',
            'revisions'
        ),
        'labels' => array(
            'name' => 'Groupnode',
            'singular_name' => 'Groupnode',
        ),
    );
    register_post_type( 'groupnode', $args );
// fine post_type
}
add_action( 'init', 'groupnode_init' );

?>