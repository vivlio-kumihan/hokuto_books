<div id="Container">
  <div id="Main">
    <div class="conBox" id="TopBookList">
      <h3 class="blogTitle"><?php single_cat_title(); ?></h3>
      <!-- ページナビゲーション -->
      <?php if(function_exists('wp_page_numbers')) : wp_page_numbers(); endif; ?>
      <?php if(have_posts()): while(have_posts()): the_post(); ?>
      <dl class="boxLink">
        <dt>
          <?php
$post_custome = get_post_custom();
$image_attributes = wp_get_attachment_image_src($post_custome['image1'][0],array(100,145));?>
          <?php if($image_attributes[0]!='') : ?>
          <a href="<?php the_permalink(); ?>"><img src="<?php echo $image_attributes[0]; ?>" alt="<?php the_title(); ?>" /></a>
          <?php endif; ?>
        </dt>
        <dd>
          <h4><a href="<?php the_permalink(); ?>">
            <?php the_title(); ?>
            </a></h4>
          <p class="excerpt"><?php echo mb_substr(strip_tags($post-> post_content),0,30).'...'; ?></p>
          <p class="author">
            <?php
    $categories = get_the_category();
        foreach($categories as $category)
          if(cat_is_ancestor_of(8, $category))
             echo ''.$category->cat_name.' ';
?>
          </p>
          <p class="cat">
            <?php
    $categories = get_the_category();
        foreach($categories as $category)
          if(cat_is_ancestor_of(10, $category))
             echo ''.$category->cat_name.' ';
?>
          </p>
          <div class="price <?php echo post_custom('book_order'); ?>"><div class="btOrder"><img src="http://localhost:8888/hokuto-bs/common/img/bt-order-s.png" alt="販売中" /></div><div class="soldOut">絶版</div>
<div class="amazon"><img src="http://localhost:8888/hokuto-bs/common/img/bt-order-a.png" alt="アマゾンで販売中" width="69" height="20" /></div></div>
        </dd>
      </dl>
      <?php endwhile; endif; ?>
      <!-- ページナビゲーション -->
      <?php if(function_exists('wp_page_numbers')) : wp_page_numbers(); endif; ?>
    </div>
  </div>
  <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
</body></html>