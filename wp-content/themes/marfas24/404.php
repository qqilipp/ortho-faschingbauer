<?php
global $wp_query;
$wp_query->set_404();
status_header(404);
nocache_headers();

get_header('custom');  // <- важно
?>

<main id="main">
  <div class="bgwhite">
    <div class="outer">
      <div class="wrap">
        <div class="padding"></div>

        <div class="col-xs-0 col-s-0 col-sm-1 col-m-2 col-ml-2 col-l-2 col-xl-2"></div>

        <div class="col-xs-12 col-s-12 col-sm-8 col-m-8 col-ml-8 col-l-8 col-xl-8">
          <div class="padding"></div>
          <div class="padding"></div>
          <div class="padding"></div>
          <div class="padding"></div>

          <p class="topline">Fehler 404</p>
          <h2 class="pagetitle">Seite nicht gefunden</h2>

          <div class="padding"></div>

          <p>
            Es tut uns leid, die aufgerufene Seite wurde nicht gefunden.<br />
            Bitte klicken Sie <a href="<?php echo esc_url( home_url() ); ?>">hier</a>,
            um zur Startseite zu gelangen oder wählen Sie die gewünschte Seite aus dem Menü.
          </p>

          <div class="padding"></div>
          <div class="padding"></div>
          <div class="padding"></div>
          <div class="padding"></div>
          <div class="padding"></div>
          <div class="padding"></div>
        </div>
      </div>
    </div>
  </div>
</main>

<?php get_footer('custom'); ?>