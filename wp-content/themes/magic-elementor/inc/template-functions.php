<?php

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Magic Elementor
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function magic_elementor_body_classes($classes)
{
	// Adds a class of hfeed to non-singular pages.
	if (!is_singular()) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if (!is_active_sidebar('sidebar-1')) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter('body_class', 'magic_elementor_body_classes');

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function magic_elementor_pingback_header()
{
	if (is_singular() && pings_open()) {
		printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
	}
}
add_action('wp_head', 'magic_elementor_pingback_header');


function magic_elementor_el_template_list()
{
	$templates = get_posts(
		array(
			'post_type' => 'elementor_library',
			'numberposts' => -1,
			'post_status' => 'publish',
		)
	);
	$template_items = [];
	$template_items['select'] = esc_html__('Select Template', 'magic-elementor');
	if (!empty($templates) && did_action('elementor/loaded')) {
		foreach ($templates as $template) {
			$template_items[$template->ID] = esc_html($template->post_title);
		}
	}
	return $template_items;
}

function magic_elementor_el_template_list_desc($section = '?')
{
	if (did_action('elementor/loaded')) {
		$help_message = __('don\'t available Template ', 'magic-elementor');
		$help_link = home_url() . '/wp-admin/edit.php?post_type=elementor_library&tabs_group=library&elementor_library_type=section';
		$help_link_text = __('Create A Template', 'magic-elementor');
	} else {
		$help_message = __('You need to install Elementor Plugin? ', 'magic-elementor');
		$help_link = home_url() . '/wp-admin/plugin-install.php?s=elementor&tab=search&type=term';
		$help_link_text = __('Install & active Elementor', 'magic-elementor');
	}

	$output = sprintf('%s %s <a target="_blank" href="%s">%s</a>', $help_message, $section, esc_url($help_link), $help_link_text);

	return $output;
}
