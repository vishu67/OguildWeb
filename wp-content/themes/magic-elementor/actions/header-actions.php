<?php

/**
 * The file for header all actions
 *
 *
 * @package Magic Elementor
 */

function magic_elementor_header_logo_output()
{
	$magic_elementor_blog_container = get_theme_mod('magic_elementor_blog_container', 'mg-wrapper');
	$magic_elementor_logo_position = get_theme_mod('magic_elementor_logo_position', 'center')

?>
	<div class="header-logosec">
		<div class="<?php echo esc_attr($magic_elementor_blog_container); ?>">
			<div class="mg-flex">
				<div class="head-logo-sec text-<?php echo esc_attr($magic_elementor_logo_position); ?>">
					<?php if (has_custom_logo()) : ?>
						<div class="site-branding brand-logo">
							<?php the_custom_logo(); ?>
						</div>
					<?php endif; ?>
					<?php
					if (display_header_text() == true || (display_header_text() == true && is_customize_preview())) : ?>
						<div class="site-branding brand-text">
							<?php if (display_header_text() == true || (display_header_text() == true && is_customize_preview())) : ?>
								<h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
								<?php
								$magic_elementor_description = get_bloginfo('description', 'display');
								if ($magic_elementor_description || is_customize_preview()) :
								?>
									<p class="site-description">
										<?php echo $magic_elementor_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
										?>
									</p>
								<?php endif; ?>
							<?php endif; ?>
						</div><!-- .site-branding -->
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
<?php
}
add_action('magic_elementor_header_logo', 'magic_elementor_header_logo_output');

// newsxpaper mene style
function magic_elementor_main_menu_output()
{
	$magic_elementor_main_menu_position = get_theme_mod('magic_elementor_main_menu_position', 'center')
?>
	<div class="menu-bar text-<?php echo esc_attr($magic_elementor_main_menu_position); ?>">
		<div class="mg-wrapper">
			<div class="magic-elementor-container menu-inner">
				<nav id="site-navigation" class="main-navigation">
					<?php
					wp_nav_menu(array(
						'theme_location' => 'main-menu',
						'menu_id'        => 'magic-elementor-menu',
						'menu_class'        => 'magic-elementor-menu',
					));
					?>
				</nav><!-- #site-navigation -->
			</div>
		</div>
	</div>

<?php
}
add_action('magic_elementor_main_menu', 'magic_elementor_main_menu_output');



// newsxpaper mene style
function magic_elementor_mobile_menu_output()
{
?>
	<div class="mobile-menu-bar">
		<div class="mg-wrapper">
			<nav id="mobile-navigation" class="mobile-navigation">
				<button id="mmenu-btn" class="menu-btn" aria-expanded="false">
					<span class="mopen"><?php esc_html_e('Menu', 'magic-elementor'); ?></span>
					<span class="mclose"><?php esc_html_e('Close', 'magic-elementor'); ?></span>
				</button>
				<?php
				wp_nav_menu(array(
					'theme_location' => 'main-menu',
					'menu_id'        => 'wsm-menu',
					'menu_class'        => 'wsm-menu',
				));
				?>
			</nav><!-- #site-navigation -->
		</div>
	</div>

<?php
}
add_action('magic_elementor_mobile_menu', 'magic_elementor_mobile_menu_output');
