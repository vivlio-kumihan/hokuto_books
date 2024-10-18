<div id="Container">
  <div id="Main">
    <div class="conBox">
      <div class="wrap"> 
          <?php if(is_front_page()): ?>
          <h3 class="blogTitle">新着情報一覧</h3>
          <?php endif; ?> 
          <?php if(is_category()): ?>
          <h3 class="blogTitle"><?php single_cat_title(); ?></h3>
          <?php endif; ?>
          <?php if(is_month()): ?>
          <h3 class="blogTitle"><?php the_time('Y年n月'); ?></h3>
          <?php endif; ?>
          <?php if(is_day()): ?>
          <h3 class="blogTitle"><?php the_time('Y年n月j日'); ?></h3>
          <?php endif; ?>
          <?php if(is_search()): ?>
          <h3 class="blogTitle">“<?php the_search_query(); ?>”の検索結果</h3>
          <?php endif; ?>
        <!-- ページナビゲーション -->
        <?php if(function_exists('wp_page_numbers')) : wp_page_numbers(); endif; ?>
        <?php if(have_posts()): while(have_posts()): the_post(); ?>
        <h4><?php the_title(); ?></h4>
        <?php the_content(); ?>
        <div class="postinfo"><?php echo date("Y-m-d", strtotime($post->post_date)); ?>｜カテゴリー：<?php the_category(', '); ?>｜<a href="<?php the_permalink(); ?>">固定ページ</a></div>
        <?php endwhile; endif; ?>
        <!-- ページナビゲーション -->
        <?php if(function_exists('wp_page_numbers')) : wp_page_numbers(); endif; ?>
      </div>
    </div>
  </div>
  <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>