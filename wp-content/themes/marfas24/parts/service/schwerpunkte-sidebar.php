<?php
if ( ! defined('ABSPATH') ) exit;

/**
 * Compact Schwerpunkte link list for the sidebar (used on "Über mich").
 * Source: ACF repeater "svc_cards" on the "Schwerpunkte" hub page (ID 1467) —
 * same field/data cards.php renders full-width there, just laid out for the
 * narrow sidebar column instead of duplicating content by hand.
 */
$svc_schwerpunkte_id = 1467;

if ( ! function_exists('have_rows') || ! have_rows('svc_cards', $svc_schwerpunkte_id) ) {
  return;
}
?>

<div class="svc-card svc-card--linklist">
  <div class="svc-card__title">Schwerpunkte</div>

  <div class="svc-linklist">
    <?php while ( have_rows('svc_cards', $svc_schwerpunkte_id) ) : the_row();

      $link    = get_sub_field('link');
      $title   = (string) get_sub_field('title');
      $excerpt = (string) get_sub_field('excerpt');
      $image   = get_sub_field('image');

      $url = '';
      if (is_array($link) && !empty($link['url'])) {
        $url = $link['url'];
      } elseif (is_string($link)) {
        $url = $link;
      }

      $img_url = '';
      $img_alt = $title;
      if (is_array($image)) {
        if (!empty($image['url'])) $img_url = $image['url'];
        if (!empty($image['alt'])) $img_alt = $image['alt'];
      } elseif (is_string($image)) {
        $img_url = $image;
      }

      if (!$url && !$title && !$excerpt) continue;
    ?>
      <a class="svc-linklist__item" href="<?php echo esc_url($url ?: '#'); ?>">
        <?php if ($img_url) : ?>
          <span class="svc-linklist__thumb">
            <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($img_alt); ?>" loading="lazy">
          </span>
        <?php endif; ?>
        <span class="svc-linklist__body">
          <?php if ($title) : ?>
            <span class="svc-linklist__title"><?php echo esc_html($title); ?></span>
          <?php endif; ?>
          <?php if ($excerpt) : ?>
            <span class="svc-linklist__excerpt"><?php echo esc_html(wp_trim_words(wp_strip_all_tags($excerpt), 14)); ?></span>
          <?php endif; ?>
        </span>
      </a>
    <?php endwhile; ?>
  </div>
</div>
