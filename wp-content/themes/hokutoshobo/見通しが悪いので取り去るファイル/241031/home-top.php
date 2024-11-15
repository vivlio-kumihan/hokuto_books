<div id="Container">
  <div id="Main">
    <div class="conBox">
      <ul>
        <li>
          <a href="http://localhost:8888/hokuto-bs/news/info/2631/"></a>
        </li>
        <li>
          <a href="http://localhost:8888/hokuto-bs/news/jihisyuppan/2350/"></a>
        </li>
        <li>
          <a href="http://localhost:8888/hokuto-bs/news/info/803/"></a>
        </li>
      </ul>
    </div>

    <div class="latest-books">
      <a href="http://localhost:8888/hokuto-bs/purchase/">
        <img src="http://localhost:8888/hokuto-bs/common/img/bt-purchase.png" alt="自費出版のご購入方法" />
      </a>
      <h3>最新の製作実績</h3>
      <p>北斗書房でおつくりいただいた自費出版作品を紹介します。</p>
      <div class="bookList">
        <?php switch_to_blog(2) ?>
        <?php
        $myposts = get_posts('numberposts=4');
        foreach ($myposts as $post) :
        ?>
          <dl class="boxLink">
            <dt>
              <?php
              $post_custome = get_post_custom();
              $image_attributes = wp_get_attachment_image_src($post_custome['image1'][0], array(100, 145)); ?>
              <?php if ($image_attributes[0] != '') : ?>
                <a href="<?php the_permalink(); ?>"><img src="<?php echo $image_attributes[0]; ?>" alt="<?php the_title(); ?>" /></a>
              <?php endif; ?>
            </dt>
            <dd>
              <h4><a href="<?php the_permalink(); ?>">
                  <?php the_title(); ?>
                </a></h4>
              <p class="excerpt"><?php echo mb_substr(strip_tags($post->post_content), 0, 30) . '...'; ?></p>
              <p class="author">
                <?php
                $categories = get_the_category();
                foreach ($categories as $category)
                  if (cat_is_ancestor_of(8, $category))
                    echo '' . $category->cat_name . ' ';
                ?>
              </p>
              <p class="cat">
                <?php
                $categories = get_the_category();
                foreach ($categories as $category)
                  if (cat_is_ancestor_of(10, $category))
                    echo '' . $category->cat_name . ' ';
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
      <p>
        <a href="http://localhost:8888/hokuto-bs/book/">書籍一覧はこちら</a>
      </p>
    </div>

    <ul class="bnr_area">
      <li><a href="http://localhost:8888/hokuto-bs/establishment/" target="_blank"><img src="http://localhost:8888/hokuto-bs/common/img/bt-kinenshi.png" alt="創業記念誌作成" width="220" height="80" /></a></li>
      <li><a href="http://prodigi.jp/~bungeidojin/" target="_blank"><img src="http://localhost:8888/hokuto-bs/common/img/bt-dojinshi.png" alt="文芸同人誌案内所" width="220" height="80" /></a></li>
      <li><a href="https://hokuto-p-co-jp.prm-ssl.jp/index.html" target="_blank"><img src="http://localhost:8888/hokuto-bs/common/img/bt-hokuto.png" alt="株式会社北斗プリント社のサイト" width="220" height="80" /></a></li>
      <li><a href="https://hokuto-p-co-jp.prm-ssl.jp/asks/index.php" target="_blank"><img src="http://localhost:8888/hokuto-bs/common/img/bt-asks.png" alt="株式会社北斗プリント社1F　あすくす" width="220" height="80" /></a></li>
      <li><a href="https://hokuto-p-co-jp.prm-ssl.jp/asks/nenga/index.php" target="_blank"><img src="http://localhost:8888/hokuto-bs/common/img/bt-nenga.png" alt="京都デザイン,京都年賀状,年賀状印刷,株式会社北斗プリント社1F　あすくす" width="220" height="80" /></a></li>
      <li><a href=" http://www.san-en.org/link/" target="_blank"><img src="http://localhost:8888/hokuto-bs/common/img/bnr/sanen.png" alt="起業家・経営者・若者の学びと未来の場。三縁の会" width="220" height="80" /></a></li>
    </ul>
  </div>
  <hr />
  <div id="Sub">
    <div id="SubTopics">
      <h3>北斗書房ブログ</h3>
      <ul>
        <li class="btHistory"><a href="http://localhost:8888/hokuto-bs/news/">新着一覧</a></li>
      </ul>
      <?php
      $network_posts = get_recentposts_from_network('perblog=5&num=5');

      if ($network_posts) :

        foreach ((array) $network_posts as $key => $post) {
          switch_to_blog($post->blog_id);
          setup_postdata($post);
      ?>
          <dl class="boxLink">
            <dt><?php echo date("Y/m/d", strtotime($post->post_date)); ?></dt>
            <dd class="icon<?php echo $post->blog_id; ?>"><a href="<?php the_permalink(); ?>" target="_parent">
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
</body>

</html>