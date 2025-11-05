<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
?>
<footer class="pg-footer" role="contentinfo">
    <div class="pg-footer__inner">
        <div class="pg-footer__brand">
            <div class="pg-footer__logo" aria-hidden="true">
                <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/logo2.png' ); ?>" alt="Het Parket Gilde Logo" class="pg-footer__logo-img">
            </div>
        </div>
        <div class="pg-footer__cols">
            <div class="pg-footer__col">
                <?php
                wp_nav_menu([
                    'theme_location' => 'footer_menu',
                    'menu_class'     => 'pg-footer__links',
                    'container'      => false
                ]);
                ?>
            </div>
            <div class="pg-footer__col">
                <h4 class="pg-footer__heading">Contact info</h4>
                <address class="pg-footer__address">
                    <div>De dijken, 7C1747 EE Tuitjenhorn</div>
                    <div><a href="mailto:info@hetparketgilde.nl">info@hetparketgilde.nl</a></div>
                    <div><a href="tel:0224751129">0224751129</a></div>
                </address>
            </div>
        </div>
    </div>
    <div class="pg-footer__bottom">
        <div class="pg-footer__bottom-inner">
            <span>© Het Parket Gilde. Alle Rechten Voorbehouden.</span>
        </div>
    </div>
</footer>