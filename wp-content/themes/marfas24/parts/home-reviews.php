<?php
if ( ! defined('ABSPATH') ) exit;

/**
 * Homepage Rezensionen-Carousel
 * Zeigt 2 Bewertungen gleichzeitig, rotiert langsam endlos durch
 * insgesamt 5 (owl.carousel, bereits sitewide geladen).
 */

$reviews = [
  [
    'name'   => 'Kristian Fitzbauer',
    'sterne' => 5,
    'text'   => 'Von Tag 1 sprich vor der Operation bis zur Nachbehandlung hat er mir immer das Gefühl gegeben für mich den Patienten da zu sein. Absolut kompetent menschlich top. Bei mir wurde eine Hüft Operation durchgeführt, würde und kann ihn nur weiterempfehlen.',
  ],
  [
    'name'   => 'Adolf Jobstmann',
    'sterne' => 5,
    'text'   => 'Ich bin 85 Jahre alt, und wurde von Prof. Martin Faschingbauer an beiden Knien erfolgreich operiert. Die Mobilität war innerhalb von 4 Tagen wieder hergestellt. Die Betreuung war herausragend. Ich kann Prof. Faschingbauer mit gutem Gewissen weiter empfehlen.',
  ],
  [
    'name'   => 'Alexandra Kos',
    'sterne' => 5,
    'text'   => 'Herr Prof. Faschingbauer hat eine sehr freundliche und ruhige Art, was mir Sicherheit in meiner Entscheidung zu einer OP gegeben hat. Er spricht eine klare Sprache und ist sehr kompetent in seinem Tun. Auf Telefonanrufe und Mailnachrichten reagiert er prompt. Eine klare Empfehlung meinerseits!',
  ],
  [
    'name'   => 'Eveline Suskopf',
    'sterne' => 5,
    'text'   => 'Herr Professor Martin Faschingbauer ist ein sehr einfühlsamer und kompetenter Arzt. Die Knie OP wurde ohne Komplikationen und zu meiner Zufriedenheit durchgeführt. Dieser Chirurg ist absolut weiterzuempfehlen.',
  ],
  [
    'name'   => 'Gerald Demschik',
    'sterne' => 5,
    'text'   => 'Nach ausführlicher und geduldiger Aufklärung wurde mein sehr schmerzhaftes Kniegelenk roboterassistiert gegen eine Totalprothese ausgetauscht. Nun, nach knapp einem Jahr komplikationsfreien Verlaufs, nehme ich die Endoprothese in den meisten Situationen gar nicht mehr wahr und bin sehr zufrieden. Klare Empfehlung!',
  ],
];
?>

<div class="bgwhite s_reviews">
  <div class="outer">
    <div class="wrap">

      <div class="col-xs-12 col-s-12 col-sm-12 col-m-12 col-ml-12 col-l-12 col-xl-12">
        <h3 class="sectiontitle textcenter">Das sagen meine Patient:innen</h3>
        <div class="padding"></div>
      </div>

    </div>

    <div class="wrap">
      <div class="reviews-carousel owl-carousel owl-theme">
        <?php foreach ($reviews as $review) : ?>
          <div class="review-card">
            <div class="review-card__stars" aria-hidden="true"><?php echo str_repeat('★', (int) $review['sterne']); ?></div>
            <p class="review-card__text">„<?php echo esc_html($review['text']); ?>"</p>
            <p class="review-card__name"><?php echo esc_html($review['name']); ?></p>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <div class="padding"></div>

  </div>
</div>
