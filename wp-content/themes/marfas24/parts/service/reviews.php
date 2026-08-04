<?php
if ( ! defined('ABSPATH') ) exit;

$post_id = get_queried_object_id();

if ( ! function_exists('have_rows') || ! have_rows('patientenbewertungen', $post_id) ) {
  return;
}

$svc_reviews = array();
while ( have_rows('patientenbewertungen', $post_id) ) : the_row();
  $svc_reviews[] = array(
    'sterne' => (int) get_sub_field('sterne'),
    'text'   => get_sub_field('text'),
    'name'   => get_sub_field('name'),
  );
endwhile;

$svc_reviews = array_values(array_filter($svc_reviews, function ($r) {
  return !empty($r['text']);
}));

if ( empty($svc_reviews) ) {
  return;
}

$svc_reviews_id  = 'svc-reviews-' . $post_id;
$svc_has_several = count($svc_reviews) > 1;
?>

<div class="svc-card svc-card--reviews" id="<?php echo esc_attr($svc_reviews_id); ?>">
  <div class="svc-card__title">Patientenstimmen</div>

  <div class="svc-reviews__viewport">
    <?php if ($svc_has_several) : ?>
      <button class="svc-reviews__arrow svc-reviews__arrow--left" type="button" aria-label="Vorherige Bewertung">‹</button>
      <button class="svc-reviews__arrow svc-reviews__arrow--right" type="button" aria-label="Nächste Bewertung">›</button>
    <?php endif; ?>

    <div class="svc-reviews__track">
      <?php foreach ($svc_reviews as $review) :
        $sterne = $review['sterne'] > 0 ? min(5, $review['sterne']) : 5;
      ?>
        <article class="svc-reviews__slide">
          <div class="svc-reviews__stars" aria-label="<?php echo esc_attr($sterne . ' von 5 Sternen'); ?>">
            <span class="svc-reviews__stars-filled"><?php echo esc_html(str_repeat('★', $sterne)); ?></span><span class="svc-reviews__stars-empty"><?php echo esc_html(str_repeat('★', 5 - $sterne)); ?></span>
          </div>
          <p class="svc-reviews__text">„<?php echo esc_html(trim($review['text'])); ?>“</p>
          <?php if (!empty($review['name'])) : ?>
            <strong class="svc-reviews__author"><?php echo esc_html($review['name']); ?></strong>
          <?php endif; ?>
        </article>
      <?php endforeach; ?>
    </div>
  </div>

  <?php if ($svc_has_several) : ?>
    <div class="svc-reviews__dots">
      <?php foreach ($svc_reviews as $i => $review) : ?>
        <button class="svc-reviews__dot<?php echo $i === 0 ? ' is-active' : ''; ?>" type="button" aria-label="<?php echo esc_attr('Bewertung ' . ($i + 1) . ' anzeigen'); ?>"></button>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>

<?php if ($svc_has_several) : ?>
<script>
(function () {
  var root = document.getElementById(<?php echo wp_json_encode($svc_reviews_id); ?>);
  if (!root || root.__svcReviewsInit) return;
  root.__svcReviewsInit = true;

  var track = root.querySelector('.svc-reviews__track');
  var slides = Array.prototype.slice.call(root.querySelectorAll('.svc-reviews__slide'));
  var dots = Array.prototype.slice.call(root.querySelectorAll('.svc-reviews__dot'));
  var prev = root.querySelector('.svc-reviews__arrow--left');
  var next = root.querySelector('.svc-reviews__arrow--right');
  var scrollTimer = null;

  function currentIndex() {
    return Math.round(track.scrollLeft / track.clientWidth);
  }

  function goTo(index) {
    index = (index + slides.length) % slides.length;
    track.scrollTo({ left: track.clientWidth * index, behavior: 'smooth' });
  }

  function syncDots() {
    var i = currentIndex();
    dots.forEach(function (dot, di) { dot.classList.toggle('is-active', di === i); });
  }

  if (prev) prev.addEventListener('click', function () { goTo(currentIndex() - 1); });
  if (next) next.addEventListener('click', function () { goTo(currentIndex() + 1); });
  dots.forEach(function (dot, i) { dot.addEventListener('click', function () { goTo(i); }); });

  track.addEventListener('scroll', function () {
    window.clearTimeout(scrollTimer);
    scrollTimer = window.setTimeout(syncDots, 80);
  });
})();
</script>
<?php endif; ?>
