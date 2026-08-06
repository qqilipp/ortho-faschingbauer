<?php
/**
 * Template Name: Kontakt (Fix)
 */

// WPML language
$lang = apply_filters('wpml_current_language', null);
if (!$lang) {
  $lang = 'de';
}

// Meta description
add_action('wp_head', function () use ($lang) {
  $desc_de = 'Kontakt zur Ordination von Prof. DDr. Martin Faschingbauer in 1090 Wien: Ordinationszeiten, Adresse, Telefon und E-Mail. Terminvereinbarung nach Vereinbarung.';
  $desc_en = 'Contact the practice of Prof. DDr. Martin Faschingbauer in Vienna (1090): office hours, address, phone and email. Appointments by arrangement.';

  echo '<meta name="description" content="' . esc_attr($lang === 'en' ? $desc_en : $desc_de) . '">' . "\n";
}, 1);

get_header('custom');

// ACF Options
$firma    = get_field('kontakt_firma', 'options') ?: 'Ortho Faschingbauer';
$addr     = get_field('kontakt_adresse', 'options');
$plzort   = get_field('kontakt_plzort', 'options');
$tel      = get_field('kontakt_tel', 'options');
$mail     = get_field('kontakt_mail', 'options');
$map_link = get_field('kontakt_maplink', 'options');

// tel: link
$tel_link = '';
if (!empty($tel)) {
  $tel_link = preg_replace('/\s+|\/+/', '', $tel);
  $tel_link = preg_replace('/^0/', '+43', $tel_link);
}

// WS Form shortcode by language
$form_shortcode = ($lang === 'en') ? '[ws_form id="2"]' : '[ws_form id="1"]';

// Google Maps iframe
$map_iframe = "<iframe
  src='https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2658.447879040621!2d16.344437077411968!3d48.21724974560984!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x476d07c3dadd5563%3A0xf3379267c0a660e!2sLazarettgasse%2025%2FOG%2F1%2C%201090%20Wien!5e0!3m2!1sde!2sat!4v1770800889016!5m2!1sde!2sat'
  allowfullscreen
  loading='lazy'
  referrerpolicy='no-referrer-when-downgrade'></iframe>";

$bottom_img_url = 'https://ortho-faschingbauer.at/wp-content/uploads/dr-martin-faschingbauer-kuenstliches-hueftgelenk.jpg';
?>

<style>
.kontakt-fix{ background: transparent; }
.kontakt-fix .kontakt-container{ max-width:1180px;margin:0 auto;padding:0 24px;}
.kontakt-hero{padding:30px 0 0;}
.kontakt-breadcrumb{font-size:12px;letter-spacing:.04em;text-transform:uppercase;opacity:.75;margin:0 0 16px;}
.kontakt-breadcrumb a{text-decoration:none;}
.kontakt-breadcrumb a:hover{text-decoration:underline;}
.kontakt-sep{margin:0 8px;opacity:.6;}

.kontakt-fix h1.svc-hero__title{margin:0 0 16px!important;line-height:1.1!important;text-align:center!important;}
.kontakt-fix h1.svc-hero__title .svc-hero__title-main{display:block!important;font-size:clamp(34px,4vw,44px)!important;font-weight:700!important;}
.kontakt-fix h1.svc-hero__title .svc-hero__title-sub{display:block!important;margin-top:8px!important;font-size:28px;font-weight:400!important;opacity:.75!important;}

/* Top grid: cards + map */
.kontakt-grid{display:grid;grid-template-columns:360px 1fr;gap:28px;align-items:start;}
.kontakt-side{display:flex;flex-direction:column;gap:18px;}

.kontakt-card{background:#f6f8f9;border:1px solid rgba(0,0,0,.08);border-radius:14px;padding:18px;}
.kontakt-card__title{font-weight:700;margin:0 0 10px;font-size:12px;color:rgba(0,0,0,.70);}
.kontakt-card__text{font-size:12px;line-height:1.55;color:#333;}
.kontakt-hours__row{display:grid;grid-template-columns:56px 1fr;column-gap:10px;}
.kontakt-hours__note{margin-top:10px;opacity:.8;}

.kontakt-map__frame{border-radius:14px;overflow:hidden;border:1px solid rgba(0,0,0,.08);background:#fff;}
.kontakt-map__frame iframe{width:100%;height:420px;border:0;display:block;}

/* Form block centered under grid */
.kontakt-form-wrap{margin-top:24px;}
.kontakt-form-card{
  max-width: 860px;
  margin: 0 auto;
  background:#f6f8f9;
  border:1px solid rgba(0,0,0,.08);
  border-radius:14px;
  padding:22px;
}
.kontakt-form-title{margin:0 0 12px;font-size:18px;font-weight:700;}
.kontakt-form form{margin:0;}
.kontakt-form input,
.kontakt-form textarea,
.kontakt-form select{
  width:100%;
  box-sizing:border-box;
  border-radius:10px;
}
.kontakt-form textarea{min-height:120px;resize:vertical;}
.kontakt-form button,
.kontakt-form input[type="submit"]{
  width:100%;
  border-radius:12px;
  padding:12px 14px;
  font-weight:600;
}

/* Bottom image */
.kontakt-bottom{padding:24px 0 0;margin:0;}
.kontakt-bottom__img{width:100%;height:auto;display:block;}

/* Responsive */
@media (max-width: 900px){
  .kontakt-grid{grid-template-columns:1fr!important;gap:18px!important;}
  .kontakt-map__frame iframe{height:320px;}
  .kontakt-form-card{padding:18px;}
}
</style>

<main id="main" class="kontakt-fix">
  <section class="kontakt-hero">
    <div class="kontakt-container">

      <p class="kontakt-breadcrumb">
        <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
        <span class="kontakt-sep">/</span>
        <span><?php echo esc_html(get_the_title()); ?></span>
      </p>

      <h1 class="svc-hero__title">
        <span class="svc-hero__title-main">
          <?php echo ($lang === 'en') ? 'Book an appointment' : 'Vereinbaren Sie einen Termin'; ?>
        </span>
        <span class="svc-hero__title-sub">
          <?php echo ($lang === 'en') ? 'at my practice.' : 'in meiner Ordination.'; ?>
        </span>
      </h1>

      <!-- TOP: Cards + Map -->
      <div class="kontakt-grid">

        <div class="kontakt-side">

          <aside class="kontakt-card">
            <div class="kontakt-card__title">
              <?php echo ($lang === 'en') ? 'Office Hours' : 'Ordinationszeiten'; ?>
            </div>
            <div class="kontakt-card__text">
              <div class="kontakt-hours">
                <div class="kontakt-hours__row">
                  <span><?php echo ($lang === 'en') ? 'Mon' : 'Mo'; ?></span>
                  <span>09:00 – 13:00</span>
                </div>
                <div class="kontakt-hours__row">
                  <span><?php echo ($lang === 'en') ? 'Thu' : 'Do'; ?></span>
                  <span>14:00 – 20:00</span>
                </div>
                <div class="kontakt-hours__row">
                  <span><?php echo ($lang === 'en') ? 'Fri' : 'Fr'; ?></span>
                  <span>09:00 – 13:00</span>
                </div>
                <div class="kontakt-hours__note">
                  <?php echo ($lang === 'en') ? 'and by appointment' : 'und nach Vereinbarung'; ?>
                </div>
              </div>
            </div>
          </aside>

          <aside class="kontakt-card">
            <div class="kontakt-card__title"><?php echo esc_html($firma); ?></div>
            <div class="kontakt-card__text">
              <?php if (!empty($addr))   echo esc_html($addr) . '<br>'; ?>
              <?php if (!empty($plzort)) echo esc_html($plzort) . '<br>'; ?>

              <?php if (!empty($tel)) : ?>
                <a href="tel:<?php echo esc_attr($tel_link); ?>"><?php echo esc_html($tel); ?></a><br>
              <?php endif; ?>

              <?php if (!empty($mail)) : ?>
                <a href="mailto:<?php echo antispambot(esc_attr($mail)); ?>"><?php echo antispambot(esc_html($mail)); ?></a>
              <?php endif; ?>

              <?php if (!empty($map_link)) : ?>
                <br>
                <a target="_blank" rel="noopener" href="<?php echo esc_url($map_link); ?>">
                  <?php echo ($lang === 'en') ? 'View on Google Maps' : 'Auf Google Maps ansehen'; ?>
                </a>
              <?php endif; ?>
            </div>
          </aside>

        </div><!-- /.kontakt-side -->

        <div class="kontakt-map">
          <div class="kontakt-map__frame">
            <?php echo $map_iframe; ?>
          </div>
        </div>

      </div><!-- /.kontakt-grid -->

      <!-- BELOW: Centered Form -->
      <div class="kontakt-form-wrap">
        <div class="kontakt-form-card">
          <h2 class="kontakt-form-title">
            <?php echo ($lang === 'en') ? 'Send a message' : 'Nachricht senden'; ?>
          </h2>
          <div class="kontakt-form">
            <?php echo do_shortcode($form_shortcode); ?>
          </div>
        </div>
      </div>

    </div><!-- /.kontakt-container -->
  </section>

  <section class="kontakt-bottom">
    <div class="kontakt-container">
      <img class="kontakt-bottom__img"
           src="<?php echo esc_url($bottom_img_url); ?>"
           alt="<?php echo ($lang === 'en')
             ? 'Dr. Martin Faschingbauer – artificial hip joint'
             : 'Dr. Martin Faschingbauer – künstliches Hüftgelenk'; ?>"
           loading="lazy">
    </div>
  </section>
</main>

<?php get_footer('custom'); ?>