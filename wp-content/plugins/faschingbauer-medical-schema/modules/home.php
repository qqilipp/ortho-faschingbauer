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
    [$website_node, $medicalbusiness_node, $physician_node] = $base_graph;

    $base = pms_get_site_base();
    $url  = home_url('/');
    $name = get_bloginfo('name');

    $physician_id = rtrim(pms_get_physician_url(), '/') . '/#physician';

    /**
     * Same 5 reviews as parts/home-reviews.php (theme) - keep both in sync.
     * Hardcoded here (not ACF-sourced) since the homepage reviews carousel
     * itself is hardcoded, unlike the ACF "patientenbewertungen" repeater
     * used on other pages.
     */
    $home_reviews = [
        ['name' => 'Kristian Fitzbauer', 'sterne' => 5, 'text' => 'Von Tag 1 sprich vor der Operation bis zur Nachbehandlung hat er mir immer das Gefühl gegeben für mich den Patienten da zu sein. Absolut kompetent menschlich top. Bei mir wurde eine Hüft Operation durchgeführt, würde und kann ihn nur weiterempfehlen.'],
        ['name' => 'Adolf Jobstmann', 'sterne' => 5, 'text' => 'Ich bin 85 Jahre alt, und wurde von Prof. Martin Faschingbauer an beiden Knien erfolgreich operiert. Die Mobilität war innerhalb von 4 Tagen wieder hergestellt. Die Betreuung war herausragend. Ich kann Prof. Faschingbauer mit gutem Gewissen weiter empfehlen.'],
        ['name' => 'Alexandra Kos', 'sterne' => 5, 'text' => 'Herr Prof. Faschingbauer hat eine sehr freundliche und ruhige Art, was mir Sicherheit in meiner Entscheidung zu einer OP gegeben hat. Er spricht eine klare Sprache und ist sehr kompetent in seinem Tun. Auf Telefonanrufe und Mailnachrichten reagiert er prompt. Eine klare Empfehlung meinerseits!'],
        ['name' => 'Eveline Suskopf', 'sterne' => 5, 'text' => 'Herr Professor Martin Faschingbauer ist ein sehr einfühlsamer und kompetenter Arzt. Die Knie OP wurde ohne Komplikationen und zu meiner Zufriedenheit durchgeführt. Dieser Chirurg ist absolut weiterzuempfehlen.'],
        ['name' => 'Gerald Demschik', 'sterne' => 5, 'text' => 'Nach ausführlicher und geduldiger Aufklärung wurde mein sehr schmerzhaftes Kniegelenk roboterassistiert gegen eine Totalprothese ausgetauscht. Nun, nach knapp einem Jahr komplikationsfreien Verlaufs, nehme ich die Endoprothese in den meisten Situationen gar nicht mehr wahr und bin sehr zufrieden. Klare Empfehlung!'],
    ];

    $review_nodes = array_map(function ($r) {
        return [
            '@type' => 'Review',
            'reviewRating' => [
                '@type'       => 'Rating',
                'ratingValue' => $r['sterne'],
                'bestRating'  => 5,
                'worstRating' => 1,
            ],
            'author' => [
                '@type' => 'Person',
                'name'  => $r['name'],
            ],
            'reviewBody' => $r['text'],
        ];
    }, $home_reviews);

    $review_count = count($home_reviews);
    $avg_rating   = round(array_sum(array_column($home_reviews, 'sterne')) / $review_count, 1);

    $medicalbusiness_node['review'] = $review_nodes;
    $medicalbusiness_node['aggregateRating'] = [
        '@type'       => 'AggregateRating',
        'ratingValue' => $avg_rating,
        'reviewCount' => $review_count,
        'bestRating'  => 5,
        'worstRating' => 1,
    ];

    $graph = [$website_node, $medicalbusiness_node, $physician_node];

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