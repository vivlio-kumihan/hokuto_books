<hr />
<div id="Sub">
  <div class="subMenu" id="WpSub">
    <div class="wrap">
      <!-- 検索 -->
  <div class="searchBox">
    <form method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
      <input type="text" class="focus" value="キーワードを入力" name="s" id="s" />
      <input name="searchsubmit" type="submit" id="searchsubmit" value="検索" />
    </form>
  </div>
  <!-- / 検索 --> 
      <ul>
        <?php dynamic_sidebar();?>
      </ul>
      <div class="feed"><a href="<?php bloginfo('rss2_url'); ?>" target="_blank">RSS</a></div>
    </div>
  </div>
</div>
