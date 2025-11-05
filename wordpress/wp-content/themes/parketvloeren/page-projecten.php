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
<!-- Gebruik externe stylesheet (geen inline CSS) -->
<link rel="stylesheet" href="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/css/home.css' ); ?>">
</head>
<body <?php body_class('pg-body'); ?>>
<?php wp_body_open(); ?>

<?php include locate_template('pg-header.php'); ?>

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
                    <div class="pg-project__media pg-project__media--click" data-src="<?php echo esc_url($afbeelding_url); ?>" data-index="<?php echo esc_attr($i); ?>" style="background-image:url('<?php echo esc_url($afbeelding_url); ?>');" role="button" tabindex="0" aria-label="Open afbeelding <?php echo esc_attr($i); ?>"></div>
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

<?php include locate_template('pg-footer.php'); ?>

<!-- Lightbox container (markup only, styling in CSS and behavior in external JS) -->
<div class="pg-lightbox" id="pgLightbox" aria-hidden="true">
    <div class="pg-lightbox__stage" role="dialog" aria-modal="true">
        <button class="pg-lightbox__close" id="pgLightboxClose" aria-label="Sluiten">✕</button>
        <div class="pg-lightbox__counter" id="pgLightboxCounter">0/0</div>
        <img src="" alt="Project afbeelding" class="pg-lightbox__img" id="pgLightboxImg">
        <div class="pg-lightbox__nav">
            <button class="pg-lightbox__arrow" id="pgLightboxPrev" aria-label="Vorige">‹</button>
            <button class="pg-lightbox__arrow" id="pgLightboxNext" aria-label="Volgende">›</button>
        </div>
    </div>
</div>

<!-- External lightbox script (geen inline JS) -->
<script src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/js/project-lightbox.js' ); ?>" defer></script>

<?php wp_footer(); ?>
</body>
</html>