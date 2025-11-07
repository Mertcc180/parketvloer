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
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <?php
            $acf_title          = get_field( 'projecten_titel' );
            $acf_subtitle       = get_field( 'projecten_subtitel' );
            $raw_content        = get_the_content();
            $formatted_content  = $raw_content ? apply_filters( 'the_content', $raw_content ) : '';
            ?>
            <h1 class="pg-section__title"><?php echo esc_html( $acf_title ?: get_the_title() ); ?></h1>
            <?php if ( $acf_subtitle ) : ?>
                <p class="pg-section__intro pg-section__intro--subtitle"><?php echo esc_html( $acf_subtitle ); ?></p>
            <?php endif; ?>
            <?php if ( $formatted_content ) : ?>
                <div class="pg-section__intro"><?php echo wp_kses_post( $formatted_content ); ?></div>
            <?php endif; ?>
        <?php endwhile; wp_reset_postdata(); endif; ?>

        <?php
        $projecten = array();

        if ( have_rows( 'projecten' ) ) {
            while ( have_rows( 'projecten' ) ) {
                the_row();

                $afbeelding = get_sub_field( 'afbeelding' );
                $titel      = get_sub_field( 'titel' );

                if ( is_array( $afbeelding ) && ! empty( $afbeelding['url'] ) && $titel ) {
                    $projecten[] = array(
                        'afbeelding_url' => $afbeelding['url'],
                        'titel'          => $titel,
                    );
                }
            }
        }

        $project_groups   = array_chunk( $projecten, 6 );
        $heeft_projecten  = ! empty( $project_groups );
        $global_index     = 0;
        ?>

        <?php if ( $heeft_projecten ) : ?>
            <?php $global_index = 0; ?>
            <div class="pg-slider pg-projects__slider pg-projects__slider--desktop" data-per-desktop="1" data-per-tablet="1" data-per-mobile="1">
                <button class="pg-slider__nav pg-slider__nav--prev" type="button" aria-label="Vorige projecten">‹</button>
                <div class="pg-slider__viewport">
                    <div class="pg-slider__track">
                        <?php foreach ( $project_groups as $group ) : ?>
                            <div class="pg-slider__slide">
                                <div class="pg-grid pg-grid--3">
                                    <?php foreach ( $group as $project ) : ?>
                                        <div class="pg-project">
                                            <div
                                                class="pg-project__media pg-project__media--click"
                                                data-src="<?php echo esc_url( $project['afbeelding_url'] ); ?>"
                                                data-index="<?php echo esc_attr( $global_index ); ?>"
                                                style="background-image:url('<?php echo esc_url( $project['afbeelding_url'] ); ?>');"
                                                role="button"
                                                tabindex="0"
                                                aria-label="<?php echo esc_attr( sprintf( 'Open projectafbeelding %d', $global_index + 1 ) ); ?>"
                                            ></div>
                                            <div class="pg-project__title"><?php echo esc_html( $project['titel'] ); ?></div>
                                        </div>
                                        <?php $global_index++; ?>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <button class="pg-slider__nav pg-slider__nav--next" type="button" aria-label="Volgende projecten">›</button>
            </div>

            <?php $global_index = 0; ?>
            <div class="pg-slider pg-projects__slider pg-projects__slider--mobile" data-per-desktop="1" data-per-tablet="1" data-per-mobile="1">
                <button class="pg-slider__nav pg-slider__nav--prev" type="button" aria-label="Vorige project">‹</button>
                <div class="pg-slider__viewport">
                    <div class="pg-slider__track">
                        <?php foreach ( $projecten as $project ) : ?>
                            <div class="pg-slider__slide">
                                <div class="pg-project">
                                    <div
                                        class="pg-project__media pg-project__media--click"
                                        data-src="<?php echo esc_url( $project['afbeelding_url'] ); ?>"
                                        data-index="<?php echo esc_attr( $global_index ); ?>"
                                        style="background-image:url('<?php echo esc_url( $project['afbeelding_url'] ); ?>');"
                                        role="button"
                                        tabindex="0"
                                        aria-label="<?php echo esc_attr( sprintf( 'Open projectafbeelding %d', $global_index + 1 ) ); ?>"
                                    ></div>
                                    <div class="pg-project__title"><?php echo esc_html( $project['titel'] ); ?></div>
                                </div>
                            </div>
                            <?php $global_index++; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
                <button class="pg-slider__nav pg-slider__nav--next" type="button" aria-label="Volgende project">›</button>
            </div>
        <?php else : ?>
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