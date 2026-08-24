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

define(
    'EPICURISME_NEWSLETTER_PATH',
    plugin_dir_path( __FILE__ )
);

require_once EPICURISME_NEWSLETTER_PATH
    . 'includes/class-newsletter-admin.php';

new Epicurisme_Newsletter_Admin();