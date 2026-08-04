<?php
/*
Template Name: LP Knieendoprothese
*/

/* $lp_form_recipient = get_option('admin_email'); */ 
// Test recipient. Replace with the client's email after testing.
$lp_form_recipient = 'praxis@ortho-faschingbauer.at';
$lp_form_status = '';
$lp_form_message = '';

if (isset($_GET['lp_sent']) && $_GET['lp_sent'] === '1') {
  $lp_form_status = 'success';
  $lp_form_message = 'Vielen Dank. Ihre Anfrage wurde gesendet.';
} elseif (isset($_GET['lp_error']) && $_GET['lp_error'] === '1') {
  $lp_form_status = 'error';
  $lp_form_message = 'Die Anfrage konnte nicht gesendet werden. Bitte versuchen Sie es später erneut.';
}

if (
  $_SERVER['REQUEST_METHOD'] === 'POST'
  && isset($_POST['lp_form_action'])
  && $_POST['lp_form_action'] === 'lp_huefte_contact'
) {
  $lp_vorname = isset($_POST['lp_vorname']) ? sanitize_text_field(wp_unslash($_POST['lp_vorname'])) : '';
  $lp_nachname = isset($_POST['lp_nachname']) ? sanitize_text_field(wp_unslash($_POST['lp_nachname'])) : '';
  $lp_email = isset($_POST['lp_email']) ? sanitize_email(wp_unslash($_POST['lp_email'])) : '';
  $lp_telefon = isset($_POST['lp_telefon']) ? sanitize_text_field(wp_unslash($_POST['lp_telefon'])) : '';
  $lp_honeypot = isset($_POST['website']) ? trim((string) wp_unslash($_POST['website'])) : '';
  $lp_form_time = isset($_POST['lp_form_time']) ? absint($_POST['lp_form_time']) : 0;
  $lp_current_url = home_url(isset($_SERVER['REQUEST_URI']) ? sanitize_text_field(wp_unslash($_SERVER['REQUEST_URI'])) : '/');
  $lp_redirect_base = remove_query_arg(array(
    'lp_form_action',
    'lp_form_nonce',
    'website',
    'lp_vorname',
    'lp_nachname',
    'lp_email',
    'lp_telefon',
    'lp_form_time',
    'lp_sent',
    'lp_error',
  ), $lp_current_url);

  if (!isset($_POST['lp_form_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['lp_form_nonce'])), 'lp_huefte_contact')) {
    $lp_form_status = 'error';
    $lp_form_message = 'Die Anfrage konnte nicht verifiziert werden. Bitte versuchen Sie es erneut.';
  } elseif ($lp_honeypot !== '') {
    wp_safe_redirect(add_query_arg('lp_sent', '1', $lp_redirect_base) . '#formular');
    exit;
  } elseif ($lp_form_time === 0 || time() - $lp_form_time < 3) {
    $lp_form_status = 'error';
    $lp_form_message = 'Die Anfrage konnte nicht verarbeitet werden. Bitte versuchen Sie es erneut.';
  } elseif ($lp_nachname === '' || ($lp_email !== '' && !is_email($lp_email)) || !preg_match('/^[0-9+\-\s()\/]{6,20}$/', $lp_telefon)) {
    $lp_form_status = 'error';
    $lp_form_message = 'Bitte füllen Sie alle Felder aus und geben Sie eine gültige E-Mail Adresse sowie Telefonnummer ein.';
  } else {
    $lp_ip = isset($_SERVER['REMOTE_ADDR']) ? sanitize_text_field(wp_unslash($_SERVER['REMOTE_ADDR'])) : 'unknown';
    $lp_rate_key = 'lp_huefte_rate_' . md5($lp_ip);

    if (get_transient($lp_rate_key)) {
      $lp_form_status = 'error';
      $lp_form_message = 'Bitte warten Sie kurz, bevor Sie eine neue Anfrage senden.';
    } else {
      set_transient($lp_rate_key, 1, 5 * MINUTE_IN_SECONDS);

      $lp_subject = 'Neue Anfrage Knieendoprothetik Landing Page';
      $lp_body = implode("\n", array(
        'Neue Anfrage über die Landing Page:',
        '',
        'Name: ' . $lp_vorname . ' ' . $lp_nachname,
        'E-Mail: ' . $lp_email,
        'Telefon: ' . $lp_telefon,
        '',
        'Seite: ' . home_url(isset($_SERVER['REQUEST_URI']) ? sanitize_text_field(wp_unslash($_SERVER['REQUEST_URI'])) : '/'),
      ));
      $lp_headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'Reply-To: ' . $lp_vorname . ' ' . $lp_nachname . ' <' . $lp_email . '>',
      );

      if (wp_mail($lp_form_recipient, $lp_subject, $lp_body, $lp_headers)) {
        wp_safe_redirect(add_query_arg('lp_sent', '1', $lp_redirect_base) . '#formular');
        exit;
      } else {
        wp_safe_redirect(add_query_arg('lp_error', '1', $lp_redirect_base) . '#formular');
        exit;
      }
    }
  }
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta name="robots" content="noindex, nofollow">
  <meta name="googlebot" content="noindex, nofollow">

  <title><?php wp_title(''); ?></title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@400;500;600;700&display=swap" rel="stylesheet">

  <?php wp_head(); ?>

  <style>
    
    html,
    body {
      margin: 0;
      padding: 0;
      background: #f3f3f3 !important;
    }

    body {
      overflow-x: hidden;
      padding-bottom: 86px;
    }

    .lp-page,
    .lp-page * {
      box-sizing: border-box;
      font-family: 'Figtree', Arial, sans-serif !important;
    }

    .lp-page {
      width: 1024px;
      max-width: 100%;
      margin: 0 auto;
      background: #ffffff;
      color: #3f3f46;
      overflow: hidden;
    }

    .lp-page a {
      text-decoration: none;
    }

    /* =========================
       HEADER
    ========================= */

    .lp-page .lp-top {
      background: #ffffff;
      padding: 52px 48px 24px;
    }

    .lp-page .lp-header-row {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 32px;
      width: 100%;
    }

    .lp-page .lp-doctor {
      flex: 0 0 auto;
    }

    .lp-page .lp-doctor-small {
      margin: 0 0 2px;
      color: #3f3f46;
      font-size: 16px;
      line-height: 20px;
      font-weight: 400;
    }

    .lp-page .lp-doctor-name {
      margin: 0;
      color: #6A96A5;
      font-size: 22px;
      line-height: 26px;
      font-weight: 700;
    }

    .lp-page .lp-btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      flex: 0 0 306px;
      width: 306px;
      height: 58px;
      padding: 0 20px;
      border: 0;
      border-radius: 8px;
      background: #6A96A5;
      color: #ffffff !important;
      font-size: 16px;
      line-height: 1.2;
      font-weight: 700;
      text-align: center;
      white-space: nowrap;
    }

    .lp-page .lp-btn:hover,
    .lp-page .lp-btn:focus {
      color: #ffffff !important;
      background: #6A96A5;
      opacity: 0.92;
    }

    /* =========================
       HERO IMAGE
    ========================= */

    .lp-page .lp-hero-image {
      width: 100%;
      height: 450px;
      overflow: hidden;
      background: #eef5f7;
    }

    .lp-page .lp-hero-image img {
      display: block;
      width: 100%;
      height: 100%;
      object-fit: cover;
      object-position: center center;
    }

    /* =========================
       TITLE BLOCK
    ========================= */

    .lp-page .lp-title-wrap {
      position: relative;
      z-index: 2;
      width: 100%;
      margin-top: -42px;
      padding: 0;
      background: transparent;
    }

    .lp-page .lp-title-card {
      width: 100%;
      background: #6A96A5;
      border-radius: 26px 26px 0 0;
      overflow: hidden;
    }

    .lp-page .lp-title-bar {
      background: #6A96A5;
      color: #ffffff;
      padding: 17px 48px 14px;
      font-size: 22px;
      line-height: 26px;
      font-weight: 700;
      text-transform: uppercase;
    }

    .lp-page .lp-title-content {
      background: #f8fbfc;
      border-radius: 24px 24px 0 0;
      padding: 34px 48px 32px;
    }

    .lp-page .lp-title-content h1 {
      margin: 0;
      max-width: 760px;
      color: #6A96A5;
      font-size: 36px;
      line-height: 1.22;
      font-weight: 400;
      letter-spacing: -0.03em;
    }

    .lp-page .lp-title-content h1 strong {
      display: block;
      font-weight: 700;
    }

    /* =========================
       REVIEW BLOCK
    ========================= */

    .lp-page .lp-review-section {
      background: #f8fbfc;
      padding: 0 48px 46px;
    }

    .lp-page .lp-review-card {
      position: relative;
      width: 520px;
      max-width: calc(100% - 96px);
      margin: 0 auto;
      padding: 24px 42px 26px;
      background: #ffffff;
      border: 1px solid rgba(106, 150, 165, 0.12);
      border-radius: 22px;
      box-shadow: 0 4px 14px rgba(0, 0, 0, 0.04);
      text-align: center;
    }

    .lp-page .lp-review-slides {
      position: relative;
    }

    .lp-page .lp-review-slide {
      display: none;
      width: 100%;
    }

    .lp-page .lp-review-slide.active {
      display: block;
    }

    .lp-page .lp-review-stars {
      margin: 0 0 15px;
      color: #ffb400;
      font-size: 34px;
      line-height: 1;
      letter-spacing: 2px;
    }

    .lp-page .lp-review-text {
      margin: 0 auto 13px;
      color: #555555;
      font-size: 16px;
      line-height: 1.35;
      font-weight: 400;
    }

    .lp-page .lp-review-author {
      display: block;
      color: #3f3f46;
      font-size: 14px;
      line-height: 1.3;
      font-weight: 700;
      font-style: italic;
    }

    .lp-page .lp-review-arrow {
      position: absolute;
      top: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      width: 28px;
      height: 28px;
      padding: 0;
      border: 1px solid rgba(106, 150, 165, 0.16);
      border-radius: 50%;
      appearance: none;
      background: #ffffff;
      box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
      color: #6A96A5;
      cursor: pointer;
      font-size: 22px;
      line-height: 1;
      transform: translateY(-50%);
    }

    .lp-page .lp-review-arrow-left {
      left: -14px;
    }

    .lp-page .lp-review-arrow-right {
      right: -14px;
    }

    .lp-page .lp-review-dots {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 7px;
      margin-top: 18px;
    }

    .lp-page .lp-review-dot {
      width: 9px;
      height: 9px;
      padding: 0;
      border: 0;
      border-radius: 50%;
      appearance: none;
      background: #dfe8eb;
      cursor: pointer;
    }

    .lp-page .lp-review-dot.active {
      background: #6A96A5;
    }

    /* =========================
       EXPERT SECTION
    ========================= */

    .lp-page .lp-expert-section {
      padding: 34px 48px 40px;
      background: white;
    }

    .lp-page .lp-expert-topbar {
      width: 100%;
      padding: 16px 20px;
      border-radius: 0;
      background: #6A96A5;
      color: #ffffff;
      text-align: center;
      font-size: 18px;
      line-height: 1.2;
      font-weight: 600;
      margin-bottom: 50px;
    }

    .lp-page .lp-expert-card-wrap {
      position: relative;
      max-width: 880px;
      margin: 0 auto;
      padding-top: 58px;
    }

    .lp-page .lp-expert-photo {
      position: absolute;
      top: 0;
      left: 50%;
      z-index: 3;
      width: 128px;
      height: 128px;
      overflow: hidden;
      border-radius: 50%;
      background: #d9dde3;
      box-shadow: none;
      transform: translateX(-50%);
    }

    .lp-page .lp-expert-photo img {
      display: block;
      width: 100%;
      height: 100%;
      object-fit: cover;
      object-position: center top;
    }

    .lp-page .lp-expert-card {
      padding: 84px 48px 28px;
      border: 1px solid rgba(106, 150, 165, 0.12);
      border-radius: 24px;
      background: #f1f3f4;
      text-align: center;
    }

    .lp-page .lp-expert-card h2 {
      margin: 0 0 6px;
      color: #6A96A5;
      font-size: 24px;
      line-height: 1.2;
      font-weight: 700;
      letter-spacing: -0.02em;
    }

    .lp-page .lp-expert-subtitle {
      margin: 0 0 20px;
      color: #4b4b4f;
      font-size: 16px;
      line-height: 1.3;
      font-weight: 400;
    }

    .lp-page .lp-expert-lead {
      max-width: 620px;
      margin: 0 auto 24px;
      color: #3d3d42;
      font-size: 18px;
      line-height: 1.25;
      font-weight: 700;
      text-align: center;
    }

    .lp-page .lp-expert-tags {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 10px;
      margin-top: 8px;
    }

    .lp-page .lp-expert-tag {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      max-width: 100%;
      padding: 8px 18px;
      border: 1px solid rgba(106, 150, 165, 0.08);
      border-radius: 999px;
      background: #f8fbfc;
      color: #9bb9c6;
      font-size: 13px;
      line-height: 1.2;
      font-weight: 500;
      text-align: center;
    }

    /* =========================
       INDICATIONS SECTION
    ========================= */

    .lp-page .lp-indications-section {
      padding: 42px 60px 54px;
      background: #f1f3f4;
    }

    .lp-page .lp-indications-title {
      margin: 0 0 12px;
      color: #6A96A5;
      font-size: 30px;
      line-height: 1.18;
      font-weight: 700;
      letter-spacing: -0.03em;
    }

    .lp-page .lp-indications-text {
      max-width: 760px;
      margin: 0 0 34px;
      color: #4b4b4f;
      font-size: 18px;
      line-height: 1.45;
      font-weight: 400;
    }

    .lp-page .lp-indications-text strong {
      color: #222226;
      font-weight: 700;
    }

    .lp-page .lp-symptom-grid {
      display: grid;
      grid-template-columns: repeat(2, minmax(0, 1fr));
      gap: 16px 26px;
      max-width: 700px;
    }

    .lp-page .lp-symptom-card {
      position: relative;
      display: flex;
      align-items: center;
      min-height: 84px;
      padding: 18px 22px 17px 82px;
      overflow: hidden;
      border-radius: 24px;
      background: #ffffff;
      color: #151518;
      font-size: 16px;
      line-height: 1.2;
      font-weight: 400;
    }

    .lp-page .lp-symptom-card::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 9px;
      background: #6A96A5;
    }

    .lp-page .lp-symptom-icon {
      position: absolute;
      left: 26px;
      top: 50%;
      width: 28px;
      height: 28px;
      color: #6A96A5;
      transform: translateY(-50%);
    }

    .lp-page .lp-symptom-icon img {
      display: block;
      width: 100%;
      height: 100%;
      object-fit: contain;
    }

    .lp-page .lp-symptom-card strong {
      font-weight: 700;
    }

    /* =========================
       CTA FORM SECTION
    ========================= */

    .lp-page .lp-cta-section {
      position: relative;
      padding: 78px 60px 64px;
      background: #6A96A5;
      scroll-margin-top: 20px;
    }

    .lp-page .lp-section-arrow {
      position: absolute;
      top: 0;
      left: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      width: 72px;
      height: 72px;
      border-radius: 50%;
      background: #ffffff;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.18);
      color: #6A96A5;
      transform: translate(-50%, -50%);
    }

    .lp-page .lp-section-arrow svg {
      display: block;
      width: 30px;
      height: 30px;
      stroke: currentColor;
    }

    .lp-page .lp-cta-card {
      max-width: 820px;
      margin: 0 auto;
      padding: 34px 56px 40px;
      border-radius: 28px;
      background: #ffffff;
    }

    .lp-page .lp-cta-card h2 {
      max-width: 620px;
      margin: 0 0 26px;
      color: #6A96A5;
      font-size: 34px;
      line-height: 1.12;
      font-weight: 700;
      letter-spacing: -0.03em;
    }

    .lp-page .lp-cta-form {
      display: grid;
      gap: 18px;
    }

    .lp-page .lp-form-message {
      margin: 0 0 18px;
      padding: 12px 16px;
      border-radius: 8px;
      font-size: 15px;
      line-height: 1.35;
      font-weight: 600;
    }

    .lp-page .lp-form-message.success {
      background: rgba(106, 150, 165, 0.12);
      color: #416171;
    }

    .lp-page .lp-form-message.error {
      background: rgba(180, 64, 64, 0.1);
      color: #8a2f2f;
    }

    .lp-page .lp-form-hidden {
      position: absolute;
      left: -9999px;
      width: 1px;
      height: 1px;
      overflow: hidden;
    }

    .lp-page .lp-cta-input {
      width: 100%;
      height: 58px;
      padding: 0 18px;
      border: 1px solid #e1e1e1;
      border-radius: 9px;
      appearance: none;
      background: #ffffff;
      color: #3f3f46;
      font-size: 16px;
      line-height: 1.2;
      font-weight: 400;
      outline: none;
    }

    .lp-page .lp-cta-input::placeholder {
      color: #a7a7ad;
      opacity: 1;
    }

    .lp-page .lp-cta-input:focus {
      border-color: #6A96A5;
    }

    .lp-page .lp-cta-note {
      margin: 0;
      color: #555555;
      font-size: 13px;
      line-height: 1.35;
      font-weight: 400;
    }

    .lp-page .lp-cta-note a {
      color: #3f3f46;
      font-weight: 700;
      text-decoration: underline;
    }

    .lp-page .lp-cta-submit {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 100%;
      height: 60px;
      padding: 0 24px;
      border: 0;
      border-radius: 8px;
      appearance: none;
      background: #6A96A5;
      color: #ffffff;
      cursor: pointer;
      font-size: 16px;
      line-height: 1.2;
      font-weight: 700;
      text-align: center;
    }

    /* =========================
       FAQ SECTION
    ========================= */

    .lp-page .lp-faq-section {
      padding: 42px 60px 58px;
      background: #ffffff;
    }

    .lp-page .lp-faq-title {
      margin: 0 0 28px;
      color: #6A96A5;
      font-size: 32px;
      line-height: 1.15;
      font-weight: 700;
      letter-spacing: -0.03em;
    }

    .lp-page .lp-faq-list {
      display: grid;
      gap: 14px;
    }

    .lp-page .lp-faq-item {
      border: 1px solid #e3e5e6;
      border-radius: 22px;
      background: #ffffff;
      overflow: hidden;
      transition: border-color 0.28s ease, box-shadow 0.28s ease;
    }

    .lp-page .lp-faq-item[open] {
      border-color: #1594f5;
      box-shadow: inset 0 0 0 1px #1594f5;
    }

    .lp-page .lp-faq-question {
      position: relative;
      display: block;
      padding: 24px 62px 24px 30px;
      color: #111114;
      cursor: pointer;
      font-size: 17px;
      line-height: 1.35;
      font-weight: 700;
      list-style: none;
      transition: color 0.28s ease;
    }

    .lp-page .lp-faq-question::-webkit-details-marker {
      display: none;
    }

    .lp-page .lp-faq-question::after {
      content: "+";
      position: absolute;
      top: 50%;
      right: 30px;
      color: #6A96A5;
      font-size: 30px;
      line-height: 1;
      font-weight: 400;
      transform: translateY(-50%);
      transition: color 0.28s ease, opacity 0.28s ease, transform 0.28s ease;
    }

    .lp-page .lp-faq-answer {
      margin: -8px 0 0;
      padding: 0 62px 26px 30px;
      color: #55555c;
      font-size: 16px;
      line-height: 1.45;
      font-weight: 400;
      overflow: hidden;
      transform: translateY(-2px);
      transition: height 0.48s cubic-bezier(0.22, 1, 0.36, 1), opacity 0.32s ease, transform 0.48s cubic-bezier(0.22, 1, 0.36, 1);
      will-change: height, opacity, transform;
    }

    /* =========================
       CONTACT SECTION
    ========================= */

    .lp-page .lp-contact-section {
      padding: 36px 60px 40px;
      background: #f1f3f4;
      text-align: center;
    }

    .lp-page .lp-contact-title {
      max-width: 640px;
      margin: 0 auto 26px;
      color: #6A96A5;
      font-size: 32px;
      line-height: 1.18;
      font-weight: 700;
      letter-spacing: -0.03em;
    }

    .lp-page .lp-contact-subtitle {
      margin: 0 0 12px;
      color: #3f3f46;
      font-size: 16px;
      line-height: 1.35;
      font-weight: 700;
    }

    .lp-page .lp-contact-times,
    .lp-page .lp-contact-address {
      color: #4b4b4f;
      font-size: 16px;
      line-height: 1.55;
      font-weight: 400;
    }

    .lp-page .lp-contact-times {
      margin: 0 0 26px;
    }

    .lp-page .lp-contact-location-icon {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 30px;
      height: 30px;
      margin: 0 auto 12px;
      color: #3f3f46;
    }

    .lp-page .lp-contact-location-icon svg {
      display: block;
      width: 100%;
      height: 100%;
      stroke: currentColor;
    }

    .lp-page .lp-contact-address {
      margin: 0 0 34px;
    }

    .lp-page .lp-contact-address a {
      color: inherit;
      text-decoration: none;
    }

    .lp-page .lp-contact-links {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      margin: 0 0 18px;
      color: #55555c;
      font-size: 13px;
      line-height: 1.2;
      font-weight: 400;
    }

    .lp-page .lp-contact-links a {
      color: #55555c;
    }

    .lp-page .lp-contact-copy {
      margin: 0;
      color: #55555c;
      font-size: 12px;
      line-height: 1.25;
      font-weight: 400;
    }

    /* =========================
       FIXED FOOTER
    ========================= */

    .lp-fixed-footer {
      position: fixed;
      left: 50%;
      bottom: 0;
      z-index: 50;
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 6px;
      width: 1024px;
      max-width: 100%;
      padding: 10px 20px;
      background: #f3f3f3;
      transform: translateX(-50%);
    }

    .lp-fixed-footer,
    .lp-fixed-footer * {
      box-sizing: border-box;
      font-family: 'Figtree', Arial, sans-serif !important;
    }

    .lp-fixed-action {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 58px;
      border: 1px solid #6A96A5;
      border-radius: 8px;
      background: #ffffff;
      color: #6A96A5;
      text-decoration: none;
    }

    .lp-fixed-action.lp-fixed-action-email {
      background: #6A96A5;
      color: #ffffff;
    }

    .lp-fixed-action svg {
      display: block;
      width: 32px;
      height: 32px;
      fill: currentColor;
    }

    #wp-phone-fab {
      display: none !important;
    }

    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 1023px) {
      .lp-page {
        width: 100%;
      }
    }

    @media (max-width: 900px) {
      .lp-page .lp-symptom-grid {
        grid-template-columns: 1fr;
        max-width: 100%;
      }

      .lp-page .lp-symptom-card {
        width: 100%;
      }
    }

    @media (max-width: 767px) {
      .lp-page .lp-top {
        padding: 32px 22px 22px;
      }

      .lp-page .lp-header-row {
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
      }

      .lp-page .lp-doctor {
        min-width: 0;
      }

      .lp-page .lp-doctor-small {
        font-size: 14px;
      }

      .lp-page .lp-doctor-name {
        font-size: 18px;
      }

      .lp-page .lp-btn {
        flex-basis: auto;
        flex-shrink: 0;
        width: clamp(178px, 52vw, 220px);
        padding: 0 12px;
        font-size: 14px;
        line-height: 1.15;
        white-space: normal;
      }

      .lp-page .lp-hero-image {
        height: 260px;
      }

      .lp-page .lp-title-bar {
        padding: 16px 22px 14px;
        font-size: 18px;
        line-height: 22px;
      }

      .lp-page .lp-title-content {
        padding: 30px 22px 30px;
      }

      .lp-page .lp-title-content h1 {
        font-size: 28px;
      }

      .lp-page .lp-review-section {
        padding: 0 22px 38px;
      }

      .lp-page .lp-review-card {
        width: 100%;
        max-width: 100%;
        padding: 24px 28px 26px;
      }

      .lp-page .lp-review-arrow {
        display: none;
      }

      .lp-page .lp-expert-section {
        padding: 34px 20px 40px;
      }

      .lp-page .lp-expert-topbar {
        font-size: 16px;
      }

      .lp-page .lp-expert-photo {
        width: 110px;
        height: 110px;
      }

      .lp-page .lp-expert-card {
        padding: 78px 20px 24px;
      }

      .lp-page .lp-expert-card h2 {
        font-size: 20px;
      }

      .lp-page .lp-expert-subtitle {
        font-size: 15px;
      }

      .lp-page .lp-expert-lead {
        font-size: 17px;
      }

      .lp-page .lp-expert-tag {
        font-size: 12px;
      }

      .lp-page .lp-indications-section {
        padding: 38px 28px 54px;
      }

      .lp-page .lp-indications-title {
        font-size: 28px;
      }

      .lp-page .lp-indications-text {
        margin-bottom: 34px;
        font-size: 16px;
      }

      .lp-page .lp-symptom-grid {
        grid-template-columns: 1fr;
        gap: 14px;
      }

      .lp-page .lp-symptom-card {
        min-height: 84px;
        padding: 18px 18px 17px 72px;
        font-size: 16px;
      }

      .lp-page .lp-symptom-icon {
        left: 22px;
      }

      .lp-page .lp-cta-section {
        padding: 70px 28px 58px;
      }

      .lp-page .lp-section-arrow {
        width: 66px;
        height: 66px;
      }

      .lp-page .lp-cta-card {
        padding: 28px 28px 34px;
        border-radius: 22px;
      }

      .lp-page .lp-cta-card h2 {
        font-size: 30px;
      }

      .lp-page .lp-faq-section {
        padding: 34px 28px 38px;
      }

      .lp-page .lp-faq-title {
        margin-bottom: 24px;
        font-size: 28px;
      }

      .lp-page .lp-faq-question {
        padding: 22px 54px 22px 20px;
        font-size: 15px;
      }

      .lp-page .lp-faq-question::after {
        right: 20px;
        font-size: 28px;
      }

      .lp-page .lp-faq-answer {
        padding: 0 42px 22px 20px;
        font-size: 15px;
      }

      .lp-page .lp-contact-section {
        padding: 34px 28px 34px;
      }

      .lp-page .lp-contact-title {
        font-size: 28px;
      }

      .lp-fixed-footer {
        padding: 9px 8px;
      }

      .lp-fixed-action {
        height: 50px;
      }

      .lp-fixed-action svg {
        width: 28px;
        height: 28px;
      }
    }
  </style>
</head>

<body>

<main class="lp-page">
  <!-- HEADER -->
  <section class="lp-top">
    <div class="lp-header-row">
      <div class="lp-doctor">
        <p class="lp-doctor-small">Prof. DDr.</p>
        <p class="lp-doctor-name">M. Faschingbauer</p>
      </div>

      <a href="#formular" class="lp-btn">
        Jetzt unverbindlich anfragen
      </a>
    </div>
  </section>

  <!-- HERO IMAGE -->
  <section class="lp-hero-image">
    <img
      src="https://ortho-faschingbauer.at/wp-content/uploads/dr-martin-faschingbauer-7823-lowres.jpg"
      alt="Prof. DDr. Martin Faschingbauer künstliches Kniegelenk"
    >
  </section>

  <!-- TITLE BLOCK -->
  <section class="lp-title-wrap">
    <div class="lp-title-card">
      <div class="lp-title-bar">
        KNIECHIRURG UND SPEZIALIST IN WIEN
      </div>

      <div class="lp-title-content">
        <h1>
          Wieder schmerzfrei bewegen dank Knieprothese
          <strong>Prof. DDr. Faschingbauer</strong>
        </h1>
      </div>
    </div>
  </section>

  <!-- REVIEW BLOCK -->
  <section class="lp-review-section">
    <div class="lp-review-card" data-review-slider>
      <button class="lp-review-arrow lp-review-arrow-left" type="button" aria-label="Vorheriger Erfahrungsbericht">‹</button>
      <button class="lp-review-arrow lp-review-arrow-right" type="button" aria-label="Nächster Erfahrungsbericht">›</button>

      <div class="lp-review-slides">
        <article class="lp-review-slide active">
          <div class="lp-review-stars">★★★★★</div>

          <p class="lp-review-text">
            „Ich kann aus jahrzehntelanger Orthopäden-Erfahrung in DE und AT sagen,
            dass Herr Prof. Faschingbauer (mindestens) 5 Sterne verdient. Kompetent,
            interessiert und engagiert hat er meine leider erforderliche KTEP-Patellarevision
            durchgeführt und mich vorher und nachher voll Empathie betreut.“
          </p>

          <strong class="lp-review-author">
            Peter K.
          </strong>
        </article>

        <article class="lp-review-slide">
          <div class="lp-review-stars">★★★★★</div>

          <p class="lp-review-text">
            „Herr Prof. Faschingbauer hat eine sehr freundliche und ruhige Art,
            was mir Sicherheit in meiner Entscheidung zu einer OP gegeben hat.
            Er spricht eine klare Sprache und ist sehr kompetent in seinem Tun.
            Dadurch habe ich das Gefühl, mich auf ihn verlassen zu können und bin
            auch mit dem Ergebnis der OP sehr zufrieden. Auf Telefonanrufe und
            Mailnachrichten reagiert er prompt, was auch nicht selbstverständlich ist.
            Eine klare Empfehlung meinerseits!“
          </p>

          <strong class="lp-review-author">
            Alexandra K.
          </strong>
        </article>

        <article class="lp-review-slide">
          <div class="lp-review-stars">★★★★★</div>

          <p class="lp-review-text">
            „Nach ausführlicher und geduldiger Aufklärung wurde mein sehr schmerzhaftes
            Kniegelenk im Dezember 2024 im Evangelischen Krankenhaus von Herrn Prof. DDr.
            Faschingbauer roboterassistiert gegen eine Totalprothese ausgetauscht.
            Nun - nach knapp einem Jahr komplikationsfreien Verlaufs - nehme ich die
            Endoprothese in den meisten Situationen gar nicht mehr wahr und bin sehr zufrieden.
            Herr Prof. DDr. Faschingbauer war vor und nach der OP zu allen auftretenden
            Fragen prompt erreichbar. Klare Empfehlung!“
          </p>

          <strong class="lp-review-author">
            Gerald D.
          </strong>
        </article>

        <article class="lp-review-slide">
          <div class="lp-review-stars">★★★★★</div>

          <p class="lp-review-text">
            „Ein Arzt aus Leidenschaft: Herr Primar Faschingbauer, überzeugt nicht nur
            durch sein enormes Fachwissen, sondern auch durch seine unglaublich freundliche
            und ruhige Art. Man merkt sofort, dass hier der Patient als Mensch im Mittelpunkt
            steht. Die Behandlung war präzise und erfolgreich. Ich kann Herrn Primar jedem
            wärmstens empfehlen, der Wert auf höchste medizinische Qualität und eine
            vertrauensvolle Atmosphäre.“
          </p>

          <strong class="lp-review-author">
            Dani Sk.
          </strong>
        </article>

        <article class="lp-review-slide">
          <div class="lp-review-stars">★★★★★</div>

          <p class="lp-review-text">
            „Herr Professor Martin Faschingbauer ist ein sehr einfühlsamer und kompetenter
            Arzt. Die Knie OP wurde ohne Komplikationen und zu meiner Zufriedenheit durchgeführt.
            Dieser Chirurg ist absolut weiterzuempfehlen.“
          </p>

          <strong class="lp-review-author">
            Eveline S.
          </strong>
        </article>

        <article class="lp-review-slide">
          <div class="lp-review-stars">★★★★★</div>

          <p class="lp-review-text">
            „Von Tag 1, sprich vor der Operation bis zur Nachbehandlung, hat er mir immer
            das Gefühl gegeben, für mich den Patienten da zu sein. Absolut kompetent –
            menschlich top. Bei mir wurde eine Hüft Operation durchgeführt, würde und kann
            ihn nur weiterempfehlen.“
          </p>

          <strong class="lp-review-author">
            Kristian F.
          </strong>
        </article>

        <article class="lp-review-slide">
          <div class="lp-review-stars">★★★★★</div>

          <p class="lp-review-text">
            „Prof. Faschingbauer ist ein absoluter Experte in der Endoprothetik.
            Er hat mich sehr empathisch zu der Entscheidung für eine Knieprothese geführt.
            In der Klinik Penzing wurde ich als Kassenpatientin bestens betreut und nach
            3 Monaten bin ich wieder voll fit.“
          </p>

          <strong class="lp-review-author">
            C. F.
          </strong>
        </article>
      </div>
    </div>

    <div class="lp-review-dots">
      <button class="lp-review-dot active" type="button" aria-label="Erfahrungsbericht 1 anzeigen"></button>
      <button class="lp-review-dot" type="button" aria-label="Erfahrungsbericht 2 anzeigen"></button>
      <button class="lp-review-dot" type="button" aria-label="Erfahrungsbericht 3 anzeigen"></button>
      <button class="lp-review-dot" type="button" aria-label="Erfahrungsbericht 4 anzeigen"></button>
      <button class="lp-review-dot" type="button" aria-label="Erfahrungsbericht 5 anzeigen"></button>
      <button class="lp-review-dot" type="button" aria-label="Erfahrungsbericht 6 anzeigen"></button>
      <button class="lp-review-dot" type="button" aria-label="Erfahrungsbericht 7 anzeigen"></button>
    </div>
  </section>

  <!-- EXPERT SECTION -->
  <section class="lp-expert-section">
    <div class="lp-expert-topbar">Rasche Terminvergabe · Persönliche Beratung</div>

    <div class="lp-expert-card-wrap">
      <div class="lp-expert-photo">
        <img src="https://ortho-faschingbauer.at/wp-content/uploads/martin-faschinbauer-kuehl-03.png" alt="Prof. DDr. M. Faschingbauer">
      </div>

      <div class="lp-expert-card">
        <h2>Prof. DDr. M. Faschingbauer</h2>
        <p class="lp-expert-subtitle">Facharzt für Orthopädie und Unfallchirurgie</p>

        <p class="lp-expert-lead">
          Langjährige Erfahrung in der operativen Orthopädie mit Fokus auf Hüft- und Knieendoprothetik.
        </p>

        <div class="lp-expert-tags">
          <span class="lp-expert-tag">Mitglied European Knee Society</span>
          <span class="lp-expert-tag">John Insall Travelling Fellow</span>
          <span class="lp-expert-tag">Habilitation Knieendoprothetik (Uni Ulm)</span>
        </div>
      </div>
    </div>
  </section>

  <!-- INDICATIONS SECTION -->
  <section class="lp-indications-section">
    <h2 class="lp-indications-title">Wann ist eine Knie-OP sinnvoll?</h2>

    <p class="lp-indications-text">
      Ein <strong>künstliches Kniegelenk</strong> wird bei fortgeschrittenem Verschleiß
      und erfolgloser konservativer Therapie empfohlen. Klassische Symptome sind:
    </p>

    <div class="lp-symptom-grid">
      <div class="lp-symptom-card">
        <span class="lp-symptom-icon" aria-hidden="true">
          <img src="https://ortho-faschingbauer.at/wp-content/uploads/directions_walk_24dp_416171_FILL0_wght300_GRAD0_opsz24-1.png" alt="Anlaufschmerz">
        </span>
        <span><strong>Anlaufschmerz</strong></span>
      </div>

      <div class="lp-symptom-card">
        <span class="lp-symptom-icon" aria-hidden="true">
          <img src="https://ortho-faschingbauer.at/wp-content/uploads/stairs_2_24dp_416171_FILL0_wght300_GRAD0_opsz24-1.png" alt="Belastungsschmerz">
        </span>
        <span><strong>Belastungsschmerz</strong> beim Treppensteigen oder Gehen</span>
      </div>

      <div class="lp-symptom-card">
        <span class="lp-symptom-icon" aria-hidden="true">
          <img src="https://ortho-faschingbauer.at/wp-content/uploads/directions_walk_24dp_416171_FILL0_wght300_GRAD0_opsz24-1.png" alt="Instabilität">
        </span>
        <span><strong>Instabilität</strong> und „Wegknicken“</span>
      </div>

      <div class="lp-symptom-card">
        <span class="lp-symptom-icon" aria-hidden="true">
          <img src="https://ortho-faschingbauer.at/wp-content/uploads/femur_alt_24dp_416171_FILL0_wght300_GRAD0_opsz24-1.png" alt="Sichtbare Fehlstellungen">
        </span>
        <span><strong>Sichtbare Fehlstellungen</strong> durch den einseitigen Abrieb des Knorpels</span>
      </div>

      <div class="lp-symptom-card">
        <span class="lp-symptom-icon" aria-hidden="true">
          <img src="https://ortho-faschingbauer.at/wp-content/uploads/rheumatology_24dp_416171_FILL0_wght300_GRAD0_opsz24-1.png" alt="Regelmäßige Schwellungen">
        </span>
        <span><strong>Regelmäßige Schwellungen</strong> und Entzündungen</span>
      </div>
    </div>
  </section>

  <!-- CTA FORM SECTION -->
  <section id="formular" class="lp-cta-section">
    <div class="lp-section-arrow" aria-hidden="true">
      <svg viewBox="0 0 24 24" fill="none" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M6 9l6 6 6-6"></path>
      </svg>
    </div>

    <div class="lp-cta-card">
      <h2>Jetzt unverbindliche Beratung anfragen</h2>

      <?php if ($lp_form_message !== '') : ?>
        <p class="lp-form-message <?php echo esc_attr($lp_form_status); ?>">
          <?php echo esc_html($lp_form_message); ?>
        </p>
      <?php endif; ?>

      <form class="lp-cta-form" action="<?php echo esc_url(get_permalink()); ?>#formular" method="post">
        <input type="hidden" name="lp_form_action" value="lp_huefte_contact">
        <input type="hidden" name="lp_form_time" value="<?php echo esc_attr(time()); ?>">
        <?php wp_nonce_field('lp_huefte_contact', 'lp_form_nonce'); ?>

        <label class="lp-form-hidden" for="lp-website">Website</label>
        <input id="lp-website" class="lp-form-hidden" type="text" name="website" tabindex="-1" autocomplete="off">

        <input class="lp-cta-input" type="text" name="lp_vorname" placeholder="Vorname" value="<?php echo isset($lp_vorname) && $lp_form_status !== 'success' ? esc_attr($lp_vorname) : ''; ?>">
        <input class="lp-cta-input" type="text" name="lp_nachname" placeholder="Nachname*" value="<?php echo isset($lp_nachname) && $lp_form_status !== 'success' ? esc_attr($lp_nachname) : ''; ?>" required>
        <input class="lp-cta-input" type="email" name="lp_email" placeholder="E-Mail Adresse" value="<?php echo isset($lp_email) && $lp_form_status !== 'success' ? esc_attr($lp_email) : ''; ?>">
        <input class="lp-cta-input" type="tel" name="lp_telefon" placeholder="Telefonnummer*" value="<?php echo isset($lp_telefon) && $lp_form_status !== 'success' ? esc_attr($lp_telefon) : ''; ?>" required pattern="[0-9+\-\s()\/]{6,20}" inputmode="tel">

        <p class="lp-cta-note">
          Mit dem Absenden stimmen Sie der <a href="/datenschutzerklaerung/">Datenschutzerklärung</a>
          sowie der <a href="#kontakt">Kontaktaufnahme</a> durch Ortho Faschingbauer zur
          Terminvereinbarung zu.
        </p>

        <button class="lp-cta-submit" type="submit">
          Jetzt unverbindlich Termin anfragen
        </button>
      </form>
    </div>
  </section>

  <!-- FAQ SECTION -->
  <section class="lp-faq-section">
    <h2 class="lp-faq-title">Häufig gestellte Fragen</h2>

    <div class="lp-faq-list">
      <details class="lp-faq-item" open>
        <summary class="lp-faq-question">Wie lange hält ein künstliches Kniegelenk?</summary>
        <p class="lp-faq-answer">
          Moderne Knieprothesen haben eine lange Lebensdauer. Bei normaler Belastung halten viele
          Implantate 15 bis 20 Jahre oder länger. Entscheidend sind unter anderem Knochenqualität,
          Aktivitätsniveau, Implantattyp und eine sorgfältige Nachbehandlung.
        </p>
      </details>

      <details class="lp-faq-item">
        <summary class="lp-faq-question">Wie schmerzhaft ist die Operation und die Zeit danach?</summary>
        <p class="lp-faq-answer">
          Nach einer Knieoperation sind Schmerzen in den ersten Tagen normal, werden aber mit einem
          individuellen Schmerzkonzept behandelt. Ziel ist, frühzeitig Bewegung zu ermöglichen und
          die Beschwerden Schritt für Schritt zu reduzieren.
        </p>
      </details>

      <details class="lp-faq-item">
        <summary class="lp-faq-question">Welche Arten von Knieprothesen gibt es?</summary>
        <p class="lp-faq-answer">
          Je nach Befund kommen unterschiedliche Versorgungen infrage, zum Beispiel Teilprothesen
          oder Totalendoprothesen. Welche Lösung sinnvoll ist, hängt davon ab, welche Bereiche des
          Kniegelenks betroffen sind und wie stark der Verschleiß ausgeprägt ist.
        </p>
      </details>

      <details class="lp-faq-item">
        <summary class="lp-faq-question">Wie sieht eine Kniegelenkprothese aus?</summary>
        <p class="lp-faq-answer">
          Eine Knieprothese ersetzt die geschädigten Gelenkflächen durch künstliche Komponenten.
          Sie besteht meist aus Metall- und Kunststoffelementen, die ein möglichst natürliches Gleiten
          des Gelenks ermöglichen sollen.
        </p>
      </details>

      <details class="lp-faq-item">
        <summary class="lp-faq-question">Ist ein künstliches Kniegelenk im Alltag spürbar?</summary>
        <p class="lp-faq-answer">
          Viele Patientinnen und Patienten nehmen ihr künstliches Kniegelenk nach der Heilungsphase
          im Alltag kaum noch wahr. Voraussetzung dafür sind eine gute Operationstechnik, konsequente
          Rehabilitation und realistische Belastung im Alltag.
        </p>
      </details>

      <details class="lp-faq-item">
        <summary class="lp-faq-question">Wann kann ich nach der OP wieder Auto fahren?</summary>
        <p class="lp-faq-answer">
          Das hängt vom Heilungsverlauf, der operierten Seite, der Beweglichkeit und der sicheren
          Kontrolle des Beins ab. Häufig wird das Autofahren erst nach ärztlicher Rücksprache wieder
          empfohlen.
        </p>
      </details>
    </div>
  </section>

  <!-- CONTACT SECTION -->
  <section id="kontakt" class="lp-contact-section">
    <h2 class="lp-contact-title">Wir freuen uns auf Ihre Kontaktaufnahme!</h2>

    <p class="lp-contact-subtitle">Ordinationszeiten</p>

    <p class="lp-contact-times">
      Mo 09:00 – 13:00<br>
      Do 14:00 – 20:00<br>
      Fr 09:00 – 13:00<br>
      und nach Vereinbarung
    </p>

    <div class="lp-contact-location-icon" aria-hidden="true">
      <svg viewBox="0 0 24 24" fill="none" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
        <path d="M12 21s7-6.2 7-12a7 7 0 1 0-14 0c0 5.8 7 12 7 12z"></path>
        <circle cx="12" cy="9" r="2.5"></circle>
      </svg>
    </div>

    <p class="lp-contact-address">
      <a href="https://maps.app.goo.gl/eev6Up8Ne8z4U7Q59" target="_blank" rel="noopener noreferrer">Lazarettgasse 25 / 1.OG<br>
      A-1090 Wien</a>
    </p>

    <div class="lp-contact-links">
      <a href="/impressum/">Impressum</a>
      <span>|</span>
      <a href="/datenschutzerklaerung/">Datenschutz</a>
    </div>

    <p class="lp-contact-copy">© 2026 Prof. DDr. med. univ. Martin Faschingbauer</p>
  </section>
</main>

<div class="lp-fixed-footer">
  <a class="lp-fixed-action lp-fixed-action-phone" href="tel:+431401807010" aria-label="Telefonisch anrufen">
    <svg viewBox="0 0 24 24" aria-hidden="true">
      <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1C10.61 21 3 13.39 3 4c0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.24.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"></path>
    </svg>
  </a>

  <a class="lp-fixed-action lp-fixed-action-email" href="#formular" aria-label="Zum Formular springen">
    <svg viewBox="0 0 24 24" aria-hidden="true">
      <path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4-8 5-8-5V6l8 5 8-5v2z"></path>
    </svg>
  </a>
</div>

<script>
  (function () {
    const slider = document.querySelector('[data-review-slider]');

    if (!slider) {
      return;
    }

    const slidesWrap = slider.querySelector('.lp-review-slides');
    const slides = Array.from(slider.querySelectorAll('.lp-review-slide'));
    const dots = Array.from(document.querySelectorAll('.lp-review-dot'));
    const prevButton = slider.querySelector('.lp-review-arrow-left');
    const nextButton = slider.querySelector('.lp-review-arrow-right');
    let activeIndex = 0;
    let autoplayId = null;

    function setFixedSlideHeight() {
      slidesWrap.style.minHeight = '';

      const maxHeight = slides.reduce(function (height, slide) {
        const wasActive = slide.classList.contains('active');

        slide.style.display = 'block';
        const slideHeight = slide.offsetHeight;
        slide.style.display = '';
        slide.classList.toggle('active', wasActive);

        return Math.max(height, slideHeight);
      }, 0);

      slidesWrap.style.minHeight = maxHeight + 'px';
    }

    function showSlide(index) {
      activeIndex = (index + slides.length) % slides.length;

      slides.forEach(function (slide, slideIndex) {
        slide.classList.toggle('active', slideIndex === activeIndex);
      });

      dots.forEach(function (dot, dotIndex) {
        dot.classList.toggle('active', dotIndex === activeIndex);
      });
    }

    function startAutoplay() {
      window.clearInterval(autoplayId);
      autoplayId = window.setInterval(function () {
        showSlide(activeIndex + 1);
      }, 5000);
    }

    prevButton.addEventListener('click', function () {
      showSlide(activeIndex - 1);
      startAutoplay();
    });

    nextButton.addEventListener('click', function () {
      showSlide(activeIndex + 1);
      startAutoplay();
    });

    dots.forEach(function (dot, dotIndex) {
      dot.addEventListener('click', function () {
        showSlide(dotIndex);
        startAutoplay();
      });
    });

    window.addEventListener('resize', setFixedSlideHeight);
    setFixedSlideHeight();
    startAutoplay();
  }());

  (function () {
    const faqLists = Array.from(document.querySelectorAll('.lp-faq-list'));

    if (!faqLists.length) {
      return;
    }

    function getAnswer(item) {
      return item.querySelector('.lp-faq-answer');
    }

    function openItem(item) {
      const answer = getAnswer(item);

      if (!answer) {
        item.open = true;
        return;
      }

      window.clearTimeout(item._faqCloseTimer);
      item.open = true;
      answer.style.height = '0px';
      answer.style.opacity = '0';
      answer.style.transform = 'translateY(-2px)';

      window.requestAnimationFrame(function () {
        answer.style.height = answer.scrollHeight + 'px';
        answer.style.opacity = '1';
        answer.style.transform = 'translateY(0)';
      });
    }

    function closeItem(item) {
      const answer = getAnswer(item);

      if (!answer) {
        item.open = false;
        return;
      }

      answer.style.height = answer.scrollHeight + 'px';
      answer.style.opacity = '1';
      answer.style.transform = 'translateY(0)';

      window.requestAnimationFrame(function () {
        answer.style.height = '0px';
        answer.style.opacity = '0';
        answer.style.transform = 'translateY(-2px)';
      });

      window.clearTimeout(item._faqCloseTimer);
      item._faqCloseTimer = window.setTimeout(function () {
        if (answer.style.height === '0px') {
          item.open = false;
        }
      }, 480);
    }

    faqLists.forEach(function (list) {
      const items = Array.from(list.querySelectorAll('.lp-faq-item'));

      items.forEach(function (item) {
        const answer = getAnswer(item);

        if (answer) {
          answer.style.height = item.open ? answer.scrollHeight + 'px' : '0px';
          answer.style.opacity = item.open ? '1' : '0';
          answer.style.transform = item.open ? 'translateY(0)' : 'translateY(-2px)';
        }
      });

      list.addEventListener('click', function (event) {
        const question = event.target.closest('.lp-faq-question');

        if (!question || !list.contains(question)) {
          return;
        }

        event.preventDefault();

        const currentItem = question.closest('.lp-faq-item');
        const shouldOpen = currentItem && !currentItem.open;

        items.forEach(function (item) {
          if (item !== currentItem && item.open) {
            closeItem(item);
          }
        });

        if (!currentItem) {
          return;
        }

        if (shouldOpen) {
          openItem(currentItem);
        } else {
          closeItem(currentItem);
        }
      });
    });

    window.addEventListener('resize', function () {
      faqLists.forEach(function (list) {
        Array.from(list.querySelectorAll('.lp-faq-item[open] .lp-faq-answer')).forEach(function (answer) {
          answer.style.height = answer.scrollHeight + 'px';
        });
      });
    });
  }());
</script>

<?php wp_footer(); ?>

</body>
</html>
