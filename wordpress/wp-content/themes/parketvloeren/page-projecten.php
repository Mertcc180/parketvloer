<?php 
/**
 * Template Name: Projecten
 *
 * Custom "Projecten" page template.
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

<!-- Custom Header Navigation (copy from front-page.php) -->
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
                <li class="pg-nav__item pg-nav__item--active">
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

<main class="pg-projects" style="padding-top:120px;">
    <div class="pg-section__inner">
        <h1 class="pg-section__title">Onze Projecten</h1>
        <p style="text-align:center; color:#b0b0b0; margin-bottom:2.5rem;">Neem een kijkje in ons recente werk</p>
        <div class="pg-grid pg-grid--3">
            <?php
            $heeft_projecten = false;
            for($i = 1; $i <= 6; $i++) {
                $afbeelding = get_field('afbeelding_' . $i);
                $titel = get_field('titel_' . $i);
                $afbeelding_url = '';
                if (is_array($afbeelding) && !empty($afbeelding['url'])) {
                    $afbeelding_url = $afbeelding['url'];
                }
                if($afbeelding_url && $titel):
                    $heeft_projecten = true;
            ?>
                <div class="pg-project">
                    <div class="pg-project__media" style="background-image:url('<?php echo esc_url($afbeelding_url); ?>');"></div>
                    <div class="pg-project__title"><?php echo esc_html($titel); ?></div>
                </div>
            <?php
                endif;
            }
            ?>
        </div>
        <?php if(!$heeft_projecten): ?>
            <p style="text-align:center;">Nog geen projecten toegevoegd.</p>
        <?php endif; ?>
    </div>
</main>

<!-- Footer Section (copy from front-page.php) -->
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
            <span>©️ Het Parket Gilde. Alle Rechten Voorbehouden.</span>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>