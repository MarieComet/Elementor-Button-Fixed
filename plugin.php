<?php
namespace MCCustomWidget;

use MCCustomWidget\Widgets\MC_Button_Fixed;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.2.0
 */
class Plugin {
    /**
     * Instance
     *
     * @since 1.2.0
     * @access private
     * @static
     *
     * @var Plugin The single instance of the class.
     */
    private static $_instance = null;
    /**
     * Instance
     *
     * Ensures only one instance of the class is loaded or can be loaded.
     *
     * @since 1.2.0
     * @access public
     *
     * @return Plugin An instance of the class.
     */
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * widget_scripts
     *
     * Load required plugin core files.
     *
     * @since 1.2.0
     * @access public
     */
    public function widget_scripts() {
        //wp_register_script( 'button-fixed-js', plugins_url( '/assets/js/button-fixed.js', __FILE__ ), [ 'jquery' ], false, true );
        
    }

    /**
     *  widgets styles
     *
     * Load widgets styles
     *
    */
    public function widget_styles() { 

        wp_enqueue_style( 'button-fixed-css', plugins_url( 'assets/css/button-fixed-css.css', __FILE__ ) );

    }

    /**
     * Include Widgets files
     *
     * Load widgets files
     *
     * @since 1.2.0
     * @access private
     */
    private function include_widgets_files() {
        require_once( __DIR__ . '/widgets/button-fixed.php' );
        //require_once( __DIR__ . '/widgets/inline-editing.php' );
    }
    /**
     * Register Widgets
     *
     * Register new Elementor widgets.
     *
     * @since 1.2.0
     * @access public
     */
    public function register_widgets() {
        // Its is now safe to include Widgets files
        $this->include_widgets_files();
        // Register Widgets
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\MC_Button_Fixed() );
        //\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\Inline_Editing() );
    }
    /**
     *  Plugin class constructor
     *
     * Register plugin action hooks and filters
     *
     * @since 1.2.0
     * @access public
     */
    public function __construct() {
        // Register widget scripts
        add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );

        add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'widget_styles' ] );
        // Register widgets
        add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );
    }
}
// Instantiate Plugin Class
Plugin::instance();