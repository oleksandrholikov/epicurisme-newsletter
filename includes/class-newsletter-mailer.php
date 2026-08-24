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
}