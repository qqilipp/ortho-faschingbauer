<?php
if (!defined('ABSPATH')) exit;

/**
 * ContactPage Schema
 * Outputs: ContactPage
 * Uses base graph (WebSite + MedicalBusiness + Physician)
 */

add_action('wp_head', function () {

    // Показываем только на странице Kontakt (DE/EN через WPML)
    if (!function_exists('pms_is_page_base') || !pms_is_page_base(PMS_KONTAKT_DE)) {
        return;
    }

    $post_id = get_queried_object_id();
    if (!$post_id) return;

    // Контактные данные
    $contact = pms_get_contact_data();

    // Базовый граф
    $base_graph = pms_build_base_graph($contact);

    $base  = pms_get_site_base();
    $url   = get_permalink($post_id);
    $title = get_the_title($post_id);

    $webpage_id   = rtrim($url, '/') . '/#webpage';
    $physician_id = rtrim(pms_get_physician_url(), '/') . '/#physician';

    $graph = $base_graph;

    $graph[] = [
        '@type' => 'ContactPage',
        '@id'   => $webpage_id,
        'url'   => $url,
        'name'  => $title,

        'inLanguage' => pms_in_language(),

        'isPartOf' => [
            '@id' => $base . '/#website'
        ],

        'about' => [
            '@id' => $base . '/#medicalbusiness'
        ],

        'mainEntity' => [
            '@id' => $base . '/#medicalbusiness'
        ],

        'author' => [
            '@id' => $physician_id
        ],

        'reviewedBy' => [
            '@id' => $physician_id
        ],

        'datePublished' => get_the_date('Y-m-d', $post_id),
        'dateModified'  => get_the_modified_date('Y-m-d', $post_id),
    ];

    pms_print_jsonld($graph);

}, 5);