<?php /* Template Name: sitemap */ ?>

<?php get_header(); ?>

<div class="main">
  <div class="main__contents-aside-wrapper">
    <div class="main__contents-wrapper">
      <div class="main__inner">
        <h3 class="main__header3">サイトマップ</h3>
        <ul class="main__list">
          <li><a href="<?php echo esc_url(home_url('/')); ?>">ホーム</a></li>
          <li><a href="<?php echo esc_url(home_url('/book/')); ?>">書籍一覧</a></li>
          <li><a href="<?php echo esc_url(home_url('/news/')); ?>">新着情報一覧</a></li>
        </ul>
      </div>
    </div>

    <aside class="main__other-info">
      <?php
      // データをテンプレートファイルに渡して表示
      load_template(get_template_directory() . '/components/other-info.php', false);
      ?>
    </aside>
  </div>
</div>

<?php get_footer(); ?>