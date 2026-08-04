<?php
if (!defined('ABSPATH')) exit;

/**
 * Get raw Bricks data from common meta keys.
 */
function pms_get_bricks_data(int $post_id) {
    $keys = ['_bricks_page_content', '_bricks_data', '_bricks_editor_data'];

    foreach ($keys as $k) {
        $raw = get_post_meta($post_id, $k, true);
        if (empty($raw)) continue;

        // Sometimes already array, sometimes JSON string
        if (is_array($raw)) return $raw;

        if (is_string($raw)) {
            $decoded = json_decode($raw, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                return $decoded;
            }
        }
    }

    return null;
}

/**
 * Recursively walk Bricks elements tree.
 * Bricks usually stores elements as array of nodes; each node has:
 * - "name" or "type"
 * - "settings"
 * - "children"
 */
function pms_walk_bricks_elements($nodes, callable $cb): void {
    if (!is_array($nodes)) return;

    foreach ($nodes as $node) {
        if (!is_array($node)) continue;

        $cb($node);

        // children might be in "children" or sometimes nested "elements"
        if (!empty($node['children']) && is_array($node['children'])) {
            pms_walk_bricks_elements($node['children'], $cb);
        }
        if (!empty($node['elements']) && is_array($node['elements'])) {
            pms_walk_bricks_elements($node['elements'], $cb);
        }
    }
}

/**
 * Extract FAQ items from a Bricks Accordion-like element.
 * Supports:
 * - settings.items[] with title/content (most common)
 * - settings.panels[] etc (fallback)
 */
function pms_extract_faq_items_from_node(array $node): array {
    $settings = $node['settings'] ?? [];
    if (!is_array($settings)) return [];

    $candidates = [];

    if (!empty($settings['items']) && is_array($settings['items'])) {
        $candidates = $settings['items'];
    } elseif (!empty($settings['panels']) && is_array($settings['panels'])) {
        $candidates = $settings['panels'];
    } elseif (!empty($settings['accordionItems']) && is_array($settings['accordionItems'])) {
        $candidates = $settings['accordionItems'];
    }

    $out = [];
    foreach ($candidates as $it) {
        if (!is_array($it)) continue;

        // Common field names
        $q = (string)($it['title'] ?? $it['label'] ?? $it['heading'] ?? '');
        $a = (string)($it['content'] ?? $it['text'] ?? $it['body'] ?? '');

        $q = trim(wp_strip_all_tags($q));
        $a = trim(html_entity_decode(wp_strip_all_tags($a), ENT_QUOTES, 'UTF-8'));

        if ($q === '' || $a === '') continue;

        $out[] = ['q' => $q, 'a' => $a];
    }

    return $out;
}

/**
 * Main: get FAQ items from Bricks page by searching for:
 * - element that has class/ID marker (recommended)
 * - then fallback to any accordion elements if marker not set (optional)
 */
function pms_get_faq_from_bricks(int $post_id, array $opts = []): array {
    $marker_class = $opts['marker_class'] ?? 'schema-faq';
    $marker_id    = $opts['marker_id'] ?? ''; // optional
    $allow_fallback_any_accordion = (bool)($opts['fallback_any'] ?? false);

    $data = pms_get_bricks_data($post_id);
    if (!$data) return [];

    $found = [];

    // Bricks structure: sometimes root is array of elements, sometimes wraps in ['content'].
    $nodes = $data;
    if (isset($data['content']) && is_array($data['content'])) {
        $nodes = $data['content'];
    }

    // 1) First pass: find marked element and extract from it
    pms_walk_bricks_elements($nodes, function(array $node) use (&$found, $marker_class, $marker_id) {
        $settings = $node['settings'] ?? [];
        if (!is_array($settings)) return;

        $id    = (string)($settings['_cssId'] ?? $settings['cssId'] ?? $settings['id'] ?? '');
        $class = (string)($settings['_cssClasses'] ?? $settings['cssClasses'] ?? $settings['class'] ?? '');

        $has_marker =
            ($marker_id !== '' && $id === $marker_id) ||
            ($marker_class !== '' && $class !== '' && preg_match('~\b' . preg_quote($marker_class, '~') . '\b~', $class));

        if (!$has_marker) return;

        $items = pms_extract_faq_items_from_node($node);
        if (!empty($items)) {
            $found = array_merge($found, $items);
        }
    });

    if (!empty($found)) {
        // Deduplicate by question
        $uniq = [];
        foreach ($found as $it) $uniq[$it['q']] = $it['a'];
        $out = [];
        foreach ($uniq as $q => $a) $out[] = ['q' => $q, 'a' => $a];
        return $out;
    }

    // 2) Optional fallback: any accordion-like element
    if (!$allow_fallback_any_accordion) return [];

    pms_walk_bricks_elements($nodes, function(array $node) use (&$found) {
        $name = (string)($node['name'] ?? $node['type'] ?? '');

        // Loose detection: element name contains "accordion" or "toggle"
        if (!preg_match('~accordion|toggle|faq~i', $name)) return;

        $items = pms_extract_faq_items_from_node($node);
        if (!empty($items)) {
            $found = array_merge($found, $items);
        }
    });

    return $found;
}