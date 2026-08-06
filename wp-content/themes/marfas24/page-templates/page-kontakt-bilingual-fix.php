<?php
/**
 * Template Name: Kontakt (Fix) DE/EN
 */

/**
 * Language helper for WPML: returns 'en' or 'de' (fallback de)
 */
function of_lang() {
  if (defined('ICL_LANGUAGE_CODE') && ICL_LANGUAGE_CODE) {
    return strtolower(ICL_LANGUAGE_CODE);
  }
  // Fallback by locale
  $loc = strtolower((string) get_locale());
  return (strpos($loc, 'en') === 0) ? 'en' : 'de';
}

/**
 * Tiny translator: DE / EN
 */
function of_t($de, $en) {
  return (of_lang() === 'en') ? $en : $de;
}


get_header("custom");

// данные из ACF Options (у тебя уже используются в футере)
$firma  = get_field('kontakt_firma', 'options') ?: 'Ortho Faschingbauer';
$addr   = get_field('kontakt_adresse', 'options');
$plzort = get_field('kontakt_plzort', 'options');
$tel    = get_field('kontakt_tel', 'options');
$mail   = get_field('kontakt_mail', 'options');

$map_link = get_field('kontakt_maplink', 'options'); // опционально

// link для tel:
$tel_link = '';
if ($tel) {
  $tel_link = preg_replace('/\s+|\/+/', '', $tel);
  $tel_link = preg_replace('/^0/', '+43', $tel_link);
}

$map_iframe = "<iframe 
    src='https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2658.447879040621!2d16.344437077411968!3d48.21724974560984!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x476d07c3dadd5563%3A0xf3379267c0a660e!2sLazarettgasse%2025%2FOG%2F1%2C%201090%20Wien!5e0!3m2!1sde!2sat!4v1770800889016!5m2!1sde!2sat'
    width='600'
    height='450'
    style='border:0;'
    allowfullscreen
    loading='lazy'
    referrerpolicy='no-referrer-when-downgrade'>
</iframe>";

// нижняя картинка (как ты дал ссылку)
$bottom_img_url = 'https://ortho-faschingbauer.at/wp-content/uploads/dr-martin-faschingbauer-kuenstliches-hueftgelenk.jpg';
?>

<style>
/* ===== Kontakt (match screenshot) ===== */

.kontakt-fix{ background: transparent; }

.kontakt-fix .kontakt-container{
  max-width: 1180px;
  margin: 0 auto;
  padding: 0 24px;
}

.kontakt-hero{ padding: 30px 0 0; }

.kontakt-breadcrumb{
  font-size: 12px;
  letter-spacing: .04em;
  text-transform: uppercase;
  opacity: .75;
  margin: 0 0 16px;
}
.kontakt-breadcrumb a{ text-decoration:none; }
.kontakt-breadcrumb a:hover{ text-decoration:underline; }
.kontakt-sep{ margin: 0 8px; opacity:.6; }

/* ===== Fix H1 on Kontakt (match theme, not huge) ===== */
.kontakt-fix h1.svc-hero__title{
  margin: 0 0 16px !important;
  line-height: 1.1 !important;
  text-align: center !important; /* если надо по центру */
}

/* основной текст */
.kontakt-fix h1.svc-hero__title .svc-hero__title-main{
  display: block !important;
  font-size: clamp(34px, 4vw, 44px) !important;  /* НЕ станет огромным */
  font-weight: 700 !important;
}

/* подзаголовок */
.kontakt-fix h1.svc-hero__title .svc-hero__title-sub{
  display: block !important;
  margin-top: 8px !important;
  font-size: 28px;
  font-weight: 400 !important;
  opacity: .75 !important;
}

.kontakt-hero__cta{
  display:flex;
  justify-content:center;
  margin: 0 0 26px;
}

.kontakt-btn{
  display:inline-flex;
  align-items:center;
  justify-content:center;
  background:#6a96a5;
  color:#fff;
  padding: 10px 18px;
  border-radius: 10px;
  text-decoration:none;
  font-weight:600;
  font-size: 12px;
}
.kontakt-btn:hover{ background:#5a8391; color:#fff; }

.kontakt-grid{
  display:grid;
  grid-template-columns: 320px 1fr;
  gap: 28px;
  align-items: start;
}

/* левая колонка: две карточки */
.kontakt-side{
  display:flex;
  flex-direction:column;
  gap: 18px;
}

/* карточки */
.kontakt-card{
  background:#f6f8f9;
  border:1px solid rgba(0,0,0,.08);
  border-radius: 14px;
  padding: 18px;
}

.kontakt-card__title{
  font-weight: 700;
  margin: 0 0 10px;
  font-size: 12px;
  color: rgba(0,0,0,.70);
}

.kontakt-card__text{
  font-size: 12px;
  line-height: 1.55;
  color:#333;
}

.kontakt-card__text a{ text-decoration:none; }
.kontakt-card__text a:hover{ text-decoration:underline; }

/* аккуратное выравнивание времени */
.kontakt-hours__row{
  display:grid;
  grid-template-columns: 56px 1fr;
  column-gap: 10px;
}
.kontakt-hours__spacer{ height: 10px; }
.kontakt-hours__note{ margin-top: 8px; }

/* карта */
.kontakt-map__frame{
  border-radius: 14px;
  overflow:hidden;
  border:1px solid rgba(0,0,0,.08);
  background:#fff;
}

.kontakt-map__frame iframe{
  width:100%;
  border:0;
  display:block;
}

.kontakt-map__placeholder{
  height: 320px;
  border-radius: 14px;
  border:1px solid rgba(0,0,0,.08);
  display:flex;
  align-items:center;
  justify-content:center;
  text-decoration:none;
  color:#333;
  background:#f6f8f9;
}

/* нижняя картинка: сверху отступ, снизу нет (как на скрине прилипает к футеру) */
.kontakt-bottom{
  padding: 24px 0 0;
  margin: 0;
}
.kontakt-bottom .kontakt-container{
  padding: 0; /* чтобы картинка была шире и “чисто” легла */
}
.kontakt-bottom__img{
  width:100%;
  height:auto;
  display:block;
  border-radius: 0;
}

/* Responsive */
@media (max-width: 980px){
  .kontakt-grid{ grid-template-columns: 1fr; }
  .kontakt-title{ font-size: 28px; }
  .kontakt-map__frame iframe,
  .kontakt-map__placeholder{ height: 240px; }
  .kontakt-bottom .kontakt-container{ padding: 0 24px; }
}
</style>

<main id="main" class="kontakt-fix">

  <section class="kontakt-hero">
    <div class="kontakt-container">

      <p class="kontakt-breadcrumb">
        <a href="<?php echo esc_url(home_url('/')); ?>"><?php echo esc_html(of_t('Home', 'Home')); ?></a>
        <span class="kontakt-sep">/</span>
        <span><?php echo esc_html(get_the_title()); ?></span>
      </p>

      <h1 class="svc-hero__title">
        <span class="svc-hero__title-main">
          <?php echo esc_html(of_t('Vereinbaren Sie einen Termin', 'Book an appointment')); ?>
        </span>
        <span class="svc-hero__title-sub">
          <?php echo esc_html(of_t('in meiner Ordination.', 'at my practice.')); ?>
        </span>
      </h1>

      <div class="kontakt-hero__cta">
        
      </div>

      <div class="kontakt-grid">

        <!-- LEFT -->
        <div class="kontakt-side">

          <aside class="kontakt-card">
            <div class="kontakt-card__title">
              <?php echo esc_html(of_t('Ordinationszeiten', 'Office Hours')); ?>
            </div>
            <div class="kontakt-card__text">
              <div class="kontakt-hours">

                <div class="kontakt-hours__row">
                  <span><?php echo esc_html(of_t('Mo', 'Mon')); ?></span>
                  <span>09:00 – 13:00</span>
                </div>

                <div class="kontakt-hours__row">
                  <span><?php echo esc_html(of_t('Do', 'Thu')); ?></span>
                  <span>14:00 – 20:00</span>
                </div>

                <div class="kontakt-hours__row">
                  <span><?php echo esc_html(of_t('Fr', 'Fri')); ?></span>
                  <span>09:00 – 13:00</span>
                </div>

                <div class="kontakt-hours__note">
                  <?php echo esc_html(of_t('und nach Vereinbarung', 'and by appointment')); ?>
                </div>

              </div>
            </div>
          </aside>

          <aside class="kontakt-card">
            <div class="kontakt-card__title"><?php echo esc_html($firma); ?></div>
            <div class="kontakt-card__text">

              <?php if ($addr) : ?>
                <?php echo esc_html($addr); ?><br>
              <?php endif; ?>

              <?php if ($plzort) : ?>
                <?php echo esc_html($plzort); ?><br>
              <?php endif; ?>

              <?php if ($tel) : ?>
                <a href="tel:<?php echo esc_attr($tel_link); ?>"><?php echo esc_html($tel); ?></a><br>
              <?php endif; ?>

              <?php if ($mail) : ?>
                <a href="mailto:<?php echo antispambot(esc_attr($mail)); ?>">
                  <?php echo antispambot(esc_html($mail)); ?>
                </a>
              <?php endif; ?>

              <?php if ($map_link) : ?>
                <br>
                <a target="_blank" rel="noopener" href="<?php echo esc_url($map_link); ?>">
                  <?php echo esc_html(of_t('Auf Google Maps ansehen', 'View on Google Maps')); ?>
                </a>
              <?php endif; ?>

            </div>
          </aside>

        </div>

        <!-- RIGHT -->
        <div class="kontakt-map">
          <?php if (!empty($map_iframe)) : ?>
            <div class="kontakt-map__frame">
              <?php echo $map_iframe; ?>
            </div>
          <?php elseif (!empty($map_link)) : ?>
            <a class="kontakt-map__placeholder" target="_blank" rel="noopener" href="<?php echo esc_url($map_link); ?>">
              <?php echo esc_html(of_t('Karte öffnen', 'Open map')); ?>
            </a>
          <?php else : ?>
            <div class="kontakt-map__placeholder"><?php echo esc_html(of_t('Karte', 'Map')); ?></div>
          <?php endif; ?>
        </div>

      </div><!-- /.kontakt-grid -->

    </div><!-- /.kontakt-container -->
  </section>

  <section class="kontakt-bottom">
    <div class="kontakt-container">
      <img class="kontakt-bottom__img"
           src="<?php echo esc_url($bottom_img_url); ?>"
           alt="<?php echo esc_attr(of_t('Dr. Martin Faschingbauer – künstliches Hüftgelenk', 'Dr. Martin Faschingbauer – artificial hip joint')); ?>"
           loading="lazy">
    </div>
  </section>

</main>

<?php get_footer("custom"); ?>