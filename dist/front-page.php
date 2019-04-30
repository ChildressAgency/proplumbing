<?php get_header(); ?>
<?php $page_id = get_the_ID(); ?>
  <section id="any-situation">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-5">
          <article>
            <?php echo apply_filters('the_content', wp_kses_post(get_post_meta($page_id, 'first_section_content', true))); ?>
          </article>
        </div>
        <div class="col-md-7">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/truck-cutout-lg.png" class="drive-in-right img-fluid d-block animation-trigger" alt="Company Truck" />
        </div>
      </div>
    </div>
  </section>

  <section id="leaky-pipe">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-7 col-lg-5">
          <article class="text-center">
            <?php echo apply_filters('the_content', wp_kses_post(get_post_meta($page_id, 'second_section_content', true))); ?>
          </article>
        </div>
        <div class="col-md-5 col-lg-7">
          <div class="pipe-valve d-none d-md-block">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/broken-pipe.png" class="pipe" alt="" />
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/valve-handle.png" class="valve" alt="" />
            <canvas id="spray"></canvas>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="testimonials-financing" class="d-flex">
    <div class="row no-gutters">
      <div class="col-md-6 testimonials d-flex justify-content-center flex-column align-items-center">
        <div id="testimonials-carousel" class="carousel slide" data-ride="carousel">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/quotes-half-circle.png" class="img-fluid d-block mx-auto mb-4" alt="" />
          <div class="carousel-inner">
            <?php
              $testimonials = get_post_meta($page_id, 'testimonials', true);

              for($t = 0; $t < $testimonials; $t++): ?>
                <div class="carousel-item<?php if($t == 0){ echo ' active'; } ?>">
                  <?php echo apply_filters('the_content', wp_kses_post(get_post_meta($page_id, 'testimonials_' . $t . '_testimonial', true))); ?>
                  <cite><?php echo wp_kses_post(get_post_meta($page_id, 'testimonials_' . $t . '_testimonial_author', true)); ?></cite>
                </div>
            <?php endfor; ?>
          </div>

          <ol class="carousel-indicators">
            <?php for($i = 0; $i < $testimonials; $i++): ?>
              <li data-target="#testimonials-carousel" data-slide-to="<?php echo $i; ?>"<?php if($i == 0){ echo ' class="active"'; } ?>></li>
            <?php endfor; ?>
          </ol>

          <?php
            $leave_review_link = get_post_meta($page_id, 'leave_a_review_link', true); ?>
            <a href="<?php echo esc_url($leave_review_link['url']); ?>" class="leave-review"><?php echo esc_html($leave_review_link['title']); ?></a>
        </div>
      </div>
      <div class="col-md-6 financing d-flex justify-content-center flex-column align-items-center">
        <div class="financing-content">
          <?php echo apply_filters('the_content', wp_kses_post(get_post_meta($page_id, 'financing_section_content', true))); ?>

          <?php $financing_link = get_post_meta($page_id, 'financing_section_link', true); ?>
          <a href="<?php echo esc_url($financing_link['url']); ?>" class="btn-rounded btn-gradient"><?php echo esc_html($financing_link['title']); ?></a>
        </div>
        <div class="dark-overlay"></div>
      </div>
    </div>
  </section>
<?php get_footer();