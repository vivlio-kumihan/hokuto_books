<?php /* Template Name: author */ ?>

<?php get_header(); ?>

<div id="page-top" class="main">
  <div class="main__contents-wrapper">
    <div class="main__inner">
      <ul class="post-category">
        hello
        <?php
        $categories = get_the_category();
        if ($categories) {
          echo '<li><a href="' . esc_url(get_category_link($categories[0]->term_id)) . '">' . $categories[0]->name . '</a></li>';
        }
        ?>
      </ul>

    </div>
  </div>
</div>

<?php get_footer(); ?>