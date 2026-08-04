<?php
if ( ! defined('ABSPATH') ) exit;

$post_id = get_queried_object_id();

// можешь переиспользовать те же переменные, что в hero.php:
$hero_kurzinfo = get_field('hero_kurzinfo', $post_id);

$has_kurzinfo = false;
if (!empty($hero_kurzinfo) && is_array($hero_kurzinfo)) {
  foreach ($hero_kurzinfo as $row) {
    $label = trim((string) ($row['label'] ?? ''));
    $value = trim(wp_strip_all_tags((string) ($row['value'] ?? '')));
    if ($label !== '' || $value !== '') { $has_kurzinfo = true; break; }
  }
}
?>

<div class="svc-hero__side">

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

  <div class="svc-card svc-card--profile">
    <div class="svc-profile__avatar">
      <img
        src="<?php echo esc_url(site_url('/wp-content/uploads/martin-faschinbauer-kuehl-03.png')); ?>"
        alt="Prof. DDr. M. Faschingbauer"
        loading="lazy"
      >
    </div>

    <div class="svc-profile__name">Prof. DDr. M. Faschingbauer</div>
    <div class="svc-profile__sub">Facharzt für Orthopädie und Unfallchirurgie</div>
    <div class="svc-profile__tagline">Spezialist für Endoprothetik</div>

    <div class="svc-profile__text">
      <p>Langjährige Erfahrung in der operativen Orthopädie mit Fokus auf Hüft- und Knieendoprothetik.</p>
    </div>

    <a href="/kontakt/" class="svc-btn svc-btn--primary svc-profile__btn">
      Termin vereinbaren
    </a>
  </div>

</div>