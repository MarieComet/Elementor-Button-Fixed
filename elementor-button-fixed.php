<?php

/**
 * Plugin Name: Elementor Button Fixed
 * Description: Fixed button for Elementor page builder
 * Plugin URI: http://dtbaker.net/web-development/creating-your-own-custom-elementor-widgets/
 * Version: 0.0.1
 * Author: Marie Comet
 * Author URI: https://mariecomet.fr
 * Text Domain: elementor-button-fixed
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

define( 'ELEMENTOR_MC_CUSTOM__FILE__', __FILE__ );

/**
 * Load Hello World
 *
 * Load the plugin after Elementor (and other plugins) are loaded.
 *
 * @since 1.0.0
 */
function mc_custom_widgets_load() {
    // Load localization file
    load_plugin_textdomain( 'mc-custom-widgets' );

    // Notice if the Elementor is not active
    if ( ! did_action( 'elementor/loaded' ) ) {
        add_action( 'admin_notices', 'mc_custom_widgets_fail_load' );
        return;
    }

    // Check version required
    $elementor_version_required = '1.0.0';
    if ( ! version_compare( ELEMENTOR_VERSION, $elementor_version_required, '>=' ) ) {
        add_action( 'admin_notices', 'mc_custom_widgets_fail_load_out_of_date' );
        return;
    }

    // Require the main plugin file
    require( __DIR__ . '/plugin.php' );
}
add_action( 'plugins_loaded', 'mc_custom_widgets_load' );