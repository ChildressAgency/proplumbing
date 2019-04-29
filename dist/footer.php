<?php $page_id = get_the_ID(); ?>

<?php if(!is_front_page()): ?>
  <section id="get-started" class="d-flex flex-column justify-content-center">
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/eagle-2.png" class="eagle img-fluid" alt="" />
    <div class="get-started-container">
      <?php if(is_page('contact-us')): ?>
        <?php echo do_shortcode('[contact-form-7 id="19" title="Contact form 1"]'); ?>
      <?php else: ?>
        <?php echo apply_filters('the_content', wp_kses_post(get_option('options_get_started_section_content'))); ?>
      <?php endif; ?>
    </div>
  </section>
<?php endif; ?>

  <footer id="footer">
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/truck-cutout-sm.png" class="footer-truck img-fluid d-block mx-auto" alt="" />
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">
          <div class="hours">
            <h2>Operation Hours</h2>
            <?php echo apply_filters('the_content', wp_kses_post(get_option('options_operation_hours'))); ?>
          </div>
        </div>
        <div class="col-md-6">
          <div class="contact-info">
            <h2>Contact Information</h2>
            <p>Address: <?php echo esc_html(get_option('options_address')); ?></p>
            <p><?php echo esc_html(get_option('options_city_state_zip')); ?></p>
            <p>Tel: <?php echo esc_html(get_option('options_phone')); ?></p>
            <p>Email: <?php echo esc_html(get_option('options_email')); ?></p>
          </div>
        </div>
      </div>

      <div class="social">
        <?php if(get_option('options_facebook')): ?>
          <a href="<?php echo esc_url(get_option('options_facebook')); ?>" id="facebook" target="_blank"><i class="fab fa-facebook-square"></i></a>
        <?php endif; ?>
      </div>

      <div class="colophon">
        <?php echo apply_filters('the_content', wp_kses_post(get_option('options_footer_disclaimer'))); ?>
        <p>Website created by <a href="https://childressagency.com" target="_blank">The Childress Agency</a></p>
      </div>
    </div>
  </footer>
  <?php wp_footer(); ?>
</body>
</html>