<?php
/**
 * The Template for displaying single image attachment posts
 *
 * @package Starter
 */

$metadata = wp_get_attachment_metadata();

get_header(); ?>

	<div id="primary" class="content-area wide">
		<main id="main" class="site-main">

			<?php while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			
				<?php if( ! class_exists( 'acf' ) || ! get_field('hide_title') ) { ?>
					<header class="entry-header">
						<?php 
							the_title( '<h1 class="entry-title">', '</h1>' );
							if( class_exists( 'acf' ) && get_field( 'subheading' ) ) { 
								echo '<p class="entry-subtitle">' . get_field( 'subheading' ) . '</p>';
							}
						?>
				        <div class="entry-meta">
					        <?php strt_posted_on(); ?>
				            <?php _e('Featured in: ', 'strt'); ?><span class="parent-post-link"><a href="<?php echo get_permalink( $post->post_parent ); ?>" rel="gallery"><?php echo get_the_title( $post->post_parent ); ?></a></span>.
				            <?php _e('Full size image: ', 'strt'); ?><span class="full-size-link"><a href="<?php echo wp_get_attachment_url(); ?>"><?php echo $metadata['width']; ?> &times; <?php echo $metadata['height']; ?></a></span>.
				            <?php edit_post_link( __( 'Edit', 'strt' ), '<span class="edit-link">', '</span>.' ); ?>
				        </div><!-- .entry-meta -->
					</header><!-- .entry-header -->
				<?php } ?>
			
				<div class="entry-content">

			        <div class="entry-attachment">
			            <figure class="image-attachment">
			                <?php strt_the_attached_image(); ?>
			                <?php if ( has_excerpt() ) : ?>
			                    <figcaption class="attachment-caption">
			                        <?php echo get_the_excerpt(); ?>
			                    </figcaption><!-- .entry-caption -->
			                <?php endif; ?>
			            </figure><!-- .wp-caption -->
			        </div><!-- .entry-attachment -->
			        <?php the_content(); ?>

				</div><!-- .entry-content -->
		
				<?php strt_attachment_nav(); ?>

			</article><!-- #post-## -->

			<?php endwhile; // End of the loop.	?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
