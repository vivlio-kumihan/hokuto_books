<div id="Container">
  <?php
if(function_exists('bcn_display'))
{
// Display the <span class="searchterm1">breadcrumb</span>
echo '<div id="TopicPath"><p>';
bcn_display();
echo '</p></div>';
}
?>
  <div id="Main">
    <div class="conBox">
      <div class="wrap">
        <h3 class="blogTitle">
          <?php single_cat_title(); ?>
        </h3>
        <!-- ページナビゲーション -->
        <?php if(function_exists('wp_page_numbers')) : wp_page_numbers(); endif; ?>
        <ul>
          <?php wp_list_categories('title_li=&child_of=10'); ?>
        </ul>
        <!-- ページナビゲーション -->
        <?php if(function_exists('wp_page_numbers')) : wp_page_numbers(); endif; ?>
      </div>
    </div>
  </div>
  <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
</body></html>