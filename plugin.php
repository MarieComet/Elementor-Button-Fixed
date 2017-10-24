<?php
namespace MCCustomWidget;

use MCCustomWidget\Widgets\MC_Button_Fixed;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Main Plugin Class
 *
 * Register new elementor widget.
 *
 * @since 1.0.0
 */
class Plugin {

    /**
     * Constructor
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function __construct() {
        $this->add_actions();
    }

    /**
     * Add Actions
     *
     * @since 1.0.0
     *
     * @access private
     */
    private function add_actions() {
        add_action( 'elementor/widgets/widgets_registered', [ $this, 'on_widgets_registered' ] );

        add_action( 'elementor/frontend/after_register_styles', function() {
            wp_register_style( 'button-fixed-css', plugins_url( '/assets/css/button-fixed-css.css', ELEMENTOR_MC_CUSTOM__FILE__ ) );
        } );

        add_action( 'elementor/frontend/after_enqueue_styles', function() {
            wp_enqueue_style( 'button-fixed-css' );
        } );
    }

    /**
     * On Widgets Registered
     *
     * @since 1.0.0
     *
     * @access public
     */
    public function on_widgets_registered() {
        $this->includes();
        $this->register_widget();
    }

    /**
     * Includes
     *
     * @since 1.0.0
     *
     * @access private
     */
    private function includes() {
        require __DIR__ . '/widgets/button-fixed.php';
    }

    /**
     * Register Widget
     *
     * @since 1.0.0
     *
     * @access private
     */
    private function register_widget() {
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new MC_Button_Fixed() );
    }
}

new Plugin();