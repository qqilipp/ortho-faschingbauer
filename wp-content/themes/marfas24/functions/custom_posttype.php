<?php
/**
 * Custom Post Types
 */

add_action('init', function () {

  // Produkte
  register_post_type('produkte', [
    'labels' => [
      'name'          => __('Produkte'),
      'singular_name' => __('Produkt'),
      'menu_name'     => __('Produkte'),
    ],
    'public'      => true,
    'has_archive' => true,
    'rewrite'     => [
      'slug' => 'produkte',
    ],
    'menu_icon'   => 'dashicons-products',
    'supports'    => ['title', 'editor', 'thumbnail', 'excerpt'],
  ]);

  // Termine
  register_post_type('termine', [
    'labels' => [
      'name'          => __('Seminare & Workshops'),
      'singular_name' => __('Termin'),
      'menu_name'     => __('Termine'),
    ],
    'public'      => true,
    'has_archive' => true,
    'rewrite'     => [
      'slug' => 'termine',
    ],
    'menu_icon'   => 'dashicons-calendar-alt',
    'supports'    => ['title', 'editor', 'thumbnail', 'excerpt'],
  ]);

  // Services (наши страницы услуг)
  register_post_type('service', [
    'labels' => [
      // ...
    ],
    'public'        => true,
    'has_archive'   => false,
    'rewrite'       => [
      'slug'       => 'service',
      'with_front' => false,
    ],
    'query_var'     => true,
    'menu_position' => 20,
    'menu_icon'     => 'dashicons-admin-tools',
    'supports'      => ['title'],
    'show_in_rest'  => false,
  ]);

}, 0);