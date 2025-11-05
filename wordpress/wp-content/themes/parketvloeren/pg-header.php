<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>
<header class="pg-header">
    <div class="pg-header__inner">
        <div class="pg-header__logo">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/logo2.png' ); ?>" alt="Het Parket Gilde Logo" class="pg-header__logo-img">
            </a>
        </div>

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

        <div class="pg-header__cta">
            <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="pg-btn pg-btn--header">Offerte aanvragen</a>
        </div>
    </div>
</header>