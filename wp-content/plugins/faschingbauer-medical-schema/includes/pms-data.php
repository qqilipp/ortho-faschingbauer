<?php
if (!defined('ABSPATH')) exit;

/**
 * Get contact data by parsing Contact page content (WPML-aware)
 */
function pms_get_contact_data(): array {

    // WPML: get Kontakt page in current language
    $kontakt_id = function_exists('pms_tr_id') ? pms_tr_id(PMS_KONTAKT_DE, 'page') : PMS_KONTAKT_DE;

    $content = (string)get_post_field('post_content', $kontakt_id);
    $title   = (string)get_the_title($kontakt_id);

    // -------------------------
    // DEFAULT DATA (fallback)
    // -------------------------

    $fallback = [
        'practice_name' => 'Ortho Faschingbauer',
        'email'         => 'praxis@ortho-faschingbauer.at',
        'phones'        => [
            'telephone' => '+43 1 40 180 7010'
        ],
        'address'       => [
            'street'      => 'Lazarettgasse 25 / 1.OG',
            'postal_code' => '1090',
            'locality'    => 'Wien',
            'country'     => 'AT',
            'address_raw' => 'Lazarettgasse 25 / 1.OG, 1090 Wien',
        ],
        'geo' => [
            'lat' => '48.220690',
            'lng' => '16.360380'
        ],
        'opening_hours' => [
            [
                'day'   => 'Monday',
                'opens' => '09:00',
                'closes'=> '13:00'
            ],
            [
                'day'   => 'Thursday',
                'opens' => '14:00',
                'closes'=> '20:00'
            ],
            [
                'day'   => 'Friday',
                'opens' => '09:00',
                'closes'=> '13:00'
            ]
        ],
        'notes' => 'und nach Vereinbarung',
        'localbusiness' => [
            'has_map' => 'https://maps.app.goo.gl/v9D1b6JZ2NCcVaVG8'
        ],
        'source' => 'fallback',
        'contact_page' => [
            'id'    => $kontakt_id,
            'url'   => get_permalink($kontakt_id),
            'title' => $title,
        ]
    ];

    // если контактная страница пустая — возвращаем fallback
    if (trim($content) === '') {
        return $fallback;
    }

    // -------------------------
    // PARSING EMAIL
    // -------------------------

    $email = '';
    if (preg_match('~([A-Z0-9._%+\-]+@[A-Z0-9.\-]+\.[A-Z]{2,})~i', $content, $m)) {
        $email = trim($m[1]);
    }

    // -------------------------
    // PARSING PHONE
    // -------------------------

    $phone = '';
    if (preg_match('~(\+\d{1,3}\s*[0-9][0-9\s\/().–\-]{6,})~u', $content, $m)) {
        $phone = trim($m[1]);
    }

    // -------------------------
    // USE FALLBACK IF PARSER FAILED
    // -------------------------

    if (!$email) {
        $email = $fallback['email'];
    }

    if (!$phone) {
        $phone = $fallback['phones']['telephone'];
    }

    $fallback['email'] = $email;
    $fallback['phones']['telephone'] = $phone;
    $fallback['source'] = 'kontakt_page_parse';

    return $fallback;
}

/**
 * Convert day abbreviations (DE/EN) to English full day name
 */
function pms_day_abbr_to_english(string $abbr): string {

    $map = [
        'Mo' => 'Monday',
        'Di' => 'Tuesday',
        'Mi' => 'Wednesday',
        'Do' => 'Thursday',
        'Fr' => 'Friday',
        'Sa' => 'Saturday',
        'So' => 'Sunday',

        'Mon' => 'Monday',
        'Tue' => 'Tuesday',
        'Wed' => 'Wednesday',
        'Thu' => 'Thursday',
        'Fri' => 'Friday',
        'Sat' => 'Saturday',
        'Sun' => 'Sunday',
    ];

    return $map[$abbr] ?? $abbr;
}