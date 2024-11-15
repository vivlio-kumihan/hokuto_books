<?php get_header(); ?>
<main id="content_wrap">
  <div class="content_area">
    <?php $current_term_slug = get_query_var('term'); ?>
    <?php
    $paged = get_query_var('paged') ? get_query_var('paged') : 1;
    $args = array(
      'paged' => $paged,
      'post_type' => 'test', // 自分のカスタム投稿スラッグを入れる
      'posts_per_page' => 10,
      'tax_query' => array(
        array(
          'taxonomy' => 'testcat', // タクソノミースラッグ
          'field' => 'slug',
          'terms' => $current_term_slug,
        ),
      ),
    ); ?>
    <?php $my_query = new WP_Query($args); ?>
    <?php if ($my_query->have_posts()) : ?>
      <ul class="cp_list">
        <?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
          <li class="cp_item">
            <a href="<?php the_permalink(); ?>" class="cp_link">
              <p class="cp_ttl">
                <?php the_title(); ?>
              </p>
            </a>
          </li>
        <?php endwhile; ?>
      </ul>
    <?php else : ?>
      <p>taxonomy.php => 現在表示できる投稿はありません。</p>
    <?php endif; ?>
  </div><!-- .content -->
</main><!-- #main -->
<?php
get_footer();
