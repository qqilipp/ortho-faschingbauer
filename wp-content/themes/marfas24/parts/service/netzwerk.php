<?php
if (!defined('ABSPATH')) exit;

/**
 * Netzwerk- / Kooperationspartner-Raster
 * Source: CPT "netzwerk", gruppiert nach Taxonomie "netzwerk_kategorie"
 * Nur auf der Seite "Kooperationen & Netzwerk" (ID 2146).
 */

if (!is_page(2146)) return;

if (!post_type_exists('netzwerk')) return;

// Feste Kategorie-Reihenfolge; unbekannte Kategorien landen danach.
$category_order = ['Kliniken', 'Universität & Wissenschaft', 'Fachgesellschaften', 'Therapiepartner'];

$terms = get_terms([
  'taxonomy'   => 'netzwerk_kategorie',
  'hide_empty' => true,
]);

if (empty($terms) || is_wp_error($terms)) return;

usort($terms, function ($a, $b) use ($category_order) {
  $pos_a = array_search($a->name, $category_order, true);
  $pos_b = array_search($b->name, $category_order, true);
  $pos_a = $pos_a === false ? 999 : $pos_a;
  $pos_b = $pos_b === false ? 999 : $pos_b;
  return $pos_a <=> $pos_b;
});
?>

<section class="netzwerk-section" aria-label="Netzwerkpartner">
  <div class="netzwerk-container">

    <?php foreach ($terms as $term) :

      $partners = get_posts([
        'post_type'      => 'netzwerk',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'orderby'        => 'title',
        'order'          => 'ASC',
        'tax_query'      => [[
          'taxonomy' => 'netzwerk_kategorie',
          'field'    => 'term_id',
          'terms'    => $term->term_id,
        ]],
      ]);

      if (empty($partners)) continue;
    ?>

      <div class="netzwerk-category">
        <h2 class="svc-section__title netzwerk-category__title"><?php echo esc_html($term->name); ?></h2>

        <div class="netzwerk-grid">
          <?php foreach ($partners as $partner) :
            $logo    = get_field('netzwerk_logo', $partner->ID);
            $desc    = (string) get_field('netzwerk_beschreibung', $partner->ID);
            $website = (string) get_field('netzwerk_website', $partner->ID);
            $name    = get_the_title($partner);
            $tag     = $website ? 'a' : 'div';
          ?>
            <<?php echo $tag; ?>
              class="netzwerk-card"
              <?php if ($website) : ?>href="<?php echo esc_url($website); ?>" target="_blank" rel="noopener"<?php endif; ?>
            >
              <?php if (is_array($logo) && !empty($logo['url'])) : ?>
                <img
                  class="netzwerk-card__logo"
                  src="<?php echo esc_url($logo['url']); ?>"
                  alt="<?php echo esc_attr(!empty($logo['alt']) ? $logo['alt'] : 'Logo ' . $name); ?>"
                  loading="lazy"
                >
              <?php endif; ?>

              <div class="netzwerk-card__body">
                <h3 class="netzwerk-card__name"><?php echo esc_html($name); ?></h3>
                <?php if ($desc) : ?>
                  <p class="netzwerk-card__desc"><?php echo esc_html($desc); ?></p>
                <?php endif; ?>
                <?php if ($website) : ?>
                  <span class="netzwerk-card__link">Website besuchen →</span>
                <?php endif; ?>
              </div>
            </<?php echo $tag; ?>>

          <?php endforeach; ?>
        </div>
      </div>

    <?php endforeach; ?>

  </div>
</section>
