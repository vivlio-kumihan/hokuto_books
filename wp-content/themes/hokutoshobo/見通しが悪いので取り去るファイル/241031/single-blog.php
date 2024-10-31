<?php get_header(); ?>
<main id="content_wrap">
  <div class="content_area">
    <?php
    if (have_posts()) :
      while (have_posts()) : the_post();
    ?>
        <h2 class="cp_ttl"><?php the_title(); ?></h2>
        <div class="cp_content">
          <?php the_content(); ?>
        </div>
    <?php endwhile;
    endif;
    ?>
  </div><!-- .content -->
</main><!-- #main -->
<?php
get_footer();