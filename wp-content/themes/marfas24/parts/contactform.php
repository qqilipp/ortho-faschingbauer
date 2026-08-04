<div class="cform">
	<?php echo do_shortcode('[contact-form-7 id="e6d5a4a" title="Kontakt"]'); ?>
</div>
<script>
  document.addEventListener( 'wpcf7mailsent', function( event ) {
    document.querySelectorAll("form.wpcf7-form > :not(.wpcf7-response-output)").forEach(el => {
      el.style.display = 'none';
    });
  }, false );
</script>