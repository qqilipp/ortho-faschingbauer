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

$svc_reviews_id = 'svc-reviews-' . $post_id;
?>

<div class="svc-card svc-card--reviews" id="<?php echo esc_attr($svc_reviews_id); ?>">
  <div class="svc-card__title">Patientenstimmen</div>

  <div class="svc-reviews__slides">
    <?php foreach ($svc_reviews as $i => $review) :
      $sterne = $review['sterne'] > 0 ? min(5, $review['sterne']) : 5;
    ?>
      <article class="svc-reviews__slide<?php echo $i === 0 ? ' is-active' : ''; ?>">
        <div class="svc-reviews__stars" aria-label="<?php echo esc_attr($sterne . ' von 5 Sternen'); ?>">
          <?php echo esc_html(str_repeat('★', $sterne) . str_repeat('☆', 5 - $sterne)); ?>
        </div>
        <p class="svc-reviews__text">„<?php echo esc_html(trim($review['text'])); ?>“</p>
        <?php if (!empty($review['name'])) : ?>
          <strong class="svc-reviews__author"><?php echo esc_html($review['name']); ?></strong>
        <?php endif; ?>
      </article>
    <?php endforeach; ?>
  </div>

  <?php if (count($svc_reviews) > 1) : ?>
    <div class="svc-reviews__dots">
      <?php foreach ($svc_reviews as $i => $review) : ?>
        <button class="svc-reviews__dot<?php echo $i === 0 ? ' is-active' : ''; ?>" type="button" aria-label="<?php echo esc_attr('Bewertung ' . ($i + 1) . ' anzeigen'); ?>"></button>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>

<?php if (count($svc_reviews) > 1) : ?>
<script>
(function () {
  var root = document.getElementById(<?php echo wp_json_encode($svc_reviews_id); ?>);
  if (!root || root.__svcReviewsInit) return;
  root.__svcReviewsInit = true;

  var slides = Array.prototype.slice.call(root.querySelectorAll('.svc-reviews__slide'));
  var dots = Array.prototype.slice.call(root.querySelectorAll('.svc-reviews__dot'));
  var active = 0;
  var timer = null;

  function show(index) {
    active = (index + slides.length) % slides.length;
    slides.forEach(function (slide, i) { slide.classList.toggle('is-active', i === active); });
    dots.forEach(function (dot, i) { dot.classList.toggle('is-active', i === active); });
  }

  dots.forEach(function (dot, i) {
    dot.addEventListener('click', function () { show(i); restart(); });
  });

  function restart() {
    if (timer) clearInterval(timer);
    timer = setInterval(function () { show(active + 1); }, 6000);
  }
  restart();
})();
</script>
<?php endif; ?>
