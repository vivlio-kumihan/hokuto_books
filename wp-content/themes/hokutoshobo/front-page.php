<?php get_header(); ?>

<div class="top-page">
  <header class="header for-top-page-main-visual">
    <div class="header__upper">
      <div class="logo-space">
        <div class="logo-space__wrapper">
          <a href="<?php echo esc_url(home_url('/')); ?>">
            <span>株式会社北斗プリント社内</span>
            <div class="logo-space__name">
              <span>北</span><span>斗</span><span>書</span><span>房</span>
            </div>
            <span>京都市左京区下鴨高木町38-2</span>
          </a>
        </div>
        <div class="logo-space__catch">
          <div>京都&nbsp;洛北の出版社</div>
          <span>60年の歴史と実績&nbsp;自費出版の北斗書房</span>
        </div>
      </div>
      <div class="main__main-copy">
        <h2>日本古典文学の街、学問の街　京都 洛北　北斗書房で個人出版しませんか</h2>
        <p>歴史・社会・教育／趣味・実用書／文芸書・写真集／絵本・自費出版</p>
        <p>60年の歴史「本づくり」の専門会社</p>
        <p>北斗書房はNPO法人自費出版ネットワーク会員です</p>
      </div>
    </div>
  </header>
</div>

<div class="main">
  <div class="main__contents-wrapper">
    <div class="top-page__slider">
      <div class="main__main-copy">
        <h2>日本古典文学の街、学問の街　京都 洛北　北斗書房で個人出版しませんか</h2>
        <p>歴史・社会・教育／趣味・実用書／文芸書・写真集／絵本・自費出版</p>
        <p>60年の歴史「本づくり」の専門会社</p>
        <p>北斗書房はNPO法人自費出版ネットワーク会員です</p>
      </div>
    </div>
  
    <!-- 最新の出版物インデックス -->
    <div class="latest-books">
      <div class="latest-books__wrapper">
        <a href="<?php echo esc_url(home_url('/purchase')); ?>">
          <img src="<?php echo get_template_directory_uri(); ?>/images/bt-purchase.png" alt="自費出版のご購入方法" />
        </a>
        <h3>最新の製作実績</h3>
        <p>北斗書房でおつくりいただいた自費出版作品を紹介します。</p>
          <!-- 削除した -->
        <p><a href="<?php echo home_url('/book/'); ?>">書籍一覧はこちら</a></p>
      </div>
    </div>
  
    <!-- 自費出版情報 -->
    <ul class="self-publish-info">
      <li class="self-publish-info__banner consultation">
        <a href="<?php echo esc_url(home_url('/news/info/2631/')); ?>">
          <div class="image-wrapper">
            <img src="<?php echo get_template_directory_uri(); ?>/images/baner_top-page02.jpg" alt="自費出版相談会のバナー">
          </div>
        </a>
      </li>
      <li class="self-publish-info__banner news-letter">
        <a href="<?php echo esc_url(home_url('/news/info/jihisyuppan/2350/')); ?>">
          <div class="image-wrapper">
            <img src="<?php echo get_template_directory_uri(); ?>/images/baner_top-page01.jpg" alt="想いのカタチのバナー">
          </div>
        </a>
      </li>
    </ul>
    <ul class="banners">
      <li class="banners__list">
        <a href="<?php echo esc_url(home_url('/establishment/')); ?>" target="_blank">
          <div class="image-wrapper">
            <img src="<?php echo get_template_directory_uri(); ?>/images/bt-kinenshi.png" alt="創業記念誌作成" width="220" height="80" />
          </div>
        </a>
      </li>
      <li class="banners__list">
        <a href="http://prodigi.jp/~bungeidojin/" target="_blank">
          <div class="image-wrapper">
            <img src="<?php echo get_template_directory_uri(); ?>/images/bt-dojinshi.png" alt="文芸同人誌案内所" width="220" height="80" />
          </div>
        </a>
      </li>
      <li class="banners__list">
        <a href="https://hokuto-p-co-jp.prm-ssl.jp/index.html" target="_blank">
          <div class="image-wrapper">
            <img src="<?php echo get_template_directory_uri(); ?>/images/bt-hokuto.png" alt="株式会社北斗プリント社のサイト" width="220" height="80" />
          </div>
        </a>
      </li>
      <li class="banners__list">
        <a href="https://hokuto-p-co-jp.prm-ssl.jp/asks/index.php" target="_blank">
          <div class="image-wrapper">
            <img src="<?php echo get_template_directory_uri(); ?>/images/bt-asks.png" alt="株式会社北斗プリント社1F　あすくす" width="220" height="80" />
          </div>
        </a>
      </li>
      <li class="banners__list">
        <a href="https://hokuto-p-co-jp.prm-ssl.jp/asks/nenga/index.php" target="_blank">
          <div class="image-wrapper">
            <img src="<?php echo get_template_directory_uri(); ?>/images/bt-nenga.png" alt="京都デザイン,京都年賀状,年賀状印刷,株式会社北斗プリント社1F　あすくす" width="220" height="80" />
          </div>
        </a>
      </li>
      <li class="banners__list">
        <a href=" http://www.san-en.org/link/" target="_blank">
          <div class="image-wrapper">
            <img src="<?php echo get_template_directory_uri(); ?>/images/bnr/sanen.png" alt="起業家・経営者・若者の学びと未来の場。三縁の会" width="220" height="80" />
          </div>
        </a>
      </li>
    </ul>
  </div>
  
  <aside class="other-info inside-front-page">
    <?php
    $args = array(
      'post_type' => 'post',
      // 最新の『n』件の投稿を取得
      'posts_per_page' => 5,
    );
    $latest_posts = new WP_Query($args);
  
    // データをテンプレートファイルに渡して表示
    load_template(get_template_directory() . '/components/other-info.php', false, array('latest_posts' => $latest_posts));
    ?>
  </aside>
</div>


<?php get_footer(); ?>