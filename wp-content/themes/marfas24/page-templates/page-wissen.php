<?php
/**
 * Template Name: Wissen Archiv
 */
get_header("custom");
?>

<main id="main" class="wissen-page">

  <section class="wissen-hero">
    <div class="wissen-container">

      <p class="wissen-breadcrumb">
        <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
        <span class="wissen-sep">/</span>
        <span><?php echo esc_html(get_the_title()); ?></span>
      </p>

      <h1 class="wissen-title"><?php the_title(); ?></h1>

    </div>
  </section>

  <section class="wissen-list">
    <div class="wissen-container">

      <div class="wissen-grid">
        <?php
        $printed = 0;

        for ($i = 1; $i <= 6; $i++) {

          $page  = get_field("card_{$i}_page");   // Link array
          $title = get_field("card_{$i}_title");
          $text  = get_field("card_{$i}_text");
          $image = get_field("card_{$i}_image");  // Image array

          if (!is_array($page) || empty($page['url'])) continue;

          $url    = $page['url'];
          $target = $page['target'] ?? '';
          $link_title = $page['title'] ?? '';

          // Title fallback
          if (!$title) $title = $link_title;

          // Text shorten a bit (optional)
          $excerpt = $text ? wp_trim_words(wp_strip_all_tags($text), 22) : '';

          // Image
          $img_html = '';
          if (is_array($image) && !empty($image['url'])) {
            $alt = !empty($image['alt']) ? $image['alt'] : ($title ?: 'Wissen');
            $img_html = '<img class="wissen-card__img" loading="lazy" src="' . esc_url($image['url']) . '" alt="' . esc_attr($alt) . '">';
          }

          $target_attr = $target ? ' target="' . esc_attr($target) . '"' : '';
          $rel_attr    = $target ? ' rel="noopener"' : '';

          $printed++;
          ?>
          <article class="wissen-card">
            <a class="wissen-card__media" href="<?php echo esc_url($url); ?>"<?php echo $target_attr . $rel_attr; ?>>
              <?php echo $img_html ?: '<div class="wissen-card__img wissen-card__img--placeholder"></div>'; ?>
            </a>

            <div class="wissen-card__body">
              <?php if ($title) : ?>
                <h2 class="wissen-card__title">
                  <a href="<?php echo esc_url($url); ?>"<?php echo $target_attr . $rel_attr; ?>>
                    <?php echo esc_html($title); ?>
                  </a>
                </h2>
              <?php endif; ?>

              <?php if ($excerpt) : ?>
                <p class="wissen-card__excerpt"><?php echo esc_html($excerpt); ?></p>
              <?php endif; ?>

              <a class="wissen-card__btn" href="<?php echo esc_url($url); ?>"<?php echo $target_attr . $rel_attr; ?>>Mehr »</a>
            </div>
          </article>
        <?php } ?>
      </div>

      <?php if ($printed === 0) : ?>
        <p>Bitte fügen Sie mindestens eine Karte (Card 1–6) im Admin-Bereich hinzu.</p>
      <?php endif; ?>

    </div>
  </section>

</main>

<?php get_footer("custom"); ?>