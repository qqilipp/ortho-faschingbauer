<?php
/**
 * Plugin Name: Faschingbauer Medical Schema
 * Description: Modular JSON-LD schema (WPML-ready) for homepage, Beschwerden, Behandlungen, Blog, Kontakt und FAQ.
 * Version: 0.2.0
 * Author: Your Name
 */

if (!defined('ABSPATH')) exit;

define('PMS_PATH', plugin_dir_path(__FILE__));
define('PMS_URL', plugin_dir_url(__FILE__));

require_once PMS_PATH . 'includes/class-pms-settings.php';
require_once PMS_PATH . 'includes/pms-data.php';
require_once PMS_PATH . 'includes/pms-schema-helpers.php';
// require_once PMS_PATH . 'includes/pms-bricks-faq.php';

add_action('plugins_loaded', function () {
    // Инициализация UI настроек (если класс есть)
    if (class_exists('PMS_Settings')) {
        PMS_Settings::init();
    }

    $opt = get_option('pms_options', []);
    if (!is_array($opt)) $opt = [];

    // Дефолты — только если опции ещё не заданы
    $defaults = [
        'home'          => '1',
        'beschwerde'    => '1',
        'behandlung'    => '1',
        'contact'       => '1',
        'blog_archive'  => '1',
        'blog_single'   => '1',
        'faq'           => '1',
        'localbusiness' => '1',
    ];

    // если опции пустые (первый запуск) — применяем дефолты
    if (empty($opt)) {
        $opt = $defaults;
        // можно сохранить один раз, чтобы UI сразу увидел значения
        update_option('pms_options', $opt, false);
    } else {
        // если опции есть — подмешиваем дефолты только для отсутствующих ключей
        $opt = array_merge($defaults, $opt);
    }

    $modules = [
        'home'          => 'modules/home.php',
        'beschwerde'    => 'modules/beschwerde.php',
        'behandlung'    => 'modules/behandlung.php',
        'contact'       => 'modules/contact.php',
        'blog_archive'  => 'modules/blog-archive.php',
        'blog_single'   => 'modules/blog-single.php',
        'faq'           => 'modules/faq.php',
        'localbusiness' => 'modules/localbusiness.php',
    ];

    foreach ($modules as $key => $relative_path) {
        if (empty($opt[$key])) continue;

        $full_path = PMS_PATH . $relative_path;
        if (file_exists($full_path)) {
            require_once $full_path;
        }
    }
}, 1);