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

        add_action(
            'admin_post_epicurisme_save_newsletter_settings',
            array( $this, 'handle_save_newsletter_settings' )
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

    $posts_service = new Epicurisme_Newsletter_Posts();

    $newsletter_posts = $posts_service->get_newsletter_posts( 5 );

    $mailer = new Epicurisme_Newsletter_Mailer();

    $html = $mailer->render_template(
        $newsletter_posts
    );

    wp_safe_redirect(
        add_query_arg(
            'newsletter_status',
            'success',
            admin_url( 'admin.php?page=epicurisme-newsletter' )
        )
    );

    exit;
    }

    public function handle_save_newsletter_settings() {

        if ( ! current_user_can( 'manage_options' ) ) {
            wp_die( 'You are not allowed to perform this action.' );
        }

        check_admin_referer(
            'epicurisme_save_newsletter_settings',
            'epicurisme_newsletter_settings_nonce'
        );

        $title = isset( $_POST['newsletter_title'] )
            ? sanitize_text_field(
                wp_unslash( $_POST['newsletter_title'] )
            )
            : '';

        $subtitle = isset( $_POST['newsletter_subtitle'] )
            ? sanitize_text_field(
                wp_unslash( $_POST['newsletter_subtitle'] )
            )
            : '';

        $intro_text = isset( $_POST['newsletter_intro_text'] )
            ? sanitize_textarea_field(
                wp_unslash( $_POST['newsletter_intro_text'] )
            )
            : '';

        $instagram_url = isset( $_POST['newsletter_instagram_url'] )
            ? esc_url_raw(
                wp_unslash( $_POST['newsletter_instagram_url'] )
            )
            : '';

        update_option(
            'epicurisme_newsletter_title',
            $title
        );

        update_option(
            'epicurisme_newsletter_subtitle',
            $subtitle
        );

        update_option(
            'epicurisme_newsletter_intro_text',
            $intro_text
        );

        update_option(
            'epicurisme_newsletter_instagram_url',
            $instagram_url
        );

        wp_safe_redirect(
            add_query_arg(
                'newsletter_status',
                'settings_saved',
                admin_url( 'admin.php?page=epicurisme-newsletter' )
            )
        );

        exit;
    }
}