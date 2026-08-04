<?php
/**
 * Single Post Template (Full Width)
 */

get_header("custom");
?>

<main id="main" class="service-page">

<?php if (have_posts()) : while (have_posts()) : the_post();

  $post_id = get_the_ID();
  $title   = get_the_title($post_id);

  $date_iso = get_the_date('c', $post_id);
  $date_hum = get_the_date(get_option('date_format'), $post_id);

  $author_id   = (int) get_post_field('post_author', $post_id);
  $author_name = get_the_author_meta('display_name', $author_id);

  $cats = get_the_category($post_id);
  $cat_name = (!empty($cats) && !is_wp_error($cats)) ? $cats[0]->name : 'Wissen';
  $cat_link = (!empty($cats) && !is_wp_error($cats))
      ? get_category_link($cats[0]->term_id)
      : home_url('/');

?>

<section class="svc-hero">
  <div class="svc-hero__container">

    <!-- Breadcrumb -->
    <nav class="svc-hero__breadcrumb" aria-label="Breadcrumb">
      <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
      <span class="svc-hero__sep">/</span>
      <a href="<?php echo esc_url($cat_link); ?>"><?php echo esc_html($cat_name); ?></a>
      <span class="svc-hero__sep">/</span>
      <span><?php echo esc_html($title); ?></span>
    </nav>

    <!-- Title -->
    <h1 class="svc-hero__title">
      <span class="svc-hero__title-main"><?php echo esc_html($title); ?></span>
    </h1>

    <!-- Meta -->
    <div class="svc-hero__intro" style="margin-bottom:18px;">
      <p style="margin:0; opacity:.75; font-size:13px;">
        <?php echo esc_html($cat_name); ?> ·
        <?php echo esc_html($author_name); ?> ·
        <time datetime="<?php echo esc_attr($date_iso); ?>"><?php echo esc_html($date_hum); ?></time>
      </p>
    </div>

    <!-- Featured image -->
    <?php if (has_post_thumbnail($post_id)) : ?>
      <div style="margin-bottom:24px;">
        <?php
          echo get_the_post_thumbnail($post_id, 'large', [
            'loading' => 'lazy',
            'style'   => 'width:100%; height:auto; display:block; border-radius:14px;'
          ]);
        ?>
      </div>
    <?php endif; ?>

    <!-- Content -->
    <div class="svc-sections">
      <div class="svc-content" style="font-size:15px; line-height:1.75;">
        <?php the_content(); ?>
      </div>
    </div>

  </div>
</section>

<?php endwhile; endif; ?>

</main>

<?php get_footer("custom"); ?>