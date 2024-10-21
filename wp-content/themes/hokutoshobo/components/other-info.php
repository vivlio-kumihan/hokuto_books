<?php if ($args['latest_posts']->have_posts()) : ?>
  <ul>
    <?php while ($args['latest_posts']->have_posts()) : $args['latest_posts']->the_post(); ?>
      <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
    <?php endwhile; ?>
  </ul>
  <?php wp_reset_postdata(); ?>
<?php else : ?>
  <p>No posts found.</p>
<?php endif; ?>

<div class="bnrArea">
  <ul>
    <li><a href="http://localhost:8888/hokuto-bs/safety/"><img src="http://localhost:8888/hokuto-bs/common/img/bt-safety.png" alt="安心・安全の証" /></a></li>
    <li><a href="http://localhost:8888/hokuto-bs/contact/"><img src="http://localhost:8888/hokuto-bs/common/img/bt-contact.png" alt="お問い合わせ・資料請求はこちら" /></a></li>
    <li><a href="https://www.adobe.com/jp/information/creativecloud/printshop.html" target="_blank"><img src="http://localhost:8888/hokuto-bs/common/img/adobe_printshop_banner.png" alt="Adobe Creative Cloud出力対応店" /></a></li>
  </ul>
</div>
<div class="bnrArea bnrAreaBottom">
  <?php if (is_home()): ?>
  <?php else: ?>
    <ul>
      <li><a href="http://www.hokuto-p.co.jp" target="_blank"><img src="http://localhost:8888/hokuto-bs/common/img/bt-hokuto.png" alt="株式会社北斗プリント社のサイト" width="230" height="80" /></a></li>
      <li><a href="http://localhost:8888/hokuto-bs/asks/" target="_blank"><img src="http://localhost:8888/hokuto-bs/common/img/bt-asks.png" alt="株式会社北斗プリント社1F　あすくす" width="230" height="80" /></a></li>
      <li><a href=" http://www.san-en.org/link/" target="_blank"><img src="http://localhost:8888/hokuto-bs/common/img/bnr/sanen.png" alt="起業家・経営者・若者の学びと未来の場。三縁の会" width="230" height="80" /></a></li>
    </ul>
  <?php endif; ?>
  <iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fhokutoshobo&amp;width=260&amp;height=590&amp;colorscheme=light&amp;show_faces=true&amp;header=true&amp;stream=true&amp;show_border=false" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:260px; height:590px;" allowtransparency="true"></iframe>
</div>