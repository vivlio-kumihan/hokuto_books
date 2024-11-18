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
    </div>
    <div class="header__lower">
      <div class="main__main-copy for-sm">
        <h2>日本古典文学の街、学問の街　京都 洛北　北斗書房で個人出版しませんか</h2>
        <p>歴史・社会・教育／趣味・実用書／文芸書・写真集／絵本・自費出版</p>
        <p>60年の歴史「本づくり」の専門会社</p>
        <p>北斗書房はNPO法人自費出版ネットワーク会員です</p>
      </div>
    </div>
  </header>
  <div class="top-page__slider">
    <div class="main__main-copy">
      <h2>日本古典文学の街、学問の街　京都 洛北　北斗書房で個人出版しませんか</h2>
      <p>歴史・社会・教育／趣味・実用書／文芸書・写真集／絵本・自費出版</p>
      <p>60年の歴史「本づくり」の専門会社</p>
      <p>北斗書房はNPO法人自費出版ネットワーク会員です</p>
    </div>
    <div class="top-page__slide">
      <!-- Slider main container -->
      <div class="swiper">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
          <!-- Slides -->
          <div class="swiper-slide">
            <div class="image-wrapper">
              <img src="<?php echo get_template_directory_uri(); ?>/images/slider/slider_advisor.png" />
            </div>
          </div>
          <div class="swiper-slide">
            <div class="image-wrapper">
              <img src="<?php echo get_template_directory_uri(); ?>/images/slider/slider_hokutoshobothink.png" />
            </div>
          </div>
          <div class="swiper-slide">
            <div class="image-wrapper">
              <img src="<?php echo get_template_directory_uri(); ?>/images/slider/slider_spcompany.png" />
            </div>
          </div>
          ...
        </div>
        <!-- If we need pagination -->
        <div class="swiper-pagination"></div>

        <!-- If we need navigation buttons -->
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>

        <!-- If we need scrollbar -->
        <div class="swiper-scrollbar"></div>
      </div>
    </div>
  </div>
</div>

<div class="main front-page">
  <div class="main__contents-aside-wrapper">
    <div class="main__contents-wrapper">
      <!-- 最新の出版物インデックス -->
      <div class="main__inner latest-books">
        <div class="latest-books__wrapper">
          <h3 class="main__header3">
            最新の製作実績
          </h3>
          <div class="main__catch">当書房でおつくりいただいた自費出版作品をご紹介</div>
          <!-- 削除した -->
          <ul class="book-post">
            <?php
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $args = array(
              'posts_per_page' => 6,
              'paged' => $paged
            );
            $all_posts = new WP_Query($args);
            ?>
            <?php if ($all_posts->have_posts()) : ?>
              <?php while ($all_posts->have_posts()) : $all_posts->the_post(); ?>
                <?php if (has_post_thumbnail()) : ?>
                  <li class="book-post__list">
                    <a href="<?php the_permalink(); ?>">
                      <div class="book-post__image-wrapper">
                        <?php the_post_thumbnail('thumbnail'); ?>
                      </div>
                    <?php endif; ?>
                    <div class="book-post__title">
                      <?php the_title(); ?>
                    </div>
                    </a>
                  </li>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
              <?php else : ?>
                <p>投稿が見つかりませんでした。</p>
              <?php endif; ?>
          </ul>
          <div class="btn-wrapper">
            <a class="to-index" href="<?php echo home_url('/book/'); ?>">自費出版の書籍一覧はこちら</a>
            <div class="selected-label buy">
              <a href="<?php echo home_url('/purchase/'); ?> alt=" alt="自費出版のご購入方法"">
              <span class=" selected-label__icon">自費出版のご購入方法</span>
              </a>
            </div>
          </div>
        </div>
      </div>

      <div class="main__inner featured-articles">
        <h3 class="main__header3">
          注目記事
        </h3>
        <div class="featured-articles__top-three">
          <!-- 注目記事 1 -->
          <div class="flex-wrapper">
            <a class="featured-articles__item" href="<?php echo esc_url(home_url('/novel-self-publish')); ?>">
              <div class="image-wrapper">
                <img src="<?php echo get_template_directory_uri(); ?>/images/banner/banner-nobel.png" alt="">
              </div>
            </a>
            <a class="featured-articles__item" href="<?php echo esc_url(home_url('/visual-self-publish')); ?>">
              <div class="image-wrapper">
                <img src="<?php echo get_template_directory_uri(); ?>/images/banner/banner-camera.png" alt="">
              </div>
            </a>
          </div>
          <!-- 注目記事 2 -->
          <a class="featured-articles__item for-msword" href="<?php echo esc_url(home_url('/welcome-msword')); ?>">
            <div class="image-wrapper welcome-msword-banner">
              <img src="<?php echo get_template_directory_uri(); ?>/images/banner/banner-msword.png" alt="">
            </div>
          </a>
        </div>
        <!-- 注目記事 3 -->
        <!-- 自費出版相談会のバナー -->
        <?php
        $post_id = 2637; // 投稿のIDを指定
        $args = array(
          'post_type' => 'news', // カスタム投稿タイプ
          'p' => $post_id,       // 投稿IDで指定
          'posts_per_page' => 1,
        );

        $my_query = new WP_Query($args);

        if ($my_query->have_posts()) :
          while ($my_query->have_posts()) : $my_query->the_post();
        ?>
            <a class="featured-articles__item" href="<?php the_permalink(); ?>">
              <div class="image-wrapper">
                <?php the_post_thumbnail(); ?>
              </div>
            </a>
        <?php
          endwhile;
        endif;
        wp_reset_postdata(); // クエリ後にデータをリセット
        ?>

        <!-- 想いのカタチのバナー -->
        <?php
        $post_id = 2350; // 投稿のIDを指定
        $args = array(
          'post_type' => 'news', // カスタム投稿タイプ
          'p' => $post_id,       // 投稿IDで指定
          'posts_per_page' => 1,
        );

        $my_query = new WP_Query($args);

        if ($my_query->have_posts()) :
          while ($my_query->have_posts()) : $my_query->the_post();
        ?>
            <a class="featured-articles__item" href="<?php the_permalink(); ?>">
              <div class="image-wrapper">
                <?php the_post_thumbnail(); ?>
              </div>
            </a>
        <?php
          endwhile;
        endif;
        wp_reset_postdata(); // クエリ後にデータをリセット
        ?>

        <!-- 自費出版のご質問募集中!! のバナー -->
        <?php
        $post_id = 803; // 投稿のIDを指定
        $args = array(
          'post_type' => 'news', // カスタム投稿タイプ
          'p' => $post_id,       // 投稿IDで指定
          'posts_per_page' => 1,
        );

        $my_query = new WP_Query($args);

        if ($my_query->have_posts()) :
          while ($my_query->have_posts()) : $my_query->the_post();
        ?>
            <a class="featured-articles__item" href="<?php the_permalink(); ?>">
              <div class="image-wrapper">
                <?php the_post_thumbnail(); ?>
              </div>
            </a>
        <?php
          endwhile;
        endif;
        wp_reset_postdata(); // クエリ後にデータをリセット
        ?>
      </div>
    </div>

    <aside class="main__other-info">
      <?php
      // データをテンプレートファイルに渡して表示
      load_template(get_template_directory() . '/components/other-info.php', false);
      ?>
    </aside>
  </div>

</div>

<?php get_footer(); ?>