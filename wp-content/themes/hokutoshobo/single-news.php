<?php get_header(); ?>

<div id="single" class="main single">
  <div class="main__contents-wrapper">
    <div class="main__inner news">
      <div class="post-content">
        <?php while (have_posts()) : the_post(); ?>
          <h3 class="main__header3"><?php the_title(); ?></h3>
          <?php the_content(); ?>
        <?php endwhile; ?>
      </div>

      <div class="page-direction">
        <ul class="book-pagination">
          <li>
            <a class="page-derection__to-index" href="<?php echo esc_url(home_url('/news')); ?>">
              記事一覧へ
            </a>
          </li>
          <?php if (get_previous_post() !== '') : ?>
            <li><?php previous_post_link('%link', '前の記事へ'); ?></li>
          <?php endif; ?>
          <?php if (get_next_post() !== '') : ?>
            <li><?php next_post_link('%link', '次の記事へ'); ?></li>
          <?php endif; ?>
        </ul>
      </div>
    </div>

    <div class="main__inner">
      <h3 class="main__header3 letter-space-dot25em">記事カテゴリー</h3>
      <ul class="archive__list">
        <li><a href="">すべて</a></li>
        <?php
        $taxonomy = 'blog_category'; // タクソノミーの名前を指定
        $terms = get_terms($taxonomy);
        if (!empty($terms) && !is_wp_error($terms)) { // エラーチェックを追加
          foreach ($terms as $term) {
            echo '<li><a href="' . get_term_link($term) . '">' . $term->name . '</a></li>';
          }
        }
        ?>
      </ul>
    </div>
  </div>
</div>

<?php get_footer(); ?>