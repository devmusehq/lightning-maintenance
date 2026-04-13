<?php
/**
 * Lightning Maintenance - Maintenance Page Template
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Get settings
$lightning_maintenance_settings = Lightning_Maintenance::get_settings();

$lightning_maintenance_headline   = ! empty( $lightning_maintenance_settings['headline'] ) 
    ? $lightning_maintenance_settings['headline'] 
    : "We'll be back soon";

$lightning_maintenance_message    = ! empty( $lightning_maintenance_settings['message'] ) 
    ? $lightning_maintenance_settings['message'] 
    : 'This site is currently undergoing scheduled maintenance. Please check back soon.';

$lightning_maintenance_bg_color   = ! empty( $lightning_maintenance_settings['bg_color'] ) 
    ? $lightning_maintenance_settings['bg_color'] 
    : '#ffffff';

$lightning_maintenance_text_color = ! empty( $lightning_maintenance_settings['text_color'] ) 
    ? $lightning_maintenance_settings['text_color'] 
    : '#1e1e1e';

$lightning_maintenance_logo_id    = ! empty( $lightning_maintenance_settings['logo_id'] ) 
    ? absint( $lightning_maintenance_settings['logo_id'] ) 
    : 0;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo esc_html( get_bloginfo( 'name' ) ); ?> — Maintenance</title>
   
    <?php wp_head(); ?>
   
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background-color: <?php echo esc_attr( $lightning_maintenance_bg_color ); ?>;
            color: <?php echo esc_attr( $lightning_maintenance_text_color ); ?>;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            text-align: center;
            line-height: 1.6;
        }
        
        .maintenance-container {
            max-width: 600px;
            padding: 60px 30px;
            border-radius: 16px;
            background-color: rgba(255,255,255,0.65);
            box-shadow: 0 10px 40px rgba(0,0,0,0.08);
        }
        
        .logo {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 60px auto;
            max-width: 100%;
        }
        
        .maintenance-logo {
            max-height: 260px;
            width: auto;
            height: auto;
            display: block;
            object-fit: contain;
        }
        
        h1 {
            font-size: 2.6rem;
            margin-bottom: 28px;
            font-weight: 600;
            line-height: 1.2;
            max-width: 100%;
        }
        
        .message {
            font-size: 1.22rem;
            margin-bottom: 40px;
            opacity: 0.92;
            line-height: 1.65;
            max-width: 100%;
        }
        
        .admin-notice {
            margin-top: 60px;
            font-size: 0.96rem;
            opacity: 0.72;
            line-height: 1.5;
        }
        
        /* Mobile adjustments */
        @media (max-width: 480px) {
            .maintenance-container {
                padding: 40px 20px;
                border-radius: 12px;
            }
            .maintenance-logo {
                max-height: 180px;
            }
            h1 {
                font-size: 2.2rem;
            }
        }
    </style>
</head>
<body>
    <div class="maintenance-container">
       
        <?php if ( $lightning_maintenance_logo_id ) : ?>
            <div class="logo">
                <?php 
                echo wp_get_attachment_image( 
                    $lightning_maintenance_logo_id, 
                    'medium', 
                    false, 
                    array( 
                        'class' => 'maintenance-logo',
                        'alt'   => get_bloginfo( 'name' ) . ' — Maintenance'
                    ) 
                ); 
                ?>
            </div>
        <?php endif; ?>
        
        <h1><?php echo esc_html( $lightning_maintenance_headline ); ?></h1>
        <div class="message">
            <?php echo wp_kses_post( $lightning_maintenance_message ); ?>
        </div>
        
        <?php if ( current_user_can( 'manage_options' ) ) : ?>
            <div class="admin-notice">
                <strong>Admin:</strong> You are seeing this because Test Mode is active.<br>
                <a href="<?php echo esc_url( admin_url( 'admin.php?page=lightning-maintenance' ) ); ?>">Manage Settings →</a>
            </div>
        <?php endif; ?>
    </div>
    
    <?php wp_footer(); ?>
</body>
</html>