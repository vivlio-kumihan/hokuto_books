<div id="Container">
  <div id="Main">
    <div class="conBox">
      <div class="wrap">
        <h3 class="blogTitle">著者一覧（五十音順）</h3>
        <ul>
          <?php wp_list_categories('orderby=order&show_count=1&title_li=&depth=2&child_of=8'); ?>
        </ul>
      </div>
    </div>
  </div>
  <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
</body></html>