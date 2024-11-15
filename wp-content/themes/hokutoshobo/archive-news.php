<?php get_header(); ?>

<div id="page-top" class="main archive">
  <div class="main__contents-wrapper">
    <!-- 新着情報一覧 -->
    <div class="main__inner news">
      <h3 class="main__header3 letter-space-dot25em">新着情報一覧</h3>
      <ul class="news__list">
        <?php
        $recent_page = get_query_var('paged') ? get_query_var('paged') : 1;

        $args = array(
          'post_type' => 'news',
          'posts_per_page' => 30,
        );

        $my_query = new WP_Query($args);

        if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post();
        ?>
            <li class="news__headline">
              <a href="<?php the_permalink(); ?>">

                <!-- サムネイル画像 -->
                <div class="image-wrapper">
                  <?php
                  // ACFで設定したサムネイル画像を取得
                  $thumbnail = get_field('thumbnail'); // ACFのフィールド名

                  // $thumbnailのurlキーが存在し、かつ値が空でない場合
                  if (isset($thumbnail['url']) && !empty($thumbnail['url'])) :
                  ?>
                    <img class="thumbnail-image" src="<?php echo esc_url($thumbnail['url']); ?>" alt="<?php echo esc_attr($thumbnail['alt'] ?? ''); ?>">
                  <?php else : ?>
                    <img class="thumbnail-image" src="<?php echo get_template_directory_uri(); ?>/images/news/news-defalut-thumbnail.jpg" alt="Default Thumbnail">
                  <?php endif; ?>
                </div>

                <!-- カテゴリー -->
                <ul class="news__category">
                  <?php
                  $terms = get_the_terms(get_the_ID(), 'blog_category');
                  if (!empty($terms) && !is_wp_error($terms)) { // エラーチェックを追加
                    foreach ($terms as $attr) {
                      echo '<li>' . $attr->name . '</li>';
                    }
                  }
                  ?>
                </ul>

                <!-- タイトル -->
                <div class="news__title"><?php the_title(); ?></div>
              </a>
            </li>
        <?php endwhile;
        endif; ?>
      </ul>

      <div class="book-pagination">
        <?php
        $args = array(
          'current' => $recent_page,
          'total' => $my_query->max_num_pages,
          'prev_text' => '前のページ',
          'next_text' => '次のページ',
        );
        echo paginate_links($args);
        ?>
      </div>
    </div>

    <!-- カテゴリー -->
    <div class="main__inner news">
      <h3 class="main__header3 letter-space-dot25em">カテゴリー</h3>
      <ul class="archive__list">
        <?php
        $taxonomy = 'blog_category'; // タクソノミーの名前を指定
        $terms = get_terms($taxonomy);
        if (!empty($terms) && !is_wp_error($terms)) { // エラーチェックを追加
          foreach ($terms as $term) {
            echo '<li><a href="' . get_term_link($term) . '">';
            echo $term->name . '（' . $term->count . '）'; // 名前と投稿数を表示
            echo '</a></li>';
          }
        }
        ?>
      </ul>
    </div>
  </div>
</div>

<?php get_footer(); ?>