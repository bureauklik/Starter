<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Starter
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">

	<?php
	if( ! class_exists( 'acf' ) || ! get_field('hide_footer') ) { 
		if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) ) {
	?>

		<aside class="footer-widgets widget-area">
			<div class="widget-column footer-widget-1"><?php dynamic_sidebar( 'footer-1' ); ?></div>
			<div class="widget-column footer-widget-2"><?php dynamic_sidebar( 'footer-2' ); ?></div>
			<div class="widget-column footer-widget-3"><?php dynamic_sidebar( 'footer-3' ); ?></div>
		</aside>
	
	<?php } } ?>

		<div class="site-info">
			<?php echo date("Y") ?> &copy; <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php echo get_bloginfo('name'); ?></a>
			<span class="sep"> | </span>
			<?php echo get_bloginfo( 'description' ) ?> - <?php printf( esc_html__( 'Website by %1$s.', 'strt' ), '<a href="https://middelham.nl/" rel="designer">Bas Middelham</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
