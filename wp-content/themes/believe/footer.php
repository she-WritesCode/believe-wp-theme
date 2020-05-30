<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Believe
 */

?>

<footer id="colophon" class="site-footer">
	<div class="row widget-area justify-content-center">
		<div class="col-md-8">
			<div class="row mx-2 mx-md-0">
				<?php if (is_active_sidebar('footer_1')) : ?>
					<div class="col-md-3">
						<?php dynamic_sidebar('footer_1'); ?>
					</div>
				<?php endif; ?>
				<?php if (is_active_sidebar('footer_2')) : ?>
					<div class="col-md-3">
						<?php dynamic_sidebar('footer_2'); ?>
					</div>
				<?php endif; ?>
				<?php if (is_active_sidebar('footer_3')) : ?>
					<div class="col-md-3">
						<?php dynamic_sidebar('footer_3'); ?>
					</div>
				<?php endif; ?>
				<?php if (is_active_sidebar('footer_4')) : ?>
					<div class="col-md-3">
						<?php dynamic_sidebar('footer_4'); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<nav id="footer-menu" class="navbar navbar-expand-sm navbar-light p-0">
		<div class="mx-auto p-2" style="background-image: url('<?php echo get_bloginfo('template_directory'); ?>/images/footer-bg.jpg'); background-repeat: no-repeat; background-position: top; background-size: cover; min-width: 70%;">
			<div class="d-flex justify-content-between">
				<div class="mr-auto">
					<?php
					wp_nav_menu(array(
						'theme_location' => 'footer',
						'menu_id'        => 'footer-menu',
						'depth'				=> 0, // 1 = with dropdowns, 0 = no dropdowns.
						'container'			=> 'div',
						'container_class'	=> '',
						'container_id'		=> 'bs-footer-navbar',
						'menu_class'		=> 'navbar-nav mt-2 mt-lg-0',
						'fallback_cb'		=> 'WP_Bootstrap_Navwalker::fallback',
						'walker'			=> new WP_Bootstrap_Navwalker()
					));
					?>
					<div class="site-info">
						<p class="copyright"><?php echo get_theme_mod('copyright_text'); ?></p>
					</div><!-- .site-info -->
				</div>
				<?php
				$custom_logo_id = get_theme_mod('footer_logo');
				$logo = wp_get_attachment_image_src($custom_logo_id, 'full')[0];
				?>
				<a class="ml-auto mt-lg-0" href="#"><img class="img-fluid" src="<?php echo $logo ?: get_template_directory() . '/images/footer-logo.png' ?>" alt="<?php bloginfo('name') ?>" /></a>
			</div>
		</div>
	</nav>
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>