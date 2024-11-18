<?php get_header(); ?>

<!-- 新着情報のカテゴリー一覧 -->
<div class="main news category">
  <div class="main__contents-wrapper">
    <div class="main__inner">
      <h3 class="main__header3"><?php single_term_title(); ?></h3>

      <?php if (have_posts()) : ?>
        <ul class="news__list">
          <?php while (have_posts()) : the_post(); ?>
            <li class="news__headline">
              <a class="news__headline-inner-wrapped-anchor" href="<?php the_permalink(); ?>">
                <div class="image-wrapper">
                  <?php
                  $thumbnail = get_field('thumbnail');
                  if (isset($thumbnail['url']) && !empty($thumbnail['url'])) :
                  ?>
                    <img class="thumbnail-image" src="<?php echo esc_url($thumbnail['url']); ?>" alt="<?php echo esc_attr($thumbnail['alt'] ?? ''); ?>">
                  <?php else : ?>
                    <img class="thumbnail-image" src="<?php echo get_template_directory_uri(); ?>/images/news/news-defalut-thumbnail.jpg" alt="Default Thumbnail">
                  <?php endif; ?>
                </div>

                <div class="news__contents">
                  <ul class="news__category">
                    <?php
                    $terms = get_the_terms(get_the_ID(), 'blog_category');
                    if (!empty($terms) && !is_wp_error($terms)) {
                      foreach ($terms as $attr) {
                        echo '<li class="news__category-item">' . esc_html($attr->name) . '</li>';
                      }
                    }
                    ?>
                  </ul>
                  <div class="news__title"><?php the_title(); ?></div>
                  <div class="news__text"><?php the_excerpt(); ?></div>
                  <time class="news__date" datetime="<?php echo get_the_date('Y-m-d'); ?>">
                    <?php echo get_the_date(); ?>
                  </time>
                </div>
              </a>
            </li>
          <?php endwhile; ?>
        </ul>

        <!-- ページネーション -->
        <div class="pagination">
          <span class="page-numbers pagination__to-index inner-categor">
              <a href="<?php echo esc_url(home_url('/news')); ?>">
                記事一覧へ
              </a>
            </span>
            <?php
            echo paginate_links([
              'total' => $wp_query->max_num_pages, // 最大ページ数
              'current' => max(1, get_query_var('paged')), // 現在のページ
              'prev_text' => '前へ',  // 前ページリンクテキスト
              'next_text' => '次へ',  // 次ページリンクテキスト
            ]);
            ?>
        </div>

      <?php else : ?>
        <p>このカテゴリーにはまだ記事がありません。</p>
      <?php endif; ?>
    </div>
  </div>
</div>

</div>
</main>

<?php get_footer(); ?>