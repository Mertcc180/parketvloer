<?php
/**
 * Template Name: Homepage
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

// Safety check for ACF
if ( ! function_exists('get_field') ) {
    echo '<div style="padding:40px; text-align:center; font-family:sans-serif;">Advanced Custom Fields plugin is niet actief.</div>';
    return;
}

// Resolve the correct page ID (front page)
global $post;
$page_id = get_queried_object_id();

// If not a static page, try the static front-page option
if ( ! $page_id ) {
    $page_id = (int) get_option('page_on_front');
}

// Fallback: find a page using this template file
if ( ! $page_id ) {
    $tpl_page = get_posts([
        'post_type'      => 'page',
        'post_status'    => 'publish',
        'posts_per_page' => 1,
        'meta_key'       => '_wp_page_template',
        'meta_value'     => 'front-page.php',
    ]);
    if ( $tpl_page ) {
        $page_id = (int) $tpl_page[0]->ID;
    }
}

// Fallback: a page with slug “homepage”
if ( ! $page_id ) {
    $p = get_page_by_path('homepage');
    if ( $p ) $page_id = (int) $p->ID;
}

// Helpers
$img_url = function ($field) {
    if (is_array($field) && !empty($field['url'])) return $field['url'];
    if (is_string($field) && $field) return $field;
    return '';
};

$link_resolve = function ($field) {
    if (is_array($field) && !empty($field['url'])) {
        return ['href' => $field['url'], 'target' => !empty($field['target']) ? $field['target'] : ''];
    }
    if (is_string($field) && $field) return ['href' => $field, 'target' => ''];
    return ['href' => '', 'target' => ''];
};

// HERO
$hero_title     = get_field('hero_title', $page_id);
$hero_subtitle  = get_field('hero_subtitle', $page_id);
$hero_cta_text  = get_field('hero_cta_text', $page_id);
$hero_cta_link  = get_field('hero_cta_link', $page_id);
$hero_link      = $link_resolve($hero_cta_link);

// Read both EN and NL field names
$hero_bg        = get_field('hero_background', $page_id) ?: get_field('hero_achtergrond', $page_id);
$hero_bg_url    = $img_url($hero_bg);
$hero_style     = $hero_bg_url ? "--hero-bg:url('".esc_url($hero_bg_url)."')" : '';

// BENEFITS (Repeater)
$benefits_title = get_field('benefits_title', $page_id);
$benefits = get_field('benefits', $page_id);

// REVIEWS (Repeater)
$reviews_title = get_field('reviews_title', $page_id);
$reviews = get_field('reviews', $page_id);

// PROJECTS (Repeater)
$projects_title = get_field('projects_title', $page_id);
$projects = get_field('projects', $page_id);

// CTA
$cta_title      = get_field('cta_title', $page_id);
$cta_text       = get_field('cta_text', $page_id);
$cta_btn_text   = get_field('cta_button_text', $page_id);
$cta_btn_link   = get_field('cta_button_link', $page_id);
$cta_link       = $link_resolve($cta_btn_link);
$has_cta_btn    = $cta_btn_text && $cta_link['href'];

$cta_text_clean = $cta_text ? trim($cta_text) : '';
$show_cta_text  = $cta_text_clean !== '' && strcasecmp($cta_text_clean, 'Offerte aanvragen') !== 0;

// FOOTER CONTACT
$contact_city    = get_field('contact_city', $page_id);
$contact_region  = get_field('contact_region', $page_id);
$contact_email   = get_field('contact_email', $page_id);
$contact_phone   = get_field('contact_phone', $page_id);
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

<main id="homepage" class="pg-home">
    <!-- Hero -->
    <section class="pg-hero" style="<?php echo esc_attr($hero_style); ?>">
        <div class="pg-hero__overlay"></div>
        <div class="pg-hero__inner">
            <?php if ($hero_title): ?>
                <h1 class="pg-hero__title"><?php echo esc_html($hero_title); ?></h1>
            <?php endif; ?>
            <?php if ($hero_subtitle): ?>
                <p class="pg-hero__subtitle"><?php echo esc_html($hero_subtitle); ?></p>
            <?php endif; ?>
            <?php if ($hero_cta_text && $hero_link['href']): ?>
                <div class="pg-hero__actions">
                    <a href="<?php echo esc_url($hero_link['href']); ?>"<?php echo $hero_link['target'] ? ' target="'.esc_attr($hero_link['target']).'" rel="noopener"' : ''; ?> class="pg-btn pg-btn--primary">
                        <?php echo esc_html($hero_cta_text); ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Benefits -->
    <section class="pg-section pg-benefits">
        <div class="pg-section__inner">
            <?php if ($benefits_title): ?>
                <h2 class="pg-section__title"><?php echo esc_html($benefits_title); ?></h2>
            <?php endif; ?>
            <div class="pg-grid pg-grid--3">
                <?php if ($benefits): foreach ($benefits as $b): ?>
                    <div class="pg-card pg-benefit">
                        <div class="pg-icon" aria-hidden="true">
                            <?php
                            // Toon het geüploade icoon, anders een fallback SVG
                            if (!empty($b['icon']['url'])) {
                                // Optioneel: controleer of het een SVG is voor inline
                                $icon_url = esc_url($b['icon']['url']);
                                $icon_ext = pathinfo($icon_url, PATHINFO_EXTENSION);
                                if ($icon_ext === 'svg') {
                                    // SVG inline tonen
                                    echo file_get_contents(ABSPATH . str_replace(site_url() . '/', '', $icon_url));
                                } else {
                                    // PNG/JPG als img
                                    echo '<img src="' . $icon_url . '" alt="" style="width:32px;height:32px;">';
                                }
                            } else {
                                // Fallback SVG
                                ?>
                                <svg viewBox="0 0 24 24" width="32" height="32" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="6"/><path d="M8.5 14 7 22l5-2 5 2-1.5-8"/></svg>
                                <?php
                            }
                            ?>
                        </div>
                        <?php if ($b['title']): ?><h3 class="pg-card__title"><?php echo esc_html($b['title']); ?></h3><?php endif; ?>
                        <?php if ($b['text']):  ?><p class="pg-card__text"><?php echo esc_html($b['text']); ?></p><?php endif; ?>
                    </div>
                <?php endforeach; endif; ?>
            </div>
        </div>
    </section>

    <!-- Reviews -->
    <section class="pg-section pg-testimonials">
        <div class="pg-section__inner">
            <?php if ($reviews_title): ?>
                <h2 class="pg-section__title"><?php echo esc_html($reviews_title); ?></h2>
            <?php endif; ?>
            <div class="pg-grid pg-grid--3">
                <?php if ($reviews): foreach ($reviews as $r): ?>
                    <blockquote class="pg-quote">
                        <?php if ($r['text']): ?><p><?php echo esc_html($r['text']); ?></p><?php endif; ?>
                        <?php if ($r['author']): ?><footer>— <?php echo esc_html($r['author']); ?></footer><?php endif; ?>
                    </blockquote>
                <?php endforeach; endif; ?>
            </div>
        </div>
    </section>

    <!-- Projects -->
    <section class="pg-section pg-projects">
        <div class="pg-section__inner">
            <?php if ($projects_title): ?>
                <h2 class="pg-section__title"><?php echo esc_html($projects_title); ?></h2>
            <?php endif; ?>
            <div class="pg-grid pg-grid--3 pg-projects__grid">
                <?php if ($projects): foreach ($projects as $p): 
                    $img_url = '';
                    if (is_array($p['image']) && !empty($p['image']['url'])) $img_url = $p['image']['url'];
                    ?>
                    <article class="pg-project">
                        <?php if ($img_url): ?>
                            <div class="pg-project__media" style="background-image: url('<?php echo esc_url($img_url); ?>')"></div>
                        <?php endif; ?>
                        <?php if ($p['title']): ?>
                            <h3 class="pg-project__title"><?php echo esc_html($p['title']); ?></h3>
                        <?php endif; ?>
                    </article>
                <?php endforeach; endif; ?>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="pg-section pg-cta">
        <div class="pg-section__inner">
            <?php if ($cta_title): ?><h2 class="pg-section__title"><?php echo esc_html($cta_title); ?></h2><?php endif; ?>
            <?php if ($show_cta_text): ?><p class="pg-cta__text"><?php echo esc_html($cta_text_clean); ?></p><?php endif; ?>
            <?php if ($has_cta_btn): ?>
                <a class="pg-btn pg-btn--primary" href="<?php echo esc_url($cta_link['href']); ?>"<?php echo $cta_link['target'] ? ' target="'.esc_attr($cta_link['target']).'" rel="noopener"' : ''; ?>>
                    <?php echo esc_html($cta_btn_text); ?>
                </a>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php include locate_template('pg-footer.php'); ?>

<?php wp_footer(); ?>
</body>
</html>