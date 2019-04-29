<?php get_header(); ?>
<?php $page_id = get_the_ID(); ?>
<main id="main">
  <div class="container-fluid">
    <article class="main-content">
      <?php if(have_posts()): while(have_posts()): the_post(); ?>
        <?php the_content(); ?>
      <?php endwhile; endif; ?>

      <?php
        $services = new WP_Query(array(
          'post_type' => 'service',
          'posts_per_page' => -1,
          'post_status' => 'publish'
        ));

        if($services->have_posts()): ?>
          <ul class="services-list list-unstyled d-flex flex-wrap justify-content-center text-center">
            <?php while($services->have_posts()): $services->the_post(); ?>
              <li>
                <a href="<?php the_permalink(); ?>" class="service-link">
                  <?php
                    $featured_img_id = get_post_thumbnail_id();
                    $featured_img = wp_get_attachment_image_src($featured_img_id, 'thumbnail', true);
                  ?>
                  <img src="<?php echo esc_url($featured_img[0]); ?>" class="img-fluid d-block mx-auto" alt="<?php the_title(); ?>" />
                  <h3><?php the_title(); ?></h3>
                </a>
              </li>
            <?php endwhile; ?>
          </ul>
      <?php endif; wp_reset_postdata(); ?>
      </div>
    </article>
  </div>
</main>
<?php get_footer(); 