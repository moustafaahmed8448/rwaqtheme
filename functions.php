<?php

function momorwaqtheme_setup() {
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
  register_nav_menus(array(
    'primary' => __('Primary Menu', 'momorwaqtheme'),
  ));
}
add_action('after_setup_theme', 'momorwaqtheme_setup');

function momorwaqtheme_assets() {
  wp_enqueue_style('momorwaqtheme-style', get_stylesheet_uri(), array(), '1.0.0');
  wp_enqueue_style('momorwaqtheme-main', get_template_directory_uri() . '/assets/css/main.css', array(), '1.0.0');
  wp_enqueue_script('momorwaqtheme-main', get_template_directory_uri() . '/assets/js/main.js', array(), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'momorwaqtheme_assets');
