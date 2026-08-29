<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Epicurisme_Newsletter_API {

    public function __construct() {
        add_action( 'rest_api_init', array( $this, 'register_routes' ) );
    }

    public function register_routes() {
        register_rest_route(
            'epicurisme-newsletter/v1',
            '/subscribe',
            array(
                'methods'             => 'POST',
                'callback'            => array( $this, 'subscribe' ),
                'permission_callback' => '__return_true',
            )
        );
    }

    public function subscribe( WP_REST_Request $request ) {
        $email   = sanitize_email( $request->get_param( 'email' ) );
        $consent = rest_sanitize_boolean( $request->get_param( 'consent' ) );

        if ( ! is_email( $email ) ) {
            return new WP_Error(
                'invalid_email',
                'Adresse e-mail invalide.',
                array( 'status' => 400 )
            );
        }

        if ( ! $consent ) {
            return new WP_Error(
                'consent_required',
                'Le consentement est requis.',
                array( 'status' => 400 )
            );
        }

        $mailchimp = new Epicurisme_Mailchimp_Service();

        $result = $mailchimp->subscribe( $email );

        if ( is_wp_error( $result ) ) {
            return $result;
        }

        return rest_ensure_response(
            array(
                'success' => true,
                'message' => 'Subscriber added to Mailchimp.',
                'status'  => $result['status'] ?? null,
            )
        );
    }
}