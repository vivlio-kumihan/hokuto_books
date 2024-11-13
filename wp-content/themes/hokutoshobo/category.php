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

      // このジャンルに関連する投稿を取得
      $args = array(
        'post_type' => 'post',
        'posts_per_page' => -1,
        'category__in' => array($current_category->term_id),
      );

      $query = new WP_Query($args);

      if ($query->have_posts()) :
        echo '<ul class="category">';
        while ($query->have_posts()) : $query->the_post();
          // 投稿リストの表示
          get_template_part('template-parts/post-item');
        endwhile;
        echo '</ul>';

        // ページネーション（ページ分け）を表示
        echo '<div class="book-pagination">';
          the_posts_pagination();
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