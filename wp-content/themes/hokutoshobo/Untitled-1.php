<!-- 最新の投稿のアイキャッチ画像を投稿とは関係のない別のページで取得する方法。 -->

<ul>
  <?php
    $args = array(
      'post_type' => 'news',
      'posts_per_page' => 1,
    );
    $my_query = new WP_Query($args);

    if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post();
  ?>

  <li class="post-item">
    <a href="<?php the_permalink(); ?>">
      <div class="frame">
        <?php the_post_thumbnail(); ?>
      </div>
    </a>
  </li>

  <?php endwhile; endif; ?>
</ul>



<!-- 
<ul>
        <?php
        $args = array(
          'post_type' => 'news',
          'posts_per_page' => 4,
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
          if (!empty($terms) && !is_wp_error($terms)) { // エラーチェックを追加
            foreach ($terms as $attr) {
              echo '<li>' . $attr->name . '</li>';
            }
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
?> -->