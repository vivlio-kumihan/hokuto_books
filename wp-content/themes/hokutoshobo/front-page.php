<?php get_header(); ?>
<div class="container">
  <div class="top-slider">
  </div>

  <div class="latest-books">
    <a href="<?php echo esc_url(home_url('/purchase')); ?>" style="float:right;"><img src="<?php echo get_template_directory_uri(); ?>/images/bt-purchase.png" alt="自費出版のご購入方法" /></a>
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
              <div class="btOrder"><img src="<?php echo get_template_directory_uri(); ?>/images/bt-order-s.png" alt="販売中" /></div>
              <div class="soldOut">絶版</div>
            </div>
          </dd>
        </dl>
      <?php endforeach; ?>
      <?php restore_current_blog(); ?>
    </div>
    <p><a href="<?php echo home_url('/book/'); ?>">書籍一覧はこちら</a></p>
  </div>

  <ul class="self-publish-info">
    <li class="self-publish-info__top-two">
      <div class="self-publish-info__visual-collection"></div>
      <div class="self-publish-info__compilation-collection"></div>
    </li>
    <li><a href="">自費出版相談会</a></li>
    <li><a href="">想いのカタチ</a></li>
  </ul>

  <ul class="banners">
    <li><a href="<?php echo esc_url(home_url('/establishment/')); ?>" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/bt-kinenshi.png" alt="創業記念誌作成" width="220" height="80" /></a></li>
    <li><a href="http://prodigi.jp/~bungeidojin/" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/bt-dojinshi.png" alt="文芸同人誌案内所" width="220" height="80" /></a></li>
    <li><a href="https://hokuto-p-co-jp.prm-ssl.jp/index.html" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/bt-hokuto.png" alt="株式会社北斗プリント社のサイト" width="220" height="80" /></a></li>
    <li><a href="https://hokuto-p-co-jp.prm-ssl.jp/asks/index.php" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/bt-asks.png" alt="株式会社北斗プリント社1F　あすくす" width="220" height="80" /></a></li>
    <li><a href="https://hokuto-p-co-jp.prm-ssl.jp/asks/nenga/index.php" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/bt-nenga.png" alt="京都デザイン,京都年賀状,年賀状印刷,株式会社北斗プリント社1F　あすくす" width="220" height="80" /></a></li>
    <li><a href=" http://www.san-en.org/link/" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/bnr/sanen.png" alt="起業家・経営者・若者の学びと未来の場。三縁の会" width="220" height="80" /></a></li>
  </ul>
</div>

<aside class="other-info">
  <?php
  $args = array(
    'post_type' => 'post',
    // 最新の『n』件の投稿を取得
    'posts_per_page' => 4,
  );
  $latest_posts = new WP_Query($args);

  // データをテンプレートファイルに渡して表示
  load_template(get_template_directory() . '/components/other-info.php', false, array('latest_posts' => $latest_posts));
  ?>
</aside>

<?php get_footer(); ?>