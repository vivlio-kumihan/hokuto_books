<?php /* Template Name: novel-self-publish */ ?>

<?php get_header(); ?>

<div class="main">
  <div class="main__inner">
    <section>
      <h3 class="main__header3">novel-self-publish</h3>
      <h4 class="main__header4">和田&emsp;章仁&ensp;<span class="font-sm">様</span></h4>
      <div class="flex-wrapper  margin-top-1dot5em">
        <div class="image-wrapper">
          <img src="<?php echo get_template_directory_uri(); ?>/images/voice/voice-wada-shoji-kyoto-michi-zukuri.png" />
        </div>
        <div class="image-wrapper">
          <img src="<?php echo get_template_directory_uri(); ?>/images/voice/voice-wada-shoji.png" />
        </div>
      </div>
      <p>本書は、古代から現代までの京都府におけるみちづくりの歴史をまとめてみたいとの思いから執筆を始めました。今までに京都府域を対象にしたみちづくりについて記録した書物は見当たりませんでした。そこで、かつて京都市職員として道路の計画に携わり、その後、研究者として快適な道路環境づくりに取り組んできた経験から、京都のみちづくりの歴史を後世に残さなければならないと考えたのです。このため、古代から近世までの街道の発達過程や、近代から現代に至る道路整備の変遷をたどることにより、みちづくりの移り変わりを書き留めることにしました。</p>
      <p>多くの歴史的な資料や書物をはじめ、国土交通省や京都府、京都市などの行政機関の記念誌や広報資料を参考にして書き進めていきました。そうした中で、戦後整備された数多くの道路の中から、本書に取り上げるべき道路としてふさわしいのはどれか、さらにはみちづくりの範囲をどこまでにすべきかといった判断が難しく、頭を痛めました。</p>
      <p>この著作を進めていくと、道路は地域、地方さらには国土を形成するうえで重要な施設であり、社会の繁栄に大きく貢献していることが実感でき、今後もより一層の整備・拡充が望まれます。さらに道路は私たちの生活を支える身近な施設でもあることから、近年の道路に求められている機能や役割は多岐にわたっています。それゆえ将来の道路整備に向けて、過去から現在までのみちづくりの歴史を振り返ってみることは、大変意義のあることだったと考えています。今後、安全・安心かつ快適なみちづくりを進めていくうえで、本書がその一助となることを切に願っています。</p>
      <p>完成した本書はすばらしい出来栄えで、校正から表紙カバーや帯の作成、印刷、製本に至るまで北斗書房の皆様が全力で取り組んでいただけた結果だと推察いたしております。とりわけ相生隆久氏には担当編集者としてさまざまなアドバイスをいただくとともに、完成まできめ細かなサポートをしていただき、心から感謝しています。</p>
      <a class="arrow-link put-right" href="<?php echo esc_url(home_url('/book/genre/history/1134/')); ?>" target="_blank">
        作品紹介はこちら<span class="arrow-link__mark"></span>
      </a>
    </section>
  </div>

  <aside class="other-info">
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