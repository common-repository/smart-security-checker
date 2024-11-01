<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://smartsoftfirm.com/
 * @since             1.0.0
 * @package           Smart_Security_Checker
 *
 * @wordpress-plugin
 * Plugin Name:       Smart Security Checker
 * Plugin URI:        
 * Description:       This plugin Allows users to check for malware and other security issues on their WordPress website. Use this tool to check your WordPress website for malware and other security issues.


 * Version:           1.0.0
 * Author:            SmartSoftFirm
 * Author URI:        https://smartsoftfirm.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       smart-security-checker
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
define( 'SMART_SECURITY_CHECKER_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-smart-security-checker-activator.php
 */
function activate_smart_security_checker() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-smart-security-checker-activator.php';
	Smart_Security_Checker_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-smart-security-checker-deactivator.php
 */
function deactivate_smart_security_checker() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-smart-security-checker-deactivator.php';
	Smart_Security_Checker_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_smart_security_checker' );
register_deactivation_hook( __FILE__, 'deactivate_smart_security_checker' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-smart-security-checker.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_smart_security_checker() {

	$plugin = new Smart_Security_Checker();
	$plugin->run();

}
run_smart_security_checker();


// Add a menu item to the WordPress admin menu
add_action('admin_menu', 'smart_security_checker_menu');

function smart_security_checker_menu() {
  add_menu_page('Smart Security Checker', 'Smart Security Checker', 'manage_options', 'Smart security-checker', 'smart_security_checker_page', 'dashicons-shield-alt', 99);
}

// Display the plugin page
function smart_security_checker_page() {
  if (!current_user_can('manage_options')) {
    wp_die(__('You do not have sufficient permissions to access this page.'));
  }
  echo '<div class="wrap">';
  echo '<h1>Smart Security Checker</h1>';
  echo '<p>Use this tool to check your site for malware and other security issues.</p>';
  echo '<form method="post" action="">';
  echo '<input type="submit" name="check_security" value="Check for Security Issues" class="button-primary" />';
  echo '</form>';
  echo '</div>';

  // Check for security issues if the form was submitted
  if (isset($_POST['check_security'])) {
    check_for_smart_security_issues();
  }
}

// Function to check for security issues
function check_for_smart_security_issues() {
  // Replace this with your own security checking code
  echo'<div class="notice notice-success"><p>No security issues found.</p></div>';
}