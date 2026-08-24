<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( empty( $newsletter_posts ) || ! is_array( $newsletter_posts ) ) {
    return;
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

$instagram_icon = EPICURISME_NEWSLETTER_URL
    . 'assets/images/instagram.png';

?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo esc_html( $title ); ?></title>
</head>

<body
    style="
        margin: 0;
        padding: 0;
        background-color: #f5f3f0;
        font-family: Arial, Helvetica, sans-serif;
        color: #111111;
    "
>

<table
    role="presentation"
    width="100%"
    cellpadding="0"
    cellspacing="0"
    border="0"
    style="
        width: 100%;
        background-color: #f5f3f0;
        margin: 0;
        padding: 0;
    "
>
    <tr>
        <td
            align="center"
            style="
                padding: 32px 16px;
            "
        >

            <table
                role="presentation"
                width="600"
                cellpadding="0"
                cellspacing="0"
                border="0"
                style="
                    width: 100%;
                    max-width: 600px;
                    background-color: #ffffff;
                    border-collapse: collapse;
                "
            >

                <!-- HEADER -->
                <tr>
                    <td
                        align="center"
                        style="
                            padding: 40px 24px 20px;
                        "
                    >
                        <h1
                            style="
                                margin: 0;
                                font-family: Georgia, 'Times New Roman', serif;
                                font-size: 36px;
                                line-height: 1.1;
                                font-weight: 700;
                                color: #111111;
                            "
                        >
                            <?php echo esc_html( $title ); ?>
                        </h1>
                    </td>
                </tr>

                <tr>
                    <td
                        align="center"
                        style="
                            padding: 0 24px 32px;
                        "
                    >
                        <p
                            style="
                                margin: 0;
                                font-family: Georgia, 'Times New Roman', serif;
                                font-size: 18px;
                                line-height: 1.5;
                                font-style: italic;
                                color: #444444;
                            "
                        >
                            <?php echo esc_html( $subtitle ); ?>
                        </p>
                    </td>
                </tr>
                <!--DESCRIPTION -->
                <?php if ( ! empty( $intro_text ) ) : ?>
                    <tr>
                        <td
                            align="center"
                            style="
                                padding: 0 32px 32px;
                            "
                        >
                            <p
                                style="
                                    margin: 0;
                                    font-size: 15px;
                                    line-height: 1.6;
                                    color: #555555;
                                "
                            >
                                <?php echo nl2br( esc_html( $intro_text ) ); ?>
                            </p>
                        </td>
                    </tr>
                <?php endif; ?>

                <!-- ACCENT LINE -->
                <tr>
                    <td
                        align="center"
                        style="
                            padding: 0 24px 36px;
                        "
                    >
                        <table
                            role="presentation"
                            width="90"
                            cellpadding="0"
                            cellspacing="0"
                            border="0"
                            style="
                                width: 90px;
                                border-collapse: collapse;
                            "
                        >
                            <tr>
                                <td
                                    style="
                                        height: 2px;
                                        background-color: #de9366;
                                        font-size: 0;
                                        line-height: 0;
                                    "
                                >
                                    &nbsp;
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <!-- SECTION TITLE -->
                <tr>
                    <td
                        align="center"
                        style="
                            padding: 0 24px 32px;
                        "
                    >
                        <h2
                            style="
                                margin: 0;
                                font-size: 20px;
                                line-height: 1.3;
                                font-weight: 700;
                                letter-spacing: 0.12em;
                                text-transform: uppercase;
                                color: #111111;
                            "
                        >
                            Les derniers articles
                        </h2>
                    </td>
                </tr>

                <!-- ARTICLES -->
                <?php foreach ( $newsletter_posts as $post ) : ?>

                    <tr>
                        <td
                            style="
                                padding: 0 24px 40px;
                            "
                        >

                            <table
                                role="presentation"
                                width="100%"
                                cellpadding="0"
                                cellspacing="0"
                                border="0"
                                style="
                                    width: 100%;
                                    border-collapse: collapse;
                                "
                            >

                                <!-- IMAGE -->
                                <tr>
                                    <td
                                        style="
                                            padding: 0;
                                        "
                                    >
                                        <a
                                            href="<?php echo esc_url( $post['url'] ); ?>"
                                            style="
                                                display: block;
                                                text-decoration: none;
                                            "
                                        >
                                            <img
                                                src="<?php echo esc_url( $post['image'] ); ?>"
                                                alt="<?php echo esc_attr( $post['title'] ); ?>"
                                                width="552"
                                                style="
                                                    width: 100%;
                                                    max-width: 552px;
                                                    height: auto;
                                                    display: block;
                                                    border: 0;
                                                    outline: none;
                                                    text-decoration: none;
                                                "
                                            >
                                        </a>
                                    </td>
                                </tr>

                                <!-- CATEGORY -->
                                <?php if ( ! empty( $post['category'] ) ) : ?>
                                    <tr>
                                        <td
                                            style="
                                                padding: 16px 0 8px;
                                            "
                                        >
                                            <span
                                                style="
                                                    display: inline-block;
                                                    padding: 4px 8px;
                                                    background-color: #111111;
                                                    color: #ffffff;
                                                    font-size: 11px;
                                                    line-height: 1.2;
                                                    font-weight: 700;
                                                    letter-spacing: 0.12em;
                                                    text-transform: uppercase;
                                                "
                                            >
                                                <?php echo esc_html( $post['category'] ); ?>
                                            </span>
                                        </td>
                                    </tr>
                                <?php endif; ?>

                                <!-- TITLE -->
                                <tr>
                                    <td
                                        style="
                                            padding: 4px 0 20px;
                                        "
                                    >
                                        <h3
                                            style="
                                                margin: 0;
                                                font-family: Georgia, 'Times New Roman', serif;
                                                font-size: 26px;
                                                line-height: 1.25;
                                                font-weight: 700;
                                                color: #111111;
                                            "
                                        >
                                            <a
                                                href="<?php echo esc_url( $post['url'] ); ?>"
                                                style="
                                                    color: #111111;
                                                    text-decoration: none;
                                                "
                                            >
                                                <?php echo esc_html( $post['title'] ); ?>
                                            </a>
                                        </h3>
                                    </td>
                                </tr>

                                <!-- BUTTON -->
                                <tr>
                                    <td
                                        style="
                                            padding: 0 0 8px;
                                        "
                                    >
                                        <table
                                            role="presentation"
                                            cellpadding="0"
                                            cellspacing="0"
                                            border="0"
                                            style="
                                                border-collapse: collapse;
                                            "
                                        >
                                            <tr>
                                                <td
                                                    bgcolor="#111111"
                                                    style="
                                                        background-color: #111111;
                                                    "
                                                >
                                                    <a
                                                        href="<?php echo esc_url( $post['url'] ); ?>"
                                                        style="
                                                            display: inline-block;
                                                            padding: 12px 18px;
                                                            color: #ffffff;
                                                            font-size: 13px;
                                                            line-height: 1;
                                                            font-weight: 700;
                                                            letter-spacing: 0.08em;
                                                            text-transform: uppercase;
                                                            text-decoration: none;
                                                        "
                                                    >
                                                        Lire l’article →
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                                <!-- SEPARATOR -->
                                <tr>
                                    <td
                                        style="
                                            padding-top: 32px;
                                        "
                                    >
                                        <table
                                            role="presentation"
                                            width="100%"
                                            cellpadding="0"
                                            cellspacing="0"
                                            border="0"
                                            style="
                                                width: 100%;
                                                border-collapse: collapse;
                                            "
                                        >
                                            <tr>
                                                <td
                                                    style="
                                                        height: 1px;
                                                        background-color: #e5e5e5;
                                                        font-size: 0;
                                                        line-height: 0;
                                                    "
                                                >
                                                    &nbsp;
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>

                            </table>

                        </td>
                    </tr>

                <?php endforeach; ?>

                <!-- FOOTER -->
                <tr>
                    <td
                        align="center"
                        style="
                            padding: 36px 24px 16px;
                            background-color: #111111;
                        "
                    >
                        <p
                            style="
                                margin: 0 0 12px;
                                font-family: Georgia, 'Times New Roman', serif;
                                font-size: 22px;
                                line-height: 1.2;
                                color: #ffffff;
                            "
                        >
                            Epicurisme Mag
                        </p>

                        <p
                            style="
                                margin: 0 0 22px;
                                font-size: 13px;
                                line-height: 1.5;
                                color: #d6d6d6;
                            "
                        >
                           <?php echo esc_html( $subtitle ); ?>
                        </p>

                        <?php if ( ! empty( $instagram_url ) ) : ?>
                                <a
                                    href="<?php echo esc_url( $instagram_url ); ?>"
                                    style="
                                        display: inline-block;
                                        text-decoration: none;
                                    "
                                >
                                    <img
                                        src="<?php echo esc_url( $instagram_icon ); ?>"
                                        alt="Instagram"
                                        width="24"
                                        height="24"
                                        style="
                                            display: block;
                                            border: 0;
                                        "
                                    >
                                </a>
                        <?php endif; ?>
                        
                    </td>
                </tr>

                <tr>
                    <td
                        align="center"
                        style="
                            padding: 16px 24px 28px;
                            background-color: #111111;
                        "
                    >
                        <p
                            style="
                                margin: 0;
                                font-size: 11px;
                                line-height: 1.5;
                                color: #8f8f8f;
                            "
                        >
                            Vous recevez cet e-mail parce que vous êtes inscrit au Club Epicurisme.
                        </p>
                    </td>
                </tr>

            </table>

        </td>
    </tr>
</table>

</body>
</html>