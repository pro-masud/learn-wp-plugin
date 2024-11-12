<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://dev-masud-rana.netlify.app/
 * @since      1.0.0
 *
 * @package    Wp_Slider
 * @subpackage Wp_Slider/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Wp_Slider
 * @subpackage Wp_Slider/includes
 * @author     Masud Rana <promasudbd@gmail.com>
 */
class Wp_Slider_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		delete_option( 'wp_slider_options' );
	}
}
