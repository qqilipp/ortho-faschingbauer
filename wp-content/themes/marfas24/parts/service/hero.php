<?php
if ( ! defined('ABSPATH') ) exit;

$post_id = get_queried_object_id();
$title   = get_the_title($post_id);

// ACF
$hero_intro    = get_field('hero_intro', $post_id);        // WYSIWYG
$hero_kurzinfo = get_field('hero_kurzinfo', $post_id);     // Repeater (label/value)
$hero_image    = get_field('hero_image', $post_id);        // Image (optional)

// switches (safe defaults)
$hero_disable       = (bool) get_field('hero_disable', $post_id);
$hero_image_disable = (bool) get_field('hero_image_disable', $post_id);

// determine whether hero has any meaningful content
$has_intro = !empty(trim(wp_strip_all_tags((string) $hero_intro)));

$has_kurzinfo = false;
if (!empty($hero_kurzinfo) && is_array($hero_kurzinfo)) {
  foreach ($hero_kurzinfo as $row) {
    $label = trim((string) ($row['label'] ?? ''));
    $value = trim(wp_strip_all_tags((string) ($row['value'] ?? '')));
    if ($label !== '' || $value !== '') { $has_kurzinfo = true; break; }
  }
}

$has_image = (!$hero_image_disable && !empty($hero_image) && is_array($hero_image) && !empty($hero_image['url']));

$hero_has_any_content = ($has_intro || $has_kurzinfo || $has_image);

// hard hide hero if disabled OR nothing filled at all
if ($hero_disable || !$hero_has_any_content) {
  add_filter('body_class', fn($c) => array_merge($c, ['no-hero']));
  return;
}

// HERO TITLE (ACF textarea) — supports Enter for 2 lines
$hero_title_raw = get_field('hero_titel', $post_id);
if (!$hero_title_raw) {
  $hero_title_raw = $title; // fallback to WP title
}

// split by line breaks
$lines = preg_split("/\r\n|\n|\r/", trim((string) $hero_title_raw));
$line_main = $lines[0] ?? '';
$line_sub  = '';

if (is_array($lines) && count($lines) > 1) {
  // Everything after the first line becomes the subline
  $line_sub = trim(implode(' ', array_slice($lines, 1)));
}

/* ===========================
   WPML / Language helpers
   =========================== */
$lang  = defined('ICL_LANGUAGE_CODE') ? ICL_LANGUAGE_CODE : 'de';
$is_en = ($lang === 'en');

// Contact URL
if ($is_en) {
    $contact_url = home_url('/en/contact/');
} else {
    $contact_url = home_url('/kontakt/');
}

// Static strings (DE default, EN override)
$txt_home_breadcrumb = $is_en ? 'Home' : 'Home';

$txt_empty_intro = $is_en ? 'No page content has been defined yet.' : 'Es wurde noch kein Seiteninhalt definiert.';

$txt_primary_cta = $is_en ? 'Book a consultation' : 'Beratungsgespräch vereinbaren';

// Profile card strings
$profile_name = 'Prof. DDr. M. Faschingbauer';
$profile_sub  = $is_en ? 'Specialist in Orthopaedics and Trauma Surgery' : 'Facharzt für Orthopädie und Unfallchirurgie';
$profile_tag  = $is_en ? 'Specialist in Endoprosthetics' : 'Spezialist für Endoprothetik';
$profile_text = $is_en
  ? 'Extensive experience in orthopaedic surgery with a focus on hip and knee endoprosthetics.'
  : 'Langjährige Erfahrung in der operativen Orthopädie mit Fokus auf Hüft- und Knieendoprothetik.';
$profile_btn  = $is_en ? 'Book an appointment' : 'Termin vereinbaren';
?>

<section class="svc-hero">
  <div class="svc-hero__container">
    <div class="svc-hero__grid">

      <!-- LEFT -->
      <div class="svc-hero__main">

        <nav class="svc-hero__breadcrumb" aria-label="Breadcrumb">
          <a href="<?php echo esc_url(home_url('/')); ?>"><?php echo esc_html($txt_home_breadcrumb); ?></a>
          <span class="svc-hero__sep">/</span>
          <span><?php echo esc_html($title); ?></span>
        </nav>

        <h1 class="svc-hero__title">
          <span class="svc-hero__title-main">
            <?php echo esc_html($line_main); ?>
          </span>

          <?php if ($line_sub) : ?>
            <span class="svc-hero__title-sub">
              <?php echo esc_html($line_sub); ?>
            </span>
          <?php endif; ?>
        </h1>

        <?php if (!empty($hero_intro)) : ?>
          <div class="svc-hero__intro">
            <?php echo wp_kses_post($hero_intro); ?>
          </div>
        <?php else : ?>
          <div class="svc-hero__intro">
            <p><?php echo esc_html($txt_empty_intro); ?></p>
          </div>
        <?php endif; ?>

        <div class="svc-hero__actions">
          <a class="svc-btn svc-btn--primary" href="<?php echo esc_url($contact_url); ?>">
            <?php echo esc_html($txt_primary_cta); ?>
          </a>
        </div>

        <?php if ($has_image) : ?>
          <div class="svc-hero__visual">
            <img
              class="svc-hero__visual-img"
              src="<?php echo esc_url($hero_image['url']); ?>"
              alt="<?php echo esc_attr(!empty($hero_image['alt']) ? $hero_image['alt'] : $title); ?>"
              loading="lazy"
            >
          </div>
        <?php endif; ?>

      </div>

      <!-- RIGHT -->
      <aside class="svc-hero__side">

        <!-- Kurzinfo -->
        <?php if ($has_kurzinfo) : ?>
          <div class="svc-card">
            <?php
              $kurzinfo_title = get_field('hero_kurzinfo_title', $post_id);
              if (!$kurzinfo_title) $kurzinfo_title = 'Kurzinfo';
            ?>
            <div class="svc-card__title"><?php echo esc_html($kurzinfo_title); ?></div>

            <dl class="svc-kv">
              <?php foreach ($hero_kurzinfo as $row) :
                $label = trim((string) ($row['label'] ?? ''));
                $value = trim((string) ($row['value'] ?? ''));
                if ($label === '' && $value === '') continue;
              ?>
                <div class="svc-kv__row">
                  <?php if ($label !== '') : ?>
                    <dt class="svc-kv__label"><?php echo esc_html($label); ?></dt>
                  <?php endif; ?>
                  <?php if ($value !== '') : ?>
                    <dd class="svc-kv__value"><?php echo wp_kses_post($value); ?></dd>
                  <?php endif; ?>
                </div>
              <?php endforeach; ?>
            </dl>
          </div>
        <?php endif; ?>

        <!-- Profile card (STATIC) -->
        <div class="svc-card svc-card--profile">
          <div class="svc-profile__avatar">
            <img
              src="<?php echo esc_url(site_url('/wp-content/uploads/martin-faschinbauer-kuehl-03.png')); ?>"
              alt="<?php echo esc_attr($profile_name); ?>"
              loading="lazy"
            >
          </div>

          <div class="svc-profile__name"><?php echo esc_html($profile_name); ?></div>
          <div class="svc-profile__sub"><?php echo esc_html($profile_sub); ?></div>
          <div class="svc-profile__tagline"><?php echo esc_html($profile_tag); ?></div>

          <div class="svc-profile__text">
            <p><?php echo esc_html($profile_text); ?></p>
          </div>

          <a href="<?php echo esc_url($contact_url); ?>" class="svc-btn svc-btn--primary svc-profile__btn">
            <?php echo esc_html($profile_btn); ?>
          </a>
        </div>

        <?php get_template_part('parts/service/reviews'); ?>

      </aside>

    </div>
  </div>
</section>