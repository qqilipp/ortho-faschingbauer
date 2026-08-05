<?php
/**
 * Service Cards (after FAQ)
 * Source: ACF repeater "svc_cards"
 * Output: blog-like cards (.wissen-grid / .wissen-card)
 */

// If ACF isn't available or no cards on this page — output nothing.
if (!function_exists('have_rows') || !have_rows('svc_cards')) {
  return;
}
?>

<section class="wissen-list" aria-label="Weitere Inhalte">
  <div class="wissen-container">
    <div class="wissen-grid">

      <?php while (have_rows('svc_cards')) : the_row();

        // Link can be ACF "Link" array or simple URL string
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

        // Image can be array (recommended). We'll use full URL.
        $img_url = '';
        $img_alt = $title;

        if (is_array($image)) {
          if (!empty($image['url'])) $img_url = $image['url'];
          if (!empty($image['alt'])) $img_alt = $image['alt'];
        } elseif (is_string($image)) {
          $img_url = $image;
        }

        // Skip completely empty rows
        if (!$url && !$title && !$excerpt && !$img_url) {
          continue;
        }
      ?>
        <a class="wissen-card" href="<?php echo esc_url($url ?: '#'); ?>">

          <?php if ($img_url) : ?>
            <img
              class="wissen-card__img"
              src="<?php echo esc_url($img_url); ?>"
              alt="<?php echo esc_attr($img_alt); ?>"
              loading="lazy"
              decoding="async"
            >
          <?php else : ?>
            <span class="wissen-card__img wissen-card__img--placeholder" aria-hidden="true"></span>
          <?php endif; ?>

          <div class="wissen-card__body">

            <?php if ($title) : ?>
              <h2 class="wissen-card__title"><?php echo esc_html($title); ?></h2>
            <?php endif; ?>

            <?php if ($excerpt) : ?>
              <p class="wissen-card__excerpt">
                <?php echo esc_html($excerpt); ?>
              </p>
            <?php endif; ?>

          </div>
        </a>

      <?php endwhile; ?>

    </div>
  </div>
</section>