<?php
if ( ! defined('ABSPATH') ) exit;

$post_id = get_queried_object_id();

if ( ! function_exists('have_rows') || ! have_rows('service_content', $post_id) ) {
  return;
}
?>

<section class="svc-sections">
  <div class="svc-sections__container">

    <?php while ( have_rows('service_content', $post_id) ) : the_row(); ?>

      <?php if ( get_row_layout() === 'text_block' ) :
        $title = get_sub_field('title');
        $text  = get_sub_field('text');
      ?>
        <article class="svc-section svc-section--text">
          <?php if ($title) : ?>
            <h2 class="svc-section__title"><?php echo esc_html($title); ?></h2>
          <?php endif; ?>

          <?php if ($text) : ?>
            <div class="svc-section__content"><?php echo wp_kses_post($text); ?></div>
          <?php endif; ?>
        </article>

      <?php elseif ( get_row_layout() === 'text_with_bullets' ) :
        $title     = get_sub_field('title');
        $intro     = get_sub_field('intro');
        $list_type = get_sub_field('list_type') ?: 'ul'; // ul or ol

        $blocks    = get_sub_field('blocks');   // Repeater (Subblocks)
        $bullets   = get_sub_field('bullets');  // Repeater (old bullets)

        $is_ol      = ($list_type === 'ol');
        $list_tag   = $is_ol ? 'ol' : 'ul';
        $list_class = $is_ol ? 'svc-list svc-list--ol' : 'svc-list svc-list--ul';
      ?>
        <article class="svc-section svc-section--bullets">

          <?php if ($title) : ?>
            <h2 class="svc-section__title"><?php echo esc_html($title); ?></h2>
          <?php endif; ?>

          <?php if ($intro) : ?>
            <div class="svc-section__content"><?php echo wp_kses_post($intro); ?></div>
          <?php endif; ?>

          <?php
          // A) Bullets (old simple list) — show if filled
          if (!empty($bullets) && is_array($bullets)) : ?>
            <<?php echo $list_tag; ?> class="<?php echo esc_attr($list_class); ?>">
              <?php foreach ($bullets as $row) :
                $bullet = $row['bullet'] ?? '';
                if (!$bullet) continue;
              ?>
                <li class="svc-list__item"><?php echo wp_kses_post($bullet); ?></li>

              <?php endforeach; ?>
            </<?php echo $list_tag; ?>>
          <?php endif; ?>

          <?php
          // B) Subblocks (h3 + intro + list) — show if filled
          if (!empty($blocks) && is_array($blocks)) : ?>
            <div class="svc-subblocks">
              <?php foreach ($blocks as $b) :
                $sub_title = $b['sub_title'] ?? '';
                $sub_intro = $b['sub_intro'] ?? '';
                // IMPORTANT: your ACF field name is "list_items"
                $items     = $b['list_items'] ?? [];
                if (!$sub_title && !$sub_intro && empty($items)) continue;
              ?>
                <div class="svc-subblock">

                  <?php if ($sub_title) : ?>
                    <h3 class="svc-subblock__title"><?php echo esc_html($sub_title); ?></h3>
                  <?php endif; ?>

                  <?php if ($sub_intro) : ?>
                    <div class="svc-subblock__intro"><?php echo wp_kses_post($sub_intro); ?></div>
                  <?php endif; ?>

                  <?php if (!empty($items) && is_array($items)) : ?>
                    <<?php echo $list_tag; ?> class="<?php echo esc_attr($list_class); ?>">
                      <?php foreach ($items as $it) :
                        $item = $it['item'] ?? '';
                        if (!$item) continue;
                      ?>
                        <li class="svc-list__item"><?php echo wp_kses_post($item); ?></li>

                      <?php endforeach; ?>
                    </<?php echo $list_tag; ?>>
                  <?php endif; ?>

                </div>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>

        </article>

      <?php elseif ( get_row_layout() === 'fullwidth_image' ) :
        $img = get_sub_field('image');
      ?>
        <?php if (!empty($img) && is_array($img)) : ?>
          <figure class="svc-section svc-section--image">
            <img
              src="<?php echo esc_url($img['url']); ?>"
              alt="<?php echo esc_attr(!empty($img['alt']) ? $img['alt'] : get_the_title($post_id)); ?>"
              loading="lazy"
            >
          </figure>
        <?php endif; ?>

      <?php elseif ( get_row_layout() === 'form' ) :
        $svc_form_title  = get_sub_field('titel');
        $svc_form_teaser = get_sub_field('teaser');
        $form_id         = get_sub_field('form_id');
      ?>
        <?php if ($form_id) : ?>
          <div class="svc-section svc-section--form">
            <div class="svc-form">
              <?php if ($svc_form_title) : ?>
                <h2 class="svc-form__title"><?php echo esc_html($svc_form_title); ?></h2>
              <?php endif; ?>
              <?php if ($svc_form_teaser) : ?>
                <p class="svc-form__teaser"><?php echo esc_html($svc_form_teaser); ?></p>
              <?php endif; ?>
              <?php echo do_shortcode('[ws_form id="' . esc_attr($form_id) . '"]'); ?>
            </div>
          </div>
        <?php endif; ?>

      <?php elseif ( get_row_layout() === 'quote' ) :
        $quote  = get_sub_field('quote');
        $author = get_sub_field('author');
      ?>
        <?php if ($quote) : ?>
          <blockquote class="svc-section svc-section--quote">
            <p class="svc-quote__text"><?php echo esc_html($quote); ?></p>
            <?php if ($author) : ?>
              <cite class="svc-quote__author"><?php echo esc_html($author); ?></cite>
            <?php endif; ?>
          </blockquote>
        <?php endif; ?>

      <?php elseif ( get_row_layout() === 'steps' ) :
        $title = get_sub_field('title');
        $intro = get_sub_field('intro');
        $steps = get_sub_field('steps');
      ?>
        <article class="svc-section svc-section--steps">
          <?php if ($title) : ?>
            <h2 class="svc-section__title"><?php echo esc_html($title); ?></h2>
          <?php endif; ?>

          <?php if ($intro) : ?>
            <div class="svc-section__content"><?php echo wp_kses_post($intro); ?></div>
          <?php endif; ?>

          <?php if (!empty($steps) && is_array($steps)) : ?>
            <ol class="svc-steps">
              <?php foreach ($steps as $s) :
                $st = $s['step_title'] ?? '';
                $tx = $s['step_text'] ?? '';
                if (!$st && !$tx) continue;
              ?>
                <li class="svc-steps__item">
                  <?php if ($st) : ?>
                    <h3 class="svc-steps__title"><?php echo esc_html($st); ?></h3>
                  <?php endif; ?>
                  <?php if ($tx) : ?>
                    <div class="svc-steps__text"><?php echo wp_kses_post($tx); ?></div>
                  <?php endif; ?>
                </li>
              <?php endforeach; ?>
            </ol>
          <?php endif; ?>
        </article>

      <?php elseif ( get_row_layout() === 'inline_cta' ) :
        $label = get_sub_field('button_label');
        $link  = get_sub_field('button_link');
        $url   = is_array($link) ? ($link['url'] ?? '') : '';
        $tgt   = is_array($link) ? ($link['target'] ?? '') : '';
      ?>
        <?php if ($label && $url) : ?>
          <div class="svc-section svc-section--cta">
            <a class="svc-btn svc-btn--primary"
               href="<?php echo esc_url($url); ?>"
               <?php echo $tgt ? 'target="'.esc_attr($tgt).'" rel="noopener"' : ''; ?>>
              <?php echo esc_html($label); ?>
            </a>
          </div>
        <?php endif; ?>

      <?php endif; ?>

    <?php endwhile; ?>

  </div>
</section>