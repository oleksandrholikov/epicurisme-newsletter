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

        add_action(
            'admin_post_epicurisme_send_test_newsletter',
            array($this, 'handle_send_test_newsletter')
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
         require EPICURISME_NEWSLETTER_PATH
        . 'templates/admin/newsletter-page.php';
    }

    public function handle_send_test_newsletter() {

    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( 'You are not allowed to perform this action.' );
    }

    check_admin_referer(
        'epicurisme_send_test_newsletter',
        'epicurisme_newsletter_nonce'
    );

    $email = isset( $_POST['test_email'] )
        ? sanitize_email( wp_unslash( $_POST['test_email'] ) )
        : '';

    if ( ! is_email( $email ) ) {
        wp_safe_redirect(
            add_query_arg(
                'newsletter_status',
                'invalid_email',
                admin_url( 'admin.php?page=epicurisme-newsletter' )
            )
        );

        exit;
    }

    wp_safe_redirect(
        add_query_arg(
            'newsletter_status',
            'success',
            admin_url( 'admin.php?page=epicurisme-newsletter' )
        )
    );

    exit;
}
}