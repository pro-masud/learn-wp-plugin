<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://dev-masud-rana.netlify.app/
 * @since             1.0.0
 * @package           Wp_Slider
 *
 * @wordpress-plugin
 * Plugin Name:       WP Slider
 * Plugin URI:        https://dev-masud-rana.netlify.app/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Masud Rana
 * Author URI:        https://dev-masud-rana.netlify.app//
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-slider
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WP_SLIDER_VERSION', '1.0.0' );
define('WP_SLIDER_FILE', __FILE__);
define('WP_SLIDER_PATH', __DIR__);
define('WP_SLIDER_URL', plugins_url('', WP_SLIDER_FILE));
define('WP_SLIDER_ASSETS', WP_SLIDER_URL . '/assets');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wp-slider-activator.php
 */
function activate_wp_slider() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-slider-activator.php';
	Wp_Slider_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-slider-deactivator.php
 */
function deactivate_wp_slider() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-slider-deactivator.php';
	Wp_Slider_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wp_slider' );
register_deactivation_hook( __FILE__, 'deactivate_wp_slider' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wp-slider.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wp_slider() {

	$plugin = new Wp_Slider();
	$plugin->run();

}
run_wp_slider();
