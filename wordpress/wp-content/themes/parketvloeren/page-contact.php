<?php
/**
 * Template Name: Contact
 *
 * Custom "Contact" page template.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
<style>
/* Ensure our CSS is loaded */
@import url('<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/css/home.css' ); ?>');
</style>
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
                <li class="pg-nav__item">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a>
                </li>
                <li class="pg-nav__item">
                    <a href="<?php echo esc_url( home_url( '/over-ons' ) ); ?>">Over ons</a>
                </li>
                <li class="pg-nav__item">
                    <a href="<?php echo esc_url( home_url( '/diensten' ) ); ?>">Services</a>
                </li>
                <li class="pg-nav__item">
                    <a href="<?php echo esc_url( home_url( '/projecten' ) ); ?>">Projecten</a>
                </li>
                <li class="pg-nav__item pg-nav__item--active">
                    <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>">Contact</a>
                </li>
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
            <h1 class="pg-contact-hero__title">Neem Contact Op</h1>
        </div>
    </section>

    <section class="pg-contact-form">
        <div class="pg-contact-form__inner">
            <h2 class="pg-contact-form__title">Stuur ons een bericht</h2>
            
            <form class="pg-form" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
                <div class="pg-form__group">
                    <label for="naam" class="pg-form__label">Naam</label>
                    <input type="text" id="naam" name="naam" class="pg-form__input" required>
                </div>
                
                <div class="pg-form__group">
                    <label for="email" class="pg-form__label">E-mail</label>
                    <input type="email" id="email" name="email" class="pg-form__input" required>
                </div>
                
                <div class="pg-form__group">
                    <label for="onderwerp" class="pg-form__label">Onderwerp</label>
                    <input type="text" id="onderwerp" name="onderwerp" class="pg-form__input" required>
                </div>
                
                <div class="pg-form__group">
                    <label for="bericht" class="pg-form__label">Bericht</label>
                    <textarea id="bericht" name="bericht" class="pg-form__textarea" rows="6" required></textarea>
                </div>
                
                <button type="submit" class="pg-form__submit pg-btn pg-btn--gold">Verstuur Bericht</button>
                
                <input type="hidden" name="action" value="submit_contact_form">
                <?php wp_nonce_field('contact_form_submission', 'contact_form_nonce'); ?>
            </form>
        </div>
    </section>
    
    <section class="pg-contact-info">
        <div class="pg-contact-info__inner">
            <div class="pg-contact-details">
                <h2 class="pg-contact-details__title">Contactgegevens</h2>
                <ul class="pg-contact-details__list">
                    <li class="pg-contact-details__item pg-contact-details__item--phone">
                        <span class="pg-contact-details__label">Telefoon</span>
                        <a href="tel:0224751129" class="pg-contact-details__value">0224751129</a>
                    </li>
                    <li class="pg-contact-details__item pg-contact-details__item--email">
                        <span class="pg-contact-details__label">E-mail</span>
                        <a href="mailto:info@hetparketgilde.nl" class="pg-contact-details__value">info@hetparketgilde.nl</a>
                    </li>
                    <li class="pg-contact-details__item pg-contact-details__item--address">
                        <span class="pg-contact-details__label">Adres</span>
                        <address class="pg-contact-details__value">
                            De dijken, 7CT7A7 EE Tuitjenhorn
                        </address>
                    </li>
                </ul>
            </div>
            
            <div class="pg-contact-map">
                <h2 class="pg-contact-map__title">Onze Locatie</h2>
                <div class="pg-contact-map__container">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d38768.90808928117!2d4.710732476513671!3d52.75797300000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47cf5a37a4b4dadb%3A0xec89cdd3778516a0!2sTuitjenhorn!5e0!3m2!1snl!2snl!4v1697494369527!5m2!1snl!2snl" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
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
                    <li><a href="<?php echo esc_url( home_url( '/diensten' ) ); ?>">Services</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/projecten' ) ); ?>">Projecten</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/contact' ) ); ?>">Contact</a></li>
                </ul>
            </div>
            <div class="pg-footer__col">
                <h4 class="pg-footer__heading">Contact info</h4>
                <address class="pg-footer__address">
                    <div>De dijken</div>
                    <div>7CT7A7 EE Tuitjenhorn</div>
                    <div>Nederland</div>
                </address>
                <ul class="pg-footer__contact">
                    <li><a href="mailto:info@hetparketgilde.nl">info@hetparketgilde.nl</a></li>
                    <li><a href="tel:0224751129">0224751129</a></li>
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