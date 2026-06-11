<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class Rwaq_Elementor_Manager {

    public function __construct() {
        // Elementor v3.5+ uses 'elementor/elements/categories_registered'
        add_action( 'elementor/elements/categories_registered', [ $this, 'register_rwaq_category' ] );
        add_action( 'elementor/widgets/register', [ $this, 'register_all_widgets' ] );
    }

    /**
     * Registers a custom category section safely in the Elementor sidebar
     */
    public function register_rwaq_category( $elements_manager ) {
        $elements_manager->add_category(
            'rwaq-category',
            [
                'title' => esc_html__( 'Rwaq Widgets', 'rwaqtheme' ),
                'icon'  => 'eicon-font',
            ]
        );
    }

    /**
     * Scans and loads your widgets reliably
     */
    public function register_all_widgets( $widgets_manager ) {
        $widgets_dir = get_template_directory() . '/elementor/widgets/*.php';
        $files = glob( $widgets_dir );

        if ( empty( $files ) ) return;

        foreach ( $files as $file ) {
            require_once $file;

            $file_name = basename( $file, '.php' );
            
            
            $clean_name = str_replace( '-', '_', strtolower( $file_name ) );
            $class_name = 'Rwaq_' . $clean_name . '_Widget';

            if ( class_exists( $class_name ) ) {
                $widgets_manager->register( new $class_name() );
            }
        }
    }
}

new Rwaq_Elementor_Manager();
