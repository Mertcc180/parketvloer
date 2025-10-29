<?php
/**
 * Template Name: Services
 *
 * Custom "Services" page template.
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Resolve current page ID
$page_id = get_queried_object_id();

// Safe ACF getters
$has_acf = function_exists('get_field');

$hero_title   = $has_acf ? get_field('contact_hero_title', $page_id)   : '';
$form_title   = $has_acf ? get_field('contact_form_title', $page_id)   : '';
$form_sc      = $has_acf ? (string) get_field('contact_form_shortcode', $page_id) : '';
$form_id      = $has_acf ? (int) get_field('contact_form_id', $page_id) : 0;
if ( $form_id <= 0 ) { $form_id = 1; } // fallback als ACF veld ontbreekt

// Haal de losse velden rechtstreeks op (geen group)
$phone_label  = $has_acf ? (string) get_field('contact_phone_label',  $page_id) : '';
$phone        = $has_acf ? (string) get_field('contact_phone',        $page_id) : '';
$email_label  = $has_acf ? (string) get_field('contact_email_label',  $page_id) : '';
$email        = $has_acf ? (string) get_field('contact_email',        $page_id) : '';
$addr_label   = $has_acf ? (string) get_field('contact_address_label',$page_id) : '';
$address      = $has_acf ? (string) get_field('contact_address',      $page_id) : '';

// Fallback voor oude group 'contact_details' (optioneel)
if ( $has_acf && !$phone_label && !$phone && !$email_label && !$email && !$addr_label && !$address ) {
    $details = (array) get_field('contact_details', $page_id);
    $phone_label  = $details['contact_phone_label']   ?? '';
    $phone        = $details['contact_phone']         ?? '';
    $email_label  = $details['contact_email_label']   ?? '';
    $email        = $details['contact_email']         ?? '';
    $addr_label   = $details['contact_address_label'] ?? '';
    $address      = $details['contact_address']       ?? '';
}

$map_title = $has_acf ? get_field('contact_map_title', $page_id) : '';
$map_url   = $has_acf ? trim(get_field('contact_map', $page_id)) : '';
$map_embed = $has_acf ? trim(get_field('contact_map_embed', $page_id)) : ''; // <-- nieuw veld
// Allow only safe attributes for the iframe
$allowed_iframe = [
    'iframe' => [
        'src' => [], 'width' => [], 'height' => [], 'style' => [], 'loading' => [],
        'referrerpolicy' => [], 'allow' => [], 'allowfullscreen' => [], 'aria-hidden' => [],
        'tabindex' => [], 'frameborder' => []
    ],
];
// Breid toe om ook link en paragraaf toe te staan
$allowed_map = $allowed_iframe + [
    'a' => [ 'href' => [], 'target' => [], 'rel' => [], 'class' => [] ],
    'p' => [ 'class' => [] ],
];
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<!-- Verwijderd: inline @import; CSS wordt via functions.php geladen -->
</head>
<body <?php body_class('pg-body'); ?>>
<?php wp_body_open(); ?>

<?php include locate_template('pg-header.php'); ?>



<?php include locate_template('pg-footer.php'); ?>

<?php wp_footer(); ?>
</body>
</html>