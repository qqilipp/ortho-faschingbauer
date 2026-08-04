<?php /*


<footer class="site-footer">
  <div class="footer-inner">

    <!-- 1) Logo -->
    <div class="footer-col footer-logo">
      <a href="<?php echo esc_url( home_url('/') ); ?>" class="footer-logo-link">
        <!-- Если есть кастомный логотип WordPress -->
        <?php if ( function_exists('the_custom_logo') && has_custom_logo() ) { the_custom_logo(); } else { ?>
          <a href="<?php echo esc_url( home_url('/') ); ?>" class="footer-logo-link">
  <span class="footer-logo-line-1">Prof. DDr.</span>
  <span class="footer-logo-line-2">M. Faschingbauer</span>
</a>

        <?php } ?>
      </a>
    </div>

    <!-- 2) Links / Menu -->
    <div class="footer-col footer-links">
      <div class="footer-title">Links</div>
      <ul class="footer-list">
        <li><a href="/behandlungen/">Behandlungen</a></li>
        <li><a href="/kontakt/">Kontakt</a></li>
        <li><a href="/impressum/">Impressum</a></li>
        <li><a href="/datenschutz/">Datenschutz</a></li>
      </ul>
    </div>

    <!-- 3) Öffnungszeiten (можно потом тоже вынести в поля) -->
    <div class="footer-col footer-hours">
      <div class="footer-title">Ordinationszeiten</div>
      <div class="footer-text">
        Mo, Do 8:00 – 13:00<br> 
		und 14:00 – 19:00<br>
        Di, Fr 8:00 – 14:00<br>
        und nach Vereinbarung
      </div>
    </div>

    <!-- 4) Contact (из Kontaktdaten options) -->
    <div class="footer-col footer-contact">
      <div class="footer-title"><?php echo esc_html( get_field('kontakt_firma', 'options') ?: 'Praxis' ); ?></div>

      <div class="footer-contact-row">
        <span class="footer-ico icon-map"></span>
        <span>
          <?php echo esc_html( get_field('kontakt_adresse', 'options') ); ?><br>
          <?php echo esc_html( get_field('kontakt_plzort', 'options') ); ?>
        </span>
      </div>

      <?php if ( get_field('kontakt_tel', 'options') ) :
        $tel = get_field('kontakt_tel', 'options');
        $telformat = preg_replace('/\s+|\/+/', '', $tel);
        $telformat = preg_replace('/^0/', '+43', $telformat);
      ?>
        <div class="footer-contact-row">
          <span class="footer-ico icon-tel"></span>
          <a href="tel:<?php echo esc_attr($telformat); ?>"><?php echo esc_html($tel); ?></a>
        </div>
      <?php endif; ?>

      <?php if ( get_field('kontakt_mail', 'options') ) :
        $mymail = get_field('kontakt_mail', 'options');
      ?>
        <div class="footer-contact-row">
          <span class="footer-ico icon-mail"></span>
          <a href="mailto:<?php echo antispambot( esc_attr($mymail) ); ?>">
            <?php echo antispambot( esc_html($mymail) ); ?>
          </a>
        </div>
      <?php endif; ?>
    </div>

  </div>

  <div class="footer-bottom">
  <div class="footer-bottom-inner footer-bottom-center">
    <span>© <?php echo date('Y'); ?> <?php echo esc_html( get_field('kontakt_name', 'options') ?: get_bloginfo('name') ); ?></span>
  </div>
</div>

</footer>
*/ ?>