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

    <div class="post-content">
      <?php while (have_posts()) : the_post(); ?>
        <?php $terms = get_the_terms($post->ID, 'tax_news'); ?>
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
        <h2><?php the_title(); ?></h2>
        <p><?php the_content(); ?></p>
      <?php endwhile; ?>
    </div>

    <div class="page-direction">
      <a class="to-index" href="<?php echo home_url('/vansayplus') ?>">記事一覧へ</a>
      <ul>
        <?php if (get_previous_post() !== '') : ?>
          <!-- カスタム投稿はtrueを外すと効くということ。一刻も早くWPを卒業すべきだ。 -->
          <li class="previuos"><?php previous_post_link('%link', '前の記事へ'); ?></li>
        <?php endif; ?>
        <?php if (get_next_post() !== '') : ?>
          <!-- カスタム投稿はtrueを外すと効くということ。一刻も早くWPを卒業すべきだ。 -->
          <li><?php next_post_link('%link', '次の記事へ'); ?></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
  </div>
</main>

<?php get_footer(); ?>