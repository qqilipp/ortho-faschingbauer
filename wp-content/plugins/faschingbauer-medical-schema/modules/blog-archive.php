<?php
if (!defined('ABSPATH')) exit;

/**
 * Blog Archive Schema
 * Works for:
 * /wissen/
 * /wissen/category/*
 * /en/knowledge/*
 */

add_action('wp_head', function () {

    $show = false;

    // Главная страница блога
    if (function_exists('pms_is_page_base') && pms_is_page_base(PMS_WISSEN_DE)) {
        $show = true;
    }

    // Архивы категорий / тегов
    if (is_category() || is_tag()) {
        $show = true;
    }

    // Если в WP назначена "Beiträge-Seite"
    if (is_home()) {
        $show = true;
    }

    if (!$show) return;

    $contact    = pms_get_contact_data();
    $base_graph = pms_build_base_graph($contact);

    $base = pms_get_site_base();

    // URL текущего архива
    if (is_category() || is_tag()) {
        $url   = get_term_link(get_queried_object());
        $title = single_term_title('', false);
    } else {
        $url   = get_permalink(pms_tr_id(PMS_WISSEN_DE));
        $title = get_the_title(pms_tr_id(PMS_WISSEN_DE));
    }

    $webpage_id = rtrim($url, '/') . '/#webpage';

    $graph = $base_graph;

    $graph[] = [
        '@type' => 'CollectionPage',
        '@id'   => $webpage_id,
        'url'   => $url,
        'name'  => $title,

        'inLanguage' => function_exists('pms_in_language') ? pms_in_language() : 'de',

        'isPartOf' => [
            '@id' => $base . '/#website'
        ],

        'about' => [
            '@id' => $base . '/#medicalbusiness'
        ]
    ];

    pms_print_jsonld($graph);

}, 5);