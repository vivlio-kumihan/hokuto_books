<?php get_header(); ?>

<div id="page-top" class="main">
  <div class="main__contents-wrapper">
    <div class="main__inner">
      <?php
      // 現在表示されているカテゴリー情報を取得
      $current_category = get_queried_object();
      $is_author_category = $current_category->parent === 225; // 執筆者カテゴリの親ID
      $is_genre_category = $current_category->parent === 159; // ジャンルカテゴリの親ID
      $paged = get_query_var('paged') ? get_query_var('paged') : 1; // 現在のページ番号
      ?>

      <!-- タイトルの表示 -->
      <h3 class="main__header3">
        <?php if ($is_author_category): ?>
          <span class="header-pre">執筆者：</span> <?= esc_html($current_category->name); ?>
        <?php elseif ($is_genre_category): ?>
          <span class="header-pre">分類：</span> <?= esc_html($current_category->name); ?>
        <?php endif; ?>
      </h3>

      <?php
      // このジャンルに関連する投稿を取得
      $args = [
        'post_type' => 'post',
        'posts_per_page' => 10,
        'category__in' => [$current_category->term_id],
        'paged' => $paged,
      ];
      $query = new WP_Query($args);

      if ($query->have_posts()): ?>
        <ul class="category">
          <?php while ($query->have_posts()): $query->the_post(); ?>
            <?php get_template_part('template-parts/post-item'); ?>
          <?php endwhile; ?>
        </ul>

        <div class="pagination">
          <span class="page-numbers pagination__to-index inner-categor">
            <a href="<?= esc_url(home_url('/book')); ?>">
              書籍一覧へ
            </a>
          </span>
          <?= paginate_links([
            'total' => $query->max_num_pages,
            'current' => $paged,
            'prev_text' => '前へ',
            'next_text' => '次へ',
          ]); ?>
        </div>
      <?php else: ?>
        <p>このジャンルには投稿がありません。</p>
      <?php endif; ?>

      <?php wp_reset_postdata(); ?>
    </div>
  </div>
</div>

<?php get_footer(); ?>