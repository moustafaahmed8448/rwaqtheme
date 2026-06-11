<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class Rwaq_Theme_Main {
    private static $instance = null;

    public static function get_instance() {
        if ( null === self::$instance ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {
        $this->load_dependencies();
    }

    private function load_dependencies() {
        $dir = get_template_directory() . '/inc/';

        // Load specific layout controllers
        if ( file_exists( $dir . 'class-customize.php' ) ) {
            require_once $dir . 'class-customize.php';
        }

        // Initialize Elementor widgets integration
        if ( file_exists( $dir . 'class-elementor.php' ) ) {
            require_once $dir . 'class-elementor.php';
        }
    }
}
