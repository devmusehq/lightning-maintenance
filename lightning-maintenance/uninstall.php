<?php
/**
 * Lightning Maintenance - Uninstall
 *
 * Fired when the plugin is deleted from WordPress.
 */

// If uninstall is not called from WordPress, exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit;
}

// Delete all plugin settings
delete_option( 'lightning_maintenance_settings' );

// Clear any transients (future-proofing)
delete_transient( 'lightning_maintenance_status' );