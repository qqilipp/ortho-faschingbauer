<?php
if (!defined('ABSPATH')) exit;

/**
 * FAQ Schema
 * Uses ACF field: faq-behandlung
 * Works for:
 * /beschwerden/*
 * /orthopaedische-behandlungen/*
 */

add_action('wp_head', function () {

    $post_id = get_queried_object_id();
    if (!$post_id) return;

    // Только страницы внутри Beschwerden или Behandlungen
    if (
        !function_exists('pms_is_descendant_base') ||
        (
            !pms_is_descendant_base(PMS_BESCHWERDEN_DE) &&
            !pms_is_descendant_base(PMS_BEHANDLUNGEN_DE)
        )
    ) {
        return;
    }

    // Проверяем ACF
    if (!function_exists('get_field')) return;

    // ACF поле
    $faq_posts = get_field('faq-behandlung', $post_id);

    if (!$faq_posts || !is_array($faq_posts)) return;

    if (count($faq_posts) < 2) return;

    $url   = get_permalink($post_id);
    $title = get_the_title($post_id);

    $mainEntity = [];

    foreach ($faq_posts as $faq) {

        $question = get_the_title($faq->ID);
        $answer   = get_post_field('post_content', $faq->ID);

        if (!$question || !$answer) continue;

        $mainEntity[] = [
            '@type' => 'Question',
            'name'  => wp_strip_all_tags($question),
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text'  => wp_strip_all_tags($answer),
            ],
        ];
    }

    if (count($mainEntity) < 2) return;

    $faq_schema = [
        '@context' => 'https://schema.org',
        '@type'    => 'FAQPage',
        '@id'      => rtrim($url, '/') . '/#faq',
        'url'      => $url,
        'name'     => $title . ' – FAQ',
        'inLanguage' => function_exists('pms_in_language') ? pms_in_language() : 'de',
        'mainEntity' => $mainEntity,
    ];

    echo "\n<script type=\"application/ld+json\">" .
        wp_json_encode($faq_schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) .
        "</script>\n";

}, 30);