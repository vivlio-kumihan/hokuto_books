<?php
/*
Template Name: Page Book
*/
?>
<?php get_header(); ?>

<div id="Container">
  <div id="Main">
    <?php if(have_posts()): while(have_posts()): the_post(); ?>
    <?php the_content(); ?>
    <?php endwhile; endif; ?>
  </div>
  <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>