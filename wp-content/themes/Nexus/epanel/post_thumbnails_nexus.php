<?php
add_theme_support( 'post-thumbnails' );

global $et_theme_image_sizes;

$et_theme_image_sizes = array(
	'578x420' => 'et-featured-first',
	'578x208' => 'et-featured-second',
	'578x280' => 'et-featured-category',
	'287x208' => 'et-featured-third',
	'160x160' => 'et-recent-post-image',
	'319x160' => 'et-popular-post-image',
	'639x160' => 'et-popular-post-big-image',
	'240x240' => 'et-category-image',
	'321x214' => 'et-recent-first-image',
	'60x60'   => 'et-tabs-image-small',
);

$et_page_templates_image_sizes = array(
	'184x184' 	=> 'et-blog-page-thumb',
	'207x136' 	=> 'et-gallery-page-thumb',
	'260x170' 	=> 'et-portfolio-medium-page-thumb',
	'260x315' 	=> 'et-portfolio-medium-portrait-page-thumb',
	'140x94' 	=> 'et-portfolio-small-page-thumb',
	'140x170' 	=> 'et-portfolio-small-portrait-page-thumb',
	'430x283' 	=> 'et-portfolio-large-page-thumb',
	'430x860' 	=> 'et-portfolio-large-portrait-page-thumb',
);

$et_theme_image_sizes = array_merge( $et_theme_image_sizes, $et_page_templates_image_sizes );

$et_theme_image_sizes = apply_filters( 'et_theme_image_sizes', $et_theme_image_sizes );
$crop = apply_filters( 'et_post_thumbnails_crop', true );

if ( is_array( $et_theme_image_sizes ) ){
	foreach ( $et_theme_image_sizes as $image_size_dimensions => $image_size_name ){
		$dimensions = explode( 'x', $image_size_dimensions );

		if ( in_array( $image_size_name, array( 'et-home-product-thumb', 'et-index-product-thumb', 'et-single-product-thumb' ) ) )
			$crop = false;

		add_image_size( $image_size_name, $dimensions[0], $dimensions[1], $crop );

		$crop = apply_filters( 'et_post_thumbnails_crop', true );
	}
}