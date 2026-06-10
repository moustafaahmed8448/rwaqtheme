<?php

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
