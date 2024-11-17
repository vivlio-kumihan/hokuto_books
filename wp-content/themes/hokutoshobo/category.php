<?php get_header(); ?>

<div class="main">
  <div class="main__contents-wrapper">
    <div class="main__inner">
      <?php
      // 現在表示されているカテゴリー情報を取得
      $current_category = get_queried_object();
      $is_author_category = $current_category->parent === 225; // 執筆者カテゴリの親ID
      $is_genre_category = $current_category->parent === 159; // ジャンルカテゴリの親ID

      // タイトルの表示
      if ($is_author_category) {
        echo '<h3 class="main__header3"><span class="header-pre">執筆者：</span> ' . esc_html($current_category->name) . '</h3>';
      } elseif ($is_genre_category) {
        echo '<h3 class="main__header3"><span class="header-pre">分類：</span> ' . esc_html($current_category->name) . '</h3>';
      }

      // 現在のページ番号を取得
      $paged = get_query_var('paged') ? get_query_var('paged') : 1;

      // このジャンルに関連する投稿を取得
      $args = array(
        'post_type' => 'post',
        'posts_per_page' => 10,
        'category__in' => array($current_category->term_id),
        'paged' => $paged, // ページ番号を追加
      );

      $query = new WP_Query($args);

      if ($query->have_posts()) :
        echo '<ul class="category">';
        while ($query->have_posts()) : $query->the_post();
          // 投稿リストの表示
          get_template_part('template-parts/post-item');
        endwhile;
        echo '</ul>';

        echo '<div class="pagination">';
        // カスタムクエリのページネーションを正しく表示
        echo paginate_links(array(
          'total' => $query->max_num_pages,
          'current' => $paged,
          'prev_text' => '前へ',
          'next_text' => '次へ',
        ));
        echo '</div>';
      else :
        echo '<p>このジャンルには投稿がありません。</p>';
      endif;

      wp_reset_postdata();
      ?>
    </div>
    
  </div>
</div>

<?php get_footer(); ?>