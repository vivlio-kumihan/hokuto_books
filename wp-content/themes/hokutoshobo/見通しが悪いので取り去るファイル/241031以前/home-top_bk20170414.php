<div id="Container">
  <div id="Main">
    <div class="conBox">
      <div class="top_menu">
      <h2><img src="http://localhost:8888/hokuto-bs/common/img/top-menu-h2.png" width="679" height="65" alt="北斗書房はこんな自費出版会社です"/></h2>
        <ul>
          <a href="http://localhost:8888/hokuto-bs/feature/"><li class="top_menu01">
            <h3><img src="http://localhost:8888/hokuto-bs/common/img/top-menu01-h3.png" width="220" height="33" alt="当社の特徴"/></h3>
            <p>本づくりのプロ集団として長年蓄積された信用とノウハウは、細かいところにまで気配りの行き届いた、質の高い自費出版物をご提供します。</p>
            <p class="more">詳しくはこちら</p>
          </li></a>
          <a href="/staff/"><li class="top_menu02">
            <h3><img src="http://localhost:8888/hokuto-bs/common/img/top-menu02-h3.png" width="220" height="33" alt="専属スタッフがお手伝い"/></h3>
            <p>原稿作成から装丁まで、懇切丁寧なご提案をさせて頂きますので、どうぞお気軽にご相談下さい。</p>
            <p class="more">詳しくはこちら</p>
          </li></a>
          <a href="http://localhost:8888/hokuto-bs/voice/"><li class="top_menu03">
            <h3><img src="http://localhost:8888/hokuto-bs/common/img/top-menu03-h3.png" width="220" height="33" alt="お客様の声"/></h3>
            <p>弊社で自費出版をされた方の体験記です。これから自費出版をお考えの方のご参考になりましたら幸いです。</p>
            <p class="more">詳しくはこちら</p>
          </li></a>
          <a href="http://localhost:8888/hokuto-bs/price/"><li class="top_menu04">
            <h3><img src="http://localhost:8888/hokuto-bs/common/img/top-menu04-h3.png" width="220" height="33" alt="多彩な料金プラン"/></h3>
            <p>お客様のニーズに合わせた、様々な料金プランをご用意しております。もちろん、オーダーメイドも可能です。</p>
            <p class="more">詳しくはこちら</p>
          </li></a>
          <a href="/knowledge/"><li class="top_menu05">
            <h3><img src="http://localhost:8888/hokuto-bs/common/img/top-menu05-h3.png" width="220" height="33" alt="自費出版豆知識"/></h3>
            <p>本のサイズや紙の種類、各部の名称など、自費出版で参考になる情報を掲載しております。</p>
            <p class="more">詳しくはこちら</p>
          </li></a>
          <a href="http://localhost:8888/hokuto-bs/faq/"><li class="top_menu06">
            <h3><img src="http://localhost:8888/hokuto-bs/common/img/top-menu06-h3.png" width="220" height="33" alt="Ｑ＆Ａ"/></h3>
            <p>本の仕様、進め方、費用についてなど、よくあるご質問をＱ＆Ａ形式でまとめております。</p>
            <p class="more">詳しくはこちら</p>
          </li></a>
        </ul>
      </div>
    </div>
    <div class="conBox" id="TopBookList">
      <h3>最新の製作実績</h3>
      <p>北斗書房でおつくりいただいた自費出版作品を紹介します。</p>
      <p><a href="http://localhost:8888/hokuto-bs/purchase/">自費出版のご購入方法はこちら</a></p>
      <div class="bookList">
        <?php switch_to_blog(2) ?>
        <?php
$myposts = get_posts('numberposts=4');
foreach($myposts as $post) :
?>
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
            <div class="price <?php echo post_custom('book_order'); ?>">
              <div class="btOrder"><img src="http://localhost:8888/hokuto-bs/common/img/bt-order-s.png" alt="販売中" /></div>
              <div class="soldOut">絶版</div>
            </div>
          </dd>
        </dl>
        <?php endforeach; ?>
        <?php restore_current_blog(); ?>
      </div>
      <p><a href="http://localhost:8888/hokuto-bs/book/">書籍一覧はこちら</a></p>
    </div>
    <div class="conBox">
      <ul class="bnr_area">
        <li><a href="http://localhost:8888/hokuto-bs/establishment/" target="_blank"><img src="http://localhost:8888/hokuto-bs/common/img/bt-kinenshi.png" alt="創業記念誌作成" width="220" height="80" /></a></li>
        <li><a href="http://prodigi.jp/~bungeidojin/" target="_blank"><img src="http://localhost:8888/hokuto-bs/common/img/bt-dojinshi.png" alt="文芸同人誌案内所" width="220" height="80" /></a></li>
        <li><a href="http://www.hokuto-p.co.jp" target="_blank"><img src="http://localhost:8888/hokuto-bs/common/img/bt-hokuto.png" alt="株式会社北斗プリント社のサイト" width="220" height="80" /></a></li>
        <li><a href="http://localhost:8888/hokuto-bs/asks/" target="_blank"><img src="http://localhost:8888/hokuto-bs/common/img/bt-asks.png" alt="株式会社北斗プリント社1F　あすくす" width="220" height="80" /></a></li>
        <li><a href=" http://www.san-en.org/link/" target="_blank"><img src="http://localhost:8888/hokuto-bs/common/img/bnr/sanen.png" alt="起業家・経営者・若者の学びと未来の場。三縁の会" width="220" height="80" /></a></li>
      </ul>
    </div>
  </div>
  <hr />
  <div id="Sub">
    <div id="SubTopics">
      <h3>北斗書房ブログ</h3>
      <ul>
        <li class="btHistory"><a href="/news/">新着一覧</a></li>
      </ul>
      <?php
$network_posts = get_recentposts_from_network( 'perblog=5&num=5' );
 
if( $network_posts ) :
 
foreach( (array) $network_posts as $key => $post ) {
    switch_to_blog( $post->blog_id );
    setup_postdata( $post );
    ?>
      <dl class="boxLink">
        <dt><?php echo date("Y/m/d", strtotime($post->post_date)); ?></dt>
        <dd class="icon<?php echo $post->blog_id; ?>"><a href="<?php the_permalink() ;?>" target="_parent">
          <?php the_title(); ?>
          </a></dd>
      </dl>
      <?php
    restore_current_blog();
}
wp_reset_query();
 
endif;
?>
    </div>
    <?php include_once("banner.php") ?>
  </div>
</div>
<?php get_footer(); ?>
</body></html>