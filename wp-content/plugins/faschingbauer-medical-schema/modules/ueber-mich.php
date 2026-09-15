<?php
if (!defined('ABSPATH')) exit;

/**
 * "Über mich" Physician Bio Page Schema
 * Output: ProfilePage + full Physician node (credentials, alma mater,
 * memberships, affiliation, patient reviews).
 * Uses base graph (WebSite + MedicalBusiness) but replaces the minimal
 * Physician stub from pms_build_base_graph() with a fully detailed node
 * that keeps the same @id, since this is the canonical page about him.
 */

add_action('wp_head', function () {

    if (!function_exists('pms_is_page_base') || !pms_is_page_base(PMS_UEBERMICH_DE)) {
        return;
    }

    $post_id = get_queried_object_id();
    if (!$post_id) return;

    $contact    = pms_get_contact_data();
    $base_graph = pms_build_base_graph($contact);
    [$website_node, $medicalbusiness_node] = $base_graph;

    $base  = pms_get_site_base();
    $url   = get_permalink($post_id);
    $title = get_the_title($post_id);

    $physician_url = pms_get_physician_url();
    $physician_id  = rtrim($physician_url, '/') . '/#physician';
    $webpage_id    = rtrim($url, '/') . '/#webpage';

    // Profile photo lives in the ACF field "profil_foto", not the WP featured image
    $image_url = '';
    if (function_exists('get_field')) {
        $photo = get_field('profil_foto', $post_id);
        if (is_array($photo) && !empty($photo['url'])) {
            $image_url = (string) $photo['url'];
        } elseif (is_numeric($photo) && (int) $photo > 0) {
            $image_url = (string) wp_get_attachment_url((int) $photo);
        }
    }

    $description = '';
    if (function_exists('get_field')) {
        $description = trim(wp_strip_all_tags((string) get_field('hero_intro', $post_id)));
    }

    $cv_url = $base . '/wp-content/uploads/20260214-CV.pdf';

    $physician = [
        '@type'  => ['Person', 'Physician'],
        '@id'    => $physician_id,
        'name'   => 'Prof. DDr. Martin Faschingbauer, MBA',
        'honorificPrefix' => 'Prof. DDr.',
        'url'    => $physician_url,
        'jobTitle' => 'Facharzt für Orthopädie und Unfallchirurgie, Spezialist für Endoprothetik',
        'medicalSpecialty' => 'https://schema.org/Orthopedic',
        'worksFor' => ['@id' => $base . '/#medicalbusiness'],
        'affiliation' => [
            '@type' => 'Hospital',
            'name'  => 'Wiener Privatklinik',
        ],
        'knowsLanguage' => ['de-AT', 'en'],
        'knowsAbout' => [
            'Hüftendoprothetik',
            'Knieendoprothetik',
            'Revisionsendoprothetik',
            'Sporttraumatologie',
        ],

        'hasCredential' => [
            [
                '@type' => 'EducationalOccupationalCredential',
                'credentialCategory' => 'Facharzt für Orthopädie und Unfallchirurgie',
                'dateCreated' => '2016',
            ],
            [
                '@type' => 'EducationalOccupationalCredential',
                'credentialCategory' => 'Habilitation, Orthopädie und Unfallchirurgie',
                'recognizedBy' => ['@type' => 'CollegeOrUniversity', 'name' => 'Universität Ulm'],
                'dateCreated' => '2018',
            ],
            [
                '@type' => 'EducationalOccupationalCredential',
                'credentialCategory' => 'Außerplanmäßige Professur',
                'recognizedBy' => ['@type' => 'CollegeOrUniversity', 'name' => 'Universität Ulm'],
                'dateCreated' => '2020',
            ],
            [
                '@type' => 'EducationalOccupationalCredential',
                'credentialCategory' => 'Master of Business Administration (MBA), Gesundheitsökonomie',
                'recognizedBy' => ['@type' => 'CollegeOrUniversity', 'name' => 'IUBH Internationale Hochschule'],
                'dateCreated' => '2020',
            ],
            [
                '@type' => 'EducationalOccupationalCredential',
                'credentialCategory' => 'Zusatzausbildung Spezielle Orthopädische Chirurgie',
            ],
            [
                '@type' => 'EducationalOccupationalCredential',
                'credentialCategory' => 'Zusatzausbildung Orthopädische Rheumatologie',
            ],
        ],

        'alumniOf' => [
            ['@type' => 'CollegeOrUniversity', 'name' => 'Universität Ulm'],
            ['@type' => 'CollegeOrUniversity', 'name' => 'IUBH Internationale Hochschule'],
            ['@type' => 'EducationalOrganization', 'name' => 'Hospital for Special Surgery, New York'],
        ],

        'memberOf' => [
            ['@type' => 'MedicalOrganization', 'name' => 'European Knee Society (EKS)'],
            ['@type' => 'MedicalOrganization', 'name' => 'European Society of Sports Traumatology, Knee Surgery & Arthroscopy (ESSKA)'],
            ['@type' => 'MedicalOrganization', 'name' => 'Deutsche Gesellschaft für Endoprothetik (AE)'],
            ['@type' => 'MedicalOrganization', 'name' => 'Österreichische Gesellschaft für Orthopädie und Orthopädische Chirurgie (ÖGO)'],
            ['@type' => 'MedicalOrganization', 'name' => 'Deutsche Gesellschaft für Orthopädie und Orthopädische Chirurgie (DGOOC)'],
            ['@type' => 'MedicalOrganization', 'name' => 'Deutsche Gesellschaft für Orthopädie und Unfallchirurgie (DGOU)'],
        ],

        'award' => 'John N. Insall Fellow',

        'sameAs' => [
            'https://pubmed.ncbi.nlm.nih.gov/?term=faschingbauer+m+%5Bau%5D&sort=date',
        ],

        'subjectOf' => [
            '@type' => 'DigitalDocument',
            'name'  => 'Lebenslauf Prof. DDr. Martin Faschingbauer',
            'url'   => $cv_url,
        ],
    ];

    if ($image_url !== '') {
        $physician['image'] = $image_url;
    }

    if ($description !== '') {
        $physician['description'] = $description;
    }

    if (function_exists('pms_build_reviews_and_rating')) {
        $reviews = pms_build_reviews_and_rating($post_id);
        if (!empty($reviews)) {
            $physician['review']          = $reviews['review'];
            $physician['aggregateRating'] = $reviews['aggregateRating'];
        }
    }

    $graph = [$website_node, $medicalbusiness_node, $physician];

    $webpage = [
        '@type' => 'ProfilePage',
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
            '@id' => $physician_id
        ],

        'datePublished' => get_the_date('Y-m-d', $post_id),
        'dateModified'  => get_the_modified_date('Y-m-d', $post_id),
    ];

    if ($image_url !== '') {
        $webpage['primaryImageOfPage'] = [
            '@type' => 'ImageObject',
            'url'   => $image_url,
        ];
    }

    $graph[] = $webpage;

    pms_print_jsonld($graph);

}, 5);
