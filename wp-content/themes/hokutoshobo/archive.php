<?php /* Template Name: book　*/ ?>

<?php get_header(); ?>

<div id="page-top" class="main archive">
  <div class="main__contents-wrapper">
    <div class="main__inner">
      <h3 class="main__header3 letter-space-dot25em">書籍一覧</h3>
      <ul class="book-post">
        <?php
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $args = array(
          'posts_per_page' => 14,
          'paged' => $paged
        );
        $all_posts = new WP_Query($args);
        ?>
        <?php if ($all_posts->have_posts()) : ?>
          <?php while ($all_posts->have_posts()) : $all_posts->the_post(); ?>
            <?php if (has_post_thumbnail()) : ?>
              <li class="book-post__list">
                <a href="<?php the_permalink(); ?>">
                  <div class="book-post__image-wrapper">
                    <?php the_post_thumbnail('thumbnail'); ?>
                  </div>
                <?php endif; ?>
                <div class="book-post__title">
                  <?php the_title(); ?>
                </div>
                </a>
              </li>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
          <?php else : ?>
            <p>投稿が見つかりませんでした。</p>
          <?php endif; ?>
      </ul>

      <!-- ページネーション -->
      <div class="pagination">
        <?php
        echo paginate_links(array(
          'total' => $all_posts->max_num_pages,
          'current' => $paged,
          'prev_text' => '前へ',
          'next_text' => '次へ',
        ));
        ?>
      </div>
    </div>

    <div class="main__inner">
      <h3 class="main__header3 letter-space-dot25em">分類</h3>
      <?php
      // 親カテゴリーID 159 の子カテゴリーを取得
      $categories = get_categories(array(
        'parent' => 159, // 親カテゴリーID 159 を指定
        'hide_empty' => false, // 投稿がないカテゴリーも表示
      ));

      echo '<ul class="archive__list">';
      foreach ($categories as $category) {
        // カテゴリーリンクを取得
        $category_link = get_category_link($category->term_id);

        // 各カテゴリーの投稿数を取得して表示
        echo '<li><a href="' . esc_url($category_link) . '">' . esc_html($category->name) . '</a>（' . esc_html($category->count) . '）</li>';
      }
      echo '</ul>';
      ?>
    </div>

    <div class="main__inner">
      <h3 class="main__header3 letter-space-dot25em">執筆者</h3>
      <?php
      $authors = [];
      $args = array(
        'post_type'      => 'post', // 投稿タイプ
        'posts_per_page' => -1,     // すべての投稿を取得
        'meta_key'       => 'book_ruby', // 'book_ruby' でソート
        'orderby'        => 'meta_value',
        'order'          => 'ASC'
      );

      $query = new WP_Query($args);

      if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
          // カスタムフィールドの取得
          $author_name = get_post_meta(get_the_ID(), 'book_author', true);
          $author_ruby = get_post_meta(get_the_ID(), 'book_ruby', true);

          // 執筆者名が配列に既に含まれているか確認
          $found = false;
          foreach ($authors as &$author) {
            if ($author['name'] === $author_name) {
              $author['count']++;
              $found = true;
              break;
            }
          }

          // 新しい執筆者なら配列に追加
          if (!$found) {
            $authors[] = [
              'name' => $author_name,
              'ruby' => $author_ruby,
              'count' => 1,
            ];
          }
        endwhile;
      endif;

      // 'book_ruby' でソート
      usort($authors, function ($a, $b) {
        return strcmp($a['ruby'], $b['ruby']);
      });

      wp_reset_postdata();

      // リストに表示
      echo '<ul class="archive__list author">';
      foreach ($authors as $author) {
        // ID 225 の子カテゴリーを取得
        $categories = get_categories(array(
          'parent' => 225, // 親カテゴリーID 225 を指定
          'hide_empty' => false, // 投稿がないカテゴリーも表示
        ));

        // 一致するカテゴリーを探してリンクを作成
        foreach ($categories as $category) {
          if ($category->name === $author['name']) {
            $category_slug = $category->slug;
            $category_link = get_category_link($category->term_id); // カテゴリーリンクを取得
            echo '<li><a href="' . esc_url($category_link) . '">' . esc_html($author['name']) . '</a>（' . esc_html($author['count']) . '）</li>';
            break;
          }
        }
      }
      echo '</ul>';

      // クエリのリセット
      wp_reset_postdata();
      ?>
    </div>
  </div>
</div>

<?php get_footer(); ?>