<div class="aside-contents">
  <div class="blog-index">
    <div class="main__header3 link-inner">
      北斗書房ブログ
      <ul class="pre-mark__orange-arrow">
        <li><a href="<?php echo esc_url(home_url('/news')); ?>">新着一覧</a></li>
      </ul>
    </div>
    <ul class="news__list">
      <?php
      $recent_page = get_query_var('paged') ? get_query_var('paged') : 1;

      $args = array(
        'post_type' => 'news',
        'posts_per_page' => 4,
        'paged' => $recent_page, // 現在のページ番号を指定
      );

      $my_query = new WP_Query($args);

      if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post();
      ?>
          <li class="news__headline">
            <a class="news__headline-inner-wrapped-anchor" href="<?php the_permalink(); ?>">
              <div class="image-wrapper">
                <?php
                $thumbnail = get_field('thumbnail');
                if (isset($thumbnail['url']) && !empty($thumbnail['url'])) :
                ?>
                  <img class="thumbnail-image" src="<?php echo esc_url($thumbnail['url']); ?>" alt="<?php echo esc_attr($thumbnail['alt'] ?? ''); ?>">
                <?php else : ?>
                  <img class="thumbnail-image" src="<?php echo get_template_directory_uri(); ?>/images/news/news-defalut-thumbnail.jpg" alt="Default Thumbnail">
                <?php endif; ?>
              </div>

              <div class="news__contents">
                <ul class="news__category">
                  <?php
                  $terms = get_the_terms(get_the_ID(), 'blog_category');
                  if (!empty($terms) && !is_wp_error($terms)) {
                    foreach ($terms as $attr) {
                      echo '<li class="news__category-item">' . esc_html($attr->name) . '</li>';
                    }
                  }
                  ?>
                </ul>
                <div class="news__title"><?php the_title(); ?></div>
                <time class="news__date" datetime="<?php echo get_the_date('Y-m-d'); ?>">
                  <?php echo get_the_date(); ?>
                </time>
              </div>
            </a>
          </li>
      <?php endwhile;
      endif;
      wp_reset_postdata(); ?>
    </ul>
  </div>

  <div class="main__header3">
    リンク情報
  </div>
  <ul class="main__other-info-banners">
    <li>
      <a href="<?php echo esc_url(home_url('/safety/')); ?>">
        <div class="image-wrapper">
          <img src="<?php echo get_template_directory_uri(); ?>/images/bt-safety.png" alt="安心・安全の証" />
        </div>
      </a>
    </li>
    <li>
      <a href="https://www.adobe.com/jp/information/creativecloud/printshop.html" target="_blank">
        <div class="image-wrapper">
          <img src="<?php echo get_template_directory_uri(); ?>/images/adobe_printshop_banner.png" alt="Adobe Creative Cloud出力対応店" />
        </div>
      </a>
    </li>
    <li>
      <a href="http://www.hokuto-p.co.jp/establishment/" target="_blank">
        <div class="image-wrapper">
          <img src="<?php echo get_template_directory_uri(); ?>/images/bt-kinenshi.png" alt="創業記念誌作成" width="220" height="80" />
        </div>
      </a>
    </li>
    <li>
      <a href="http://prodigi.jp/~bungeidojin/" target="_blank">
        <div class="image-wrapper">
          <img src="<?php echo get_template_directory_uri(); ?>/images/bt-dojinshi.png" alt="文芸同人誌案内所" width="220" height="80" />
        </div>
      </a>
    </li>
    <li>
      <a href="https://hokuto-p-co-jp.prm-ssl.jp/index.html" target="_blank">
        <div class="image-wrapper">
          <img src="<?php echo get_template_directory_uri(); ?>/images/bt-hokuto.png" alt="株式会社北斗プリント社のサイト" width="220" height="80" />
        </div>
      </a>
    </li>
    <li>
      <a href="https://hokuto-p-co-jp.prm-ssl.jp/asks/index.php" target="_blank">
        <div class="image-wrapper">
          <img src="<?php echo get_template_directory_uri(); ?>/images/bt-asks.png" alt="株式会社北斗プリント社1F　あすくす" width="220" height="80" />
        </div>
      </a>
    </li>
    <li>
      <a href="https://hokuto-p-co-jp.prm-ssl.jp/asks/nenga/index.php" target="_blank">
        <div class="image-wrapper">
          <img src="<?php echo get_template_directory_uri(); ?>/images/bt-nenga.png" alt="京都デザイン,京都年賀状,年賀状印刷,株式会社北斗プリント社1F　あすくす" width="220" height="80" />
        </div>
      </a>
    </li>
    <li>
      <a href=" http://www.san-en.org/link/" target="_blank">
        <div class="image-wrapper">
          <img src="<?php echo get_template_directory_uri(); ?>/images/bnr/sanen.png" alt="起業家・経営者・若者の学びと未来の場。三縁の会" width="220" height="80" />
        </div>
      </a>
    </li>
  </ul>
  <div class="fb-page"
    data-href="https://www.facebook.com/hokutoshobo"
    data-tabs="timeline"
    data-width="400"
    data-height="590"
    data-small-header="false"
    data-adapt-container-width="true"
    data-hide-cover="false"
    data-show-facepile="true">
  </div>
</div>