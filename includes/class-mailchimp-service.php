<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Epicurisme_Mailchimp_Service {

    private string $api_key;
    private string $audience_id;
    private string $server_prefix;

    public function __construct() {
        $this->api_key       = defined( 'EPICURISME_MAILCHIMP_API_KEY' )
            ? EPICURISME_MAILCHIMP_API_KEY
            : '';

        $this->audience_id   = defined( 'EPICURISME_MAILCHIMP_AUDIENCE_ID' )
            ? EPICURISME_MAILCHIMP_AUDIENCE_ID
            : '';

        $this->server_prefix = defined( 'EPICURISME_MAILCHIMP_SERVER_PREFIX' )
            ? EPICURISME_MAILCHIMP_SERVER_PREFIX
            : '';
    }

    public function subscribe( string $email ) {
        if (
            empty( $this->api_key ) ||
            empty( $this->audience_id ) ||
            empty( $this->server_prefix )
        ) {
            return new WP_Error(
                'mailchimp_config_missing',
                'Mailchimp configuration is missing.'
            );
        }

        $email = strtolower( trim( $email ) );

        $subscriber_hash = md5( $email );

        $url = sprintf(
            'https://%s.api.mailchimp.com/3.0/lists/%s/members/%s',
            $this->server_prefix,
            $this->audience_id,
            $subscriber_hash
        );

        $response = wp_remote_request(
            $url,
            array(
                'method'  => 'PUT',
                'headers' => array(
                    'Authorization' => 'Basic ' . base64_encode(
                        'epicurisme:' . $this->api_key
                    ),
                    'Content-Type'  => 'application/json',
                ),
                'body' => wp_json_encode(
                    array(
                        'email_address' => $email,
                        'status_if_new' => 'subscribed',
                    )
                ),
                'timeout' => 15,
            )
        );

        if ( is_wp_error( $response ) ) {
            return $response;
        }

        $status_code = wp_remote_retrieve_response_code( $response );
        $body = json_decode(
            wp_remote_retrieve_body( $response ),
            true
        );

        if ( $status_code < 200 || $status_code >= 300 ) {
            return new WP_Error(
                'mailchimp_error',
                $body['detail'] ?? 'Mailchimp request failed.',
                array(
                    'status' => $status_code,
                )
            );
        }

        return $body;
    }
}