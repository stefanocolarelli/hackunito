<?php
/**
 * Register New Sidebar
 */
function cbox_register_project_sidebar()
{
    register_sidebar(array(
        'name' => 'Project sidebar',
        'id' => 'project-sidebar',
        'description' => "The Project widget area",
        'before_widget' => '<article id="%1$s" class="widget %2$s">',
        'after_widget' => '</article>',
        'before_title' => '<h4>',
        'after_title' => '</h4>'
    ));
}
add_action( 'widgets_init', 'cbox_register_project_sidebar' );

function project_sidebar(){
return cbox_alt_sidebar();
}

// Alt Sidebar
function cbox_alt_sidebar() { { 
	if ( 'project' == get_post_type() ): ?>
		<aside id="sidebar-alt">  
		    <?php
		        if ( is_active_sidebar( 'project-sidebar' ) ) {
		        dynamic_sidebar( 'project-sidebar');
		    } else { ?>
		        <div class="widget"><h4>Alternative Sidebar.</h4>
		        <a href="<?php echo home_url( '/'  ); ?>wp-admin/widgets.php" title="Add Widgets">Add Widgets</a></div><?php
		    }
		    ?>
		</aside>  
	<?php endif; }} 
?>