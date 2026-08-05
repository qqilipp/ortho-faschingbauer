<?php
if (!defined('ABSPATH')) exit;

/**
 * "Orthopäde in Wien" hub page
 * Output: MedicalWebPage (about/mainEntity = physician) + FAQPage
 * (own FAQPage block, since the existing faq.php module reads a
 * different ACF field (faq-behandlung, post relationship) than the
 * question/answer repeater (faq_items) this page actually uses).
 */

add_action('wp_head', function () {

    if (!function_exists('pms_is_page_in_set') || !pms_is_page_in_set([2141])) {
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
        'about'      => ['@id' => $physician_id],
        'mainEntity' => ['@id' => $physician_id],
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

    // --- FAQPage (from faq_items: question/answer repeater) ---
    if (function_exists('get_field')) {
        $faq_rows = get_field('faq_items', $post_id);

        if (!empty($faq_rows) && is_array($faq_rows)) {
            $main_entity = [];

            foreach ($faq_rows as $row) {
                $question = trim((string) ($row['question'] ?? ''));
                $answer   = trim((string) ($row['answer'] ?? ''));
                if ($question === '' || $answer === '') continue;

                $main_entity[] = [
                    '@type' => 'Question',
                    'name'  => wp_strip_all_tags($question),
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text'  => wp_strip_all_tags($answer),
                    ],
                ];
            }

            if (count($main_entity) >= 2) {
                $graph[] = [
                    '@type' => 'FAQPage',
                    '@id'   => rtrim($url, '/') . '/#faq',
                    'url'   => $url,
                    'name'  => $title . ' – FAQ',
                    'inLanguage' => pms_in_language(),
                    'mainEntity' => $main_entity,
                ];
            }
        }
    }

    pms_print_jsonld($graph);

}, 5);
