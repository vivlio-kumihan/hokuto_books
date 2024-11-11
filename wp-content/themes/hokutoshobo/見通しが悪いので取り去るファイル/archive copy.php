<?php get_header(); ?>

<main>
  <div class="container">
    <div class="category-link-menu">
      <header data-cat-id="all">記事カテゴリー</header>
      <ul class="sub-menu">
        <li><a href="/news/">すべて</a></li>
        <?php
        $categories = get_categories();
        if ($categories) {
          foreach ($categories as $category) {
            echo '<li><a href="/category/' . $category->slug . '">' . $category->name . '</a></li>';
          }
        }
        ?>
      </ul>
    </div>

    <ul class="post-archive">
      <?php
      $recent_page = get_query_var('paged') ? get_query_var('paged') : 1;

      $args = array(
        'posts_per_page' => 10,
        'paged' => $recent_page,
        'category_name' => get_queried_object()->slug,
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
                  $category = get_the_category();
                  foreach ($category as $attr) {
                    echo '<li>' . $attr->name . '</li>';
                  }
                  ?>
                </ul>
                <time datetime="<?php echo get_the_date("Y-m-d") ?>"><?php echo get_the_date("Y年m月d日") ?></time>
              </div>
              <div class="post-title"><?php the_title(); ?></div>
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