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
 * @package           Dev_Portfolio
 *
 * @wordpress-plugin
 * Plugin Name:       Dev Portfolio
 * Plugin URI:        https://dev-masud-rana.netlify.app/
 * Description:       Dev-Portfolio is a powerful and easy-to-use WordPress plugin designed to showcase your professional portfolio. Perfect for developers, designers, and creatives, it provides customizable layouts and seamless integration, allowing you to highlight your projects with style and functionality
 * Version:           1.0.0
 * Author:            Masud Rana
 * Author URI:        https://dev-masud-rana.netlify.app//
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       dev-portfolio
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
define( 'DEV_PORTFOLIO_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-dev-portfolio-activator.php
 */
function activate_dev_portfolio() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-dev-portfolio-activator.php';
	Dev_Portfolio_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-dev-portfolio-deactivator.php
 */
function deactivate_dev_portfolio() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-dev-portfolio-deactivator.php';
	Dev_Portfolio_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_dev_portfolio' );
register_deactivation_hook( __FILE__, 'deactivate_dev_portfolio' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-dev-portfolio.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_dev_portfolio() {

	$plugin = new Dev_Portfolio();
	$plugin->run();

}
run_dev_portfolio();
