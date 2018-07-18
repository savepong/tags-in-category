<?php
/**
 * @package Tags in Category
 */
/*
Plugin Name: Tags in Category
Plugin URI: https://github.com/savepong/tags-in-category
Description: Show categories child of parent category
Version: 1.0
Author: Pongsiri Chuaychoonoo
Author URI: https://savepong.com
*/

add_shortcode('tags-in-category', 'tags_in_category');

function tags_in_category($atts = []) {
	// normalize attribute keys, lowercase
    $atts = array_change_key_case((array)$atts, CASE_LOWER);
	
	$parent_category = get_term_by( 'slug', $atts['category'], 'product_cat' );
	$taxonomy     = 'product_cat';

	$categories	= get_categories( array(
		'taxonomy'     => $taxonomy,
        'orderby' 	=> 'name',
        'order'		=> 'ASC',
        'parent'  	=> $parent_category->term_id
    ));
	
	echo '<div class="seed-grid-4 seed-grid-mobile-2 text-center panel-widget-style"><h3 class="widget-title">'. $parent_category->name .'</h3>';
	
	foreach ( $categories as $category ) {
		printf( '<a href="%1$s" style="border:1px solid #163D4F;border-radius: 5px;padding:5px;margin-right:3px;">%2$s</a> ',
			esc_url( get_category_link( $category->term_id ) ),
			esc_html( $category->name )
		);
	}
	
	echo '</div>';

}

