<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class Rwaq_Custom_Hero_Widget extends \Elementor\Widget_Base {

    public function get_name() { return 'rwaq_custom_hero'; }
    public function get_title() { return esc_html__( 'Rwaq Custom Hero', 'rwaqtheme' ); }
    public function get_icon() { return 'eicon-banner'; }
    public function get_categories() { return [ 'general' ]; }

    protected function register_controls() {
        $this->start_controls_section(
            'content_section',
            [ 'label' => esc_html__( 'Content', 'rwaqtheme' ), 'tab' => \Elementor\Controls_Manager::TAB_CONTENT ]
        );

        $this->add_control(
            'title',
            [ 'label' => esc_html__( 'Heading', 'rwaqtheme' ), 'type' => \Elementor\Controls_Manager::TEXT, 'default' => 'Auntri Style Framework' ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        echo '<div class="rwaq-hero-box"><h1>' . esc_html( $settings['title'] ) . '</h1></div>';
    }
}
