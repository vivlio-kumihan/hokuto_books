<?php get_header(); ?>

<div class="main wp-search">
  <div class="main__contents-aside-wrapper">
    <div class="main__contents-wrapper">
      <div class="main__inner">
        <h3 class="main__header3">『<?php echo esc_html(get_search_query()); ?>』の検索結果</h3>
        <?php if (have_posts()) : ?>
          <?php while (have_posts()) : the_post(); ?>
            <?php get_template_part('/components/content', 'excerpt'); ?>
          <?php endwhile; ?>
        <?php else : ?>
          <div class="col-full">
            <div class="wrap-col">
              <p>検索キーワードに該当する記事がありませんでした。</p>
            </div>
          </div>
        <?php endif; ?>
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