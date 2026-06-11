<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class Rwaq_Elementor_Manager {

    public function __construct() {
        // Run setup hooks only if Elementor plugin is active
        if ( did_action( 'elementor/loaded' ) ) {
            add_action( 'elementor/widgets/register', [ $this, 'register_all_widgets' ] );
        }
    }

    public function register_all_widgets( $widgets_manager ) {
        $widgets_dir = get_template_directory() . '/elementor/widgets/*.php';
        
        // Dynamic Scanner: Automatically finds all PHP files in the folder
        $files = glob( $widgets_dir );

        if ( empty( $files ) ) return;

        foreach ( $files as $file ) {
            require_once $file;

            // Generate the expected class name based on the file name
            // Example: "custom-hero.php" looks for a class named "Rwaq_Custom_Hero_Widget"
            $file_name = basename( $file, '.php' );
            $class_name = 'Rwaq_' . str_replace( '-', '_', ucwords( $file_name, '-' ) ) . '_Widget';

            if ( class_exists( $class_name ) ) {
                $widgets_manager->register( new $class_name() );
            }
        }
    }
}

new Rwaq_Elementor_Manager();
