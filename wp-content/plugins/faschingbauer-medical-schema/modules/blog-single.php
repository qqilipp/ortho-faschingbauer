<?php
if (!defined('ABSPATH')) exit;

/**
 * Blog Article Schema
 * Works for:
 * /wissen/*
 */

add_action('wp_head', function () {

    if (!is_singular('post')) return;

    $post_id = get_queried_object_id();
    if (!$post_id) return;

    $contact    = pms_get_contact_data();
    $base_graph = pms_build_base_graph($contact);

    $base  = pms_get_site_base();
    $url   = get_permalink($post_id);
    $title = get_the_title($post_id);
    $img   = pms_get_featured_image_url($post_id);

    $physician_id = rtrim(pms_get_physician_url(), '/') . '/#physician';

    $graph = $base_graph;

    $article_id = rtrim($url, '/') . '/#article';
    $webpage_id = rtrim($url, '/') . '/#webpage';

    /**
     * BlogPosting
     */

    $article = [
        '@type' => 'BlogPosting',
        '@id'   => $article_id,
        'headline' => $title,
        'url'   => $url,

        'inLanguage' => pms_in_language(),

        'mainEntityOfPage' => [
            '@id' => $webpage_id
        ],

        'datePublished' => get_the_date('Y-m-d', $post_id),
        'dateModified'  => get_the_modified_date('Y-m-d', $post_id),

        'author' => [
            '@id' => $physician_id
        ],

        'publisher' => [
            '@id' => $base . '/#medicalbusiness'
        ],
    ];

    if ($img) {
        $article['image'] = [
            '@type' => 'ImageObject',
            'url'   => $img,
        ];
    }

    $graph[] = $article;

    /**
     * WebPage
     */

    $graph[] = [
        '@type' => 'WebPage',
        '@id'   => $webpage_id,
        'url'   => $url,
        'name'  => $title,

        'inLanguage' => pms_in_language(),

        'isPartOf' => [
            '@id' => $base . '/#website'
        ],

        'about' => [
            '@id' => $article_id
        ]
    ];

    pms_print_jsonld($graph);

}, 5);