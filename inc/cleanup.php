<?php

/*--------------------------------------------------------------
# Load jquery from CDN
--------------------------------------------------------------*/
function latest_jquery() {
	if (!is_admin() && $GLOBALS['pagenow'] != 'wp-login.php') {
		wp_deregister_script('jquery');
		wp_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js', array(), null);
	}
}
add_action( 'wp_enqueue_scripts', 'latest_jquery', 10 );


/*--------------------------------------------------------------
# Remove wp-embed
--------------------------------------------------------------*/
function strt_deregister_scripts(){
	wp_deregister_script( 'wp-embed' );
}
add_action( 'wp_footer', 'strt_deregister_scripts' );


/*--------------------------------------------------------------
# Remove Menu classes (but allow specific classes)
--------------------------------------------------------------*/
function strt_css_attributes_filter($var) {
	return is_array($var) ? array_intersect($var, array(
		'current_page_item',
		'current-menu-item',
		'current_page_ancestor',
		'current-menu-ancestor',
		'menu-item',
		'menu-item-has-children',
		'page_item',
		'page_item_has_children'
	)) : '';
}
add_filter('nav_menu_css_class', 'strt_css_attributes_filter', 100, 1);
add_filter('nav_menu_item_id', 'strt_css_attributes_filter', 100, 1);
add_filter('page_css_class', 'strt_css_attributes_filter', 100, 1);


/*--------------------------------------------------------------
# Clean up head
--------------------------------------------------------------*/
function strt_cleanup_head() {
 	// Remove comments feed
 	add_filter( 'feed_links_show_comments_feed', function() { return false; });
	// Remove all extra feeds 
	remove_action('wp_head','feed_links_extra', 3);
 	// Remove Emoji detection script.
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	// Remove Emoji styles.
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	// Remove WP version.
	remove_action( 'wp_head', 'wp_generator' );
	// Remove the REST API lines
	remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
	// Remove the Oembed lines
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
	// Remove EditURI link.
	remove_action( 'wp_head', 'rsd_link' );
	// Remove Windows Live Writer.
	remove_action( 'wp_head', 'wlwmanifest_link' );
}
add_action( 'init', 'strt_cleanup_head' );
