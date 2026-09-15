<?php
/**
 * Custom Post Type "Netzwerk" (Kooperations-/Partnerseite)
 * Fields: Logo, Name (= Titel), Beschreibung, Link zur Website.
 * Grouped by taxonomy "netzwerk_kategorie" for the grid on the
 * Kooperationen & Netzwerk page (see parts/service/netzwerk.php).
 */

add_action('init', function () {

  register_post_type('netzwerk', [
    'labels' => [
      'name'               => __('Netzwerk'),
      'singular_name'      => __('Netzwerkpartner'),
      'add_new_item'       => __('Neuen Netzwerkpartner hinzufügen'),
      'edit_item'          => __('Netzwerkpartner bearbeiten'),
      'new_item'           => __('Neuer Netzwerkpartner'),
      'view_item'          => __('Netzwerkpartner ansehen'),
      'search_items'       => __('Netzwerkpartner suchen'),
      'not_found'          => __('Keine Netzwerkpartner gefunden'),
      'not_found_in_trash' => __('Keine Netzwerkpartner im Papierkorb'),
      'menu_name'          => __('Netzwerk'),
    ],
    'public'        => false,
    'show_ui'       => true,
    'show_in_menu'  => true,
    'has_archive'   => false,
    'query_var'     => false,
    'rewrite'       => false,
    'menu_icon'     => 'dashicons-groups',
    'menu_position' => 21,
    'supports'      => ['title'],
    'show_in_rest'  => false,
  ]);

  register_taxonomy('netzwerk_kategorie', ['netzwerk'], [
    'labels' => [
      'name'          => __('Netzwerk-Kategorien'),
      'singular_name' => __('Netzwerk-Kategorie'),
      'search_items'  => __('Kategorie suchen'),
      'all_items'     => __('Alle Kategorien'),
      'edit_item'     => __('Kategorie bearbeiten'),
      'update_item'   => __('Kategorie aktualisieren'),
      'add_new_item'  => __('Neue Kategorie'),
      'new_item_name' => __('Neue Kategorie'),
      'menu_name'     => __('Kategorien'),
    ],
    'hierarchical'      => true,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => false,
    'rewrite'           => false,
    'public'            => false,
  ]);

}, 0);

/**
 * "Titel eingeben" placeholder -> macht klar, dass der Titel der Name ist.
 */
add_filter('enter_title_here', function ($title, $post) {
  if (get_post_type($post) === 'netzwerk') {
    return __('Name des Partners (z. B. Wiener Privatklinik)');
  }
  return $title;
}, 10, 2);

/**
 * ACF-Felder: Logo, Beschreibung, Link zur Website
 */
add_action('acf/init', function () {

  if (!function_exists('acf_add_local_field_group')) return;

  acf_add_local_field_group([
    'key'    => 'group_netzwerk',
    'title'  => 'Netzwerkpartner',
    'fields' => [
      [
        'key'           => 'field_netzwerk_logo',
        'label'         => 'Logo',
        'name'          => 'netzwerk_logo',
        'type'          => 'image',
        'return_format' => 'array',
        'preview_size'  => 'medium',
        'instructions'  => 'Idealerweise ein Logo mit transparentem Hintergrund (PNG/SVG). Optional – ohne Logo wird eine reine Textkarte angezeigt.',
      ],
      [
        'key'          => 'field_netzwerk_beschreibung',
        'label'        => 'Beschreibung',
        'name'         => 'netzwerk_beschreibung',
        'type'         => 'textarea',
        'rows'         => 3,
        'instructions' => 'Kurzer Satz zur Art der Kooperation (1–2 Sätze).',
      ],
      [
        'key'          => 'field_netzwerk_website',
        'label'        => 'Link zur Website',
        'name'         => 'netzwerk_website',
        'type'         => 'url',
        'instructions' => 'Vollständige URL inkl. https://',
      ],
    ],
    'location' => [
      [
        [
          'param'    => 'post_type',
          'operator' => '==',
          'value'    => 'netzwerk',
        ],
      ],
    ],
  ]);

});

/**
 * Vier Standard-Kategorien einmalig anlegen (idempotent).
 * Sinnvolle Gliederung für Dr. Faschingbauers fachliches Netzwerk:
 * Ordination/Klinik, akademische Ausbildung, Fachgesellschaften, Therapiepartner.
 */
add_action('init', function () {

  if (get_option('netzwerk_kategorien_seeded')) return;

  $terms = [
    'Kliniken',
    'Universität & Wissenschaft',
    'Fachgesellschaften',
    'Therapiepartner',
  ];

  foreach ($terms as $term) {
    if (!term_exists($term, 'netzwerk_kategorie')) {
      wp_insert_term($term, 'netzwerk_kategorie');
    }
  }

  update_option('netzwerk_kategorien_seeded', 1, false);

}, 20);
