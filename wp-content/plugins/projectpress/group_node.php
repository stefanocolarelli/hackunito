<?php
function project_init() {
$labels_need = array(
    'name' => _x( 'Need', 'taxonomy general name' ),
    'singular_name' => _x( 'Need', 'taxonomy singular name' ),
    'menu_name' => __( 'Need' ),
  ); 
  register_taxonomy('need',array('project'), array(
    'labels' => $labels_need,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'need' ),
	'show_admin_column' => true,
  ));

 $labels_area_of_interest = array(
    'name' => _x( 'Area of Interest', 'taxonomy general name' ),
    'singular_name' => _x( 'Area of Interest', 'taxonomy singular name' ),
    'menu_name' => __( 'Area of Interest' ),
  ); 
  register_taxonomy('area-of-interest',array('project'), array(
    'labels' => $labels_area_of_interest,
	'hierarchical' => true,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'area-of-interest' ),
	'show_admin_column' => true,
  )); 
  
 // qui finisce la parte della tax e inizia il post_type. Se hai bisogno solo del primo, cancella tutto questo  
    $args = array(
        'public' => true,
        'query_var' => 'project',
        'rewrite' => array(
            'slug' => 'project',
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
            'name' => 'Project',
            'singular_name' => 'Project',
        ),
    );
    register_post_type( 'project', $args );
// fine post_type
}
add_action( 'init', 'project_init' );

?>