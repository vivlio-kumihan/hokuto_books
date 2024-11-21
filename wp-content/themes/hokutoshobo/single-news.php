<?php get_header(); ?>

<div id="single" class="main single">
  <div class="main__contents-aside-wrapper">
    <div class="main__contents-wrapper">
      <div class="main__inner news">
        <div class="post-content">
          <?php while (have_posts()) : the_post(); ?>
            <h3 class="main__header3"><?php the_title(); ?></h3>
            <?php the_content(); ?>
          <?php endwhile; ?>
        </div>

        <div class="page-direction">
          <ul class="pagination">
            <li class="pagination__to-index page-numbers">
              <a href="<?php echo esc_url(home_url('/news')); ?>">
                記事一覧へ
              </a>
            </li>
            <?php if (get_previous_post() !== '') : ?>
              <li class="pagination__prev-btn"><?php previous_post_link('%link', '前へ'); ?></li>
            <?php endif; ?>
            <?php if (get_next_post() !== '') : ?>
              <li class="pagination__next-btn"><?php next_post_link('%link', '次へ'); ?></li>
            <?php endif; ?>
          </ul>
        </div>
      </div>

      <div class="main__inner news">
        <h3 class="main__header3">記事カテゴリー</h3>
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

    <aside class="main__other-info">
      <?php
      // データをテンプレートファイルに渡して表示
      load_template(get_template_directory() . '/components/other-info.php', false);
      ?>
    </aside>
  </div>
</div>

<?php get_footer(); ?>