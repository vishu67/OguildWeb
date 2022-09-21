<?php

/**
 * Magic Elementor Theme Customizer
 *
 * @package Magic Elementor
 */
require get_template_directory() . '/inc/customizer/header-customizer.php';
require get_template_directory() . '/inc/customizer/footer-customizer.php';



/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

function magic_elementor_customize_register($wp_customize)
{
	$wp_customize->get_setting('blogname')->transport         = 'postMessage';
	$wp_customize->get_setting('blogdescription')->transport  = 'postMessage';
	$wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

	//select sanitization function
	function magic_elementor_sanitize_select($input, $setting)
	{
		$input = sanitize_key($input);
		$choices = $setting->manager->get_control($setting->id)->choices;
		return (array_key_exists($input, $choices) ? $input : $setting->default);
	}

	$wp_customize->add_panel('magic_elementor_settings', array(
		'priority'       => 50,
		'title'          => __('Magic Elementor Theme settings', 'magic-elementor'),
		'description'    => __('All Magic Elementor theme settings', 'magic-elementor'),
	));


	//Magic Elementor blog settings
	$wp_customize->add_section('magic_elementor_blog', array(
		'title' => __('Magic Elementor Blog Settings', 'magic-elementor'),
		'capability'     => 'edit_theme_options',
		'description'     => __('Magic Elementor theme blog settings', 'magic-elementor'),
		'panel'    => 'magic_elementor_settings',

	));
	$wp_customize->add_setting('magic_elementor_blog_container', array(
		'default'        => 'mg-wrapper',
		'capability'     => 'edit_theme_options',
		'type'           => 'theme_mod',
		'sanitize_callback' => 'magic_elementor_sanitize_select',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('magic_elementor_blog_container', array(
		'label'      => __('Container type', 'magic-elementor'),
		'description' => __('You can set standard container or full width container. ', 'magic-elementor'),
		'section'    => 'magic_elementor_blog',
		'settings'   => 'magic_elementor_blog_container',
		'type'       => 'select',
		'choices'    => array(
			'mg-wrapper' => __('Standard Container', 'magic-elementor'),
			'mg-wrapper-full' => __('Full width Container', 'magic-elementor'),
		),
	));

	$wp_customize->add_setting('magic_elementor_blog_layout', array(
		'default'        => 'rightside',
		'capability'     => 'edit_theme_options',
		'type'           => 'theme_mod',
		'sanitize_callback' => 'magic_elementor_sanitize_select',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('magic_elementor_blog_layout', array(
		'label'      => __('Select Blog Layout', 'magic-elementor'),
		'description' => __('Right and Left sidebar only show when sidebar widget is available. ', 'magic-elementor'),
		'section'    => 'magic_elementor_blog',
		'settings'   => 'magic_elementor_blog_layout',
		'type'       => 'select',
		'choices'    => array(
			'rightside' => __('Right Sidebar', 'magic-elementor'),
			'leftside' => __('Left Sidebar', 'magic-elementor'),
			'fullwidth' => __('No Sidebar', 'magic-elementor'),
		),
	));
	$wp_customize->add_setting('magic_elementor_blog_style', array(
		'default'        => 'list',
		'capability'     => 'edit_theme_options',
		'type'           => 'theme_mod',
		'sanitize_callback' => 'magic_elementor_sanitize_select',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('magic_elementor_blog_style', array(
		'label'      => __('Select Blog Style', 'magic-elementor'),
		'section'    => 'magic_elementor_blog',
		'settings'   => 'magic_elementor_blog_style',
		'type'       => 'select',
		'choices'    => array(
			'list' => __('List Style', 'magic-elementor'),
			'classic' => __('Classic Style', 'magic-elementor'),
		),
	));
	//Magic Elementor page settings
	$wp_customize->add_section('magic_elementor_page', array(
		'title' => __('Magic Elementor Page Settings', 'magic-elementor'),
		'capability'     => 'edit_theme_options',
		'description'     => __('Magic Elementor theme blog settings', 'magic-elementor'),
		'panel'    => 'magic_elementor_settings',

	));
	$wp_customize->add_setting('magic_elementor_page_container', array(
		'default'        => 'mg-wrapper',
		'capability'     => 'edit_theme_options',
		'type'           => 'theme_mod',
		'sanitize_callback' => 'magic_elementor_sanitize_select',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('magic_elementor_page_container', array(
		'label'      => __('Page Container type', 'magic-elementor'),
		'description' => __('The setting won\'t work for elementor pages.', 'magic-elementor'),
		'section'    => 'magic_elementor_page',
		'settings'   => 'magic_elementor_page_container',
		'type'       => 'select',
		'choices'    => array(
			'mg-wrapper' => __('Standard Container', 'magic-elementor'),
			'mg-wrapper-full' => __('Full width Container', 'magic-elementor'),
		),
	));
	$wp_customize->add_setting('magic_elementor_page_header', array(
		'default'        => 'show',
		'capability'     => 'edit_theme_options',
		'type'           => 'theme_mod',
		'sanitize_callback' => 'magic_elementor_sanitize_select',
		'transport' => 'refresh',
	));
	$wp_customize->add_control('magic_elementor_page_header', array(
		'label'      => __('Show Page header', 'magic-elementor'),
		'description' => __('The setting won\'t work for elementor pages.', 'magic-elementor'),
		'section'    => 'magic_elementor_page',
		'settings'   => 'magic_elementor_page_header',
		'type'       => 'select',
		'choices'    => array(
			'show' => __('Show all pages', 'magic-elementor'),
			'hide-home' => __('Hide Only Front Page', 'magic-elementor'),
			'hide' => __('Hide All Pages', 'magic-elementor'),
		),
	));




	if (isset($wp_customize->selective_refresh)) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'magic_elementor_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'magic_elementor_customize_partial_blogdescription',
			)
		);
	}
}
add_action('customize_register', 'magic_elementor_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function magic_elementor_customize_partial_blogname()
{
	bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function magic_elementor_customize_partial_blogdescription()
{
	bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function magic_elementor_customize_preview_js()
{
	wp_enqueue_script('magic-elementor-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array('customize-preview'), MAGIC_ELEMENTOR_VERSION, true);
}
add_action('customize_preview_init', 'magic_elementor_customize_preview_js');
