<?php
/**
 * Template Name: Contact
 *
 * Custom "Contact" page template.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Resolve current page ID
$page_id = get_queried_object_id();

// Safe ACF getters
$has_acf = function_exists('get_field');

$hero_title   = $has_acf ? get_field('contact_hero_title', $page_id)   : '';
$form_title   = $has_acf ? get_field('contact_form_title', $page_id)   : '';
$form_sc      = $has_acf ? (string) get_field('contact_form_shortcode', $page_id) : '';
$form_id      = $has_acf ? (int) get_field('contact_form_id', $page_id) : 0;
if ( $form_id <= 0 ) { $form_id = 1; } // fallback als ACF veld ontbreekt

// Haal de losse velden rechtstreeks op (geen group)
$phone_label  = $has_acf ? (string) get_field('contact_phone_label',  $page_id) : '';
$phone        = $has_acf ? (string) get_field('contact_phone',        $page_id) : '';
$email_label  = $has_acf ? (string) get_field('contact_email_label',  $page_id) : '';
$email        = $has_acf ? (string) get_field('contact_email',        $page_id) : '';
$addr_label   = $has_acf ? (string) get_field('contact_address_label',$page_id) : '';
$address      = $has_acf ? (string) get_field('contact_address',      $page_id) : '';

// Fallback voor oude group 'contact_details' (optioneel)
if ( $has_acf && !$phone_label && !$phone && !$email_label && !$email && !$addr_label && !$address ) {
    $details = (array) get_field('contact_details', $page_id);
    $phone_label  = $details['contact_phone_label']   ?? '';
    $phone        = $details['contact_phone']         ?? '';
    $email_label  = $details['contact_email_label']   ?? '';
    $email        = $details['contact_email']         ?? '';
    $addr_label   = $details['contact_address_label'] ?? '';
    $address      = $details['contact_address']       ?? '';
}

$map_title = $has_acf ? get_field('contact_map_title', $page_id) : '';
$map_url   = $has_acf ? trim(get_field('contact_map', $page_id)) : '';
$map_embed = $has_acf ? trim(get_field('contact_map_embed', $page_id)) : ''; // <-- nieuw veld
// Allow only safe attributes for the iframe
$allowed_iframe = [
    'iframe' => [
        'src' => [], 'width' => [], 'height' => [], 'style' => [], 'loading' => [],
        'referrerpolicy' => [], 'allow' => [], 'allowfullscreen' => [], 'aria-hidden' => [],
        'tabindex' => [], 'frameborder' => []
    ],
];
// Breid toe om ook link en paragraaf toe te staan
$allowed_map = $allowed_iframe + [
    'a' => [ 'href' => [], 'target' => [], 'rel' => [], 'class' => [] ],
    'p' => [ 'class' => [] ],
];
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<!-- Verwijderd: inline @import; CSS wordt via functions.php geladen -->
</head>
<body <?php body_class('pg-body'); ?>>
<?php wp_body_open(); ?>

<!-- Custom Header Navigation -->
<header class="pg-header">
    <div class="pg-header__inner">
        <div class="pg-header__logo">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/logo2.png' ); ?>" alt="Het Parket Gilde Logo" class="pg-header__logo-img">
            </a>
        </div>
        <nav class="pg-header__nav">
            <ul class="pg-nav">
                <li class="pg-nav__item"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
                <li class="pg-nav__item"><a href="<?php echo esc_url( home_url( '/over-ons' ) ); ?>">Over ons</a></li>
                <li class="pg-nav__item"><a href="<?php echo esc_url( home_url( '/services' ) ); ?>">Services</a></li>
                <li class="pg-nav__item"><a href="<?php echo esc_url( home_url( '/projecten' ) ); ?>">Projecten</a></li>
                <li class="pg-nav__item pg-nav__item--active"><a href="<?php echo esc_url( home_url( '/contact' ) ); ?>">Contact</a></li>
            </ul>
        </nav>
        <div class="pg-header__cta">
            <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="pg-btn pg-btn--header">Offerte aanvragen</a>
        </div>
    </div>
</header>

<main id="contact" class="pg-contact">
    <section class="pg-contact-hero">
        <div class="pg-contact-hero__inner">
            <?php if ($hero_title): ?>
                <h1 class="pg-contact-hero__title"><?php echo esc_html($hero_title); ?></h1>
            <?php endif; ?>
        </div>
    </section>

    <section class="pg-contact-form">
        <div class="pg-contact-form__inner">
            <?php if ($form_title): ?>
                <h2 class="pg-contact-form__title"><?php echo esc_html($form_title); ?></h2>
            <?php endif; ?>

            <div class="pg-form">
                <?php
                // Render Ninja Forms zonder afhankelijk te zijn van een ACF-shortcode veld.
                $id = $form_id > 0 ? absint($form_id) : 1;
                $html = do_shortcode('[ninja_form id="' . $id . '"]');

                if ( trim( $html ) ) {
                    echo $html;
                } else {
                    echo '<p class="pg-form__notice">Formulier niet gevonden. Controleer of Ninja Forms actief is en het formulier-ID bestaat.</p>';
                }
                ?>
            </div>
        </div>
    </section>

    <section class="pg-contact-info">
        <div class="pg-contact-info__inner">
            <div class="pg-contact-details">
                <h2 class="pg-contact-details__title">Contactgegevens</h2>
                <ul class="pg-contact-details__list">
                    <?php if ($phone || $phone_label): ?>
                        <li class="pg-contact-details__item">
                            <i class="fa-solid fa-phone pg-contact-details__icon"></i>
                            <div class="pg-contact-details__content">
                                <?php if ($phone_label): ?>
                                    <span class="pg-contact-details__label"><?php echo esc_html($phone_label); ?></span>
                                <?php endif; ?>
                                <?php if ($phone): ?>
                                    <a href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', $phone)); ?>" class="pg-contact-details__value">
                                        <?php echo esc_html($phone); ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </li>
                    <?php endif; ?>

                    <?php if ($email || $email_label): ?>
                        <li class="pg-contact-details__item">
                            <i class="fa-solid fa-envelope pg-contact-details__icon"></i>
                            <div class="pg-contact-details__content">
                                <?php if ($email_label): ?>
                                    <span class="pg-contact-details__label"><?php echo esc_html($email_label); ?></span>
                                <?php endif; ?>
                                <?php if ($email): ?>
                                    <?php $safe_email = sanitize_email($email); ?>
                                    <?php if ($safe_email): ?>
                                        <a href="mailto:<?php echo esc_attr( antispambot($safe_email) ); ?>" class="pg-contact-details__value">
                                            <?php echo esc_html( antispambot($safe_email) ); ?>
                                        </a>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </li>
                    <?php endif; ?>

                    <?php if ($address || $addr_label): ?>
                        <li class="pg-contact-details__item">
                            <i class="fa-solid fa-location-dot pg-contact-details__icon"></i>
                            <div class="pg-contact-details__content">
                                <?php if ($addr_label): ?>
                                    <span class="pg-contact-details__label"><?php echo esc_html($addr_label); ?></span>
                                <?php endif; ?>
                                <?php if ($address): ?>
                                    <address class="pg-contact-details__value">
                                        <?php echo nl2br(esc_html($address)); ?>
                                    </address>
                                <?php endif; ?>
                            </div>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>

            <?php if ( !empty($map_embed) ) : ?>
                <div class="pg-contact-map">
                    <?php if ($map_title): ?>
                        <h2 class="pg-contact-map__title"><?php echo esc_html($map_title); ?></h2>
                    <?php endif; ?>
                    <div class="pg-contact-map__container">
                        <?php
                        // Alleen veilige iframe tonen
                        echo wp_kses($map_embed, $allowed_iframe);
                        ?>
                    </div>
                </div>
            <?php elseif ( !empty($map_url) ) : ?>
                <div class="pg-contact-map">
                    <?php if ($map_title): ?>
                        <h2 class="pg-contact-map__title"><?php echo esc_html($map_title); ?></h2>
                    <?php endif; ?>
                    <div class="pg-contact-map__container">
                        <?php
                        $embed_src = '';
                        if (strpos($map_url, 'google.com/maps') !== false || strpos($map_url, 'goo.gl/maps') !== false || strpos($map_url, 'maps.app.goo.gl') !== false) {
                            $embed_src = 'https://www.google.com/maps?q=' . rawurlencode($map_url) . '&output=embed';
                        }
                        if ($embed_src) {
                            echo '<iframe width="100%" height="400" style="border:0" loading="lazy" allowfullscreen referrerpolicy="no-referrer-when-downgrade" src="' . esc_url($embed_src) . '"></iframe>';
                            echo '<p class="pg-contact-map__link"><a href="' . esc_url($map_url) . '" target="_blank" rel="noopener">Open in Google Maps</a></p>';
                        } else {
                            echo '<p class="pg-form__notice">Ongeldige Google Maps link.</p>';
                        }
                        ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<!-- Footer Section -->
<footer class="pg-footer" role="contentinfo">
    <div class="pg-footer__inner">
        <div class="pg-footer__brand">
            <div class="pg-footer__logo" aria-hidden="true">
                <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/logo2.png' ); ?>" alt="Het Parket Gilde Logo" class="pg-footer__logo-img">
            </div>
        </div>
        <div class="pg-footer__cols">
            <div class="pg-footer__col">
                <ul class="pg-footer__links">
                    <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/over-ons' ) ); ?>">Over ons</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/services' ) ); ?>">Services</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/projecten' ) ); ?>">Projecten</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/contact' ) ); ?>">Contact</a></li>
                </ul>
            </div>
            <div class="pg-footer__col">
                <h4 class="pg-footer__heading">Contact info</h4>
                <address class="pg-footer__address">
                    <?php if ( ! empty( $address ) ) : ?>
                        <?php echo nl2br( esc_html( $address ) ); ?>
                    <?php endif; ?>
                </address>
                <ul class="pg-footer__contact">
                    <?php if ( ! empty( $email ) ) : ?>
                        <?php $safe_email = sanitize_email( $email ); ?>
                        <?php if ( $safe_email ) : ?>
                            <li>
                                <a href="mailto:<?php echo esc_attr( antispambot( $safe_email ) ); ?>">
                                    <?php echo esc_html( antispambot( $safe_email ) ); ?>
                                </a>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php if ( ! empty( $phone ) ) : ?>
                        <li>
                            <a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $phone ) ); ?>">
                                <?php echo esc_html( $phone ); ?>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="pg-footer__bottom">
        <div class="pg-footer__bottom-inner">
            <span>© Het Parket Gilde Alle Rechten Voorbehouden.</span>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>