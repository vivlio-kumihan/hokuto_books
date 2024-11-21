<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <header class="entry-header">
    <h5 class="main__header5">
      <a href="<?php the_permalink(); ?>" rel="bookmark">
        <?php the_title(); ?>
      </a>
    </h5>
  </header>

  <div class="entry-summary">
    <?php the_excerpt(); ?>
  </div>
</article>