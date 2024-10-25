<?php /* Template Name: price */ ?>

<?php get_header(); ?>

<div class="main">
  <div class="main__inner">
    <h3 class="main__header3">ご参考お見積プラン</h3>
    <div class="wrapper margin-top-1em">
      <p>北斗書房では、たとえ市場に流通しない本であっても、商業出版と比較して何ら遜色ない品質と仕上がりをご提供いたします。制作の打合せと校正を重ね、お客様にとっての世界でただ1冊の本を、丁寧にお作りします。</p>
      <p>以下の御見積プランは、自費出版でよくある「自分史」の、標準的な仕様とご参考価格となります。</p>
      <p>このプランに無い仕様に関しましては、お客様のご予算をお伺いしながらその都度御見積いたしますので、どうぞお気軽にご相談下さい。</p>
    </div>
    <ul class="main__list for-only-links-with-image">
      <li>
        <a href="<?php echo esc_url(home_url('/price/namiseihon/')); ?>">
          並製本お見積プラン
        </a>
      </li>
      <li>
        <a href="<?php echo esc_url(home_url('/price/jyoseihon/')); ?>">
          上製本お見積プラン
        </a>
      </li>
    </ul>
  </div>
</div>

<?php get_footer(); ?>