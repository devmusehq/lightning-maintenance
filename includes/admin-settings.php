<?php
/**
 * Admin Settings for Lightning Maintenance
 *
 * @package Lightning_Maintenance
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Lightning_Maintenance_Admin {

    public function init() {
        add_action( 'admin_menu', array( $this, 'add_settings_page' ) );
        add_action( 'admin_init', array( $this, 'register_settings' ) );
        add_action( 'wp_dashboard_setup', array( $this, 'add_dashboard_widget' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_assets' ) );
    }

    public function add_settings_page() {
        add_menu_page(
            __( 'Lightning Maintenance', 'lightning-maintenance' ),
            __( 'Maintenance', 'lightning-maintenance' ),
            'manage_options',
            'lightning-maintenance',
            array( $this, 'render_settings_page' ),
            LIGHTNING_MAINTENANCE_URL . 'assets/images/lightning-maintenance-icon.png',
            81
        );
    }

    public function register_settings() {
        register_setting(
            'lightning_maintenance_settings_group',
            'lightning_maintenance_settings',
            array( $this, 'sanitize_settings' )
        );

        // Status Section
        add_settings_section(
            'lightning_maintenance_status_section',
            __( 'Status', 'lightning-maintenance' ),
            null,
            'lightning-maintenance'
        );

        add_settings_field(
            'enabled',
            __( 'Maintenance Mode', 'lightning-maintenance' ),
            array( $this, 'field_enabled' ),
            'lightning-maintenance',
            'lightning_maintenance_status_section'
        );

        add_settings_field(
            'test_mode',
            __( 'Test Mode (Preview)', 'lightning-maintenance' ),
            array( $this, 'field_test_mode' ),
            'lightning-maintenance',
            'lightning_maintenance_status_section'
        );

        // Appearance Section
        add_settings_section(
            'lightning_maintenance_appearance_section',
            __( 'Appearance', 'lightning-maintenance' ),
            null,
            'lightning-maintenance'
        );

        add_settings_field(
            'logo_id',
            __( 'Logo', 'lightning-maintenance' ),
            array( $this, 'field_logo' ),
            'lightning-maintenance',
            'lightning_maintenance_appearance_section'
        );

        add_settings_field(
            'headline',
            __( 'Headline', 'lightning-maintenance' ),
            array( $this, 'field_headline' ),
            'lightning-maintenance',
            'lightning_maintenance_appearance_section'
        );

        add_settings_field(
            'message',
            __( 'Message', 'lightning-maintenance' ),
            array( $this, 'field_message' ),
            'lightning-maintenance',
            'lightning_maintenance_appearance_section'
        );

        add_settings_field(
            'bg_color',
            __( 'Background Colour', 'lightning-maintenance' ),
            array( $this, 'field_bg_color' ),
            'lightning-maintenance',
            'lightning_maintenance_appearance_section'
        );

        add_settings_field(
            'text_color',
            __( 'Text Colour', 'lightning-maintenance' ),
            array( $this, 'field_text_color' ),
            'lightning-maintenance',
            'lightning_maintenance_appearance_section'
        );
    }

    public function sanitize_settings( $input ) {
        $output = array();

        $output['enabled']    = ! empty( $input['enabled'] );
        $output['test_mode']  = ! empty( $input['test_mode'] );

        $output['headline']   = sanitize_text_field( $input['headline'] ?? "We'll be back soon" );
        $output['message']    = wp_kses_post( $input['message'] ?? '' );
        $output['logo_id']    = absint( $input['logo_id'] ?? 0 );

        $output['bg_color']   = sanitize_hex_color( $input['bg_color'] ?? '#ffffff' );
        $output['text_color'] = sanitize_hex_color( $input['text_color'] ?? '#1e1e1e' );

        return $output;
    }

    public function render_settings_page() {
        ?>
        <div class="wrap">
            <div style="margin-bottom: 25px;">
                <img src="<?php echo esc_url( LIGHTNING_MAINTENANCE_URL . 'assets/images/lm-logo.png' ); ?>" 
                     alt="Lightning Maintenance" 
                     style="max-height: 68px; width: auto;">
            </div>
            <h1 style="margin: 0 0 8px 0;">Lightning Maintenance</h1>
            <p class="description">Blazing-fast. Dead simple. Zero bloat.</p>

            <!-- Settings API automatically adds nonce + referer verification via settings_fields() -->
            <form method="post" action="options.php">
                <?php
                settings_fields( 'lightning_maintenance_settings_group' );
                do_settings_sections( 'lightning-maintenance' );
                submit_button( __( 'Save Settings', 'lightning-maintenance' ) );
                ?>
            </form>

            <hr style="margin: 35px 0 25px 0;">

            <h2>Quick Help</h2>
            <p><strong>Test Mode:</strong> When enabled, only logged-in admins will see the maintenance page. Use this to safely preview before going live.</p>
            <p><strong>Emergency Exit:</strong> If ever locked out, visit 
                <code><?php echo esc_url( wp_nonce_url( home_url( '/?exit-maintenance=1' ), 'lightning_maintenance_emergency_exit' ) ); ?></code>
            </p>
        </div>
        <?php
    }

    public function field_enabled() {
        $settings = get_option( 'lightning_maintenance_settings', array() );
        $enabled  = ! empty( $settings['enabled'] );
        ?>
        <label class="switch">
            <input type="checkbox" 
                   name="lightning_maintenance_settings[enabled]" 
                   value="1" 
                   <?php checked( $enabled ); ?>>
            <span class="slider round"></span>
        </label>
        <?php
    }

    public function field_test_mode() {
        $settings   = get_option( 'lightning_maintenance_settings', array() );
        $test_mode  = ! empty( $settings['test_mode'] );
        ?>
        <label class="switch">
            <input type="checkbox" 
                   name="lightning_maintenance_settings[test_mode]" 
                   value="1" 
                   <?php checked( $test_mode ); ?>>
            <span class="slider round"></span>
        </label>
        <span class="description"><?php esc_html_e( 'Only admins see the maintenance page (safe preview)', 'lightning-maintenance' ); ?></span>
        <?php
    }

    public function field_headline() {
        $settings = get_option( 'lightning_maintenance_settings', array() );
        $value    = isset( $settings['headline'] ) ? $settings['headline'] : "We'll be back soon";
        ?>
        <input type="text" 
               name="lightning_maintenance_settings[headline]" 
               value="<?php echo esc_attr( $value ); ?>" 
               class="regular-text">
        <?php
    }

    public function field_message() {
        $settings = get_option( 'lightning_maintenance_settings', array() );
        $value    = isset( $settings['message'] ) ? $settings['message'] : 'This site is currently undergoing scheduled maintenance. Please check back soon.';
        ?>
        <textarea name="lightning_maintenance_settings[message]" 
                  rows="4" 
                  cols="60" 
                  class="large-text"><?php echo esc_textarea( $value ); ?></textarea>
        <?php
    }

    public function field_logo() {
        $settings = get_option( 'lightning_maintenance_settings', array() );
        $logo_id  = isset( $settings['logo_id'] ) ? absint( $settings['logo_id'] ) : 0;
        ?>
        <input type="hidden" 
               name="lightning_maintenance_settings[logo_id]" 
               id="lightning_logo_id" 
               value="<?php echo esc_attr( $logo_id ); ?>">

        <button type="button" class="button button-primary" id="lightning_upload_logo">
            <?php esc_html_e( 'Choose Logo from Media Library', 'lightning-maintenance' ); ?>
        </button>

        <button type="button" class="button" id="lightning_remove_logo" 
                style="<?php echo $logo_id ? '' : 'display:none;'; ?>">
            <?php esc_html_e( 'Remove Logo', 'lightning-maintenance' ); ?>
        </button>

        <div id="lightning_logo_preview" style="margin-top:15px;">
            <?php
            if ( $logo_id ) {
                echo wp_get_attachment_image(
                    $logo_id,
                    'medium',
                    false,
                    array( 'style' => 'max-height:140px; width:auto;' )
                );
            }
            ?>
        </div>

        <script>
        jQuery(document).ready(function($) {
            var file_frame;

            $('#lightning_upload_logo').on('click', function(e) {
                e.preventDefault();

                if ( file_frame ) {
                    file_frame.open();
                    return;
                }

                file_frame = wp.media({
                    title: '<?php esc_html_e( "Select or Upload Logo", "lightning-maintenance" ); ?>',
                    button: { text: '<?php esc_html_e( "Use this image", "lightning-maintenance" ); ?>' },
                    multiple: false
                });

                file_frame.on('select', function() {
                    var attachment = file_frame.state().get('selection').first().toJSON();
                    $('#lightning_logo_id').val(attachment.id);
                    $('#lightning_logo_preview').html('<img src="' + attachment.url + '" style="max-height:140px; width:auto;" />');
                    $('#lightning_remove_logo').show();
                });

                file_frame.open();
            });

            $('#lightning_remove_logo').on('click', function() {
                $('#lightning_logo_id').val('');
                $('#lightning_logo_preview').html('');
                $(this).hide();
            });
        });
        </script>
        <?php
    }

    public function field_bg_color() {
        $settings = get_option( 'lightning_maintenance_settings', array() );
        $color    = isset( $settings['bg_color'] ) ? $settings['bg_color'] : '#ffffff';
        ?>
        <input type="text" 
               name="lightning_maintenance_settings[bg_color]" 
               id="lightning_bg_color" 
               value="<?php echo esc_attr( $color ); ?>" 
               class="lightning-color-picker">
        <?php
    }

    public function field_text_color() {
        $settings = get_option( 'lightning_maintenance_settings', array() );
        $color    = isset( $settings['text_color'] ) ? $settings['text_color'] : '#1e1e1e';
        ?>
        <input type="text" 
               name="lightning_maintenance_settings[text_color]" 
               id="lightning_text_color" 
               value="<?php echo esc_attr( $color ); ?>" 
               class="lightning-color-picker">
        <?php
    }

    public function add_dashboard_widget() {
        wp_add_dashboard_widget(
            'lightning_maintenance_dashboard',
            __( 'Lightning Maintenance', 'lightning-maintenance' ),
            array( $this, 'render_dashboard_widget' )
        );
    }

    public function render_dashboard_widget() {
        $settings   = get_option( 'lightning_maintenance_settings', array() );
        $is_enabled = ! empty( $settings['enabled'] );

        ?>
        <p>
            <strong>Current Status:</strong><br>
            <?php if ( $is_enabled ) : ?>
                <span style="color:#d63638; font-weight: 600;">Maintenance Mode Active</span>
            <?php else : ?>
                <span style="color:#00a32a; font-weight: 600;">Site is Live</span>
            <?php endif; ?>
        </p>

        <a href="<?php echo esc_url( admin_url( 'admin.php?page=lightning-maintenance' ) ); ?>" class="button button-primary">
            Manage Settings
        </a>

        <p style="margin-top: 25px; padding-top: 15px; border-top: 1px solid #eee; color: #777; font-size: 13px;">
            Made with ❤️ by <a href="https://devmuse.co" target="_blank" style="color: #2271b1; text-decoration: none;">DevMuse</a>
        </p>
        <?php
    }

    public function enqueue_assets( $hook ) {
        if ( 'toplevel_page_lightning-maintenance' !== $hook ) {
            return;
        }

        wp_enqueue_media();
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_script( 'wp-color-picker' );

        wp_enqueue_style(
            'lightning-maintenance-admin',
            LIGHTNING_MAINTENANCE_URL . 'assets/css/admin.css',
            array( 'wp-color-picker' ),
            LIGHTNING_MAINTENANCE_VERSION
        );

        // Initialize color pickers
        wp_add_inline_script( 'wp-color-picker', '
            jQuery(document).ready(function($) {
                $(".lightning-color-picker").wpColorPicker();
            });
        ' );
    }
}

// Initialize
$lightning_maintenance_admin = new Lightning_Maintenance_Admin();
$lightning_maintenance_admin->init();