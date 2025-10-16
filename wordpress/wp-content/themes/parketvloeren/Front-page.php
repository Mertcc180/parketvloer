<?php
/**
 * Template Name: Homepage
 *
 * Renders a bespoke landing page that matches the provided design mockup.
 * Uses existing Astra header/footer and provides full-width hero and
 * sectioned content with a dark theme and gold accents.
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
                <li class="pg-nav__item pg-nav__item--active">
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
                <li class="pg-nav__item">
                    <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>">Contact</a>
                </li>
            </ul>
        </nav>
        <div class="pg-header__cta">
            <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="pg-btn pg-btn--header">Offerte aanvragen</a>
        </div>
    </div>
</header>

<?php
// Asset base for local images (optional placeholders).
$theme_uri  = get_stylesheet_directory_uri();
$theme_dir  = get_stylesheet_directory();
// You can replace these files with your own images under assets/images/.
$hero_rel   = '/assets/images/home.png';
$proj1_rel  = '/assets/images/project.png';
$proj2_rel  = '/assets/images/project.png';
$proj3_rel  = '/assets/images/project.png';

// Build conditional inline styles so we gracefully fallback if images are absent.
$hero_style  = file_exists( $theme_dir . $hero_rel ) ? "--hero-bg:url('{$theme_uri}{$hero_rel}')" : '';
$proj1_style = file_exists( $theme_dir . $proj1_rel ) ? "--img:url('{$theme_uri}{$proj1_rel}')" : '';
$proj2_style = file_exists( $theme_dir . $proj2_rel ) ? "--img:url('{$theme_uri}{$proj2_rel}')" : '';
$proj3_style = file_exists( $theme_dir . $proj3_rel ) ? "--img:url('{$theme_uri}{$proj3_rel}')" : '';
?>

<main id="homepage" class="pg-home">
    <!-- Hero Section -->
    <section class="pg-hero" style="<?php echo esc_attr( $hero_style ); ?>">
        <div class="pg-hero__overlay"></div>
        <div class="pg-hero__inner">
            <h1 class="pg-hero__title">Unieke Parketvloeren voor Jouw Woonstijl</h1>
            <p class="pg-hero__subtitle">Stijl en Kwaliteit voor ieder Interieur</p>
            <div class="pg-hero__actions">
                <a href="<?php echo esc_url( home_url( '/diensten' ) ); ?>" class="pg-btn pg-btn--primary">Bekijk onze Services</a>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section class="pg-section pg-benefits">
        <div class="pg-section__inner">
            <h2 class="pg-section__title">Waarom Kiezen Voor Het Parket Gilde?</h2>
            <div class="pg-grid pg-grid--3">
                <div class="pg-card pg-benefit">
                    <div class="pg-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" width="32" height="32" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="6"/><path d="M8.5 14 7 22l5-2 5 2-1.5-8"/></svg>
                    </div>
                    <h3 class="pg-card__title">Ongeëvenaard Vakmanschap</h3>
                    <p class="pg-card__text">Onze ambachtslieden leveren precisie, detail en afwerking van topniveau bij elke installatie en renovatie.</p>
                </div>
                <div class="pg-card pg-benefit">
                    <div class="pg-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" width="32" height="32" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2l7 3v6c0 5-3.5 9-7 11-3.5-2-7-6-7-11V5l7-3z"/></svg>
                    </div>
                    <h3 class="pg-card__title">Duurzame Kwaliteit</h3>
                    <p class="pg-card__text">We werken met hoogwaardig, duurzaam hout en afwerkingen die jarenlang mooi blijven.</p>
                </div>
                <div class="pg-card pg-benefit">
                    <div class="pg-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" width="32" height="32" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.8 6.6a5 5 0 0 0-7.1 0L12 8.3l-1.7-1.7a5 5 0 0 0-7.1 7.1l8.8 8.8 8.8-8.8a5 5 0 0 0 0-7.1z"/></svg>
                    </div>
                    <h3 class="pg-card__title">Persoonlijke Aandacht</h3>
                    <p class="pg-card__text">Van advies tot oplevering: we denken mee, communiceren duidelijk en leveren volgens afspraak.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="pg-section pg-testimonials">
        <div class="pg-section__inner">
            <h2 class="pg-section__title">Wat onze Klanten Zeggen</h2>
            <div class="pg-grid pg-grid--3">
                <blockquote class="pg-quote">
                    <p>"Echte vakmensen. Strakke planning en een schitterend resultaat dat ons huis transformeerde."</p>
                    <footer>— M. Jansen</footer>
                </blockquote>
                <blockquote class="pg-quote">
                    <p>"Kundig advies en prachtige materialen. We zijn enorm blij met onze nieuwe visgraatvloer."</p>
                    <footer>— S. Bakker</footer>
                </blockquote>
                <blockquote class="pg-quote">
                    <p>"Transparant, vriendelijk en heel netjes gewerkt. Absolute aanrader!"</p>
                    <footer>— A. Bergman</footer>
                </blockquote>
            </div>
        </div>
    </section>

    <!-- Projects Section -->
    <section class="pg-section pg-projects">
        <div class="pg-section__inner">
            <h2 class="pg-section__title">Recente Projecten</h2>
            <div class="pg-grid pg-grid--3 pg-projects__grid">
                <article class="pg-project">
                    <div class="pg-project__media" style="<?php echo esc_attr( $proj1_style ); ?>"></div>
                    <h3 class="pg-project__title">Huis 1</h3>
                </article>
                <article class="pg-project">
                    <div class="pg-project__media" style="<?php echo esc_attr( $proj2_style ); ?>"></div>
                    <h3 class="pg-project__title">Huis 2</h3>
                </article>
                <article class="pg-project">
                    <div class="pg-project__media" style="<?php echo esc_attr( $proj3_style ); ?>"></div>
                    <h3 class="pg-project__title">Huis 3</h3>
                </article>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="pg-section pg-cta">
        <div class="pg-section__inner">
            <h2 class="pg-section__title">Klaar voor een Prachtige Vloer?</h2>
            <p class="pg-cta__text">Neem contact met ons op voor advies of een gratis, vrijblijvende offerte.</p>
            <a class="pg-btn pg-btn--primary" href="<?php echo esc_url( home_url( '/contact' ) ); ?>">Vraag een Offerte Aan</a>
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
                    <li><a href="<?php echo esc_url( home_url( '/diensten' ) ); ?>">Diensten</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/projecten' ) ); ?>">Projecten</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/contact' ) ); ?>">Contact</a></li>
                </ul>
            </div>
            <div class="pg-footer__col">
                <h4 class="pg-footer__heading">Contact info</h4>
                <address class="pg-footer__address">
                    <div>De Goorn</div>
                    <div>Regio Koggenland</div>
                    <div>Nederland</div>
                </address>
                <ul class="pg-footer__contact">
                    <li><a href="mailto:info@hetparketgilde.nl">info@hetparketgilde.nl</a></li>
                    <li><a href="tel:+31612345678">+31 6 12 34 56 78</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="pg-footer__bottom">
        <div class="pg-footer__bottom-inner">
            <span>© Het Parket Gilde. Alle Rechten Voorbehouden.</span>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
