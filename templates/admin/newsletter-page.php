<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

?>

<div class="wrap">
    <h1>Epicurisme Newsletter</h1>

    <p>
        Send a test newsletter to a selected email address.
    </p>

    <?php
    $status = isset( $_GET['newsletter_status'] )
        ? sanitize_key( wp_unslash( $_GET['newsletter_status'] ) )
        : '';
    ?>

    <?php if ( 'success' === $status ) : ?>
        <div class="notice notice-success is-dismissible">
            <p>
                Test email address validated successfully.
            </p>
        </div>
    <?php endif; ?>

    <?php if ( 'invalid_email' === $status ) : ?>
        <div class="notice notice-error is-dismissible">
            <p>
                Please enter a valid email address.
            </p>
        </div>
    <?php endif; ?>
    
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

        <?php
        submit_button(
            'Send test email'
        );
        ?>
    </form>
</div>