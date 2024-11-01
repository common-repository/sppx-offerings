<?php

/**
 * Fired during plugin activation
 *
 * @link       http://www.bitsourceky.com
 * @since      1.0.0
 *
 * @package    Silicon_prairie_issues
 * @subpackage Silicon_prairie_issues/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Silicon_prairie_issues
 * @subpackage Silicon_prairie_issues/includes
 * @author     Bit Source <developers@bitsourceky.com>
 */
class Silicon_prairie_issues_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */

	public static function activate() {

		//Registers custom post type

		require_once __DIR__ . '/register_issue_post_type.php';

		silicon_prairie_issues_my_custom_post_issue_run();

		flush_rewrite_rules();

	}

}
