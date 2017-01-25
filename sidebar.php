<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Starter
 */

if ( is_page() && is_active_sidebar( 'sidebar-1' ) ) { ?>

	<aside id="secondary" class="widget-area">
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	</aside><!-- #secondary -->

<?php } elseif ( ! is_page() && is_active_sidebar( 'sidebar-2' ) ) { ?>

	<aside id="secondary" class="widget-area">
		<?php dynamic_sidebar( 'sidebar-2' ); ?>
	</aside><!-- #secondary --> 

<?php } ?>