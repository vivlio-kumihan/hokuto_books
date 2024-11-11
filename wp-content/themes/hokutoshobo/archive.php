<?php /* Template Name: book　*/ ?>

<?php get_header(); ?>

<div id="page-top" class="main">
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
      <div class="book-post__pagination">
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
  </div>
</div>

<?php get_footer(); ?>