<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Believe
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
	<?php wp_head(); ?>
</head>

<body <?php body_class('h-100'); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site">

		<header id="masthead">
			<nav class="navbar navbar-expand-sm navbar-light p-0">
				<div class="my-container p-1 d-flex" style="background-image: url('<?php echo get_bloginfo('template_directory'); ?>/images/header-bg.jpg'); background-repeat: no-repeat; background-position: top; background-size: cover; min-width: 70%;">
					<a class="navbar-brand" href="#">
						<?php
						$custom_logo_id = get_theme_mod('custom_logo');
						$logo = wp_get_attachment_image_src($custom_logo_id, 'full');
						if (has_custom_logo()) { ?>
							<img src="<?php esc_url($logo) ?>" alt="<?php get_bloginfo('name') ?>">
						<?php } else { ?>
							<img class="img-fluid" src="<?php echo get_bloginfo('template_directory'); ?>/images/logo.png" alt="<?php get_bloginfo('name') ?>" />
						<?php } ?>
					</a>
					<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
						<span class="navbar-toggler-icon"></span>
					</button>

					<?php
					wp_nav_menu(array(
						'theme_location' => 'main',
						'menu_id'        => 'primary-menu',
						'depth'				=> 1, // 1 = with dropdowns, 0 = no dropdowns.
						'container'			=> 'div',
						'container_class'	=> 'collapse navbar-collapse',
						'container_id'		=> 'bs-primary-navbar-collapse-1',
						'menu_class'		=> 'navbar-nav ml-auto mt-2 mt-lg-0',
						'fallback_cb'		=> 'WP_Bootstrap_Navwalker::fallback',
						'walker'			=> new WP_Bootstrap_Navwalker()
					));
					?>
				</div>
			</nav><!-- #site-navigation -->
			<?php get_template_part('template-parts/slider') ?>
		</header><!-- #masthead -->