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
                <div class="service-card"
                    data-idx="<?php echo esc_attr($idx); ?>"
                    data-title="<?php echo esc_attr($service['service_detail_title'] ?? $service['service_title'] ?? ''); ?>"
                    data-desc="<?php echo esc_attr($service['service_detail_text'] ?? $service['service_desc'] ?? ''); ?>"
                    data-image="<?php echo !empty($service['service_detail_image']['url']) ? esc_url($service['service_detail_image']['url']) : ''; ?>"
                >
                    <span class="service-icon">
                        <?php if (!empty($service['service_icon'])): ?>
                            <img src="<?php echo esc_url($service['service_icon']['url']); ?>" alt="<?php echo esc_attr($service['service_title']); ?>" />
                        <?php endif; ?>
                    </span>
                    <h3><?php echo esc_html($service['service_title'] ?? ''); ?></h3>
                    <p><?php echo esc_html($service['service_desc'] ?? ''); ?></p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <div id="expanded-service-card" class="expanded-service-card" style="display:none"></div>

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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.service-card');
    const expanded = document.getElementById('expanded-service-card');
    cards.forEach(card => {
        card.addEventListener('click', function() {
            // Get data
            const title = card.getAttribute('data-title');
            const desc = card.getAttribute('data-desc');
            const image = card.getAttribute('data-image');
            // Build HTML
            expanded.innerHTML = `
    <div class="service-card service-card--expanded service-card--row">
        ${image ? `<div class="service-detail-img"><img src="${image}" alt="${title}" /></div>` : ''}
        <div class="service-detail-content">
            <h3>${title}</h3>
            <p>${desc}</p>
        </div>
    </div>
`;
            expanded.style.display = 'block';
            expanded.scrollIntoView({behavior: 'smooth', block: 'center'});
        });
    });
});
</script>