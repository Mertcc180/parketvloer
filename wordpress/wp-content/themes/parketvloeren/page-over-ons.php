<?php 
/**
 * Template Name: Over Ons
 *
 * Custom "Over Ons" (About Us) page template.
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

<?php include locate_template('pg-header.php'); ?>

<main id="overons" class="pg-overons">
    <!-- Story Section -->
    <section class="pg-about-hero">
        <div class="pg-about-hero__inner">
            <h1 class="pg-about-hero__title">Ons Verhaal van Passie en Vakmanschap</h1>
            <p class="pg-about-hero__text">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's Lorem Ipsum is simply dummy text of the printing
            </p>
        </div>
    </section>

    <!-- Experience Section -->
    <section class="pg-about-section pg-about-experience">
        <div class="pg-about-section__inner">
            <div class="pg-about-section__content">
                <h2 class="pg-about-section__title">Onze Ervaring met Vloeren</h2>
                <div class="pg-about-experience__wrapper">
                    <div class="pg-about-experience__text">
                        <p class="pg-about-section__text">
                            Lorem ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing
                        </p>
                    </div>
                    <div class="pg-about-experience__image">
                        <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/project.png' ); ?>" alt="Parket vloer installatie">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission and Values Section -->
    <section class="pg-about-section pg-about-mission">
        <div class="pg-about-section__inner">
            <h2 class="pg-about-section__title">Onze Missie en Kernwaarden</h2>
            <p class="pg-about-section__text pg-about-section__text--centered">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's
            </p>
            
            <div class="pg-about-values">
                <div class="pg-about-value">
                    <div class="pg-about-value__icon">
                        <svg viewBox="0 0 24 24" width="32" height="32" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 22a10 10 0 1 0 0-20 10 10 0 0 0 0 20z"></path>
                            <path d="M12 16v-4"></path>
                            <path d="M12 8h.01"></path>
                        </svg>
                    </div>
                    <h3 class="pg-about-value__title">Betrouwbaarheid</h3>
                    <p class="pg-about-value__text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy</p>
                </div>
                <div class="pg-about-value">
                    <div class="pg-about-value__icon">
                        <svg viewBox="0 0 24 24" width="32" height="32" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 7h-9"></path>
                            <path d="M14 17H5"></path>
                            <circle cx="17" cy="17" r="3"></circle>
                            <circle cx="7" cy="7" r="3"></circle>
                        </svg>
                    </div>
                    <h3 class="pg-about-value__title">Vakmanschap</h3>
                    <p class="pg-about-value__text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy</p>
                </div>
                <div class="pg-about-value">
                    <div class="pg-about-value__icon">
                        <svg viewBox="0 0 24 24" width="32" height="32" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 7h-9"></path>
                            <path d="M14 17H5"></path>
                            <path d="M12 22l5-3 5 3V7l-5-3-5 3"></path>
                            <path d="M12 22V7"></path>
                            <path d="M7 7l5-3"></path>
                        </svg>
                    </div>
                    <h3 class="pg-about-value__title">Elegantie</h3>
                    <p class="pg-about-value__text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy</p>
                </div>
            </div>
        </div>
    </section>

    <section class="pg-section pg-cta">
        <div class="pg-section__inner">
            <h2 class="pg-section__title">Klaar voor een Prachtige Vloer?</h2>
            <p class="pg-cta__text">Neem contact met ons op voor advies of een gratis, vrijblijvende offerte.</p>
            <a class="pg-btn pg-btn--primary" href="<?php echo esc_url( home_url( '/contact' ) ); ?>">Vraag een Offerte Aan</a>
        </div>
    </section>
</main>

<?php include locate_template('pg-footer.php'); ?>

<?php wp_footer(); ?>
</body>
</html>