<?php get_header(); ?>

<main>
  <div class="container">
    <div class="category-link-menu">
      <header>記事カテゴリー</header>
      <ul class="sub-menu">
        <li><a href="/vansayplus/">すべて</a></li>
        <?php
        $taxonomy = 'blog_category'; // タクソノミーの名前を指定
        $terms = get_terms($taxonomy);
        if (!empty($terms)) {
          foreach ($terms as $term) {
            echo '<li><a href="' . get_term_link($term) . '">' . $term->name . '</a></li>';
          }
        }
        ?>
      </ul>
    </div>
    <ul class="post-archive">
      <?php
      $recent_page = get_query_var('paged') ? get_query_var('paged') : 1;

      $args = array(
        'post_type' => 'news',
        'posts_per_page' => -1,
      );

      $my_query = new WP_Query($args);

      if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post();
      ?>
          <li class="post-item">
            <a href="<?php the_permalink(); ?>">
              <div class="frame">
                <?php the_post_thumbnail(); ?>
              </div>
              <div class="header-sub">
                <ul class="post-category">
                  <?php
                  $terms = get_the_terms(get_the_ID(), 'blog_category');
                  foreach ($terms as $attr) {
                    echo '<li>' . $attr->name . '</li>';
                  }
                  ?>
                </ul>
                <time datetime="<?php echo get_the_date("Y-m-d") ?>"><?php echo get_the_date("Y年m月d日") ?></time>
              </div>
              <div class="post-title"><?php the_title(); ?></div>
              <!-- p要素で記事抜粋が必要なときはこの関数 => the_excerpt(); -->
              <!-- CPT UIのメニューから『アーカイブあり』をtrueにしておくのを忘れずに。 -->
            </a>
          </li>
      <?php endwhile;
      endif; ?>
    </ul>

    <div id="breadcrumbs" class="breadcrumbs">
      <?php
      $args = array(
        'type' => 'list',
        'current' => $recent_page,
        'total' => $my_query->max_num_pages,
        'prev_text' => '前のページ',
        'next_text' => '次のページ',
      );
      echo paginate_links($args);
      ?>
    </div>
  </div>
</main>

<?php get_footer(); ?>