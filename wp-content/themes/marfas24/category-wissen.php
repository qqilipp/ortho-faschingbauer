<?php
/**
 * Category Template: Wissen
 * File name: category-wissen.php (slug категории = wissen)
 */

get_header("custom");

// текущая категория
$term = get_queried_object();
$term_name = is_object($term) && !empty($term->name) ? $term->name : 'Wissen';

/**
 * ===== STATIC 5 CARDS (manual) =====
 * Тут ты руками задаёшь 5 карточек (URL/Title/Text/Image).
 * Ничего динамического, никаких ACF.
 */

/*
$static_cards = [
  [
    'url'   => home_url('hueftbeschwerden/'), // <-- поменяй на нужную страницу
    'title' => 'Hüfte',
    'text'  => 'Ein Orthopäde für die Hüfte ist dann gefragt, wenn Hüftschmerzen, Bewegungseinschränkungen oder funktionelle Probleme des Hüftgelenks den Alltag zunehmend beeinträchtigen.',
    'img'   => home_url('/wp-content/uploads/dr-martin-faschingbauer-kuenstliches-hueftgelenk.jpg'),
    'alt'   => 'Service 1',
  ],
  [
    'url'   => home_url('/kniebeschwerden/'), // <-- поменяй
    'title' => 'Beschwerden am Knie',
    'text'  => 'Ob beim Sport, beim Wandern oder beim einfachen Treppensteigen – wenn das Knie streikt, ist eine fachkundige Analyse von einem spezialisierten Knie Orthopäden gefragt.',
    'img'   => home_url('/wp-content/uploads/dr-martin-faschingbauer-kuenstliches-hueftgelenk.jpg'),
    'alt'   => 'Service 2',
  ],
  [
    'url'   => home_url('/schulter-orthopaede-bei-schmerzen-und-verletzungen/'), // <-- поменяй
    'title' => 'Schulter Orthopäde',
    'text'  => 'Das Schultergelenk ist das beweglichste Gelenk unseres Körpers, was es jedoch auch besonders anfällig für Verschleiß und Verletzungen macht. ',
    'img'   => home_url('/wp-content/uploads/dr-martin-faschingbauer-kuenstliches-hueftgelenk.jpg'),
    'alt'   => 'Service 3',
  ],
  [
    'url'   => home_url('/ellenbogen-und-handspezialist/'), // <-- поменяй
    'title' => 'Hand & Ellenbogen',
    'text'  => 'Die Hand ist unser wichtigstes Werkzeug im Alltag, während der Ellenbogen als stabiles Scharnier die Positionierung im Raum erst ermöglicht.',
    'img'   => home_url('/wp-content/uploads/dr-martin-faschingbauer-kuenstliches-hueftgelenk.jpg'),
    'alt'   => 'Service 4',
  ],
  [
    'url'   => home_url('/orthopaedie-fuer-fuss-und-sprunggelenk/'), // <-- поменяй
    'title' => 'Fuß & Sprunggelenk',
    'text'  => 'Die Orthopädie für Fuß und Sprunggelenk befasst sich mit Beschwerden an Strukturen, die täglich hohe Belastungen tragen und für Stand, Gang und Gleichgewicht essentiell sind.',
    'img'   => home_url('/wp-content/uploads/dr-martin-faschingbauer-kuenstliches-hueftgelenk.jpg'),
    'alt'   => 'Service 5',
  ],
];


*/
?>

<style>
/* ===== Wissen Category ===== */

.wissen-page{ background: transparent; }

.wissen-container{
  max-width: 1180px;
  margin: 0 auto;
  padding: 0 24px;
}

.wissen-hero{ padding: 30px 0 10px; }

.wissen-breadcrumb{
  font-size: 12px;
  letter-spacing: .04em;
  text-transform: uppercase;
  opacity: .75;
  margin: 0 0 16px;
}
.wissen-breadcrumb a{ text-decoration:none; }
.wissen-breadcrumb a:hover{ text-decoration:underline; }
.wissen-sep{ margin: 0 8px; opacity:.6; }

.wissen-title{
  margin: 0 0 18px;
  font-size: 34px;
  line-height: 1.2;
  font-weight: 400;
  color: rgba(0,0,0,.70);
}

/* GRID */
.wissen-posts{ padding: 8px 0 26px; }

.wissen-grid{
  display:grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 22px;
}

/* Card (общий стиль) */
.wissen-card{
  background:#f6f8f9;
  border:1px solid rgba(0,0,0,.08);
  border-radius: 14px;
  overflow:hidden;
  display:flex;
  flex-direction:column;
  min-height: 100%;
}

.wissen-card__media{
  display:block;
  text-decoration:none;
}
.wissen-card__img{
  width:100%;
  height: 210px;
  object-fit: cover;
  display:block;
}
.wissen-card__img--placeholder{
  height: 210px;
  background: rgba(0,0,0,.06);
}

.wissen-card__body{
  padding: 16px 16px 18px;
  display:flex;
  flex-direction:column;
  gap: 10px;
  flex: 1;
}

.wissen-card__title{
  margin:0;
  font-size: 16px;
  line-height: 1.25;
  font-weight: 700;
  color: rgba(0,0,0,.80);
}
.wissen-card__title a{
  color: inherit;
  text-decoration:none;
}
.wissen-card__title a:hover{ text-decoration:underline; }

.wissen-card__meta{
  font-size: 12px;
  opacity: .75;
  line-height: 1.4;
}

.wissen-card__excerpt{
  margin:0;
  font-size: 13px;
  line-height: 1.6;
  color: rgba(0,0,0,.75);
}

.wissen-card__btn{
  margin-top: auto;
  display:inline-flex;
  width: fit-content;
  align-items:center;
  justify-content:center;
  background:#6a96a5;
  color:#fff;
  padding: 9px 14px;
  border-radius: 10px;
  text-decoration:none;
  font-weight:600;
  font-size: 12px;
}
.wissen-card__btn:hover{ background:#5a8391; color:#fff; }

/* Pagination */
.wissen-pagination{
  margin-top: 20px;
}
.wissen-pagination .page-numbers{
  display:inline-block;
  margin-right: 8px;
  padding: 8px 10px;
  border-radius: 10px;
  border:1px solid rgba(0,0,0,.08);
  text-decoration:none;
}
.wissen-pagination .current{
  background:#6a96a5;
  color:#fff;
  border-color: transparent;
}

/* Divider */
.wissen-divider{
  border: 0;
  height: 1px;
  background: rgba(0,0,0,.12);
  margin: 22px 0 24px;
}

/* Bottom cards: 2 колонки */
.wissen-bottom{ padding: 0 0 40px; }
.wissen-bottom__title{
  margin: 0 0 14px;
  font-size: 18px;
  font-weight: 700;
  color: rgba(0,0,0,.75);
}

@media (max-width: 980px){
  .wissen-grid{ grid-template-columns: 1fr; }
  .wissen-title{ font-size: 28px; }
  .wissen-card__img, .wissen-card__img--placeholder{ height: 200px; }
}
</style>

<main id="main" class="wissen-page">

  <section class="wissen-hero">
    <div class="wissen-container">

      <p class="wissen-breadcrumb">
        <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
        <span class="wissen-sep">/</span>
        <span><?php echo esc_html($term_name); ?></span>
      </p>

      <h1 class="wissen-title"><?php echo esc_html($term_name); ?></h1>

    </div>
  </section>

  <!-- POSTS -->
  <section class="wissen-posts">
    <div class="wissen-container">

      <div class="wissen-grid">
        <?php if (have_posts()) : while (have_posts()) : the_post();

          $post_id = get_the_ID();
          $url     = get_permalink($post_id);
          $title   = get_the_title($post_id);

          $date_iso = get_the_date('c', $post_id);
          $date_hum = get_the_date(get_option('date_format'), $post_id);

          $author_id   = (int) get_post_field('post_author', $post_id);
          $author_name = get_the_author_meta('display_name', $author_id);

          $cats = get_the_category($post_id);
          $cat_name = (!empty($cats) && !is_wp_error($cats)) ? $cats[0]->name : $term_name;

          $excerpt = get_the_excerpt($post_id);
          $excerpt = $excerpt ? wp_trim_words(wp_strip_all_tags($excerpt), 22) : '';

          $img_html = '';
          if (has_post_thumbnail($post_id)) {
            $img_html = get_the_post_thumbnail($post_id, 'large', [
              'class' => 'wissen-card__img',
              'loading' => 'lazy',
            ]);
          }
          ?>
          <article class="wissen-card">
            <a class="wissen-card__media" href="<?php echo esc_url($url); ?>">
              <?php echo $img_html ?: '<div class="wissen-card__img wissen-card__img--placeholder"></div>'; ?>
            </a>

            <div class="wissen-card__body">
              <h2 class="wissen-card__title">
                <a href="<?php echo esc_url($url); ?>"><?php echo esc_html($title); ?></a>
              </h2>

              <div class="wissen-card__meta">
                <?php echo esc_html($cat_name); ?> ·
                <?php echo esc_html($author_name); ?> ·
                <time datetime="<?php echo esc_attr($date_iso); ?>"><?php echo esc_html($date_hum); ?></time>
              </div>

              <?php if ($excerpt) : ?>
                <p class="wissen-card__excerpt"><?php echo esc_html($excerpt); ?></p>
              <?php endif; ?>

              <a class="wissen-card__btn" href="<?php echo esc_url($url); ?>">Mehr »</a>
            </div>
          </article>

        <?php endwhile; else: ?>
          <p>Keine Beiträge gefunden.</p>
        <?php endif; ?>
      </div>

      <?php
      $links = paginate_links([
        'type' => 'array',
        'prev_text' => '«',
        'next_text' => '»',
      ]);
      if (!empty($links) && is_array($links)) : ?>
        <nav class="wissen-pagination" aria-label="Pagination">
          <?php foreach ($links as $link) echo $link; ?>
        </nav>
      <?php endif; ?>

      <!-- <hr class="wissen-divider"> -->

      <!-- STATIC 5 CARDS (manual) -->
      <section class="wissen-bottom">
      <!--  <h2 class="wissen-bottom__title">Weitere Themen</h2> -->

        <div class="wissen-grid">
          <?php foreach ($static_cards as $card) :

            $card_url   = !empty($card['url']) ? $card['url'] : '#';
            $card_title = !empty($card['title']) ? $card['title'] : '';
            $card_text  = !empty($card['text']) ? $card['text'] : '';
            $card_img   = !empty($card['img']) ? $card['img'] : '';
            $card_alt   = !empty($card['alt']) ? $card['alt'] : $card_title;

            $excerpt = $card_text ? wp_trim_words(wp_strip_all_tags($card_text), 22) : '';
            ?>
            <article class="wissen-card">
              <a class="wissen-card__media" href="<?php echo esc_url($card_url); ?>">
                <?php if ($card_img) : ?>
                  <img class="wissen-card__img" loading="lazy" src="<?php echo esc_url($card_img); ?>" alt="<?php echo esc_attr($card_alt); ?>">
                <?php else : ?>
                  <div class="wissen-card__img wissen-card__img--placeholder"></div>
                <?php endif; ?>
              </a>

              <div class="wissen-card__body">
                <?php if ($card_title) : ?>
                  <h2 class="wissen-card__title">
                    <a href="<?php echo esc_url($card_url); ?>"><?php echo esc_html($card_title); ?></a>
                  </h2>
                <?php endif; ?>

                <?php if ($excerpt) : ?>
                  <p class="wissen-card__excerpt"><?php echo esc_html($excerpt); ?></p>
                <?php endif; ?>

                <a class="wissen-card__btn" href="<?php echo esc_url($card_url); ?>">Mehr »</a>
              </div>
            </article>
          <?php endforeach; ?>
        </div>
      </section>

    </div>
  </section>

</main>

<?php get_footer("custom"); ?>