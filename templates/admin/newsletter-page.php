<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$title = get_option(
    'epicurisme_newsletter_title',
    'Le Club Epicurisme'
);

$subtitle = get_option(
    'epicurisme_newsletter_subtitle',
    'Le City Guide chic des Epicuriens'
);

$intro_text = get_option(
    'epicurisme_newsletter_intro_text',
    ''
);

$instagram_url = get_option(
    'epicurisme_newsletter_instagram_url',
    ''
);

$status = isset( $_GET['newsletter_status'] )
    ? sanitize_key( wp_unslash( $_GET['newsletter_status'] ) )
    : '';

?>

<div class="wrap">
    <h1>Epicurisme Newsletter</h1>

<?php if ( 'settings_saved' === $status ) : ?>
        <div class="notice notice-success is-dismissible">
            <p>Newsletter settings saved.</p>
        </div>
    <?php endif; ?>

    <?php if ( 'email_sent' === $status ) : ?>
        <div class="notice notice-success is-dismissible">
            <p>
                Test newsletter sent successfully.
            </p>
        </div>
    <?php endif; ?>

    <?php if ( 'email_failed' === $status ) : ?>
        <div class="notice notice-error is-dismissible">
            <p>
                The test newsletter could not be sent.
            </p>
        </div>
    <?php endif; ?>

    <?php if ( 'invalid_email' === $status ) : ?>
        <div class="notice notice-error is-dismissible">
            <p>Please enter a valid email address.</p>
        </div>
    <?php endif; ?>

    <?php if ( 'newsletter_ready' === $status ) : ?>
        <div class="notice notice-info is-dismissible">
            <p>
                Newsletter sending handler is ready.
                Mailchimp campaign sending is not connected yet.
            </p>
        </div>
    <?php endif; ?>

    <?php if ( 'campaign_sent' === $status ) : ?>
        <div class="notice notice-success is-dismissible">
            <p>
                Newsletter sent successfully via Mailchimp.
            </p>
        </div>
    <?php endif; ?>

    <h2>Newsletter settings</h2>

    <form
        method="post"
        action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>"
    >
        <input
            type="hidden"
            name="action"
            value="epicurisme_save_newsletter_settings"
        >

        <?php
        wp_nonce_field(
            'epicurisme_save_newsletter_settings',
            'epicurisme_newsletter_settings_nonce'
        );
        ?>

        <table class="form-table">

            <tr>
                <th scope="row">
                    <label for="newsletter-title">
                        Title
                    </label>
                </th>

                <td>
                    <input
                        id="newsletter-title"
                        name="newsletter_title"
                        type="text"
                        class="regular-text"
                        value="<?php echo esc_attr( $title ); ?>"
                    >
                </td>
            </tr>

            <tr>
                <th scope="row">
                    <label for="newsletter-subtitle">
                        Subtitle
                    </label>
                </th>

                <td>
                    <input
                        id="newsletter-subtitle"
                        name="newsletter_subtitle"
                        type="text"
                        class="regular-text"
                        value="<?php echo esc_attr( $subtitle ); ?>"
                    >
                </td>
            </tr>

            <tr>
                <th scope="row">
                    <label for="newsletter-intro">
                        Intro text
                    </label>
                </th>

                <td>
                    <textarea
                        id="newsletter-intro"
                        name="newsletter_intro_text"
                        rows="5"
                        class="large-text"
                    ><?php echo esc_textarea( $intro_text ); ?></textarea>

                    <p class="description">
                        Optional text displayed before the latest articles.
                    </p>
                </td>
            </tr>

            <tr>
                <th scope="row">
                    <label for="newsletter-instagram">
                        Instagram URL
                    </label>
                </th>

                <td>
                    <input
                        id="newsletter-instagram"
                        name="newsletter_instagram_url"
                        type="url"
                        class="regular-text"
                        value="<?php echo esc_url( $instagram_url ); ?>"
                    >
                </td>
            </tr>

        </table>

        <?php submit_button( 'Save settings' ); ?>
    </form>

        <hr>

    <h2>Send newsletter</h2>

    <p>
        The newsletter will be sent to subscribers
        from the Mailchimp audience.
    </p>

    <table class="form-table">
        <tr>
            <th scope="row">
                Audience
            </th>

            <td>
                <strong>Newsletters</strong>
            </td>
        </tr>

        <tr>
            <th scope="row">
                Articles
            </th>

            <td>
                Latest 5 published articles
            </td>
        </tr>

        <tr>
            <th scope="row">
                From
            </th>

            <td>
                Le Club Epicurisme
                &lt;newsletter@epicurisme-mag.com&gt;
            </td>
        </tr>
    </table>

    <form
        method="post"
        action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>"
    >
        <input
            type="hidden"
            name="action"
            value="epicurisme_send_newsletter"
        >

        <?php
        wp_nonce_field(
            'epicurisme_send_newsletter',
            'epicurisme_send_newsletter_nonce'
        );
        ?>

        <?php
        submit_button(
            'Send newsletter',
            'primary',
            'submit',
            false,
            array(
            'onclick' => "return confirm('Envoyer cette newsletter à tous les abonnés Mailchimp ?');",
        )
        );
        ?>
    </form>

    <hr>

    <h2>Send test newsletter</h2>

    <form
        method="post"
        action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>"
    >
        <input
            type="hidden"
            name="action"
            value="epicurisme_send_test_newsletter"
        >

        <?php
        wp_nonce_field(
            'epicurisme_send_test_newsletter',
            'epicurisme_newsletter_nonce'
        );
        ?>

        <table class="form-table">
            <tr>
                <th scope="row">
                    <label for="test-email">
                        Test email
                    </label>
                </th>

                <td>
                    <input
                        id="test-email"
                        name="test_email"
                        type="email"
                        class="regular-text"
                        required
                    >
                </td>
            </tr>
        </table>

        <?php submit_button( 'Send test email' ); ?>
    </form>
</div>