<!DOCTYPE html>
<html <?php language_attributes(); ?> lang="en">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="alternate" hreflang="<?php bloginfo( 'language' ); ?>" href="<?php echo esc_url( home_url() ); ?>" />
<script>document.documentElement.className += ' wf-loading';</script>
<script>
	WebFontConfig = {
		google: {
			families: ['Rubik']
		},
	};
</script>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'strt' ); ?></a>
	<header id="masthead" itemscope itemtype="http://schema.org/Organization">
		<span class="site-branding">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="url">
				<?php if ( is_front_page() && is_home() ) : ?>
					<h1 itemprop="name"><?php bloginfo( 'name' ); ?></h1>
				<?php else : ?>
					<span itemprop="name"><?php bloginfo( 'name' ); ?></span>
				<?php endif; ?>
				<?php 
				$description = get_bloginfo( 'description', 'display' );
				if ( $description || is_customize_preview() ) : ?>
					<span itemprop="description"><?php echo $description; ?></span>
				<?php endif; ?>
				<img width="190" height="48" class="site-logo" itemprop="logo" src="<?php echo get_template_directory_uri() ?>/img/starter-logo.png" alt="Logo <?php bloginfo( 'name' ); ?>" srcset="<?php echo get_template_directory_uri() ?>/img/starter-logo@2x.png 2x">
			</a>
		</span><!-- .site-branding -->
		<nav id="site-navigation">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><span><?php esc_html_e( 'Menu', 'strt' ); ?></span></button>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->
	<div id="content">
