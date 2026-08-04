<?php
/**
 * The template for displaying the footer
 */
?>

<?php
/**
 * =========================================================
 * Footer language + WPML-safe links (DE/EN)
 * =========================================================
 */
$lang = (defined('ICL_LANGUAGE_CODE') && ICL_LANGUAGE_CODE) ? strtolower(ICL_LANGUAGE_CODE) : 'de';

$tr = function ($de, $en) use ($lang) {
  return ($lang === 'en') ? $en : $de;
};

$u = function ($path_de, $path_en) use ($lang) {
  $path = ($lang === 'en') ? $path_en : $path_de;
  return home_url($path);
};

// Footer labels + footer links (hardcoded, stable)
$footer_links = [
  [
    'de' => 'Beschwerden',
    'en' => 'Complaints',
    'path_de' => '/beschwerden/',
    'path_en' => '/en/complaints/',
  ],
  [
    'de' => 'Schwerpunkte',
    'en' => 'Focus Areas',
    'path_de' => '/schwerpunkte/',
    'path_en' => '/en/endoprosthetics/',
  ],
  [
    'de' => 'Behandlungen',
    'en' => 'Treatments',
    'path_de' => '/orthopaedische-behandlungen/',   // или твой реальный DE slug
    'path_en' => '/en/treatments/',
  ],
  [
    'de' => 'Kontakt',
    'en' => 'Contact',
    'path_de' => '/kontakt/',
    'path_en' => '/en/contact/',
  ],
  [
    'de' => 'Impressum',
    'en' => 'Imprint',
    'path_de' => '/impressum/',
    'path_en' => '/en/imprint/',
  ],
  [
    'de' => 'Datenschutz',
    'en' => 'Privacy Policy',
    'path_de' => '/datenschutz/',
    'path_en' => '/en/privacy/',
  ],
];
?>

</div>

<div id="formbox" class="bglight">
	<div class="outer">
		<div class="wrap relative">
			<div class="padding"></div>
			<a class="hideform hideicon"></a>
			<div class="clear"></div>
			<div class="col-xs-1 col-s-1 col-sm-1 col-m-1 col-ml-2 col-l-2 col-xl-3"></div>
			<div class="col-xs-10 col-s-10 col-sm-10 col-m-10 col-ml-8 col-l-8 col-xl-6">

				<div class="padding"></div>
				<div class="padding"></div>

				<?php get_template_part('parts/contactform'); ?>

				<div class="clear"></div>

				<p class="topline">
					<a class="hideform" href="<?php the_permalink();?>" title="">
            <?php echo esc_html( $tr('Formular schließen', 'Close form') ); ?>
          </a>
				</p>

				<div class="padding"></div>

				<div class="clear"></div>

			</div>
			<div class="clear"></div>
		</div>
	</div>
</div>

<a id="totop" class="scrolly" href="#top" title="<?php echo esc_attr( $tr('Zum Seitenanfang', 'Back to top') ); ?>">
  <span class="icon icon-up"></span>
</a>

<div id="navicon" class="navtrigger 55555">
	<span></span>
</div>
<div id="mobolay" class="navtrigger"></div>

<?php get_template_part('parts/mobnav'); ?>

<div id="scroll0"></div><div id="scroll1"></div><div id="scroll2"></div>

<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/toggle.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/superfish.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/waypoint.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/inview.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/owl.carousel.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/main.js<?php echo '?' . filemtime( get_stylesheet_directory() . '/js/main.js'); ?>"></script>

<footer class="site-footer">
  <div class="footer-inner">

    <!-- Logo -->
    <div class="footer-col footer-logo">
      <?php if ( function_exists('the_custom_logo') && has_custom_logo() ) : ?>
        <div class="footer-logo-wrap">
          <?php the_custom_logo(); ?>
        </div>
      <?php else : ?>
        <a href="<?php echo esc_url( home_url( ($lang === 'en') ? '/en/' : '/' ) ); ?>"
           class="footer-logo-link"
           aria-label="<?php echo esc_attr( get_bloginfo('name') ); ?>">
          <span class="footer-logo-line-1"><?php echo esc_html( $tr('Prof. DDr.', 'Prof. DDr.') ); ?></span>
          <span class="footer-logo-line-2"><?php echo esc_html( $tr('M. Faschingbauer', 'M. Faschingbauer') ); ?></span>
        </a>
      <?php endif; ?>
    </div>

    <!-- Links -->
    <div class="footer-col footer-links">
      <ul class="footer-list">
        <?php foreach ($footer_links as $item) : ?>
          <li>
            <a href="<?php echo esc_url( $u($item['path_de'], $item['path_en']) ); ?>">
              <?php echo esc_html( $tr($item['de'], $item['en']) ); ?>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>

    <!-- Ordinationszeiten -->
    <div class="footer-col footer-hours">
      <div class="footer-title"><?php echo esc_html( $tr('Ordinationszeiten', 'Office Hours') ); ?></div>
      <div class="footer-text">
        <?php echo esc_html( $tr('Mo', 'Mon') ); ?> 09:00 – 13:00<br>
        <?php echo esc_html( $tr('Do', 'Thu') ); ?> 14:00 – 20:00<br>
        <?php echo esc_html( $tr('Fr', 'Fri') ); ?> 09:00 – 13:00<br>
        <?php echo esc_html( $tr('und nach Vereinbarung', 'and by appointment') ); ?>
      </div>
    </div>

    <!-- Contact (ACF options) -->
    <div class="footer-col footer-contact">
      <?php
        $firma  = get_field('kontakt_firma', 'options') ?: 'Ortho Faschingbauer';
        $addr   = get_field('kontakt_adresse', 'options');
        $plzort = get_field('kontakt_plzort', 'options');
        $tel    = get_field('kontakt_tel', 'options');
        $mail   = get_field('kontakt_mail', 'options');

        $tel_link = '';
        if ( $tel ) {
          $tel_link = preg_replace('/\s+|\/+/', '', $tel);
          $tel_link = preg_replace('/^0/', '+43', $tel_link);
        }
      ?>

      <div class="footer-title"><?php echo esc_html( $firma ); ?></div>

      <?php if ( $addr || $plzort ) : ?>
        <div class="footer-contact-row">
          <span class="footer-ico icon-map" aria-hidden="true"></span>
          <span>
            <?php if ( $addr ) : ?><?php echo esc_html( $addr ); ?><br><?php endif; ?>
            <?php if ( $plzort ) : ?><?php echo esc_html( $plzort ); ?><?php endif; ?>
          </span>
        </div>
      <?php endif; ?>

      <?php if ( $tel ) : ?>
        <div class="footer-contact-row">
          <span class="footer-ico icon-tel" aria-hidden="true"></span>
          <a href="tel:<?php echo esc_attr( $tel_link ); ?>"><?php echo esc_html( $tel ); ?></a>
        </div>
      <?php endif; ?>

      <?php if ( $mail ) : ?>
        <div class="footer-contact-row">
          <span class="footer-ico icon-mail" aria-hidden="true"></span>
          <a href="mailto:<?php echo antispambot( esc_attr( $mail ) ); ?>">
            <?php echo antispambot( esc_html( $mail ) ); ?>
          </a>
        </div>
      <?php endif; ?>
    </div>

  </div>

  <div class="footer-bottom">
    <div class="footer-bottom-inner footer-bottom-center">
      <span>
        © <?php echo esc_html( date('Y') ); ?>
        <?php echo esc_html( get_field('kontakt_name', 'options') ?: get_bloginfo('name') ); ?>
      </span>
    </div>
  </div>
</footer>


<?php wp_footer(); ?>
</body>
</html>