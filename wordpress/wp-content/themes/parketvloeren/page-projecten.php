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
<style>
/* Ensure our CSS is loaded */
@import url('<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/css/home.css' ); ?>');
</style>
</head>
<body <?php body_class('pg-body'); ?>>
<?php wp_body_open(); ?>

<?php include locate_template('pg-header.php'); ?>

<main class="pg-projects" style="padding-top:120px;">
    <div class="pg-section__inner">
        <?php
        // Haal de titel en subtitel uit ACF, met fallback tekst
        $projecten_titel = get_field('projecten_titel');
        $projecten_subtitel = get_field('projecten_subtitel');
        ?>
        <?php if($projecten_titel): ?>
            <h1 class="pg-section__title"><?php echo esc_html($projecten_titel); ?></h1>
        <?php endif; ?>
        <?php if($projecten_subtitel): ?>
            <p style="text-align:center; color:#b0b0b0; margin-bottom:2.5rem;"><?php echo esc_html($projecten_subtitel); ?></p>
        <?php endif; ?>
        <div class="pg-grid pg-grid--3">
            <?php
            $heeft_projecten = false;
            if( have_rows('projecten') ):
                $heeft_projecten = true;
                while( have_rows('projecten') ): the_row();
                    $afbeelding = get_sub_field('afbeelding');
                    $titel = get_sub_field('titel');
                    $afbeelding_url = '';
                    if (is_array($afbeelding) && !empty($afbeelding['url'])) {
                        $afbeelding_url = $afbeelding['url'];
                    }
                    if($afbeelding_url && $titel):
            ?>
                <div class="pg-project">
                    <div class="pg-project__media" style="background-image:url('<?php echo esc_url($afbeelding_url); ?>');"></div>
                    <div class="pg-project__title"><?php echo esc_html($titel); ?></div>
                </div>
            <?php
                    endif;
                endwhile;
            endif;
            ?>
        </div>
        <?php if(!$heeft_projecten): ?>
            <p style="text-align:center;">Nog geen projecten toegevoegd.</p>
        <?php endif; ?>
    </div>
</main>

<?php include locate_template('pg-footer.php'); ?>

<?php wp_footer(); ?>
</body>
</html>