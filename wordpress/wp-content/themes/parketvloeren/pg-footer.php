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
                <ul class="pg-footer__links">
                    <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/over-ons' ) ); ?>">Over ons</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/services' ) ); ?>">Services</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/projecten' ) ); ?>">Projecten</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/contact' ) ); ?>">Contact</a></li>
                </ul>
            </div>
            <div class="pg-footer__col">
                <h4 class="pg-footer__heading">Contact info</h4>
                <address class="pg-footer__address">
                    <?php if ( ! empty( $address ) ) : ?>
                        <?php echo nl2br( esc_html( $address ) ); ?>
                    <?php endif; ?>
                </address>
                <ul class="pg-footer__contact">
                    <?php if ( ! empty( $email ) ) : ?>
                        <?php $safe_email = sanitize_email( $email ); ?>
                        <?php if ( $safe_email ) : ?>
                            <li>
                                <a href="mailto:<?php echo esc_attr( antispambot( $safe_email ) ); ?>">
                                    <?php echo esc_html( antispambot( $safe_email ) ); ?>
                                </a>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php if ( ! empty( $phone ) ) : ?>
                        <li>
                            <a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $phone ) ); ?>">
                                <?php echo esc_html( $phone ); ?>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="pg-footer__bottom">
        <div class="pg-footer__bottom-inner">
            <span>© Het Parket Gilde Alle Rechten Voorbehouden.</span>
        </div>
    </div>
</footer>