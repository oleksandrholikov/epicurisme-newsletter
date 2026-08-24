<?php

/**
 * Plugin Name: Epicurisme Newsletter
 * Description: Newsletter management for Epicurisme Mag.
 * Version: 1.0.0
 * Author: Oleksandr Holikov
 * Text Domain: epicurisme-newsletter
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once plugin_dir_path( __FILE__ )
    . 'includes/class-newsletter-admin.php';

new Epicurisme_Newsletter_Admin();