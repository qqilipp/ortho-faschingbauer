<?php
if (!defined('ABSPATH')) exit;

/**
 * Page IDs (DE base IDs)
 * WPML will translate them to current language automatically via pms_tr_id().
 */
if (!defined('PMS_KONTAKT_DE'))      define('PMS_KONTAKT_DE', 1635);
if (!defined('PMS_WISSEN_DE'))       define('PMS_WISSEN_DE', 13);
if (!defined('PMS_BESCHWERDEN_DE'))  define('PMS_BESCHWERDEN_DE', 1337);
if (!defined('PMS_BEHANDLUNGEN_DE')) define('PMS_BEHANDLUNGEN_DE', 1372);
if (!defined('PMS_UEBERMICH_DE'))    define('PMS_UEBERMICH_DE', 1408);

/**
 * Base URL helpers
 */
function pms_get_site_base(): string {
    return rtrim(home_url('/'), '/');
}

/**
 * WPML: translate object id (page/post/term)
 * If WPML not active, returns base id.
 */
function pms_tr_id(int $base_id, string $type = 'page'): int {
    if ($base_id <= 0) return 0;

    if (function_exists('apply_filters') && defined('ICL_LANGUAGE_CODE')) {
        $tr = apply_filters('wpml_object_id', $base_id, $type, true, ICL_LANGUAGE_CODE);
        return $tr ? (int)$tr : (int)$base_id;
    }

    return (int)$base_id;
}

/**
 * Current page language for schema: de-AT / en / en-US etc.
 */
function pms_in_language(): string {
    if (defined('ICL_LANGUAGE_CODE') && ICL_LANGUAGE_CODE) {
        $code = (string) ICL_LANGUAGE_CODE;

        if ($code === 'de') return 'de-AT';
        if ($code === 'en') return 'en';

        return $code;
    }

    $loc = (string) get_locale();
    $loc = str_replace('_', '-', $loc);

    if ($loc === 'de-AT') return 'de-AT';
    if ($loc === 'de') return 'de-AT';

    return $loc ?: 'de-AT';
}

/**
 * Physician URL (WPML-aware)
 */
function pms_get_physician_url(): string {
    $id = pms_tr_id(PMS_UEBERMICH_DE, 'page');
    if ($id) {
        $url = get_permalink($id);
        if ($url) return $url;
    }

    return home_url('/ueber-mich/');
}

/**
 * Featured image helper
 */
function pms_get_featured_image_url(int $post_id): string {
    $url = get_the_post_thumbnail_url($post_id, 'full');
    return $url ? $url : '';
}

/**
 * Map "Monday" -> "https://schema.org/Monday"
 */
function pms_day_to_schema_url(string $day): string {
    $day = trim($day);

    $map = [
        'Monday'    => 'https://schema.org/Monday',
        'Tuesday'   => 'https://schema.org/Tuesday',
        'Wednesday' => 'https://schema.org/Wednesday',
        'Thursday'  => 'https://schema.org/Thursday',
        'Friday'    => 'https://schema.org/Friday',
        'Saturday'  => 'https://schema.org/Saturday',
        'Sunday'    => 'https://schema.org/Sunday',
    ];

    return $map[$day] ?? $day;
}

/**
 * Build OpeningHoursSpecification array
 */
function pms_build_opening_hours_spec(array $opening_hours): array {
    $spec = [];

    foreach ($opening_hours as $row) {
        $day    = trim((string)($row['day'] ?? ''));
        $opens  = trim((string)($row['opens'] ?? ''));
        $closes = trim((string)($row['closes'] ?? ''));

        if ($day === '' || $opens === '' || $closes === '') continue;

        $spec[] = [
            '@type'     => 'OpeningHoursSpecification',
            'dayOfWeek' => pms_day_to_schema_url($day),
            'opens'     => $opens,
            'closes'    => $closes,
        ];
    }

    return $spec;
}

/**
 * Check if current page equals base page (DE id) in current language (WPML-aware).
 */
function pms_is_page_base(int $base_page_id): bool {
    $current_id = (int) get_queried_object_id();
    if (!$current_id) return false;

    $target_id = pms_tr_id($base_page_id, 'page');
    return $current_id === $target_id;
}

/**
 * Check if current page is descendant of base page (DE id) in current language.
 */
function pms_is_descendant_base(int $base_page_id): bool {
    $current_id = (int) get_queried_object_id();
    if (!$current_id) return false;

    $target_id = pms_tr_id($base_page_id, 'page');
    if ($current_id === $target_id) return true;

    $ancestors = get_post_ancestors($current_id);
    if (empty($ancestors)) return false;

    return in_array($target_id, $ancestors, true);
}

/**
 * True if current page matches one of the base IDs (WPML-aware).
 */
function pms_is_page_in_set(array $base_ids, string $type = 'page'): bool {
    $current = (int) get_queried_object_id();
    if (!$current) return false;

    foreach ($base_ids as $id) {
        $id = (int) $id;
        if ($id <= 0) continue;

        $target = function_exists('pms_tr_id') ? (int) pms_tr_id($id, $type) : $id;
        if ($current === $target) return true;
    }

    return false;
}

/**
 * Base LocalBusiness settings from option (optional)
 */
function pms_get_localbusiness_settings(): array {
    $opt = get_option('pms_localbusiness', []);
    if (!is_array($opt)) $opt = [];

    $has_map = trim((string)($opt['has_map'] ?? ''));
    $same_as = $opt['same_as'] ?? [];

    if (is_string($same_as)) {
        $same_as = array_filter(array_map('trim', preg_split('~\R+~', $same_as)));
    }

    if (!is_array($same_as)) $same_as = [];
    $same_as = array_values(array_filter(array_map('trim', $same_as)));

    return [
        'has_map' => $has_map,
        'same_as' => $same_as,
    ];
}

/**
 * Build canonical LocalBusiness node.
 */
function pms_build_localbusiness_node(array $contact): array {
    $base = pms_get_site_base();

    $settings  = pms_get_localbusiness_settings();
    $telephone = trim((string)($contact['phones']['telephone'] ?? ''));
    $email     = trim((string)($contact['email'] ?? ''));

    $street  = trim((string)($contact['address']['street'] ?? ''));
    $postal  = trim((string)($contact['address']['postal_code'] ?? ''));
    $city    = trim((string)($contact['address']['locality'] ?? 'Wien'));
    $country = trim((string)($contact['address']['country'] ?? 'AT'));
    $rawAddress = trim((string)($contact['address']['address_raw'] ?? ''));

    $lat = (string)($contact['geo']['lat'] ?? '');
    $lng = (string)($contact['geo']['lng'] ?? '');

    $opening = pms_build_opening_hours_spec($contact['opening_hours'] ?? []);

    if (empty($settings['has_map']) && !empty($contact['localbusiness']['has_map'])) {
        $settings['has_map'] = (string)$contact['localbusiness']['has_map'];
    }

    $node = [
        '@type' => ['MedicalBusiness', 'LocalBusiness'],
        '@id'   => $base . '/#localbusiness',
        'name'  => trim((string)($contact['practice_name'] ?? 'Praxis')) ?: 'Praxis',
        'url'   => $base . '/',
        'parentOrganization' => ['@id' => $base . '/#medicalbusiness'],
    ];

    if ($telephone !== '') $node['telephone'] = $telephone;
    if ($email !== '')     $node['email'] = $email;

    $node['address'] = [
        '@type'           => 'PostalAddress',
        'streetAddress'   => ($street !== '' ? $street : $rawAddress),
        'postalCode'      => $postal,
        'addressLocality' => $city,
        'addressCountry'  => [
            '@type' => 'Country',
            'name'  => ($country !== '' ? $country : 'AT'),
        ],
    ];

    if ($lat !== '' && $lng !== '') {
        $node['geo'] = [
            '@type'     => 'GeoCoordinates',
            'latitude'  => (string)$lat,
            'longitude' => (string)$lng,
        ];
    }

    if (!empty($opening)) {
        $node['openingHoursSpecification'] = $opening;
    }

    if (!empty($settings['has_map'])) {
        $node['hasMap'] = $settings['has_map'];
    }

    if (!empty($settings['same_as'])) {
        $node['sameAs'] = $settings['same_as'];
    }

    return $node;
}

/**
 * Base graph: WebSite + MedicalBusiness + Physician
 */
function pms_build_base_graph(array $contact): array {
    $base = pms_get_site_base();
    $lang = pms_in_language();

    $telephone = trim((string)($contact['phones']['telephone'] ?? ''));
    $email     = trim((string)($contact['email'] ?? ''));

    $street  = trim((string)($contact['address']['street'] ?? ''));
    $postal  = trim((string)($contact['address']['postal_code'] ?? ''));
    $city    = trim((string)($contact['address']['locality'] ?? 'Wien'));
    $country = trim((string)($contact['address']['country'] ?? 'AT'));
    $rawAddress = trim((string)($contact['address']['address_raw'] ?? ''));

    $lat = (string)($contact['geo']['lat'] ?? '');
    $lng = (string)($contact['geo']['lng'] ?? '');

    $opening = pms_build_opening_hours_spec($contact['opening_hours'] ?? []);

    $website = [
        '@type' => 'WebSite',
        '@id'   => $base . '/#website',
        'url'   => $base . '/',
        'name'  => get_bloginfo('name'),
        'inLanguage' => $lang,
    ];

    $medicalbusiness = [
        '@type' => 'MedicalBusiness',
        '@id'   => $base . '/#medicalbusiness',
        'name'  => trim((string)($contact['practice_name'] ?? 'Praxis')) ?: 'Praxis',
        'url'   => $base . '/',
    ];

    if ($telephone !== '') $medicalbusiness['telephone'] = $telephone;
    if ($email !== '')     $medicalbusiness['email'] = $email;

    $medicalbusiness['address'] = [
        '@type'           => 'PostalAddress',
        'streetAddress'   => ($street !== '' ? $street : $rawAddress),
        'postalCode'      => $postal,
        'addressLocality' => $city,
        'addressCountry'  => [
            '@type' => 'Country',
            'name'  => ($country !== '' ? $country : 'AT'),
        ],
    ];

    if ($lat !== '' && $lng !== '') {
        $medicalbusiness['geo'] = [
            '@type'     => 'GeoCoordinates',
            'latitude'  => (string)$lat,
            'longitude' => (string)$lng,
        ];
    }

    if (!empty($opening)) {
        $medicalbusiness['openingHoursSpecification'] = $opening;
    }

    $physicianUrl = pms_get_physician_url();
    $physicianId  = rtrim($physicianUrl, '/') . '/#physician';

    $physician = [
        '@type' => ['Person', 'Physician'],
        '@id'   => $physicianId,
        'name'  => 'Prof. DDr. med. univ. Martin Faschingbauer',
        'url'   => $physicianUrl,
        'hasCredential' => [
            '@type'              => 'EducationalOccupationalCredential',
            'credentialCategory' => 'Facharzt für Orthopädie und Traumatologie',
        ],
        'worksFor' => [
            '@id' => $base . '/#medicalbusiness',
        ],
    ];

    return [$website, $medicalbusiness, $physician];
}

/**
 * Print JSON-LD graph
 */
function pms_print_jsonld(array $graph): void {
    $payload = [
        '@context' => 'https://schema.org',
        '@graph'   => $graph,
    ];

    echo "\n" . '<script type="application/ld+json">' .
        wp_json_encode($payload, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) .
        '</script>' . "\n";
}

