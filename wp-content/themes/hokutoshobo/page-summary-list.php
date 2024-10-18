<?php
/*
Template Name: Page Summary List
*/
?>
<?php get_header(); ?>

<div id="Container">
  <div id="Main">
    <div class="conBox">
      <div class="wrap">
        <h3>著者情報一覧</h3>
        <!-- ページナビゲーション -->
        <?php if(function_exists('wp_page_numbers')) : wp_page_numbers(); endif; ?>
        <ul>
          <?php
$post = $wp_query->post;
$id = $post->ID;
wp_list_pages('title_li=&child_of=' . $id);
?>
        </ul>
        <!-- ページナビゲーション -->
        <?php if(function_exists('wp_page_numbers')) : wp_page_numbers(); endif; ?>
      </div>
    </div>
  </div>
  <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>