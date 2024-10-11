<?php
/*
Template Name: Page Author
*/
?>
<?php get_header(); ?>

<div id="Container">
  <div id="Main">
    <div class="conBox">
      <div class="wrap">
        <?php if(have_posts()): while(have_posts()): the_post(); ?>
        <h3>
          <?php the_title(); ?>
        </h3>
        <?php the_content(); ?>
        <?php endwhile; endif; ?>
      </div>
    </div>
  </div>
  <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
</body></html>