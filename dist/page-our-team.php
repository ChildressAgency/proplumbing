<?php get_header(); ?>
<main id="main">
  <div class="container-fluid">
    <article class="main-content">
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
          <?php the_content(); ?>
        <?php endwhile;
    endif; ?>

      <?php
      $page_id = get_the_ID();
      $team = get_post_meta($page_id, 'our_team', true);
      if ($team) :
        for ($i = 0; $i < $team; $i++) : ?>
          <div class="row team-member">
            <div class="col-sm-4">
              <?php
                $team_img_id = get_post_meta($page_id, 'our_team_' . $i . '_team_member_image', true);
                $team_img = wp_get_attachment_image_src($team_img_id, 'full');
                $team_name = get_post_meta($page_id, 'our_team_' . $i . '_team_member_name', true);
                $team_title = get_post_meta($page_id, 'our_team_' . $i . '_team_member_title', true);
              ?>
              <img src="<?php echo esc_url($team_img[0]); ?>" class="img-fluid d-block mx-auto" alt="<?php echo esc_attr($team_name); ?>" />
            </div>
            <div class="col-sm-8">
              <h2><?php echo esc_html($team_name); ?><small><?php echo esc_html($team_title); ?></small></h2>
              <?php echo wp_kses_post(get_post_meta($page_id, 'our_team_' . $i . '_team_member_bio', true)); ?>
            </div>
          </div>
      <?php endfor; endif; ?>
        </article>
      </div>
    </main>
    <?php get_footer();
