<div class="flex-wrapper">
  <div class="blog-index toggle-sm-appear-lg-hide">
    <div class="main__header3 link-inner">
      北斗書房ブログ
      <ul class="pre-mark__orange-arrow">
        <li><a href="<?php echo esc_url(home_url('/news')); ?>">新着一覧</a></li>
      </ul>
    </div>
    <?php if ($args['latest_posts']->have_posts()) : ?>
      <ul class="other-info__latest-5-blogs">
        <?php while ($args['latest_posts']->have_posts()) : $args['latest_posts']->the_post(); ?>
          <li>
            <a href="<?php the_permalink(); ?>">
              <div class="other-info__blog-post-date">
                <?php the_time('Y年m月d日'); ?>
              </div>
              <div class="other-info__blog-title">
                <?php the_title(); ?>
              </div>
            </a>
          </li>
        <?php endwhile; ?>
      </ul>
      <?php wp_reset_postdata(); ?>
    <?php else : ?>
      <p>No posts found.</p>
    <?php endif; ?>
  </div>

  <ul class="other-info__banners">
    <li>
      <a href="<?php echo esc_url(home_url('/safety/')); ?>">
        <div class="image-wrapper">
          <img src="<?php echo get_template_directory_uri(); ?>/images/bt-safety.png" alt="安心・安全の証" />
        </div>
      </a>
    </li>
    <li>
      <a href="<?php echo esc_url(home_url('/contact/')); ?>">
        <div class="image-wrapper">
          <img src="<?php echo get_template_directory_uri(); ?>/images/bt-contact.png" alt="お問い合わせ・資料請求はこちら" />
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
  </ul>
  <ul class="other-info__banners toggle-sm-hide-lg-appear">
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
    data-width="260"
    data-height="590"
    data-small-header="false"
    data-adapt-container-width="true"
    data-hide-cover="false"
    data-show-facepile="true">
  </div>
</div>