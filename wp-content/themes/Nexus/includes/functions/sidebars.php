<?php
function et_widgets_init() {
	register_sidebar( array(
		'name' => 'Sidebar',
		'id' => 'sidebar-1',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div> <!-- end .widget -->',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	) );

	register_sidebar( array(
		'name' => 'Homepage Sidebar ( middle column )',
		'id' => 'sidebar-additional',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div> <!-- end .widget -->',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	) );

	register_sidebar( array(
		'name' => 'Footer Area #1',
		'id' => 'sidebar-2',
		'before_widget' => '<div id="%1$s" class="fwidget %2$s">',
		'after_widget' => '</div> <!-- end .fwidget -->',
		'before_title' => '<h4 class="title">',
		'after_title' => '</h4>',
	) );

	register_sidebar( array(
		'name' => 'Footer Area #2',
		'id' => 'sidebar-3',
		'before_widget' => '<div id="%1$s" class="fwidget %2$s">',
		'after_widget' => '</div> <!-- end .fwidget -->',
		'before_title' => '<h4 class="title">',
		'after_title' => '</h4>',
	) );

	register_sidebar( array(
		'name' => 'Footer Area #3',
		'id' => 'sidebar-4',
		'before_widget' => '<div id="%1$s" class="fwidget %2$s">',
		'after_widget' => '</div> <!-- end .fwidget -->',
		'before_title' => '<h4 class="title">',
		'after_title' => '</h4>',
	) );

	register_sidebar( array(
		'name' => 'Footer Area #4',
		'id' => 'sidebar-5',
		'before_widget' => '<div id="%1$s" class="fwidget %2$s">',
		'after_widget' => '</div> <!-- end .fwidget -->',
		'before_title' => '<h4 class="title">',
		'after_title' => '</h4>',
	) );
}
add_action( 'widgets_init', 'et_widgets_init' );