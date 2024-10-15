<div id="Container">
  <div id="WpMain">
    <div class="conBox" id="TopBookList">
      <h3>新着書籍一覧</h3>
      <ul>
        <li class="btHistory"><a href="http://localhost:8888/hokuto-bs/book/">一覧</a></li>
        <li class="btRss"><a href="http://localhost:8888/hokuto-bs/book/feed/">RSS</a></li>
      </ul>
      <?php switch_to_blog(2) ?>
      <?php
      $myposts = get_posts('numberposts=20');
      foreach ($myposts as $post) :
      ?>
        <dl class="boxLink">
          <dt><?php
              $post_custome = get_post_custom();
              $image_attributes = wp_get_attachment_image_src($post_custome['image1'][0], array(100, 145)); ?>
            <?php if ($image_attributes[0] != '') : ?><a href="<?php the_permalink(); ?>"><img src="<?php echo $image_attributes[0]; ?>" alt="<?php the_title(); ?>" /></a><?php endif; ?></dt>
          <dd>
            <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
            <p class="excerpt"><?php echo mb_substr(strip_tags($post->post_content), 0, 30) . '...'; ?></p>
            <p class="author"><?php echo post_custom('book_author'); ?></p>
            <p class="cat"><?php the_category(', '); ?></p>
          </dd>
        </dl>
      <?php endforeach; ?>
      <?php restore_current_blog(); ?>
    </div>
  </div>
  <hr />
  <div id="Sub">
    <div id="SubTopics">
      <h2>トピックス</h2>
      <ul>
        <li class="btHistory"><a href="/news/">新着一覧</a></li>
        <li class="btHistory"><a href="http://localhost:8888/hokuto-bs/book/">新刊一覧</a></li>
      </ul>
      <?php
      $network_posts = get_recentposts_from_network('perblog=5');

      if ($network_posts) :

        foreach ((array) $network_posts as $key => $post) {
          switch_to_blog($post->blog_id);
          setup_postdata($post);
      ?>
          <dl class="boxLink">
            <dt><?php echo date("Y/m/d", strtotime($post->post_date)); ?></dt>
            <dd class="icon<?php echo $post->blog_id; ?>"><a href="<?php the_permalink(); ?>" target="_parent"><?php the_title(); ?></a></dd>
          </dl>
      <?php
          restore_current_blog();
        }
        wp_reset_query();

      endif;
      ?>
    </div>
    <div class="bnrArea">
      <ul>
        <li><a href="http://localhost:8888/hokuto-bs/establishment/" target="_blank"><img src="http://localhost:8888/hokuto-bs/common/img/bt-kinenshi.png" alt="" /></a></li>
        <li><a href="http://prodigi.jp/~bungeidojin/" target="_blank"><img src="http://localhost:8888/hokuto-bs/common/img/bt-dojinshi.png" width="280" height="90" alt="" /></a></li>
        <li><a href="#"><img src="http://localhost:8888/hokuto-bs/common/img/bt-jihisyupan-news.png" width="280" height="90" alt="" /></a></li>
        <li><a href="http://www.hokuto-p.co.jp" target="_blank"><img src="http://localhost:8888/hokuto-bs/common/img/bt-hokuto.png" width="280" height="90" alt="" /></a></li>
      </ul>
    </div>
  </div>
</div>
<?php get_footer(); ?>
</body>

</html>