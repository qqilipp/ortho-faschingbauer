<?php
if (!defined('ABSPATH')) exit;

/**
 * Homepage Schema
 * Outputs: MedicalWebPage
 * Uses base graph (WebSite + MedicalBusiness + Physician)
 */

add_action('wp_head', function () {

    // Универсальное определение главной страницы
    $front_id = (int) get_option('page_on_front');
    $is_front = is_front_page() || ($front_id && is_page($front_id));

    if (!$is_front) return;

    $contact    = pms_get_contact_data();
    $base_graph = pms_build_base_graph($contact);

    $base = pms_get_site_base();
    $url  = home_url('/');
    $name = get_bloginfo('name');

    $physician_id = rtrim(pms_get_physician_url(), '/') . '/#physician';

    $graph = $base_graph;

    $graph[] = [
        '@type' => 'MedicalWebPage',
        '@id'   => $base . '/#webpage',
        'url'   => $url,
        'name'  => $name,

        'inLanguage' => pms_in_language(),

        'isPartOf' => [
            '@id' => $base . '/#website'
        ],

        'about' => [
            ['@id' => $base . '/#medicalbusiness']
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

        'dateModified' => get_the_modified_date('Y-m-d', get_queried_object_id()),
    ];

    pms_print_jsonld($graph);

}, 5);