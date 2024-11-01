<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.bitsourceky.com
 * @since             1.0.1
 * @package           Silicon_prairie_issues
 *
 * @wordpress-plugin
 * Plugin Name:       SPPX Offerings
 * Plugin URI:        https://sppx.io/
 * Description:       This plugin enables Silicon Prairie Issues to be displayed on your site.
 * Version:           1.0.1
 * Author:            Bit Source
 * Author URI:        http://www.bitsourceky.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       silicon_prairie_issues
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
define( 'SILICON_PRAIRIE_ISSUES_VERSION', '1.0.1' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-silicon_prairie_issues-activator.php
 */
function activate_silicon_prairie_issues() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-silicon_prairie_issues-activator.php';
	Silicon_prairie_issues_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-silicon_prairie_issues-deactivator.php
 */
function deactivate_silicon_prairie_issues() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-silicon_prairie_issues-deactivator.php';
	Silicon_prairie_issues_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_silicon_prairie_issues' );
register_deactivation_hook( __FILE__, 'deactivate_silicon_prairie_issues' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-silicon_prairie_issues.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.1
 */
function run_silicon_prairie_issues() {

	$plugin = new Silicon_prairie_issues();
	$plugin->run();

}
run_silicon_prairie_issues();
