<?php
// adctive call back function for header social
if (!function_exists('magic_elementor_use_ftemplate_callback')) :
    function magic_elementor_use_ftemplate_callback()
    {
        if (get_theme_mod('magic_elementor_use_ftemplate') == 1) {
            return true;
        } else {
            return false;
        }
    }
endif;
if (!function_exists('magic_elementor_fdefault_callback')) :
    function magic_elementor_fdefault_callback()
    {
        if (get_theme_mod('magic_elementor_use_ftemplate') != 1) {
            return true;
        } else {
            return false;
        }
    }
endif;

function magic_elementor_footer_customize_register($wp_customize)
{

    $wp_customize->add_section('magic_elementor_footer', array(
        'title' => __('Magic Elementor Footer Settings', 'magic-elementor'),
        'capability'     => 'edit_theme_options',
        'description'     => __('Magic Elementor theme footer settings', 'magic-elementor'),
        'panel'    => 'magic_elementor_settings',
        'priority'       => 600,


    ));
    $wp_customize->add_setting('magic_elementor_use_ftemplate', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'default'       =>  '',
        'sanitize_callback' => 'absint',
        'transport'     => 'refresh',
    ));
    $wp_customize->add_control('magic_elementor_use_ftemplate', array(
        'label'      => __('Use Elementor Template In Footer? ', 'magic-elementor'),
        'section'    => 'magic_elementor_footer',
        'settings'   => 'magic_elementor_use_ftemplate',
        'type'       => 'checkbox',
    ));
    $wp_customize->add_setting('magic_elementor_ftemplate_list', array(
        'default'        => 'select',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'magic_elementor_sanitize_select',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('magic_elementor_ftemplate_list', array(
        'label'      => __('Select Template For Footer', 'magic-elementor'),
        'description' => magic_elementor_el_template_list_desc(__('For Footer?', 'magic-elementor')),
        'section'    => 'magic_elementor_footer',
        'settings'   => 'magic_elementor_ftemplate_list',
        'type'       => 'select',
        'choices'    => magic_elementor_el_template_list(),
        'active_callback' => 'magic_elementor_use_ftemplate_callback'
    ));
    $wp_customize->add_setting('magic_elementor_ftext_position', array(
        'default'        => 'center',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'magic_elementor_sanitize_select',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('magic_elementor_ftext_position', array(
        'label'      => __('Footer Text Position', 'magic-elementor'),
        'section'    => 'magic_elementor_footer',
        'settings'   => 'magic_elementor_ftext_position',
        'type'       => 'select',
        'choices'    => array(
            'left' => __('Left', 'magic-elementor'),
            'center' => __('Center', 'magic-elementor'),
            'right' => __('Right', 'magic-elementor'),
        ),
        'active_callback' => 'magic_elementor_fdefault_callback'

    ));
}
add_action('customize_register', 'magic_elementor_footer_customize_register');
