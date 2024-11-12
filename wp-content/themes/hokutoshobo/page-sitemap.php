<?php /* Template Name: sitemap */ ?>

<?php get_header(); ?>

<div id="Container">
  <div id="Main">
    <div class="conBox">
      <h3>サイトマップ</h3>
      <ul>
        <li><a href="<?php echo esc_url(home_url('/')); ?>">ホーム</a></li>
        <ul>
          <li><a href="<?php echo esc_url(home_url('/book/')); ?>">書籍一覧</a></li>
          <li><a href="<?php echo esc_url(home_url('/news/')); ?>">新着情報一覧</a></li>
        </ul>
      </ul>
    </div>
  </div>
</div>

<?php get_footer(); ?>