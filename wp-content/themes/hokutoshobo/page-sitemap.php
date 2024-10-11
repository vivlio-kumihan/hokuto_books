<?php
/*
Template Name: Page Sitemap
*/
?>
<?php get_header(); ?>

<div id="Container">
  <div id="Main">
    <div class="conBox">
      <h3>サイトマップ</h3>
      <ul>
        <li><a href="/">ホーム</a></li>
      </ul>
      <div class="child">
        <?php query_posts('pagename=sitemap-main'); ?>
        <?php if(have_posts()): while(have_posts()): the_post(); ?>
        <?php the_content(); ?>
        <?php endwhile; endif; ?>
        <ul>
          <li><a href="http://localhost:8888/hokuto-bs/book/">書籍一覧</a></li>
          <li><a href="/news/">新着情報一覧</a></li>
        </ul>
      </div>
    </div>
  </div>
  <?php get_sidebar(page); ?>
</div>
<?php get_footer(); ?>
</body></html>