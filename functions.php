<?php
if ( ! defined( 'ABSPATH' ) ) exit;



// Pull in the core theme engine
if ( file_exists( get_template_directory() . '/inc/class-main.php' ) ) {
    require_once get_template_directory() . '/inc/class-main.php';
}



// Start the theme application
if ( class_exists( 'Rwaq_Theme_Main' ) ) {
    Rwaq_Theme_Main::get_instance();
}





function rwaqtheme_setup() {
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
  register_nav_menus(array(
    'primary' => __('Primary Menu', 'rwaqtheme'),
  ));
}
add_action('after_setup_theme', 'rwaqtheme_setup');

function rwaqtheme_assets() {
  wp_enqueue_style('rwaqtheme-style', get_stylesheet_uri(), array(), '1.0.0');
  wp_enqueue_style('rwaqtheme-main', get_template_directory_uri() . '/assets/css/main.css', array(), '1.0.0');
  wp_enqueue_script('rwaqtheme-main', get_template_directory_uri() . '/assets/js/main.js', array(), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'rwaqtheme_assets');

function rwaqtheme_language_attributes($output, $doctype) {
  if ('html' !== $doctype || is_admin()) {
    return $output;
  }

  $output = preg_replace('/lang="[^"]*"/', 'lang="ar"', $output);
  $output = preg_replace('/\sdir="[^"]*"/', '', $output);
  $output .= ' dir="rtl"';

  return $output;
}
add_filter('language_attributes', 'rwaqtheme_language_attributes', 10, 2);

function rwaqtheme_body_class($classes) {
  if (!is_admin()) {
    $classes[] = 'rtl';
  }

  return $classes;
}
add_filter('body_class', 'rwaqtheme_body_class');




if ( file_exists( get_template_directory() . '/install-resource/class-tgm-plugin-activation.php' ) ) {
    require_once get_template_directory() . '/install-resource/class-tgm-plugin-activation.php';
}

function rwaqtheme_register_required_plugins() {
    $plugins = [
        // 1. Your Custom Bundled Plugin from install-resource folder
        [
            'name'               => 'Rwaq Core Functionality Plugin',
            'slug'               => 'rwaq-core',
            'source'             => get_template_directory() . '/install-resource/plugins/rwaq-core.zip', // Path to your zip file
            'required'           => true, // True means the theme requires it to work
            'version'            => '1.0.0',
            'force_activation'   => false,
            'force_deactivation' => false,
        ],
        // 2. An external plugin from the official WordPress repository (e.g., Elementor)
        [
            'name'     => 'Elementor Website Builder',
            'slug'     => 'elementor',
            'required' => true,
        ],
    ];

    $config = [
        'id'           => 'rwaqtheme-tgmpa',       // Unique ID for your theme's notices
        'default_path' => '',                      // Default absolute path to bundled plugins
        'menu'         => 'tgmpa-install-plugins', // Menu slug for the installation page
        'has_notices'  => true,                    // Show admin notices
        'dismissable'  => true,                    // Allow users to dismiss the notice
        'is_automatic' => true,                    // Automatically activate plugins after installation
    ];

    tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'rwaqtheme_register_required_plugins' );
