<?php if ($args['latest_posts']->have_posts()) : ?>
  <ul class="other-info__latest-5-blogs">
    <?php while ($args['latest_posts']->have_posts()) : $args['latest_posts']->the_post(); ?>
      <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
    <?php endwhile; ?>
  </ul>
  <?php wp_reset_postdata(); ?>
<?php else : ?>
  <p>No posts found.</p>
<?php endif; ?>

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