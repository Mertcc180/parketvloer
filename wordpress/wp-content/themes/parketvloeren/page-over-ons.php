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
            <h1 class="pg-about-hero__title"><?php echo esc_html(get_field('hero_title')); ?></h1>
            <p class="pg-about-hero__text">
                <?php echo esc_html(get_field('hero_text')); ?>
            </p>
        </div>
    </section>

    <!-- Experience Section -->
    <section class="pg-about-section pg-about-experience">
        <div class="pg-about-section__inner">
            <div class="pg-about-section__content">
                <h2 class="pg-about-section__title"><?php echo esc_html(get_field('ervaring_title')); ?></h2>
                <div class="pg-about-experience__wrapper">
                    <div class="pg-about-experience__text">
                        <p class="pg-about-section__text">
                            <?php echo esc_html(get_field('ervaring_text')); ?>
                        </p>
                    </div>
                    <div class="pg-about-experience__image">
                        <?php 
                        $img = get_field('ervaring_afbeelding');
                        if ($img) {
                            echo '<img src="' . esc_url($img['url']) . '" alt="' . esc_attr($img['alt']) . '">';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission and Values Section -->
    <section class="pg-about-section pg-about-mission">
        <div class="pg-about-section__inner">
            <h2 class="pg-about-section__title"><?php echo esc_html( get_field( 'missie_title' ) ); ?></h2>
            <p class="pg-about-section__text pg-about-section__text--centered">
                <?php echo esc_html( get_field( 'missie_text' ) ); ?>
            </p>

            <?php 
    $kernwaarden       = function_exists( 'get_field' ) ? get_field( 'kernwaarden' ) : [];
    $kernwaarden_count = is_array( $kernwaarden ) ? count( $kernwaarden ) : 0;
?>
            <?php if ( $kernwaarden_count > 0 ) : ?>
                <div class="pg-about-values-slider<?php echo $kernwaarden_count <= 3 ? ' pg-about-values-slider--static' : ''; ?>" data-total="<?php echo esc_attr( $kernwaarden_count ); ?>">
                    <button class="pg-about-values__nav pg-about-values__nav--prev" type="button" aria-label="<?php esc_attr_e( 'Vorige kernwaarden', 'parketvloeren' ); ?>" <?php echo $kernwaarden_count <= 3 ? 'disabled aria-disabled="true"' : ''; ?>>
                        <span aria-hidden="true">‹</span>
                    </button>
                    <div class="pg-about-values-slider__viewport">
                        <div class="pg-about-values">
                            <?php foreach ( $kernwaarden as $kernwaarde ) : ?>
                                <div class="pg-about-value">
                                    <div class="pg-about-value__icon">
                                        <?php
                                        $icon = $kernwaarde['icon_svg'] ?? null;
                                        if ( $icon && isset( $icon['url'] ) ) {
                                            printf(
                                                '<img src="%1$s" alt="%2$s" class="pg-icon" />',
                                                esc_url( $icon['url'] ),
                                                esc_attr( $icon['alt'] ?? '' )
                                            );
                                        }
                                        ?>
                                    </div>
                                    <h3 class="pg-about-value__title"><?php echo esc_html( $kernwaarde['kernwaarde_title'] ?? '' ); ?></h3>
                                    <p class="pg-about-value__text"><?php echo esc_html( $kernwaarde['kernwaarde_text'] ?? '' ); ?></p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <button class="pg-about-values__nav pg-about-values__nav--next" type="button" aria-label="<?php esc_attr_e( 'Volgende kernwaarden', 'parketvloeren' ); ?>" <?php echo $kernwaarden_count <= 3 ? 'disabled aria-disabled="true"' : ''; ?>>
                        <span aria-hidden="true">›</span>
                    </button>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <section class="pg-section pg-cta">
        <div class="pg-section__inner">
            <h2 class="pg-section__title"><?php echo esc_html(get_field('cta_title')); ?></h2>
            <p class="pg-cta__text"><?php echo esc_html(get_field('cta_text')); ?></p>
            <a class="pg-btn pg-btn--primary" href="<?php echo esc_url(get_field('cta_link')); ?>">
                <?php echo esc_html(get_field('cta_btn_text')); ?>
            </a>
        </div>
    </section>
</main>

<?php include locate_template('pg-footer.php'); ?>

<?php wp_footer(); ?>
</body>
</html>