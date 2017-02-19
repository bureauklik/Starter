<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Starter
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if( ! class_exists( 'acf' ) || ! get_field('hide_title') ) { ?>
		<header class="entry-header">
			<?php 
				the_title( '<h1 class="entry-title">', '</h1>' );
				if( class_exists( 'acf' ) && get_field( 'subheading' ) ) { 
					echo '<p class="entry-subtitle">' . get_field( 'subheading' ) . '</p>';
				}
			?>
		</header><!-- .entry-header -->
	<?php } ?>

	<div class="entry-content">
		<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'strt' ),
				'after'  => '</div>',
			) );
		?>

		<?php if( class_exists( 'acf' ) ) { get_template_part( 'template-parts/content', 'acf' ); } ?>

	</div><!-- .entry-content -->

</article><!-- #post-## -->
