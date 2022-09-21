<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Magic Elementor
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>

	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'magic-elementor'); ?></a>
	<?php
	$magic_elementor_use_htemplate = get_theme_mod('magic_elementor_use_htemplate');
	if ($magic_elementor_use_htemplate && did_action('elementor/loaded')) {
		$magic_elementor_template_list = get_theme_mod('magic_elementor_template_list');

		if ('select' == $magic_elementor_template_list) {
			printf('<div class="me-htemplate-not">%s</div>', __('Please select a template for display Header!! If the template list is empty then you need to add a header template first!!!', 'magic-elementor'));
		} else {
			echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display($magic_elementor_template_list, true); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	} else {
	?>
		<header class="header" id="header">
			<?php do_action('magic_elementor_mobile_menu'); ?>

			<?php do_action('magic_elementor_header_logo'); ?>
			<?php do_action('magic_elementor_main_menu'); ?>
		</header>
	<?php
	}
	?>