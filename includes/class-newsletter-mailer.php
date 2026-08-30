<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Epicurisme_Newsletter_Mailer {

    public function render_template( $newsletter_posts ) {

        ob_start();

        require EPICURISME_NEWSLETTER_PATH
            . 'templates/email/newsletter.php';

        return ob_get_clean();
    }

    // public function get_html( $newsletter_posts ) {
    //     return $this->render_template( $newsletter_posts );
    // }

    public function send_test( $email, $newsletter_posts ) {

        $subject = 'Le Club Epicurisme';

        $html = $this->render_template( $newsletter_posts );

        $headers = array(
            'Content-Type: text/html; charset=UTF-8',
        );

        return wp_mail(
            $email,
            $subject,
            $html,
            $headers
        );
    }
}