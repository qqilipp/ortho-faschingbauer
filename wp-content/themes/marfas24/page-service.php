<?php
/*
Template Name: Service Page
*/
get_header("custom");
?>

<main class="service-page">
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <?php get_template_part('parts/service/hero'); ?>
    <?php get_template_part('parts/service/sections'); ?>
    <?php get_template_part('parts/service/faq'); ?>
<?php get_template_part('parts/service/cards'); ?>

    <?php get_template_part('parts/service/cta'); ?>
  <?php endwhile; endif; ?>
</main>

<?php echo '<!-- SERVICE_BEFORE_FOOTER -->'; ?>
<?php // get_footer("custom"); ?>


<?php get_footer("custom"); ?>