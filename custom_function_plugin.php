<?php
/**
* Plugin Name: Custom Function Plugin		 + * old version
* Plugin URI: https://thecustomizewindows.com/2015/05/create-wordpress-plugin-to-avoid-snippets-on-themes-functions-php/		 + * kept for referance purpose
* Description: Custom plugin to add snippets.		
* Author: Abhishek Ghosh		
* Author URI: https://thecustomizewindows.com		
* Version: 1.0		
*/		
 
// remove post image links		  
// https://thecustomizewindows.com/2014/10/remove-wordpress-post-image-link-image-link-404-fix/
function k99_image_link_void( $content ) {
    $content =
        preg_replace(
            array('{<a(.*?)(wp-att|wp-content\/uploads)[^>]*><img}',
                '{ wp-image-[0-9]*" /></a>}'),
            array('<img','" />'),
            $content
        );
    return $content;
}
add_filter( 'the_content', 'k99_image_link_void' );
// remove image ?
function rkv_imagelink_setup() {
	$image_set = get_option( 'image_default_link_type' );
	
	if ($image_set !== 'none') {
		update_option('image_default_link_type', 'none');
	}
}
add_action('admin_init', 'rkv_imagelink_setup', 10);
// remove extra header stuffs (head cleaner!)
// https://thecustomizewindows.com/2015/02/remove-junks-from-wordpress-header/
remove_action('wp_head', 'rsd_link'); 
remove_action('wp_head', 'wp_generator'); 
remove_action('wp_head', 'feed_links', 2); 
remove_action('wp_head', 'feed_links_extra', 3); 
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');
// remove p around image
// https://thecustomizewindows.com/2015/05/remove-p-wrap-around-post-images-in-wordpress-genesis/
function filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}
add_filter('the_content', 'filter_ptags_on_images'); 
// remove emoji loading in wp 4.2+
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' ); // php is not closed in the last line
