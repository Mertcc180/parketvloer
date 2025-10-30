<?php
/**
 * Template Name: Services
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

$page_id = get_queried_object_id();
$has_acf = function_exists('get_field');

$services_intro   = $has_acf ? get_field('services_intro', $page_id) : '';
$service1_title   = $has_acf ? get_field('service1_title', $page_id) : '';
$service1_desc    = $has_acf ? get_field('service1_desc', $page_id) : '';
$service2_title   = $has_acf ? get_field('service2_title', $page_id) : '';
$service2_desc    = $has_acf ? get_field('service2_desc', $page_id) : '';
$service3_title   = $has_acf ? get_field('service3_title', $page_id) : '';
$service3_desc    = $has_acf ? get_field('service3_desc', $page_id) : '';
$service4_title   = $has_acf ? get_field('service4_title', $page_id) : '';
$service4_desc    = $has_acf ? get_field('service4_desc', $page_id) : '';
$service5_title   = $has_acf ? get_field('service5_title', $page_id) : '';
$service5_desc    = $has_acf ? get_field('service5_desc', $page_id) : '';
$service6_title   = $has_acf ? get_field('service6_title', $page_id) : '';
$service6_desc    = $has_acf ? get_field('service6_desc', $page_id) : '';
$cta_title        = $has_acf ? get_field('cta_title', $page_id) : '';
$cta_text         = $has_acf ? get_field('cta_text', $page_id) : '';
$cta_button_text  = $has_acf ? get_field('cta_button_text', $page_id) : '';
$cta_button_url   = $has_acf ? get_field('cta_button_url', $page_id) : '';
$services_title   = $has_acf ? get_field('services_title', $page_id) : '';
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body <?php body_class('pg-body'); ?>>
<?php wp_body_open(); ?>
<?php include locate_template('pg-header.php'); ?>

<main class="services-main">
    <h2 class="services-title"><?php echo esc_html($services_title); ?></h2>
    <p class="services-intro"><?php echo esc_html($services_intro); ?></p>
    <div class="services-grid">
        <div class="service-card">
            <span class="service-icon"><i class="fa-solid fa-lightbulb"></i></span>
            <h3><?php echo esc_html($service1_title); ?></h3>
            <p><?php echo esc_html($service1_desc); ?></p>
        </div>
        <div class="service-card">
            <span class="service-icon"><i class="fa-solid fa-palette"></i></span>
            <h3><?php echo esc_html($service2_title); ?></h3>
            <p><?php echo esc_html($service2_desc); ?></p>
        </div>
        <div class="service-card">
            <span class="service-icon"><i class="fa-solid fa-chart-line"></i></span>
            <h3><?php echo esc_html($service3_title); ?></h3>
            <p><?php echo esc_html($service3_desc); ?></p>
        </div>
        <div class="service-card">
            <span class="service-icon"><i class="fa-solid fa-gem"></i></span>
            <h3><?php echo esc_html($service4_title); ?></h3>
            <p><?php echo esc_html($service4_desc); ?></p>
        </div>
        <div class="service-card">
            <span class="service-icon"><i class="fa-solid fa-paper-plane"></i></span>
            <h3><?php echo esc_html($service5_title); ?></h3>
            <p><?php echo esc_html($service5_desc); ?></p>
        </div>
        <div class="service-card">
            <span class="service-icon"><i class="fa-solid fa-shield-alt"></i></span>
            <h3><?php echo esc_html($service6_title); ?></h3>
            <p><?php echo esc_html($service6_desc); ?></p>
        </div>
    </div>
    <div class="services-cta">
        <h4><?php echo esc_html($cta_title); ?></h4>
        <p><?php echo esc_html($cta_text); ?></p>
        <?php if ($cta_button_url && $cta_button_text): ?>
            <a href="<?php echo esc_url($cta_button_url); ?>" class="cta-btn"><?php echo esc_html($cta_button_text); ?></a>
        <?php endif; ?>
    </div>
</main>

<?php include locate_template('pg-footer.php'); ?>
<?php wp_footer(); ?>
</body>
</html>