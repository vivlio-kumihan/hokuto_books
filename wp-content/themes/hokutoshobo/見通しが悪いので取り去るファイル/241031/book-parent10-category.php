<div id="Container">
  <div id="Main">
    <div class="conBox">
      <div class="wrap">
        <h3 class="blogTitle">
          <?php single_cat_title(); ?>
        </h3>
        <ul>
        <?php wp_list_categories('orderby=order&show_count=1&title_li=&depth=2&child_of=10'); ?>
        </ul>
      </div>
    </div>
  </div>
  <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
</body></html>