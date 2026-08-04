<?php
/**
 * Theme functions
 */

add_action('template_redirect', function () {

  $path = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH);

  if ($path === '/en/joint-replacement-specialist-vienna/total-joint-replacement-knee-joint' ||
      $path === '/en/joint-replacement-specialist-vienna/total-joint-replacement-knee-joint/') {
    nocache_headers();
    wp_redirect(home_url('/en/knee-replacement/'), 301);
    exit;
  }

  if ($path === '/en/joint-replacement-specialist-vienna/total-joint-replacement-hip-joint' ||
      $path === '/en/joint-replacement-specialist-vienna/total-joint-replacement-hip-joint/') {
    nocache_headers();
    wp_redirect(home_url('/en/hip-replacement/'), 301);
    exit;
  }

}, 0);




/**
 * WPML language switcher: always link to real translation permalink
 * Works even if slugs differ (beschwerden -> complaints, orthopaedische-behandlungen -> treatments)
 */
add_filter('wpml_ls_languages', function ($languages) {

  if (empty($languages) || !is_array($languages)) return $languages;

  $post_id = (int) get_queried_object_id();
  if (!$post_id) return $languages;

  foreach ($languages as $code => $lang) {

    // получаем ID перевода текущего объекта на нужный язык
    $translated_id = apply_filters('wpml_object_id', $post_id, get_post_type($post_id), true, $code);

    if ($translated_id) {
      $languages[$code]['url'] = get_permalink($translated_id);
    }
  }

  return $languages;

}, 20);







/**
 * Theme support
 */
add_action('after_setup_theme', function () {

  add_theme_support('title-tag');

  add_theme_support('html5', array(
    'comment-list',
    'comment-form',
    'search-form',
    'gallery',
    'caption',
    'style',
    'script',
  ));

});


/**
 * Cleanup wp_head
 */
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'wp_oembed_add_discovery_links');

/**
 * Includes
 */
require_once get_template_directory() . '/functions/thumbnails.php';
require_once get_template_directory() . '/functions/menus.php';
require_once get_template_directory() . '/functions/login.php';
require_once get_template_directory() . '/functions/shortcodes.php';
require_once get_template_directory() . '/functions/quotes.php';

require_once get_template_directory() . '/functions/acf.php';
require_once get_template_directory() . '/functions/acf_kontakt.php';
require_once get_template_directory() . '/functions/acf_seo.php';

require_once get_template_directory() . '/functions/roles.php';
require_once get_template_directory() . '/functions/admin.php';
require_once get_template_directory() . '/functions/dashboard.php';
require_once get_template_directory() . '/functions/backup.php';

require_once get_template_directory() . '/functions/custom_posttype.php';
// require_once get_template_directory() . '/functions/custom_taxonomy.php';

require_once get_template_directory() . '/functions/activate.php';

/**
 * CF7: remove <p> wrapper
 */
add_filter('wpcf7_autop_or_not', '__return_false');

/**
 * WPML: do not load language selector CSS
 */
if (!defined('ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS')) {
  define('ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true);
}

/**
 * Disable Block Editor
 */
add_filter('use_block_editor_for_post', '__return_false', 10);

/**
 * Remove Gutenberg CSS on frontend
 */
function tigris_remove_wp_block_library_css() {
  wp_dequeue_style('wp-block-library');
  wp_dequeue_style('wp-block-library-theme');
  wp_dequeue_style('global-styles');
  wp_dequeue_style('classic-theme-styles');
}
add_action('wp_enqueue_scripts', 'tigris_remove_wp_block_library_css', 100);

/**
 * Remove default theme version test from Site Health
 */
function tigris_disable_status_tests($tests) {
  unset($tests['direct']['theme_version']);
  return $tests;
}
add_filter('site_status_tests', 'tigris_disable_status_tests');

/**
 * Disable login language switcher
 */
add_filter('login_display_language_dropdown', '__return_false');

/**
 * Disable WP sitemap
 */
add_filter('wp_sitemaps_enabled', '__return_false');

/**
 * Admin: jQuery + select2 only on ACF screens
 */
add_action('admin_enqueue_scripts', function () {

  $screen = function_exists('get_current_screen') ? get_current_screen() : null;
  if (!$screen) return;

  $is_acf_screen =
    (isset($_GET['post_type']) && $_GET['post_type'] === 'acf-field-group') ||
    (isset($screen->id) && strpos($screen->id, 'acf') !== false) ||
    (isset($screen->base) && strpos($screen->base, 'acf') !== false);

  if (!$is_acf_screen) return;

  wp_enqueue_script('jquery');

  if (wp_script_is('select2', 'registered')) {
    wp_enqueue_script('select2');
  }
  if (wp_style_is('select2', 'registered')) {
    wp_enqueue_style('select2');
  }

}, 999);

/**
 * Canonical: disable for /service/ urls and service CPT single
 */
add_filter('redirect_canonical', function ($redirect_url, $requested_url) {

  $uri = isset($_SERVER['REQUEST_URI']) ? (string) $_SERVER['REQUEST_URI'] : '';

  if (strpos($uri, '/service/') === 0) {
    return false;
  }

  if (is_singular('service')) {
    return false;
  }

  return $redirect_url;
}, 10, 2);

/**
 * Admin menu: shortcut to ACF Field Groups
 */
add_action('admin_menu', function () {

  add_menu_page(
    'ACF Field Groups',
    'ACF',
    'manage_options',
    'edit.php?post_type=acf-field-group',
    '',
    'dashicons-layout',
    25
  );

});

/**
 * ACF: add page template to location rule list
 */
add_filter('acf/location/rule_values/page_template', function ($choices) {
  $choices['page-service.php'] = 'Service Page';
  return $choices;
});

/*
// Frontend scripts (старое меню) — отключено, потому что скрипты подключаются вручную в footer.php
add_action('wp_enqueue_scripts', function () {

  wp_enqueue_script('jquery');

  wp_enqueue_script(
    'superfish',
    get_template_directory_uri() . '/js/superfish.js',
    array('jquery'),
    null,
    true
  );

  wp_enqueue_script(
    'toggle',
    get_template_directory_uri() . '/js/toggle.js',
    array('jquery'),
    null,
    true
  );

  $main_path = get_template_directory() . '/js/main.js';
  $main_ver  = file_exists($main_path) ? filemtime($main_path) : null;

  wp_enqueue_script(
    'waypoint',
    get_template_directory_uri() . '/js/waypoint.js',
    array('jquery'),
    null,
    true
  );

  wp_enqueue_script(
    'inview',
    get_template_directory_uri() . '/js/inview.js',
    array('jquery'),
    null,
    true
  );

  wp_enqueue_script(
    'owl-carousel',
    get_template_directory_uri() . '/js/owl.carousel.min.js',
    array('jquery'),
    null,
    true
  );

  wp_enqueue_script(
    'theme-main',
    get_template_directory_uri() . '/js/main.js',
    array('jquery', 'superfish', 'toggle', 'waypoint', 'inview', 'owl-carousel'),
    $main_ver,
    true
  );

}, 20);
*/

/**
 * Раньше было так (НЕПРАВИЛЬНО: вызов enqueue вне хука), оставляю как комментарий:
 *
 * wp_enqueue_script(
 *   'mnav',
 *   get_template_directory_uri() . '/js/mnav.js',
 *   array(),
 *   filemtime(get_template_directory() . '/js/mnav.js'),
 *   true
 * );
 */
 
 




add_action('wp_head', function () {
  echo <<<HTML
<script>
document.addEventListener('DOMContentLoaded', function () {
  document.querySelectorAll('[data-svc-faq]').forEach(function (root) {
    if (root.__svcFaqInit) return;
    root.__svcFaqInit = true;

    root.querySelectorAll('.svc-faq__panel').forEach(function (p) {
      p.hidden = true;
      p.style.maxHeight = '';
    });

    root.addEventListener('click', function (e) {
      var btn = e.target.closest('.svc-faq__btn');
      if (!btn || !root.contains(btn)) return;

      var panelId = btn.getAttribute('aria-controls');
      var panel = panelId ? document.getElementById(panelId) : null;
      if (!panel) return;

      var isOpen = btn.getAttribute('aria-expanded') === 'true';

      root.querySelectorAll('.svc-faq__btn').forEach(function (b) {
        b.setAttribute('aria-expanded', 'false');
      });
      root.querySelectorAll('.svc-faq__panel').forEach(function (p) {
        p.hidden = true;
        p.style.maxHeight = '';
      });

      if (!isOpen) {
        btn.setAttribute('aria-expanded', 'true');
        panel.hidden = false;
        panel.style.maxHeight = panel.scrollHeight + 'px';
      }
    });
  });
});
</script>
HTML;
}, 50);







/**
 * Floating phone button + popup (delayed render).
 * Color: #6a96a5
 * Phone: +43 1 40 180 – 7010
 */

add_action('wp_footer', function () {
	?>
	<style id="wp-phone-popup-style">
		/* Container (injected after delay, but styles can exist safely) */
		.wp-phone-fab {
			position: fixed;
			right: 18px;
			bottom: 18px;
			z-index: 99999;
			width: 56px;
			height: 56px;
			border-radius: 999px;
			border: none;
			background: #6a96a5;
			box-shadow: 0 10px 25px rgba(0,0,0,.2);
			display: inline-flex;
			align-items: center;
			justify-content: center;
			cursor: pointer;
			transition: transform .15s ease, box-shadow .15s ease, opacity .15s ease;
		}
		.wp-phone-fab:hover {
			transform: translateY(-2px);
			box-shadow: 0 14px 35px rgba(0,0,0,.25);
		}
		.wp-phone-fab:active { transform: translateY(0); }
		.wp-phone-fab:focus-visible {
			outline: 3px solid rgba(106, 150, 165, .35);
			outline-offset: 3px;
		}
		.wp-phone-fab svg { width: 26px; height: 26px; fill: #fff; }

		/* Backdrop */
		.wp-phone-backdrop {
			position: fixed;
			inset: 0;
			z-index: 99998;
			background: rgba(0,0,0,.35);
			opacity: 0;
			pointer-events: none;
			transition: opacity .18s ease;
		}
		.wp-phone-backdrop.is-open {
			opacity: 1;
			pointer-events: auto;
		}

		/* Modal */
		.wp-phone-modal {
			position: fixed;
			right: 18px;
			bottom: 86px; /* above the button */
			z-index: 99999;
			width: min(360px, calc(100vw - 36px));
			background: #fff;
			border-radius: 16px;
			box-shadow: 0 20px 50px rgba(0,0,0,.25);
			transform: translateY(10px);
			opacity: 0;
			pointer-events: none;
			transition: opacity .18s ease, transform .18s ease;
			font-family: inherit;
		}
		.wp-phone-modal.is-open {
			opacity: 1;
			transform: translateY(0);
			pointer-events: auto;
		}

		.wp-phone-modal__header {
			padding: 16px 16px 10px 16px;
			display: flex;
			gap: 10px;
			align-items: flex-start;
			justify-content: space-between;
		}
		.wp-phone-modal__title {
			margin: 0;
			font-size: 18px;
			line-height: 1.25;
			font-weight: 700;
			color: #1b1b1b;
		}
		.wp-phone-modal__subtitle {
			margin: 6px 0 0 0;
			font-size: 13px;
			line-height: 1.4;
			color: #555;
		}
		.wp-phone-close {
			width: 34px;
			height: 34px;
			border-radius: 999px;
			border: none;
			background: rgba(0,0,0,.06);
			cursor: pointer;
			display: inline-flex;
			align-items: center;
			justify-content: center;
			transition: background .15s ease;
			flex: 0 0 auto;
		}
		.wp-phone-close:hover { background: rgba(0,0,0,.10); }
		.wp-phone-close:focus-visible {
			outline: 3px solid rgba(106, 150, 165, .35);
			outline-offset: 2px;
		}

		.wp-phone-modal__body { padding: 0 16px 16px 16px; }

		.wp-phone-callrow {
			display: flex;
			gap: 10px;
			align-items: center;
			background: rgba(106, 150, 165, .12);
			border: 1px solid rgba(106, 150, 165, .35);
			border-radius: 999px;
			padding: 10px 12px;
		}
		.wp-phone-callrow__icon {
			width: 34px;
			height: 34px;
			border-radius: 999px;
			background: #6a96a5;
			display: inline-flex;
			align-items: center;
			justify-content: center;
			flex: 0 0 auto;
		}
		.wp-phone-callrow__icon svg { width: 18px; height: 18px; fill: #fff; }

		.wp-phone-callrow a {
			color: #0f2d34;
			text-decoration: none;
			font-weight: 700;
			letter-spacing: .1px;
			display: inline-block;
		}
		.wp-phone-callrow a:hover { text-decoration: underline; }

		.wp-phone-hint {
			margin: 10px 0 0 0;
			font-size: 12.5px;
			color: #666;
			line-height: 1.45;
		}

		/* Small screens: move a bit up if needed */
		@media (max-width: 480px) {
			.wp-phone-modal { bottom: 82px; right: 12px; width: calc(100vw - 24px); }
			.wp-phone-fab { right: 12px; bottom: 12px; }
		}
	</style>

	<script id="wp-phone-popup-script">
	(function () {
		// Delay injection so it doesn't affect initial loading/metrics
		window.addEventListener('load', function () {
			setTimeout(function () {
				if (document.getElementById('wp-phone-fab')) return;

				var phoneDisplay = '+43 1 40 180 – 7010';
				// tel: should be digits, +, etc. (no spaces/dashes)
				var phoneTel = '+431401807010';

				// Backdrop
				var backdrop = document.createElement('div');
				backdrop.className = 'wp-phone-backdrop';
				backdrop.id = 'wp-phone-backdrop';

				// Modal
				var modal = document.createElement('div');
				modal.className = 'wp-phone-modal';
				modal.id = 'wp-phone-modal';
				modal.setAttribute('role', 'dialog');
				modal.setAttribute('aria-modal', 'true');
				modal.setAttribute('aria-labelledby', 'wp-phone-title');

				modal.innerHTML =
					'<div class="wp-phone-modal__header">' +
						'<div>' +
							'<p class="wp-phone-modal__title" id="wp-phone-title">Vereinbaren Sie jetzt einen Termin!</p>' +
							'<p class="wp-phone-modal__subtitle">Wir freuen uns auf Ihren Anruf.</p>' +
						'</div>' +
						'<button class="wp-phone-close" type="button" aria-label="Schließen">' +
							'<svg viewBox="0 0 24 24" aria-hidden="true"><path d="M18.3 5.7a1 1 0 0 0-1.4 0L12 10.6 7.1 5.7a1 1 0 1 0-1.4 1.4l4.9 4.9-4.9 4.9a1 1 0 1 0 1.4 1.4l4.9-4.9 4.9 4.9a1 1 0 0 0 1.4-1.4L13.4 12l4.9-4.9a1 1 0 0 0 0-1.4z"/></svg>' +
						'</button>' +
					'</div>' +
					'<div class="wp-phone-modal__body">' +
						'<div class="wp-phone-callrow">' +
							'<span class="wp-phone-callrow__icon" aria-hidden="true">' +
								'<svg viewBox="0 0 24 24"><path d="M6.6 10.8c1.4 2.7 3.9 5.2 6.6 6.6l2.2-2.2c.3-.3.8-.4 1.2-.2 1 .4 2.1.7 3.2.7.7 0 1.3.6 1.3 1.3V21c0 .7-.6 1.3-1.3 1.3C10.6 22.3 1.7 13.4 1.7 2.3 1.7 1.6 2.3 1 3 1h3.4c.7 0 1.3.6 1.3 1.3 0 1.1.2 2.2.7 3.2.1.4 0 .9-.2 1.2L6.6 10.8z"/></svg>' +
							'</span>' +
							'<div>' +
								'<a href="tel:' + phoneTel + '" aria-label="Jetzt anrufen: ' + phoneDisplay + '">' + phoneDisplay + '</a>' +
							'</div>' +
						'</div>' +
						'<p class="wp-phone-hint">Ein kurzer Anruf reicht – wir klären die Details und finden einen passenden Termin.</p>' +
					'</div>';

				// Floating button
				var fab = document.createElement('button');
				fab.className = 'wp-phone-fab';
				fab.id = 'wp-phone-fab';
				fab.type = 'button';
				fab.setAttribute('aria-label', 'Telefon öffnen');
				fab.setAttribute('aria-expanded', 'false');
				fab.setAttribute('aria-controls', 'wp-phone-modal');
				fab.innerHTML =
					'<svg viewBox="0 0 24 24" aria-hidden="true">' +
						'<path d="M6.6 10.8c1.4 2.7 3.9 5.2 6.6 6.6l2.2-2.2c.3-.3.8-.4 1.2-.2 1 .4 2.1.7 3.2.7.7 0 1.3.6 1.3 1.3V21c0 .7-.6 1.3-1.3 1.3C10.6 22.3 1.7 13.4 1.7 2.3 1.7 1.6 2.3 1 3 1h3.4c.7 0 1.3.6 1.3 1.3 0 1.1.2 2.2.7 3.2.1.4 0 .9-.2 1.2L6.6 10.8z"/>' +
					'</svg>';

				document.body.appendChild(backdrop);
				document.body.appendChild(modal);
				document.body.appendChild(fab);

				var closeBtn = modal.querySelector('.wp-phone-close');

				function openModal() {
					backdrop.classList.add('is-open');
					modal.classList.add('is-open');
					fab.setAttribute('aria-expanded', 'true');
					// focus close for accessibility
					closeBtn.focus({ preventScroll: true });
				}

				function closeModal() {
					backdrop.classList.remove('is-open');
					modal.classList.remove('is-open');
					fab.setAttribute('aria-expanded', 'false');
					fab.focus({ preventScroll: true });
				}

				fab.addEventListener('click', function () {
					var isOpen = modal.classList.contains('is-open');
					if (isOpen) closeModal();
					else openModal();
				});

				closeBtn.addEventListener('click', closeModal);
				backdrop.addEventListener('click', closeModal);

				document.addEventListener('keydown', function (e) {
					if (e.key === 'Escape' && modal.classList.contains('is-open')) {
						closeModal();
					}
				});
			}, 1000);
		});
	})();
	</script>
	<?php
}, 100);


/**
 * FAQ Schema (JSON-LD) from ACF Service – FAQ
 */
add_action('wp_head', function () {

  if (!is_singular()) return;

  // Проверяем, есть ли FAQ repeater
  if (!have_rows('faq_items')) return;

  $faq_schema = [
    '@context' => 'https://schema.org',
    '@type'    => 'FAQPage',
    'mainEntity' => []
  ];

  while (have_rows('faq_items')) {
    the_row();

    $question = get_sub_field('question');
    $answer   = get_sub_field('answer');

    if (!$question || !$answer) continue;

    $faq_schema['mainEntity'][] = [
      '@type' => 'Question',
      'name'  => wp_strip_all_tags($question),
      'acceptedAnswer' => [
        '@type' => 'Answer',
        'text'  => wp_strip_all_tags($answer)
      ]
    ];
  }

  if (empty($faq_schema['mainEntity'])) return;

  echo '<script type="application/ld+json">' . 
       wp_json_encode($faq_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . 
       '</script>';

});



add_filter('acf/format_value/name=hero_title', function($value) {

    if (is_page('revisionsendoprothetik')) {

        $value = str_replace(
            'Revisionsendoprothetik',
            'Revisionsendo<span class="mobile-break">-</span>prothetik',
            $value
        );
    }

    return $value;

}, 10, 1);




add_filter('the_content', function($content) {

    // normalize &nbsp; to spaces for cleanup
    $content = str_replace('&nbsp;', ' ', $content);

    // remove empty <b></b> and <strong></strong>
    $content = preg_replace('/<(b|strong)([^>]*)>\s*<\/\1>/i', '', $content);

    // remove <b><br></b> and <strong><br></strong>
    $content = preg_replace('/<(b|strong)([^>]*)>\s*<br\s*\/?>\s*<\/\1>/i', '', $content);

    return $content;

}, 20);


add_filter('acf/format_value/type=wysiwyg', function($value) {

    if (is_admin()) return $value;                 // <-- добавь
    if (!is_string($value) || $value === '') return $value;

    $value = str_replace('&nbsp;', ' ', $value);

    $value = preg_replace('/<(b|strong)([^>]*)>\s*<\/\1>/i', '', $value);
    $value = preg_replace('/<(b|strong)([^>]*)>\s*<br\s*\/?>\s*<\/\1>/i', '', $value);

    return $value;

}, 10);


add_action('wp_head', function () {
  // если Rank Math активен — он сам выводит description
  if (defined('RANK_MATH_VERSION')) return;

  if (is_page(1635)) { // Kontakt page ID
    echo '<meta name="description" content="Kontakt zur Ordination von Prof. DDr. Martin Faschingbauer in 1090 Wien. Termine nach Vereinbarung, Telefon und E-Mail – alle Infos auf einen Blick.">' . "\n";
  }
}, 1);


add_action('template_redirect', function () {

  if (!is_page_template('page-kontakt-fix.php')) return;

  ob_start(function ($html) {

    $pattern = '/<meta\s+name=(["\'])description\1\s+content=(["\'])(?:[^"\']*Ordinationszeiten[^"\']*)\2\s*\/?>\s*/i';
    $html = preg_replace($pattern, '', $html, 1);

    if (substr_count(strtolower($html), 'name="description"') > 1) {
      $html = preg_replace(
        '/(<meta\s+name=(["\'])description\2[^>]*>\s*)(?=.*<meta\s+name=(["\'])description\3)/is',
        '',
        $html,
        1
      );
    }

    return $html;
  });

  add_action('shutdown', function () {
    if (ob_get_level() > 0) {
      @ob_end_flush();
    }
  }, 0);

}, 0);





// Меняем первый h2.pagetitle на h1 только на правовых страницах
add_action('template_redirect', function () {

  if ( !is_singular('page') ) return;

  if ( !is_page(array('datenschutz','impressum','privacy','imprint')) ) return;

  ob_start(function($buffer) {

    // заменить только первый h2.pagetitle -> h1.pagetitle
    $buffer = preg_replace(
      '/<h2 class="pagetitle([^>]*)>/',
      '<h1 class="pagetitle$1>',
      $buffer,
      1
    );

    // закрыть только первый </h2> -> </h1>
    $buffer = preg_replace(
      '/<\/h2>/',
      '</h1>',
      $buffer,
      1
    );

    return $buffer;
  });

  // гарантированно отдаем буфер в конце запроса
  add_action('shutdown', function () {
    if (ob_get_level() > 0) {
      @ob_end_flush();
    }
  }, 0);

}, 0);


add_action('wp_head', function () {

  // Если Site Icon задан в админке — WP сам выведет favicon
  if (function_exists('has_site_icon') && has_site_icon()) {
    return;
  }

  $u = wp_parse_url(home_url('/'));
  $root = (!empty($u['scheme']) ? $u['scheme'] : 'https') . '://' . $u['host'] . '/';

  echo '<link rel="icon" href="' . esc_url($root . 'favicon.ico') . '" sizes="any">' . "\n";
  echo '<link rel="icon" type="image/png" sizes="32x32" href="' . esc_url($root . 'favicon-32x32.png') . '">' . "\n";
  echo '<link rel="icon" type="image/png" sizes="16x16" href="' . esc_url($root . 'favicon-16x16.png') . '">' . "\n";
  echo '<link rel="apple-touch-icon" sizes="180x180" href="' . esc_url($root . 'apple-touch-icon.png') . '">' . "\n";
  echo '<meta name="theme-color" content="#ffffff">' . "\n";

}, 1);





add_action('wp_footer', 'fb_orf_countdown_script', 100);

function fb_orf_countdown_script() {
    if (!is_front_page()) {
        return;
    }
    ?>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
      var target = new Date('2026-05-11T18:45:00+02:00').getTime();
      var block = document.querySelector('.fb-orf');

      function pad(n) {
        return String(Math.max(0, n)).padStart(2, '0');
      }

      function setText(id, value) {
        var el = document.getElementById(id);

        if (el) {
          el.textContent = value;
        }
      }

      function hideBlock() {
        if (block) {
          block.style.display = 'none';
        }
      }

      function tick() {
        var diff = target - Date.now();

        if (diff <= 0) {
          setText('fb-days', '00');
          setText('fb-hours', '00');
          setText('fb-mins', '00');
          setText('fb-secs', '00');

          hideBlock();
          return;
        }

        setText('fb-days', pad(Math.floor(diff / 86400000)));
        setText('fb-hours', pad(Math.floor((diff % 86400000) / 3600000)));
        setText('fb-mins', pad(Math.floor((diff % 3600000) / 60000)));
        setText('fb-secs', pad(Math.floor((diff % 60000) / 1000)));
      }

      tick();
      setInterval(tick, 1000);
    });
    </script>
    <?php
}