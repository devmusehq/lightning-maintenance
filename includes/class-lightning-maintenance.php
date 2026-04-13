<?php
/**
 * Core Lightning Maintenance Class
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Lightning_Maintenance {

    public function init() {
        add_action( 'template_redirect', array( $this, 'maybe_activate_maintenance' ), 1 );
        add_action( 'admin_bar_menu', array( $this, 'add_admin_bar_status' ), 999 );
        add_action( 'init', array( $this, 'handle_emergency_exit' ) );
    }

    public function handle_emergency_exit() {
        if ( ! isset( $_GET['exit-maintenance'] ) || ! current_user_can( 'manage_options' ) ) {
            return;
        }

        // Verify nonce for security
        if ( ! wp_verify_nonce( isset( $_GET['_wpnonce'] ) ? sanitize_text_field( wp_unslash( $_GET['_wpnonce'] ) ) : '', 'lightning_maintenance_emergency_exit' ) ) {
            wp_die( esc_html__( 'Nonce verification failed.', 'lightning-maintenance' ), '', array( 'response' => 403 ) );
        }

        $settings = get_option( 'lightning_maintenance_settings', array() );
        $settings['enabled']   = false;
        $settings['test_mode'] = false;
        update_option( 'lightning_maintenance_settings', $settings );

        wp_safe_redirect( admin_url( 'admin.php?page=lightning-maintenance' ) );
        exit;
    }

    public function maybe_activate_maintenance() {
        $settings     = get_option( 'lightning_maintenance_settings', array() );
        $is_enabled   = ! empty( $settings['enabled'] );
        $is_test_mode = ! empty( $settings['test_mode'] );

        if ( ! $is_enabled && ! $is_test_mode ) {
            return;
        }

        if ( $is_test_mode ) {
            if ( current_user_can( 'manage_options' ) ) {
                $this->activate_maintenance_mode();
            }
            return;
        }

        if ( $is_enabled ) {
            if ( current_user_can( 'manage_options' ) ) {
                return; // Admins see live site when real maintenance is active
            }
            $this->activate_maintenance_mode();
        }
    }

    private function activate_maintenance_mode() {
        status_header( 503 );
        nocache_headers();
        header( 'Retry-After: 86400' );

        $template = LIGHTNING_MAINTENANCE_PATH . 'templates/maintenance.php';
        if ( file_exists( $template ) ) {
            include $template;
        } else {
            wp_die(
                esc_html__( 'This site is currently undergoing maintenance. Please check back soon.', 'lightning-maintenance' ),
                esc_html__( 'Maintenance Mode', 'lightning-maintenance' ),
                array( 'response' => 503 )
            );
        }
        exit;
    }

    public function add_admin_bar_status( $wp_admin_bar ) {
        if ( ! current_user_can( 'manage_options' ) ) {
            return;
        }

        $settings   = get_option( 'lightning_maintenance_settings', array() );
        $is_enabled = ! empty( $settings['enabled'] );
        $is_test    = ! empty( $settings['test_mode'] );

        $status = 'Live';
        $class  = 'live';

        if ( $is_enabled ) {
            $status = 'Maintenance Active';
            $class  = 'maintenance';
        } elseif ( $is_test ) {
            $status = 'Test Mode Active';
            $class  = 'test';
        }

        $title = '<span class="' . esc_attr( $class ) . '">● ' . esc_html( $status ) . '</span>';

        $wp_admin_bar->add_node( array(
            'id'    => 'lightning-maintenance-status',
            'title' => $title,
            'href'  => admin_url( 'admin.php?page=lightning-maintenance' ),
        ) );
    }

    public static function get_settings() {
        $defaults = array(
            'enabled'    => false,
            'test_mode'  => false,
            'headline'   => "We'll be back soon",
            'message'    => 'This site is currently undergoing scheduled maintenance. Please check back soon.',
            'logo_id'    => 0,
            'bg_color'   => '#ffffff',
            'text_color' => '#1e1e1e'
        );

        $settings = get_option( 'lightning_maintenance_settings', array() );
        return wp_parse_args( $settings, $defaults );
    }
}