<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Read ACF from the page with slug "header".
$header_page = get_page_by_path( 'header' );
$settings_id = $header_page ? $header_page->ID : 0;

// Only these two fields + text for the button label.
$logo      = $settings_id ? get_field( 'header_logo', $settings_id ) : null; // Image array
$cta       = $settings_id ? get_field( 'header_cta', $settings_id ) : null;  // Link array
$cta_text  = $settings_id ? get_field( 'header_cta_text', $settings_id ) : ''; // Text

$site_name     = get_bloginfo( 'name' );
$logo_src      = is_array( $logo ) ? ( $logo['url'] ?? '' ) : '';
$logo_alt_text = is_array( $logo ) && ! empty( $logo['alt'] ) ? $logo['alt'] : $site_name;
?>
<header class="pg-header">
    <div class="pg-header__inner">

        <a class="pg-header__brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php echo esc_attr( $site_name ); ?>">
            <?php if ( $logo_src ) : ?>
                <img class="pg-header__logo-img" src="<?php echo esc_url( $logo_src ); ?>" alt="<?php echo esc_attr( $logo_alt_text ); ?>">
            <?php else : ?>
                <span class="pg-header__brand-text"><?php echo esc_html( $site_name ); ?></span>
            <?php endif; ?>
        </a>

        <button class="pg-header__mobile-toggle" aria-label="Toggle menu">
            <span></span><span></span><span></span>
        </button>

        <nav class="pg-header__nav pg-header__mobile-nav" aria-label="Hoofdmenu">
            <?php
            wp_nav_menu([
                'theme_location' => 'header_menu',
                'menu_class'     => 'pg-nav',
                'container'      => false,
                'fallback_cb'    => '__return_false',
            ]);
            ?>
        </nav>

        <?php if ( is_array( $cta ) && ! empty( $cta['url'] ) ) : ?>
            <div class="pg-header__cta">
                <a class="pg-btn pg-btn--header"
                   href="<?php echo esc_url( $cta['url'] ); ?>"
                   <?php echo ! empty( $cta['target'] ) ? 'target="' . esc_attr( $cta['target'] ) . '"' : ''; ?>>
                    <?php echo esc_html( $cta_text ?: ( $cta['title'] ?? '' ) ); ?>
                </a>
            </div>
        <?php endif; ?>

    </div>
</header>