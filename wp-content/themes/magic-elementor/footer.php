<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Magic Elementor
 */

?>
<?php
$magic_elementor_use_ftemplate = get_theme_mod('magic_elementor_use_ftemplate');
if ($magic_elementor_use_ftemplate && did_action('elementor/loaded')) {
	$magic_elementor_ftemplate_list = get_theme_mod('magic_elementor_ftemplate_list');

	if ('select' == $magic_elementor_ftemplate_list) {
		printf('<div class="me-ftemplate-not">%s</div>', __('Please select a template for display Footer!! If the template list is empty then you need to add a footer template first!!!', 'magic-elementor'));
	} else {
		echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display($magic_elementor_ftemplate_list, true); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
} else {
?>
	<footer id="colophon" class="site-footer">
		<div class="mg-wrapper">
			<div class="info-news site-info text-center">
				&copy;
				<?php
				echo date_i18n(
					/* translators: Copyright date format, see https://www.php.net/date */
					_x('Y', 'copyright date format', 'magic-elementor')
				);
				?>
				<a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
				<span class="sep"> | </span>
				<?php

				printf(esc_html__('Theme Magic Elementor by %s', 'magic-elementor'), '<a target="_blank" rel="developer" href="' . esc_url('https://wpthemespace.com') . '">' . esc_html__('wpthemespace.com', 'magic-elementor') . '</a>');
				?>
			</div>
		</div><!-- .container -->
	</footer><!-- #colophon -->
<?php
} // check Elementor Template
?>
<?php wp_footer(); ?>

</body>

</html>