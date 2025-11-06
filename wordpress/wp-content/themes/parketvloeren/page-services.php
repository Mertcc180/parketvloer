<?php
/**
 * Template Name: Services
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$page_id = get_queried_object_id();
$has_acf = function_exists('get_field');

$services_intro   = $has_acf ? get_field('services_intro', $page_id) : '';
$services_title   = $has_acf ? get_field('services_title', $page_id) : '';
$cta_title        = $has_acf ? get_field('cta_title', $page_id) : '';
$cta_text         = $has_acf ? get_field('cta_text', $page_id) : '';
$cta_button_text  = $has_acf ? get_field('cta_button_text', $page_id) : '';
$cta_button_url   = $has_acf ? get_field('cta_button_url', $page_id) : '';
$services_list    = $has_acf ? get_field('services_list', $page_id) : [];

$cta_text_clean   = is_string($cta_text) ? trim($cta_text) : '';
$show_cta_text    = $cta_text_clean !== '' && strcasecmp($cta_text_clean, 'Offerte aanvragen') !== 0;

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class('pg-body'); ?>>
<?php wp_body_open(); ?>
<?php include locate_template('pg-header.php'); ?>

<main class="services-main">
    <h2 class="services-title"><?php echo esc_html($services_title); ?></h2>
    <p class="services-intro"><?php echo esc_html($services_intro); ?></p>
    <div class="services-grid">
        <?php if (!empty($services_list)): ?>
            <?php foreach ($services_list as $idx => $service): ?>
                <?php
                    $service_detail_title = $service['service_detail_title'] ?? $service['service_title'] ?? '';
                    $service_anchor       = 'service-detail-' . $idx;
                ?>
                <a class="service-card" href="#<?php echo esc_attr($service_anchor); ?>">
                    <span class="service-icon">
                        <?php if (!empty($service['service_icon'])): ?>
                            <img src="<?php echo esc_url($service['service_icon']['url']); ?>" alt="<?php echo esc_attr($service['service_title']); ?>" />
                        <?php endif; ?>
                    </span>
                    <h3><?php echo esc_html($service['service_title'] ?? ''); ?></h3>
                    <p><?php echo esc_html($service['service_desc'] ?? ''); ?></p>
                </a>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <?php if (!empty($services_list)): ?>
        <div class="services-details">
            <?php foreach ($services_list as $idx => $service): ?>
                <?php
                    $service_detail_title = $service['service_detail_title'] ?? $service['service_title'] ?? '';
                    $service_detail_text  = $service['service_detail_text'] ?? $service['service_desc'] ?? '';
                    $service_detail_image = !empty($service['service_detail_image']['url']) ? $service['service_detail_image'] : null;
                    $service_anchor       = 'service-detail-' . $idx;
                ?>
                <section id="<?php echo esc_attr($service_anchor); ?>" class="service-detail-section service-card service-card--expanded service-card--row">
                    <?php if ($service_detail_image): ?>
                        <div class="service-detail-img">
                            <img src="<?php echo esc_url($service_detail_image['url']); ?>" alt="<?php echo esc_attr($service_detail_image['alt'] ?? $service_detail_title); ?>" />
                        </div>
                    <?php endif; ?>
                    <div class="service-detail-content">
                        <h3><?php echo esc_html($service_detail_title); ?></h3>
                        <?php if (!empty($service['service_detail_text'])): ?>
                            <?php echo wp_kses_post($service_detail_text); ?>
                        <?php elseif (!empty($service_detail_text)): ?>
                            <p><?php echo esc_html($service_detail_text); ?></p>
                        <?php endif; ?>
                    </div>
                </section>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="services-cta">
        <h4><?php echo esc_html($cta_title); ?></h4>
        <?php if ($show_cta_text): ?>
            <p><?php echo esc_html($cta_text_clean); ?></p>
        <?php endif; ?>
        <?php if ($cta_button_url && $cta_button_text): ?>
            <a href="<?php echo esc_url($cta_button_url); ?>" class="cta-btn"><?php echo esc_html($cta_button_text); ?></a>
        <?php endif; ?>
    </div>
</main>

<?php include locate_template('pg-footer.php'); ?>
<?php wp_footer(); ?>
</body>
</html>