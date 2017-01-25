<?php
/*--------------------------------------------------------------
# Theme setup
--------------------------------------------------------------*/
if ( ! function_exists( 'strt_setup' ) ) :
function strt_setup() {
	load_theme_textdomain( 'strt', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'strt' ),
	) );
	add_theme_support( 'post-formats', array(
		'gallery',
		'image',
		'video',
	) );
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'strt_setup' );


/*--------------------------------------------------------------
# Content width
--------------------------------------------------------------*/
function strt_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'strt_content_width', 1160 );
}
add_action( 'after_setup_theme', 'strt_content_width', 0 );


/*--------------------------------------------------------------
# Widgets
--------------------------------------------------------------*/
function strt_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Page Sidebar', 'strt' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Blog Sidebar', 'strt' ),
		'id'            => 'sidebar-2',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 1', 'strt' ),
		'id'            => 'footer-1',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 2', 'strt' ),
		'id'            => 'footer-2',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer 3', 'strt' ),
		'id'            => 'footer-3',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
	) );
}
add_action( 'widgets_init', 'strt_widgets_init' );


/*--------------------------------------------------------------
# Enqueue JS + CSS
--------------------------------------------------------------*/
function strt_scripts() {
	wp_enqueue_style( 'strt-style', get_template_directory_uri() . '/stylesheets/style.css', array(), null );
	wp_enqueue_script( 'strt-navigation', get_template_directory_uri() . '/js/strt-scripts.js', array('jquery'), null, true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'strt_scripts' );


/*--------------------------------------------------------------
# Add Inline CSS to wp_head
--------------------------------------------------------------*/
function strt_inline_css() {
	$css = file_get_contents( get_template_directory() . '/stylesheets/style.css');
	// Remove UTF-8 Bom
    $bom = pack('H*','EFBBBF');
    $css = preg_replace("/^$bom/", '', $css);
	echo '<style>' . $css . '</style>';
}
// add_action( 'wp_head', 'strt_inline_css', 9999 );


/*--------------------------------------------------------------
# Includes
--------------------------------------------------------------*/
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/extras.php';
require get_template_directory() . '/inc/cleanup.php';
require get_template_directory() . '/inc/acf-options.php';
require get_template_directory() . '/inc/acf-layouts.php';
require get_template_directory() . '/inc/icon-functions.php';
require get_template_directory() . '/inc/social-widget.php';


/*--------------------------------------------------------------
# Add WP Admin style
--------------------------------------------------------------*/
function strt_admin_style() {
	wp_enqueue_style('admin-styles', get_template_directory_uri().'/stylesheets/admin-style.css');
}
add_action('admin_enqueue_scripts', 'strt_admin_style');


/*--------------------------------------------------------------
# Add WP Editor style
--------------------------------------------------------------*/
function strt_editor_styles() {
    add_editor_style( 'stylesheets/editor-style.css' );
}
add_action( 'admin_init', 'strt_editor_styles' );


/*--------------------------------------------------------------
# Image sizes
--------------------------------------------------------------*/
// Remove 'medium_large' size to save disk space. Dont remove other default sizes.
function strt_remove_default_image_sizes( $sizes) {
	unset( $sizes['medium_large']);
	return $sizes;
}
add_filter('intermediate_image_sizes_advanced', 'strt_remove_default_image_sizes');

// Add custom sizes
add_image_size( 'post_grid', 360, 240, true );
add_image_size( 'post_grid_large', 540, 360, true );
add_image_size( 'post_header', 760, 326, true );
add_image_size( 'post_header_large', 1160, 497, true ); 

// Make custom sizes selectable in Admin
function strt_sizes( $sizes ) {
	return array_merge( $sizes, array(
		'post-header' => __( 'Post Header' , 'strt' ),
		'post-header-large' => __( 'Post Header Large' , 'strt' ),
	));
}
add_filter( 'image_size_names_choose', 'strt_sizes' );


/*--------------------------------------------------------------
# Custom Excerpt Length
--------------------------------------------------------------*/
function strt_excerpt_length( $length ) {
    return 40;
}
add_filter( 'excerpt_length', 'strt_excerpt_length', 999 );


/*--------------------------------------------------------------
# Custom Excerpt "read more" string
--------------------------------------------------------------*/
function strt_excerpt_more( $more ) {
	return sprintf( '... <a class="read-more" href="%1$s">%2$s</a>',
		get_permalink( get_the_ID() ), __( 'Read More', 'strt' )
	);
}
add_filter( 'excerpt_more', 'strt_excerpt_more' );


/*--------------------------------------------------------------
# Prevent page scroll when clicking the More link
--------------------------------------------------------------*/
function remove_more_link_scroll( $link ) {
	$link = preg_replace( '|#more-[0-9]+|', '', $link );
	return $link;
}
add_filter( 'the_content_more_link', 'remove_more_link_scroll' );


/*--------------------------------------------------------------
# Custom login logo
--------------------------------------------------------------*/
function strt_login_logo() {
	echo '<style type="text/css">h1 a { 
		background-image: url('.get_template_directory_uri().'/img/starter-logo@2x.png)!important; 
		background-size: 320px!important; 
		height: 80px!important; 
		width: 320px!important;
	}</style>';
}
add_action('login_head', 'strt_login_logo');


/*--------------------------------------------------------------
# Add wrapper to embeds to make them responsive
--------------------------------------------------------------*/
function strt_oembed_html($cache, $url, $attr, $post_id) {
    if (strpos($cache, 'youtube') || strpos($cache, 'vimeo') !== false) {
        return '<div class="embed-responsive">' . $cache . '</div>';
    } else {
	    return $cache;
    }
}
add_filter('embed_oembed_html', 'strt_oembed_html', 99, 4);


/*--------------------------------------------------------------
# Add link protocols for Social Menu
--------------------------------------------------------------*/
function strt_allow_protocol( $protocols ){
    $protocols[] = 'skype';
    return $protocols;
}
add_filter( 'kses_allowed_protocols' , 'strt_allow_protocol' );


/*--------------------------------------------------------------
# Remove Gallery Inline Styling
--------------------------------------------------------------*/
add_filter( 'use_default_gallery_style', '__return_false' );


/*--------------------------------------------------------------
# Remove paragraph tags from images in WP and ACF
--------------------------------------------------------------*/
function filter_ptags_on_images($content) {
    $content = preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
    return preg_replace('/<p>\s*(<iframe .*>*.<\/iframe>)\s*<\/p>/iU', '\1', $content);
}
add_filter('acf_the_content', 'filter_ptags_on_images', 9999);
add_filter('the_content', 'filter_ptags_on_images', 9999);


/*--------------------------------------------------------------
# Enable WP link manager
--------------------------------------------------------------*/
// add_filter('pre_option_link_manager_enabled', '__return_true');


/*--------------------------------------------------------------
# Add descriptions to menu items
--------------------------------------------------------------*/
function strt_nav_description( $item_output, $item, $depth, $args ) {
    if ( $item->description ) {
        $item_output = str_replace( $args->link_after . '</a>', '<div class="menu-item-description">' . $item->description . '</div>' . $args->link_after . '</a>', $item_output );
    }
    return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'strt_nav_description', 10, 4 );


/*--------------------------------------------------------------
# Button shortcode
--------------------------------------------------------------*/
function strt_button_shortcode( $atts ) {
	extract( shortcode_atts(
		array(
			'text' => 'button text',
			'link' => '#',
			'align' => '',
			'class' => '',
		), $atts )
	);
	return '<div class="btn_container ' . $align . '"><a href="' . $link . '" class="button ' . $class . '">' . $text . '</a></div>';
}
add_shortcode( 'button', 'strt_button_shortcode' );


/*--------------------------------------------------------------
# Remove Gravity Forms 'Add Form' button
--------------------------------------------------------------*/
add_filter( 'gform_display_add_form_button', '__return_false');


/*--------------------------------------------------------------
# Enable 'Hide labels' option in Gravity Forms
--------------------------------------------------------------*/
add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );


/*--------------------------------------------------------------
# Add all Gravity Forms capabilities to Editor role
--------------------------------------------------------------*/
function grant_gforms_editor_access() {
	$role = get_role( 'editor' );
	$role->add_cap( 'gform_full_access' );
}
// add_action( 'after_switch_theme', 'grant_gforms_editor_access' );

function revoke_gforms_editor_access() {
	$role = get_role( 'editor' );
	$role->remove_cap( 'gform_full_access' );
}
// add_action( 'switch_theme', 'revoke_gforms_editor_access' );


/*--------------------------------------------------------------
# Remove admin menu items
--------------------------------------------------------------*/
if( !current_user_can('administrator') ) {
	function remove_menus(){
		remove_menu_page( 'edit-comments.php' );          //Comments
		remove_menu_page( 'tools.php' );                  //Tools
	}
	add_action( 'admin_menu', 'remove_menus' );
}
