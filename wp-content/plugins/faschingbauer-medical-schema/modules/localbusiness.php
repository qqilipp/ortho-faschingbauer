<?php
if (!defined('ABSPATH')) exit;

/**
 * LocalBusiness JSON-LD
 *
 * Выводим ТОЛЬКО на:
 * - главной странице
 * - странице Kontakt (DE/EN через WPML)
 *
 * Требуется:
 * pms_get_contact_data()
 * pms_build_localbusiness_node()
 */

add_action('wp_head', function () {

    $show = false;

    // Главная страница
    if (is_front_page()) {
        $show = true;
    }

    // Kontakt (через базовый DE ID + WPML)
    if (function_exists('pms_is_page_base') && pms_is_page_base(PMS_KONTAKT_DE)) {
        $show = true;
    }

    if (!$show) {
        return;
    }

    // Получаем контактные данные
    $contact = pms_get_contact_data();

    if (empty($contact) || !is_array($contact)) {
        return;
    }

    // Строим базовый LocalBusiness node
    $local = pms_build_localbusiness_node($contact);

    if (empty($local) || !is_array($local)) {
        return;
    }

    /**
     * Улучшаем schema
     */

    // Медицинский тип первым
    $local['@type'] = ['MedicalBusiness', 'LocalBusiness'];

    // Google Maps
    $local['hasMap'] = 'https://maps.app.goo.gl/v9D1b6JZ2NCcVaVG8';

    // География обслуживания
    $local['areaServed'] = [
        '@type' => 'City',
        'name'  => 'Wien'
    ];

    // Соцсети (если появятся)
    /*
    $local['sameAs'] = [
        'https://www.instagram.com/...',
        'https://www.facebook.com/...',
    ];
    */

    // Печать JSON-LD
    pms_print_jsonld([$local]);

}, 30);