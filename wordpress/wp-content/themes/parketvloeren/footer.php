<?php
/**
 * The template for displaying the footer.
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
    astra_footer_before();

    // Include your custom ACF-powered footer once
    if ( ! defined( 'PG_CUSTOM_FOOTER_RENDERED' ) ) {
        locate_template( [ 'pg-footer.php' ], true, false );
    }

    astra_footer_after();
?>
    </div><!-- #page -->
<?php
    astra_body_bottom();
    wp_footer();
?>
    </body>
</html>