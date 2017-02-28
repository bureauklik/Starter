	</div><!-- #content -->

	<footer id="colophon">

		<?php
		if( ! class_exists( 'acf' ) || ! get_field('hide_footer') ) { 
			if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) ) {
		?>

		<aside class="widget-area">
			<div><?php dynamic_sidebar( 'footer-1' ); ?></div>
			<div><?php dynamic_sidebar( 'footer-2' ); ?></div>
			<div><?php dynamic_sidebar( 'footer-3' ); ?></div>
		</aside>
	
	<?php } } ?>

	</footer><!-- #colophon -->

	<div id="socket">
		<span>
			<?php echo date("Y") ?> &copy; <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php echo get_bloginfo('name'); ?></a>
			<span class="sep"> | </span>
			<?php echo get_bloginfo( 'description' ) ?> - <?php printf( esc_html__( 'Website by %1$s.', 'strt' ), '<a href="https://middelham.nl/" rel="designer">Bas Middelham</a>' ); ?>
		</span>
	</div><!-- .site-info -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
