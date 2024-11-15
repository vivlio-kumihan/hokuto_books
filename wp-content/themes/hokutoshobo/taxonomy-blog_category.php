<?php get_header(); ?>

<main>
  <div class="container">
    <header>
      <h1><?php single_term_title(); ?></h1> <!-- 現在のカテゴリー名を表示 -->
      <p><?php echo term_description(); ?></p> <!-- カテゴリーの説明を表示 -->
    </header>

    <div class="post-list">
      <?php if (have_posts()) : ?>
        <ul>
          <?php while (have_posts()) : the_post(); ?>
            <li>
              <a href="<?php the_permalink(); ?>">
                <h2><?php the_title(); ?></h2>
              </a>
              <p><?php the_excerpt(); ?></p> <!-- 記事の概要を表示 -->
              <time datetime="<?php echo get_the_date('Y-m-d'); ?>">
                <?php echo get_the_date(); ?>
              </time>
            </li>
          <?php endwhile; ?>
        </ul>
      <?php else : ?>
        <p>このカテゴリーにはまだ記事がありません。</p>
      <?php endif; ?>
    </div>
  </div>
</main>

<?php get_footer(); ?>