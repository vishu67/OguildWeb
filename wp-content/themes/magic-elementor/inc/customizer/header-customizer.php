<?php

// adctive call back function for header social
if (!function_exists('magic_elementor_use_htemplate_callback')) :
    function magic_elementor_use_htemplate_callback()
    {
        if (get_theme_mod('magic_elementor_use_htemplate') == 1) {
            return true;
        } else {
            return false;
        }
    }
endif;
if (!function_exists('magic_elementor_hdefault_callback')) :
    function magic_elementor_hdefault_callback()
    {
        if (get_theme_mod('magic_elementor_use_htemplate') != 1) {
            return true;
        } else {
            return false;
        }
    }
endif;

function magic_elementor_header_customize_register($wp_customize)
{

    $wp_customize->add_section('magic_elementor_header', array(
        'title' => __('Magic Elementor Header Settings', 'magic-elementor'),
        'capability'     => 'edit_theme_options',
        'description'     => __('Magic Elementor theme header settings', 'magic-elementor'),
        'panel'    => 'magic_elementor_settings',

    ));
    $wp_customize->add_setting('magic_elementor_use_htemplate', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'default'       =>  '',
        'sanitize_callback' => 'absint',
        'transport'     => 'refresh',
    ));
    $wp_customize->add_control('magic_elementor_use_htemplate', array(
        'label'      => __('Use Elementor Template In Header? ', 'magic-elementor'),
        'section'    => 'magic_elementor_header',
        'settings'   => 'magic_elementor_use_htemplate',
        'type'       => 'checkbox',
    ));
    $wp_customize->add_setting('magic_elementor_template_list', array(
        'default'        => 'select',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'magic_elementor_sanitize_select',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('magic_elementor_template_list', array(
        'label'      => __('Select Template For Header', 'magic-elementor'),
        'description' => magic_elementor_el_template_list_desc(__('For Header?', 'magic-elementor')),
        'section'    => 'magic_elementor_header',
        'settings'   => 'magic_elementor_template_list',
        'type'       => 'select',
        'choices'    => magic_elementor_el_template_list(),
        'active_callback' => 'magic_elementor_use_htemplate_callback'
    ));
    $wp_customize->add_setting('magic_elementor_logo_position', array(
        'default'        => 'center',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'magic_elementor_sanitize_select',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('magic_elementor_logo_position', array(
        'label'      => __('Logo Position', 'magic-elementor'),
        'description' => __('You can set the menu top of the page or under logo. ', 'magic-elementor'),
        'section'    => 'magic_elementor_header',
        'settings'   => 'magic_elementor_logo_position',
        'type'       => 'select',
        'choices'    => array(
            'left' => __('Left', 'magic-elementor'),
            'center' => __('Center', 'magic-elementor'),
            'right' => __('Right', 'magic-elementor'),
        ),
        'active_callback' => 'magic_elementor_hdefault_callback'

    ));
    $wp_customize->add_setting('magic_elementor_main_menu_position', array(
        'default'        => 'center',
        'capability'     => 'edit_theme_options',
        'type'           => 'theme_mod',
        'sanitize_callback' => 'magic_elementor_sanitize_select',
        'transport' => 'refresh',
    ));
    $wp_customize->add_control('magic_elementor_main_menu_position', array(
        'label'      => __('Main Menu Position', 'magic-elementor'),
        'description' => __('You can set the menu top of the page or under logo. ', 'magic-elementor'),
        'section'    => 'magic_elementor_header',
        'settings'   => 'magic_elementor_main_menu_position',
        'type'       => 'select',
        'choices'    => array(
            'left' => __('Left', 'magic-elementor'),
            'center' => __('Center', 'magic-elementor'),
            'right' => __('Right', 'magic-elementor'),
        ),
        'active_callback' => 'magic_elementor_hdefault_callback'
    ));
}
add_action('customize_register', 'magic_elementor_header_customize_register');
