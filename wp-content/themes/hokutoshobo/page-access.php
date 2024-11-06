<?php /* Template Name: access */ ?>

<?php get_header(); ?>

<div class="main">
  <div class="main__inner access">
    <section>
      <h3 class="main__header3">交通アクセス</h3>
      <div class="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3266.5050011034928!2d135.7745733764252!3d35.04411137279974!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x60010838e1d4d157%3A0xc4e2aab5a1228d9b!2z44CSNjA2LTA4NjQg5Lqs6YO95bqc5Lqs6YO95biC5bem5Lqs5Yy65LiL6bSo6auY5pyo55S677yT77yY4oiS77ySIOWMl-aWl-ODl-ODquODs-ODiOekvg!5e0!3m2!1sja!2sjp!4v1730106345647!5m2!1sja!2sjp" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
      <ul class="access-map">
        <li class="access-map__route">
          <div class="access-map__from-station">JR・近鉄&emsp;京都駅から</div>
          <div class="access-map__via-line">地下鉄烏丸線経由</div>
          <dl class="access-map__contents">
            <dt>北大路駅で下車される場合</dt>
            <dd>（地下鉄烏丸線）国際会議場行き&nbsp;→&nbsp;約14分&nbsp;→&nbsp;北大路駅駅下車&nbsp;→&nbsp;（市バス）北大路バスターミナル「赤のりば」204・206・北８系統&nbsp;→&nbsp;約10分&nbsp;→&nbsp;「下鴨高木町」バス停下車</dd>
          </dl>
          <dl class="access-map__contents">
            <dt>松ヶ崎駅で下車される場合</dt>
            <dd>（地下鉄烏丸線）国際会議場行き&nbsp;→&nbsp;約14分&nbsp;→&nbsp;松ヶ崎駅下車&nbsp;→&nbsp;南へ徒歩10分&nbsp;→&nbsp;高木町交差点を左（東）へ徒歩30秒<br />→ 左（北）側</dd>
          </dl>
        </li>
        <li class="access-map__route">
          <div class="access-map__from-station">阪急&emsp;四条烏丸駅から</div>
          <div class="access-map__via-line">地下鉄烏丸線経由</div>
          <dl class="access-map__contents">
            <dt>北大路駅で下車される場合</dt>
            </dt>
            <dd>（地下鉄烏丸線）国際会議場行き&nbsp;→&nbsp;約11分&nbsp;→&nbsp;北大路駅駅下車&nbsp;→&nbsp;（市バス）北大路バスターミナル「赤のりば」204・206・北８系統&nbsp;→&nbsp;約10分&nbsp;→&nbsp;「下鴨高木町」バス停下車</dd>
            </dd>
          </dl>
          <dl class="access-map__contents">
            <dt>松ヶ崎駅で下車される場合</dt>
            <dd>（地下鉄烏丸線）国際会議場行き&nbsp;→&nbsp;約11分&nbsp;→&nbsp;松ヶ崎駅下車&nbsp;→&nbsp;南へ徒歩10分&nbsp;→&nbsp;高木町交差点を左（東）へ徒歩30秒<br />→ 左（北）側</dd>
          </dl>
        </li>
        <li class="access-map__route">
          <div class="access-map__from-station">京阪&emsp;出町柳駅から</div>
          <div class="access-map__via-line"></div>
          <dl class="access-map__contents">
            <dt class="margin-top-expand">京阪&emsp;出町柳駅前バス停より</dt>
            <dd>（京都バス）32・34・35・37&nbsp;→&nbsp;約５～７分&nbsp;→&nbsp;高野橋東詰下車&nbsp;→&nbsp;西へ徒歩３分北<br />※市バスは下鴨本通りを北行するため不適です。</dd>
          </dl>
        </li>
        <li class="access-map__route">
          <div class="access-map__from-station">地下鉄&emsp;北大路駅・松ヶ崎駅から</div>
          <div class="access-map__via-line"></div>
          <dl class="access-map__contents">
            <dt class="margin-top-expand">地下鉄&emsp;北大路駅からお越しの場合</dt>
            <dd>（市バス）北大路バスターミナル「赤のりば」204・206・北８系統&nbsp;→&nbsp;約10分&nbsp;→&nbsp;「下鴨高木町」バス停下車</dd>
          </dl>
          <dl class="access-map__contents">
            <dt>地下鉄&emsp;松ヶ崎駅からお越しの場合</dt>
            <dd>南へ徒歩10分&nbsp;→&nbsp;高木町交差点を左（東）へ徒歩30秒&nbsp;→&nbsp;左（北）側</dd>
          </dl>
        </li>
      </ul>
    </section>

    <section>
      <h3 class="main__header3">広域・詳細マップ</h3>
      <ul>
        <li>
          <a href="<?php echo get_template_directory_uri(); ?>/images/access/map-l.png" target="_blank">
            <figure class="image-wrapper">
              <figcaption>広域マップ</figcaption>
              <img src="<?php echo get_template_directory_uri(); ?>/images/access/map-l-320x478.png" alt="広域マップ" />
            </figure>
          </a>
          <a href="<?php echo get_template_directory_uri(); ?>/images/access/map-zoom.png" target="_blank">
            <figure class="image-wrapper">
              <figcaption>詳細マップ</figcaption>
              <img src="<?php echo get_template_directory_uri(); ?>/images/access/map-zoom-320x323.png" alt="詳細マップ" />
            </figure>
          </a>
        </li>
        <div class="note">※地図クリックで別ページが開きます。拡大対応。</div>
        <a class="arrow-link margin-top-1em" href="<?php echo get_template_directory_uri(); ?>/images/print-map.pdf" target="_blank">
          地図のダウンロードと印刷
          <span class="arrow-link__mark"></span>
        </a>
      </ul>
    </section>
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