<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Astra
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>
<?php astra_content_bottom(); ?>
	</div> <!-- ast-container -->
	</div><!-- #content -->
<?php
	astra_content_after();

	// Custom footer matching the provided mockup.
	astra_footer_before();
?>
	<footer class="pg-footer" role="contentinfo">
		<div class="pg-footer__inner">
			<div class="pg-footer__brand">
				<div class="pg-footer__logo" aria-hidden="true">
					<svg viewBox="0 0 64 64" width="44" height="44" fill="none" stroke="currentColor" stroke-width="1.5">
						<rect x="6" y="6" width="52" height="52" rx="10" ry="10" fill="currentColor" opacity="0.1" />
						<path d="M20 40c10-4 14-10 12-20M32 20h12M24 28h18" />
					</svg>
				</div>
				<div class="pg-footer__sitename">Het Parket Gilde</div>
			</div>

			<div class="pg-footer__cols">
				<div class="pg-footer__col">
					<h4 class="pg-footer__heading">Home</h4>
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
				<span>© Het Parket Gilde. Alle Rechten Voorbehouden.</span>
			</div>
		</div>
	</footer>
<?php
	astra_footer_after();
?>
	</div><!-- #page -->
<?php
	astra_body_bottom();
	wp_footer();
?>
	</body>
</html>