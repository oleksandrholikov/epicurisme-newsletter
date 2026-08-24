<?php 

if(!defined('ABSPATH')){
    exit;
}

class Epicurisme_Newsletter_Admin {
    public function __construct() {
        add_action(
            'admin_menu',
            array($this, 'register_admin_menu')
        );
    }

    public function register_admin_menu() {
        add_menu_page(
            'Epicurisme Newsletter',
            'Newsletter',
            'manage_options',
            'epicurisme-newsletter',
            array( $this, 'render_admin_page' ),
            'dashicons-email-alt',
            30
        );
    }

    public function render_admin_page(){
        ?>
        <div class="wrap">
            <h1>Epicurisme Newsletter</h1>
            <p>Newsletter management for Epicurisme Mag.</p>
        </div>
        <?php
    }
}