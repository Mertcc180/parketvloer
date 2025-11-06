<?php
// Prevent double render if this file gets included more than once.
if ( defined( 'PG_CUSTOM_FOOTER_RENDERED' ) ) { return; }
define( 'PG_CUSTOM_FOOTER_RENDERED', true );

if ( ! defined( 'ABSPATH' ) ) { exit; }

// Always get fields from the "Footer" page
$footer_page = get_page_by_path('footer');
if ($footer_page) {
    $logo      = get_field('footer_logo', $footer_page->ID);
    $address   = get_field('footer_address', $footer_page->ID);
    $email     = get_field('footer_email', $footer_page->ID);
    $phone     = get_field('footer_phone', $footer_page->ID);
    $copyright = get_field('footer_copyright', $footer_page->ID);
} else {
    $logo = $address = $email = $phone = $copyright = '';
}
?>
<footer class="pg-footer" role="contentinfo">
    <div class="pg-footer__inner">
        <div class="pg-footer__brand">
            <div class="pg-footer__logo" aria-hidden="true">
                <?php if ($logo): ?>
                    <img src="<?php echo esc_url(is_array($logo) ? ($logo['url'] ?? '') : $logo); ?>" alt="Footer Logo" class="pg-footer__logo-img">
                <?php endif; ?>
            </div>
        </div>
        <div class="pg-footer__cols">
            <div class="pg-footer__col">
                <?php
                wp_nav_menu([
                    'theme_location' => 'footer_menu',
                    'menu_class'     => 'pg-footer__links',
                    'container'      => false,
                ]);
                ?>
            </div>
            <div class="pg-footer__col">
                <h4 class="pg-footer__heading">Contact info</h4>
                <address class="pg-footer__address">
                    <?php if ($address): ?><div><?php echo esc_html($address); ?></div><?php endif; ?>
                    <?php if ($email): ?><div><a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></div><?php endif; ?>
                    <?php if ($phone): ?><div><a href="tel:<?php echo esc_attr($phone); ?>"><?php echo esc_html($phone); ?></a></div><?php endif; ?>
                </address>
            </div>
        </div>
    </div>
    <div class="pg-footer__bottom">
        <div class="pg-footer__bottom-inner">
            <span><?php echo esc_html($copyright); ?></span>
        </div>
    </div>
</footer>
<?php get_footer(); ?>