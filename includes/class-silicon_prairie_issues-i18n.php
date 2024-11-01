<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://www.bitsourceky.com
 * @since      1.0.0
 *
 * @package    Silicon_prairie_issues
 * @subpackage Silicon_prairie_issues/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Silicon_prairie_issues
 * @subpackage Silicon_prairie_issues/includes
 * @author     Bit Source <developers@bitsourceky.com>
 */
class Silicon_prairie_issues_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'silicon_prairie_issues',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
