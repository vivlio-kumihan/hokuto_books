<div id="Container">
  <div id="Main">
    <div class="conBox" id="BookDetail">
      <?php if(have_posts()): while(have_posts()): the_post(); ?>
      <h3>
        <?php the_title(); ?>
        <span class="subTitle <?php echo post_custom('sub_title_off'); ?>"><?php echo post_custom('book_sub_title'); ?></span></h3>
      <?php the_content(); ?>
      <?php endwhile; endif; ?>
      <?php the_post(); $post_custome = get_post_custom(); ?>
      <?php
$image_attributes['image1'] = wp_get_attachment_image_src($post_custome['image1'][0],'large');
$image_attributes['image2'] = wp_get_attachment_image_src($post_custome['image2'][0],'large');
$image_attributes['image3'] = wp_get_attachment_image_src($post_custome['image3'][0],'large');
$image_attributes['image4'] = wp_get_attachment_image_src($post_custome['image4'][0],'large');
$image_attributes['image5'] = wp_get_attachment_image_src($post_custome['image5'][0],'large');
?>
      <script language="JavaScript">
	 function changePic(myPicURL){
   document.images["MainImage"].src = myPicURL;
}

</script>
      <div id="BookImages">
        <div class="infoBox">
          <div class="bookInfo">
            <dl>
              <dt>著者</dt>
              <dd class="authorName <?php echo post_custom('author_summary'); ?>">
                <h4>
                  <?php
    $categories = get_the_category();
        foreach($categories as $category)
          if(cat_is_ancestor_of(8, $category))
             echo '<a href="'.get_category_link($category->cat_ID).'">'.$category->cat_name.'</a> '; ?>
                </h4>
                <div class="authorSummary"><a href="/book/author-summary/<?php
    $categories = get_the_category();
        foreach($categories as $category)
          if(cat_is_ancestor_of(8, $category))
             echo ''.$category->category_nicename.' ';
?>
">著者略歴</a></div>
              </dd>
            </dl>
            <dl>
              <dt>価格</dt>
              <dd class="price <?php echo post_custom('book_order'); ?>"><?php echo post_custom('book_price'); ?><?php echo post_custom('price_tax'); ?> <div class="btOrder"><a href="/book/order/?title=<?php the_title(); ?>&price=<?php echo post_custom('book_price'); ?>"><img src="http://localhost:8888/hokuto-bs/common/img/bt-order.png" alt="ご購入" /></a></div>
                <div class="soldOut">絶版</div>
                <div class="amazon"><a href="<?php echo post_custom('book_amazon_url'); ?>" target="_blank"><img src="http://localhost:8888/hokuto-bs/common/img/btn/btn-amazon.png" alt="Amazon 詳細ページへ" width="164" height="26" /></a></div>
                <div class="undecided">在庫切れ重版未定</div>
              </dd>
            </dl>
            <dl>
              <dt>ISBNコード</dt>
              <dd><?php echo post_custom('book_isbn'); ?></dd>
            </dl>
            <dl>
              <dt>サイズ</dt>
              <dd><?php echo post_custom('book_size'); ?></dd>
            </dl>
            <dl>
              <dt>頁数</dt>
              <dd><?php echo post_custom('book_page'); ?>頁</dd>
            </dl>
            <dl>
              <dt>カテゴリー</dt>
              <dd>
                <?php
    $categories = get_the_category();
        foreach($categories as $category)
          if(cat_is_ancestor_of(10, $category))
            echo '<a href="'.get_category_link($category->cat_ID).'">'.$category->cat_name.'</a> '; ?>
              </dd>
            </dl>
            <p class="howtoOrder"><a class="arrow" href="http://localhost:8888/hokuto-bs/purchase/">自費出版ご購入お申し込み方法</a></p>
          </div>
        </div>
        <ul>
          <li class="bookImgMain">
            <?php if($post_custome['image1'][0]!='') : ?>
            <img src="<?php echo $image_attributes['image1'][0]; ?>" id="MainImage" />
            <?php endif; ?>
          </li>
          <li class="bookImgSub"><?php echo $post_custome['image1'][0]=='' ? '' : wp_get_attachment_image($post_custome['image1'][0],'large',1,array('onclick'=>'changePic("'.$image_attributes['image1'][0].'")')); ?></li>
          <li class="bookImgSub"><?php echo $post_custome['image2'][0]=='' ? '' : wp_get_attachment_image($post_custome['image2'][0],'large',1,array('onclick'=>'changePic("'.$image_attributes['image2'][0].'")')); ?></li>
          <li class="bookImgSub"><?php echo $post_custome['image3'][0]=='' ? '' : wp_get_attachment_image($post_custome['image3'][0],'large',1,array('onclick'=>'changePic("'.$image_attributes['image3'][0].'")')); ?></li>
          <li class="bookImgSub"><?php echo $post_custome['image4'][0]=='' ? '' : wp_get_attachment_image($post_custome['image4'][0],'large',1,array('onclick'=>'changePic("'.$image_attributes['image4'][0].'")')); ?></li>
          <li class="bookImgSub"><?php echo $post_custome['image5'][0]=='' ? '' : wp_get_attachment_image($post_custome['image5'][0],'large',1,array('onclick'=>'changePic("'.$image_attributes['image5'][0].'")')); ?></li>
        </ul>
      </div>
      <div id="tabs" class="clr">
        <ul class="tabsMenu">
          <li><a href="#page1">主な内容</a></li>
          <?php if($post_custome['page2_title'][0]!='') : ?>
          <li><a href="#page2"><?php echo $post_custome['page2_title'][0]; ?></a></li>
          <?php endif; ?>
          <?php if($post_custome['page3_title'][0]!='') : ?>
          <li><a href="#page3"><?php echo $post_custome['page3_title'][0]; ?></a></li>
          <?php endif; ?>
          <?php if($post_custome['page4_title'][0]!='') : ?>
          <li><a href="#page4"><?php echo $post_custome['page4_title'][0]; ?></a></li>
          <?php endif; ?>
          <?php if($post_custome['page5_title'][0]!='') : ?>
          <li><a href="#page5"><?php echo $post_custome['page5_title'][0]; ?></a></li>
          <?php endif; ?>
          <li></li>
        </ul>
        <div id="page1"> <?php echo $post_custome['page1_body'][0]; ?> </div>
        <?php if($post_custome['page2_title'][0]!='') : ?>
        <div id="page2"> <?php echo $post_custome['page2_body'][0]; ?> </div>
        <?php endif; ?>
        <?php if($post_custome['page3_title'][0]!='') : ?>
        <div id="page3"> <?php echo $post_custome['page3_body'][0]; ?> </div>
        <?php endif; ?>
        <?php if($post_custome['page4_title'][0]!='') : ?>
        <div id="page4"> <?php echo $post_custome['page4_body'][0]; ?> </div>
        <?php endif; ?>
        <?php if($post_custome['page5_title'][0]!='') : ?>
        <div id="page5"> <?php echo $post_custome['page5_body'][0]; ?> </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
</body></html>