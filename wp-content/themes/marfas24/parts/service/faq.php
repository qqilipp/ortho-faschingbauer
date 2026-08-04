<?php
if ( ! defined('ABSPATH') ) exit;

$post_id = get_queried_object_id();

if ( ! function_exists('have_rows') || ! have_rows('faq_items', $post_id) ) {
  return;
}
?>

<section class="svc-faq" aria-label="FAQ">
  <div class="svc-faq__container">
    <div class="svc-faq__grid">

      <div class="svc-faq__head">
        <?php
$title = get_the_title($post_id);
?>

<h2 class="svc-faq__title">
  Häufige Fragen
  <?php if ($title) : ?>
    <span class="svc-faq__subtitle">
      zur <?php echo esc_html($title); ?>
    </span>
  <?php endif; ?>
</h2>
      </div>

      <div class="svc-faq__list" data-svc-faq>
        <?php $i = 0; while ( have_rows('faq_items', $post_id) ) : the_row();
          $q = get_sub_field('question');
          $a = get_sub_field('answer');
          if (!$q || !$a) { $i++; continue; }
          $i++;
          $panel_id = 'svc-faq-panel-' . $post_id . '-' . $i;
          $btn_id   = 'svc-faq-btn-' . $post_id . '-' . $i;
        ?>
          <div class="svc-faq__item">
            <button
              class="svc-faq__btn"
              type="button"
              id="<?php echo esc_attr($btn_id); ?>"
              aria-expanded="false"
              aria-controls="<?php echo esc_attr($panel_id); ?>"
            >
              <span class="svc-faq__q"><?php echo esc_html($q); ?></span>
              <span class="svc-faq__icon" aria-hidden="true"></span>
            </button>

            <div class="svc-faq__panel" id="<?php echo esc_attr($panel_id); ?>" role="region" aria-labelledby="<?php echo esc_attr($btn_id); ?>">
              <div class="svc-faq__a">
                <?php echo wp_kses_post($a); ?>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      </div>

    </div>
  </div>
</section>