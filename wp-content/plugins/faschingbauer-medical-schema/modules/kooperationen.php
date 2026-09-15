<?php
if (!defined('ABSPATH')) exit;

/**
 * "Kooperationen & Netzwerk" Page Schema
 * Output: CollectionPage + Organization[] (from CPT "netzwerk"), plus the
 * Physician node enriched with "affiliation" pointing to those same
 * organizations. Keeps every partner as its own top-level graph node,
 * referenced by @id everywhere else (ItemList, affiliation) rather than
 * duplicated inline.
 */

add_action('wp_head', function () {

    if (!function_exists('pms_is_page_base') || !pms_is_page_base(PMS_KOOPERATIONEN_DE)) {
        return;
    }

    if (!post_type_exists('netzwerk')) return;

    $post_id = get_queried_object_id();
    if (!$post_id) return;

    $contact    = pms_get_contact_data();
    $base_graph = pms_build_base_graph($contact);
    [$website_node, $medicalbusiness_node, $physician_node] = $base_graph;

    $base  = pms_get_site_base();
    $url   = get_permalink($post_id);
    $title = get_the_title($post_id);

    $physician_id = rtrim(pms_get_physician_url(), '/') . '/#physician';
    $webpage_id   = rtrim($url, '/') . '/#webpage';

    $partners = get_posts([
        'post_type'      => 'netzwerk',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'orderby'        => 'title',
        'order'          => 'ASC',
    ]);

    $organizations = [];
    $list_items    = [];
    $position      = 0;

    foreach ($partners as $partner) {
        $website = (string) get_field('netzwerk_website', $partner->ID);
        if (!$website) continue;

        $logo = get_field('netzwerk_logo', $partner->ID);
        $desc = (string) get_field('netzwerk_beschreibung', $partner->ID);
        $org_id = $base . '/#partner-' . $partner->ID;

        $org = [
            '@type' => 'Organization',
            '@id'   => $org_id,
            'name'  => get_the_title($partner),
            'url'   => $website,
        ];

        if ($desc !== '') {
            $org['description'] = $desc;
        }

        if (is_array($logo) && !empty($logo['url'])) {
            $org['logo'] = $logo['url'];
        }

        $organizations[] = $org;

        $position++;
        $list_items[] = [
            '@type'    => 'ListItem',
            'position' => $position,
            'item'     => ['@id' => $org_id],
        ];
    }

    if (empty($organizations)) return;

    $physician_node['affiliation'] = array_map(function ($org) {
        return ['@id' => $org['@id']];
    }, $organizations);

    $graph = [$website_node, $medicalbusiness_node, $physician_node];

    foreach ($organizations as $org) {
        $graph[] = $org;
    }

    $graph[] = [
        '@type' => 'CollectionPage',
        '@id'   => $webpage_id,
        'url'   => $url,
        'name'  => $title,

        'inLanguage' => pms_in_language(),

        'isPartOf' => [
            '@id' => $base . '/#website'
        ],

        'about' => [
            '@id' => $physician_id
        ],

        'mainEntity' => [
            '@type' => 'ItemList',
            'itemListElement' => $list_items,
        ],

        'datePublished' => get_the_date('Y-m-d', $post_id),
        'dateModified'  => get_the_modified_date('Y-m-d', $post_id),
    ];

    pms_print_jsonld($graph);

}, 5);
