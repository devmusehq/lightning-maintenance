<?php
/**
 * Plugin Name:       Lightning Maintenance
 * Plugin URI:        https://devmuse.co/plugins/lightning-maintenance
 * Description:       Blazing-fast, lightweight maintenance mode for WordPress. Proper 503 status, reliable test mode, and zero bloat.
 * Version:           1.0.1
 * Requires at least: 6.0
 * Tested up to:      7.0
 * Requires PHP:      7.4
 * Author:            DevMuse
 * Author URI:        https://devmuse.co
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       lightning-maintenance
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Plugin constants
define( 'LIGHTNING_MAINTENANCE_VERSION', '1.0.1' );
define( 'LIGHTNING_MAINTENANCE_FILE', __FILE__ );
define( 'LIGHTNING_MAINTENANCE_PATH', plugin_dir_path( __FILE__ ) );
define( 'LIGHTNING_MAINTENANCE_URL', plugin_dir_url( __FILE__ ) );
define( 'LIGHTNING_MAINTENANCE_BASENAME', plugin_basename( __FILE__ ) );

// Load core files
require_once LIGHTNING_MAINTENANCE_PATH . 'includes/class-lightning-maintenance.php';
require_once LIGHTNING_MAINTENANCE_PATH . 'includes/admin-settings.php';

// Initialize the plugin
function lightning_maintenance_init() {
    $plugin = new Lightning_Maintenance();
    $plugin->init();
}
add_action( 'plugins_loaded', 'lightning_maintenance_init' );

/**
 * Activation hook
 */
function lightning_maintenance_activate() {
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'lightning_maintenance_activate' );

/**
 * Deactivation hook
 */
function lightning_maintenance_deactivate() {
    delete_option( 'lightning_maintenance_settings' );
    flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'lightning_maintenance_deactivate' );