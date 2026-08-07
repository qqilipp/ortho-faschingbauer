<?php
if ( ! defined('ABSPATH') ) exit;

$post_id = get_queried_object_id();

$hero_kurzinfo = get_field('hero_kurzinfo', $post_id);

$has_kurzinfo = false;
if (!empty($hero_kurzinfo) && is_array($hero_kurzinfo)) {
  foreach ($hero_kurzinfo as $row) {
    $label = trim((string) ($row['label'] ?? ''));
    $value = trim(wp_strip_all_tags((string) ($row['value'] ?? '')));
    if ($label !== '' || $value !== '') { $has_kurzinfo = true; break; }
  }
}

/* ===========================
   WPML / Language helpers
   =========================== */
$lang  = defined('ICL_LANGUAGE_CODE') ? ICL_LANGUAGE_CODE : 'de';
$is_en = ($lang === 'en');

if ($is_en) {
    $contact_url = home_url('/en/contact/');
} else {
    $contact_url = home_url('/kontakt/');
}

if ($is_en) {
    $about_url = home_url('/en/about/');
} else {
    $about_url = home_url('/ueber-mich/');
}

// Profile card strings
$profile_name = 'Prof. DDr. M. Faschingbauer';
$profile_sub  = $is_en ? 'Specialist in Orthopaedics and Trauma Surgery' : 'Facharzt für Orthopädie und Unfallchirurgie';
$profile_tag  = $is_en ? 'Specialist in Endoprosthetics' : 'Spezialist für Endoprothetik';
$profile_text = $is_en
  ? 'Extensive experience in orthopaedic surgery with a focus on hip and knee endoprosthetics.'
  : 'Langjährige Erfahrung in der operativen Orthopädie mit Fokus auf Hüft- und Knieendoprothetik.';
$profile_btn  = $is_en ? 'More about me' : 'Mehr über mich';

// On the "Über mich" page itself, a self-referential profile card is redundant
// (the whole page already is the bio). Show reviews + Schwerpunkte links instead.
$svc_is_about_page = is_page('ueber-mich');
?>

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

  <?php if ($svc_is_about_page) : ?>

    <?php get_template_part('parts/service/reviews'); ?>
    <?php get_template_part('parts/service/schwerpunkte-sidebar'); ?>

  <?php else : ?>

    <!-- Profile card (STATIC) -->
    <div class="svc-card svc-card--profile">
      <div class="svc-profile__avatar">
        <img
          src="<?php echo esc_url(site_url('/wp-content/uploads/martin-faschinbauer-kuehl-03.png')); ?>"
          width="250"
          height="250"
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

      <a href="<?php echo esc_url($about_url); ?>" class="svc-btn svc-btn--primary svc-profile__btn">
        <?php echo esc_html($profile_btn); ?>
      </a>
    </div>

    <?php get_template_part('parts/service/reviews'); ?>

  <?php endif; ?>

</aside>
