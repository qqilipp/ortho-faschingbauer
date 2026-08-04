<?php
if (!defined('ABSPATH')) exit;

/**
 * Behandlungen Pages (DE+EN via WPML)
 * Output: MedicalWebPage
 */

add_action('wp_head', function () {

    // IDs: Orthopädische Behandlungen + Operativ + Nicht operativ
    if (!function_exists('pms_is_page_in_set') || !pms_is_page_in_set([1372, 1376, 1382])) {
        return;
    }

    $post_id = get_queried_object_id();
    if (!$post_id) return;

    $contact    = pms_get_contact_data();
    $base_graph = pms_build_base_graph($contact);

    $base  = pms_get_site_base();
    $url   = get_permalink($post_id);
    $title = get_the_title($post_id);
    $img   = pms_get_featured_image_url($post_id);

    $webpage_id   = rtrim($url, '/') . '/#webpage';
    $physician_id = rtrim(pms_get_physician_url(), '/') . '/#physician';

    $graph = $base_graph;

    $webpage = [
        '@type' => 'MedicalWebPage',
        '@id'   => $webpage_id,
        'url'   => $url,
        'name'  => $title,
        'inLanguage' => pms_in_language(),
        'isPartOf' => ['@id' => $base . '/#website'],
        'about' => [
            '@type' => 'MedicalEntity',
            'name'  => $title,
        ],
        'mainEntity' => [
            '@type' => 'MedicalEntity',
            'name'  => $title,
        ],
        'author'     => ['@id' => $physician_id],
        'reviewedBy' => ['@id' => $physician_id],
        'datePublished' => get_the_date('Y-m-d', $post_id),
        'dateModified'  => get_the_modified_date('Y-m-d', $post_id),
    ];

    if ($img) {
        $webpage['primaryImageOfPage'] = [
            '@type' => 'ImageObject',
            'url'   => $img,
        ];
    }

    $graph[] = $webpage;

    pms_print_jsonld($graph);

}, 5);