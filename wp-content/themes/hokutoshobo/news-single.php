<div id="Container">
  <div id="Main">
    <div class="conBox">
      <div class="wrap">
        <?php if(have_posts()): while(have_posts()): the_post(); ?>
        <h3><?php the_title(); ?></h3>
        <?php the_content(); ?>
        <div class="postinfo"> <?php echo date("Y-m-d", strtotime($post->post_date)); ?>｜カテゴリー：
          <?php the_category(', '); ?>
        </div>
        <?php endwhile; endif; ?>
      </div>
    </div>
  </div>
  <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>