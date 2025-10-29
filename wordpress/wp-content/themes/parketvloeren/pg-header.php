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
        <nav class="pg-header__nav">
            <ul class="pg-nav">
                <li class="pg-nav__item<?php if (is_front_page()) echo ' pg-nav__item--active'; ?>"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
                <li class="pg-nav__item<?php if (is_page('over-ons')) echo ' pg-nav__item--active'; ?>"><a href="<?php echo esc_url( home_url( '/over-ons' ) ); ?>">Over ons</a></li>
                <li class="pg-nav__item<?php if (is_page('services') || is_page('diensten')) echo ' pg-nav__item--active'; ?>"><a href="<?php echo esc_url( home_url( '/services' ) ); ?>">Services</a></li>
                <li class="pg-nav__item<?php if (is_page('projecten')) echo ' pg-nav__item--active'; ?>"><a href="<?php echo esc_url( home_url( '/projecten' ) ); ?>">Projecten</a></li>
                <li class="pg-nav__item<?php if (is_page('contact')) echo ' pg-nav__item--active'; ?>"><a href="<?php echo esc_url( home_url( '/contact' ) ); ?>">Contact</a></li>
            </ul>
        </nav>
        <div class="pg-header__cta">
            <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="pg-btn pg-btn--header">Offerte aanvragen</a>
        </div>
    </div>
</header>