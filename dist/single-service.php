<?php get_header(); ?>
<main id="main">
  <div class="container-fluid">
    <article class="main-content">
      <?php if(have_posts()): while(have_posts()): the_post(); ?>
        <?php the_content(); ?>
      <?php endwhile; endif; ?>
    </article>
  </div>
</main>

<?php 
  $service_gallery = get_post_meta(get_the_ID(), 'gallery_shortcode', true);
  if($service_gallery): ?>
    <section id="gallery">
      <div class="container-fluid">
        <?php echo do_shortcode(); ?>
      </div>
    </section>
  <?php endif; ?>

<?php get_footer();