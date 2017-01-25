<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Starter
 */

/*--------------------------------------------------------------
# Posted on
--------------------------------------------------------------*/
if ( ! function_exists( 'strt_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function strt_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( 'Posted on %s', 'post date', 'strt' ),
		$time_string
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'strt' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

/*--------------------------------------------------------------
# Entry footer
--------------------------------------------------------------*/
if ( ! function_exists( 'strt_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function strt_entry_footer() {
	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">' . strt_get_svg( array( 'icon' => 'comment' ) );
		/* translators: %s: post title */
		comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'strt' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
		echo '</span>';
	}

	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'strt' ) );
		if ( $categories_list && strt_categorized_blog() ) {
			printf( '<span class="cat-links">' . strt_get_svg( array( 'icon' => 'folder-open' ) ) . esc_html__( 'Posted in %1$s', 'strt' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'strt' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . strt_get_svg( array( 'icon' => 'tags' ) ) . esc_html__( 'Tagged %1$s', 'strt' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'strt' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">' . strt_get_svg( array( 'icon' => 'edit' ) ),
		'</span>'
	);
}
endif;

/*--------------------------------------------------------------
# Returns true if a blog has more than 1 category.
--------------------------------------------------------------*/
function strt_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'strt_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'strt_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so strt_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so strt_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in strt_categorized_blog.
 */
function strt_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'strt_categories' );
}
add_action( 'edit_category', 'strt_category_transient_flusher' );
add_action( 'save_post',     'strt_category_transient_flusher' );


/*--------------------------------------------------------------
# Display navigation to next/previous image in attachment pages  https://github.com/mor10/simone/blob/master/inc/template-tags.php
--------------------------------------------------------------*/
if ( ! function_exists( 'strt_attachment_nav' ) ) :
	function strt_attachment_nav() { ?>
		<nav class="navigation post-navigation" role="navigation">
			<div class="post-nav-box clear">
				<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'strt' ); ?></h1>
				<div class="nav-links">
				<?php 
					previous_image_link( false, '<div class="nav-previous">' . __( 'Previous Image', 'strt' ) . '</div>' );
					next_image_link( false, '<div class="nav-next">' . __( 'Next Image', 'strt' ) . '</div>' );
				?>
				</div><!-- .nav-links -->
			</div><!-- .post-nav-box -->
		</nav><!-- .navigation -->
	<?php }
endif;


/*--------------------------------------------------------------
# Display navigation to next/previous image in attachment pages
--------------------------------------------------------------*/
if ( ! function_exists( 'strt_the_attached_image' ) ) :
/**
 * Print the attached image with a link to the next attached image.
 */
function strt_the_attached_image() {
	$post = get_post();
	/**
	 * Filter the default attachment size.
	 */
	$attachment_size = apply_filters( 'strt_attachment_size', array( 1160, 960 ) );
	$next_attachment_url = wp_get_attachment_url();
	/*
	 * Grab the IDs of all the image attachments in a gallery so we can get the URL
	 * of the next adjacent image in a gallery, or the first image (if we're
	 * looking at the last image in a gallery), or, in a gallery of one, just the
	 * link to that image file.
	 */
	$attachment_ids = get_posts( array(
		'post_parent'    => $post->post_parent,
		'fields'         => 'ids',
		'numberposts'    => -1,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID',
	) );
	// If there is more than 1 attachment in a gallery...
	if ( count( $attachment_ids ) > 1 ) {
		foreach ( $attachment_ids as $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = current( $attachment_ids );
				break;
			}
		}
		// get the URL of the next image attachment...
		if ( $next_id ) {
			$next_attachment_url = get_attachment_link( $next_id );
		}
		// or get the URL of the first image attachment.
		else {
			$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
		}
	}
	printf( '<a href="%1$s" rel="attachment">%2$s</a>',
		esc_url( $next_attachment_url ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}
endif;

