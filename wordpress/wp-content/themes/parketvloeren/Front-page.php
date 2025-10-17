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

// SECTION TITLES (ACF text fields)
$benefits_title = get_field('benefits_title', $page_id);
$reviews_title  = get_field('reviews_title',  $page_id);
$projects_title = get_field('projects_title', $page_id);

// BENEFITS
$benefit_1_title = get_field('benefit_1_title', $page_id);
$benefit_1_text  = get_field('benefit_1_text', $page_id);
$benefit_2_title = get_field('benefit_2_title', $page_id);
$benefit_2_text  = get_field('benefit_2_text', $page_id);
$benefit_3_title = get_field('benefit_3_title', $page_id);
$benefit_3_text  = get_field('benefit_3_text', $page_id);
$has_b1 = $benefit_1_title || $benefit_1_text;
$has_b2 = $benefit_2_title || $benefit_2_text;
$has_b3 = $benefit_3_title || $benefit_3_text;
$has_benefits = $has_b1 || $has_b2 || $has_b3;

// REVIEWS
$review_1_text   = get_field('review_1_text', $page_id);
$review_1_author = get_field('review_1_author', $page_id);
$review_2_text   = get_field('review_2_text', $page_id);
$review_2_author = get_field('review_2_author', $page_id);
$review_3_text   = get_field('review_3_text', $page_id);
$review_3_author = get_field('review_3_author', $page_id);
$has_r1 = $review_1_text || $review_1_author;
$has_r2 = $review_2_text || $review_2_author;
$has_r3 = $review_3_text || $review_3_author;
$has_reviews = $has_r1 || $has_r2 || $has_r3;

// PROJECTS
$proj1_img   = get_field('project_1_image', $page_id);
$proj2_img   = get_field('project_2_image', $page_id);
$proj3_img   = get_field('project_3_image', $page_id);
$proj1_url   = $img_url($proj1_img);
$proj2_url   = $img_url($proj2_img);
$proj3_url   = $img_url($proj3_img);
$proj1_style = $proj1_url ? "--img:url('".esc_url($proj1_url)."')" : '';
$proj2_style = $proj2_url ? "--img:url('".esc_url($proj2_url)."')" : '';
$proj3_style = $proj3_url ? "--img:url('".esc_url($proj3_url)."')" : '';
$proj1_title = get_field('project_1_title', $page_id);
$proj2_title = get_field('project_2_title', $page_id);
$proj3_title = get_field('project_3_title', $page_id);
$has_p1 = $proj1_url || $proj1_title;
$has_p2 = $proj2_url || $proj2_title;
$has_p3 = $proj3_url || $proj3_title;
$has_projects = $has_p1 || $has_p2 || $has_p3;

// CTA
$cta_title      = get_field('cta_title', $page_id);
$cta_text       = get_field('cta_text', $page_id);
$cta_btn_text   = get_field('cta_button_text', $page_id);
$cta_btn_link   = get_field('cta_button_link', $page_id);
$cta_link       = $link_resolve($cta_btn_link);
$has_cta_btn    = $cta_btn_text && $cta_link['href'];

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

<header class="pg-header">
    <div class="pg-header__inner">
        <div class="pg-header__logo">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/logo2.png' ); ?>" alt="" class="pg-header__logo-img">
            </a>
        </div>
        <nav class="pg-header__nav">
            <ul class="pg-nav">
                <li class="pg-nav__item pg-nav__item--active"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
                <li class="pg-nav__item"><a href="<?php echo esc_url( home_url( '/over-ons' ) ); ?>">Over ons</a></li>
                <li class="pg-nav__item"><a href="<?php echo esc_url( home_url( '/diensten' ) ); ?>">Services</a></li>
                <li class="pg-nav__item"><a href="<?php echo esc_url( home_url( '/projecten' ) ); ?>">Projecten</a></li>
                <li class="pg-nav__item"><a href="<?php echo esc_url( home_url( '/contact' ) ); ?>">Contact</a></li>
            </ul>
        </nav>
        <div class="pg-header__cta">
            <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="pg-btn pg-btn--header">Offerte aanvragen</a>
        </div>
    </div>
</header>

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
                <?php if ($has_b1): ?>
                    <div class="pg-card pg-benefit">
                        <div class="pg-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" width="32" height="32" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="6"/><path d="M8.5 14 7 22l5-2 5 2-1.5-8"/></svg>
                        </div>
                        <?php if ($benefit_1_title): ?><h3 class="pg-card__title"><?php echo esc_html($benefit_1_title); ?></h3><?php endif; ?>
                        <?php if ($benefit_1_text):  ?><p class="pg-card__text"><?php echo esc_html($benefit_1_text); ?></p><?php endif; ?>
                    </div>
                <?php endif; ?>
                <?php if ($has_b2): ?>
                    <div class="pg-card pg-benefit">
                        <div class="pg-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" width="32" height="32" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2l7 3v6c0 5-3.5 9-7 11-3.5-2-7-6-7-11V5l7-3z"/></svg>
                        </div>
                        <?php if ($benefit_2_title): ?><h3 class="pg-card__title"><?php echo esc_html($benefit_2_title); ?></h3><?php endif; ?>
                        <?php if ($benefit_2_text):  ?><p class="pg-card__text"><?php echo esc_html($benefit_2_text); ?></p><?php endif; ?>
                    </div>
                <?php endif; ?>
                <?php if ($has_b3): ?>
                    <div class="pg-card pg-benefit">
                        <div class="pg-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" width="32" height="32" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.8 6.6a5 5 0 0 0-7.1 0L12 8.3l-1.7-1.7a5 5 0 0 0-7.1 7.1l8.8 8.8 8.8-8.8a5 5 0 0 0 0-7.1z"/></svg>
                        </div>
                        <?php if ($benefit_3_title): ?><h3 class="pg-card__title"><?php echo esc_html($benefit_3_title); ?></h3><?php endif; ?>
                        <?php if ($benefit_3_text):  ?><p class="pg-card__text"><?php echo esc_html($benefit_3_text); ?></p><?php endif; ?>
                    </div>
                <?php endif; ?>
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
                <?php if ($has_r1): ?>
                    <blockquote class="pg-quote">
                        <?php if ($review_1_text): ?><p><?php echo esc_html($review_1_text); ?></p><?php endif; ?>
                        <?php if ($review_1_author): ?><footer>— <?php echo esc_html($review_1_author); ?></footer><?php endif; ?>
                    </blockquote>
                <?php endif; ?>
                <?php if ($has_r2): ?>
                    <blockquote class="pg-quote">
                        <?php if ($review_2_text): ?><p><?php echo esc_html($review_2_text); ?></p><?php endif; ?>
                        <?php if ($review_2_author): ?><footer>— <?php echo esc_html($review_2_author); ?></footer><?php endif; ?>
                    </blockquote>
                <?php endif; ?>
                <?php if ($has_r3): ?>
                    <blockquote class="pg-quote">
                        <?php if ($review_3_text): ?><p><?php echo esc_html($review_3_text); ?></p><?php endif; ?>
                        <?php if ($review_3_author): ?><footer>— <?php echo esc_html($review_3_author); ?></footer><?php endif; ?>
                    </blockquote>
                <?php endif; ?>
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
                <?php if ($has_p1): ?>
                    <article class="pg-project">
                        <div class="pg-project__media" style="<?php echo esc_attr($proj1_style); ?>"></div>
                        <?php if ($proj1_title): ?><h3 class="pg-project__title"><?php echo esc_html($proj1_title); ?></h3><?php endif; ?>
                    </article>
                <?php endif; ?>
                <?php if ($has_p2): ?>
                    <article class="pg-project">
                        <div class="pg-project__media" style="<?php echo esc_attr($proj2_style); ?>"></div>
                        <?php if ($proj2_title): ?><h3 class="pg-project__title"><?php echo esc_html($proj2_title); ?></h3><?php endif; ?>
                    </article>
                <?php endif; ?>
                <?php if ($has_p3): ?>
                    <article class="pg-project">
                        <div class="pg-project__media" style="<?php echo esc_attr($proj3_style); ?>"></div>
                        <?php if ($proj3_title): ?><h3 class="pg-project__title"><?php echo esc_html($proj3_title); ?></h3><?php endif; ?>
                    </article>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="pg-section pg-cta">
        <div class="pg-section__inner">
            <?php if ($cta_title): ?><h2 class="pg-section__title"><?php echo esc_html($cta_title); ?></h2><?php endif; ?>
            <?php if ($cta_text):  ?><p class="pg-cta__text"><?php echo esc_html($cta_text); ?></p><?php endif; ?>
            <?php if ($has_cta_btn): ?>
                <a class="pg-btn pg-btn--primary" href="<?php echo esc_url($cta_link['href']); ?>"<?php echo $cta_link['target'] ? ' target="'.esc_attr($cta_link['target']).'" rel="noopener"' : ''; ?>>
                    <?php echo esc_html($cta_btn_text); ?>
                </a>
            <?php endif; ?>
        </div>
    </section>
</main>

<footer class="pg-footer" role="contentinfo">
    <div class="pg-footer__inner">
        <div class="pg-footer__brand">
            <div class="pg-footer__logo" aria-hidden="true">
                <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/images/logo2.png' ); ?>" alt="" class="pg-footer__logo-img">
            </div>
        </div>

        <div class="pg-footer__cols">
            <div class="pg-footer__col">
                <ul class="pg-footer__links">
                    <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/over-ons' ) ); ?>">Over ons</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/diensten' ) ); ?>">Diensten</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/projecten' ) ); ?>">Projecten</a></li>
                    <li><a href="<?php echo esc_url( home_url( '/contact' ) ); ?>">Contact</a></li>
                </ul>
            </div>
            <div class="pg-footer__col">
                <h4 class="pg-footer__heading">Contact info</h4>
                <address class="pg-footer__address">
                    <?php if ($contact_city):    ?><div><?php echo esc_html($contact_city); ?></div><?php endif; ?>
                    <?php if ($contact_region):  ?><div><?php echo esc_html($contact_region); ?></div><?php endif; ?>
                </address>
                <ul class="pg-footer__contact">
                    <?php if ($contact_email): ?><li><a href="mailto:<?php echo esc_attr($contact_email); ?>"><?php echo esc_html($contact_email); ?></a></li><?php endif; ?>
                    <?php if ($contact_phone): ?><li><a href="tel:<?php echo esc_attr(preg_replace('/\s+/', '', $contact_phone)); ?>"><?php echo esc_html($contact_phone); ?></a></li><?php endif; ?>
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

<?php wp_footer(); ?>
</body>
</html>