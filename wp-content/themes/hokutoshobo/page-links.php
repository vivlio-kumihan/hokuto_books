<?php /* Template Name: links */ ?>

<?php get_header(); ?>

<div id="page-top" class="main">
  <div class="main__contents-aside-wrapper">
    <div class="main__contents-wrapper">
      <div class="main__inner">
        <h3>当社の関連団体</h3>
        <ul class="main__list">
          <li><a href="http://www.jsjapan.net/" target="_blank">NPO法人 自費出版ネットワーク</a></li>
          <li><a href="http://www.jagra.or.jp/" target="_blank">社団法人 日本グラフィックサービス工業会</a></li>
          <li><a href="http://www.kyoinko.jp/" target="_blank">京都府印刷工業組合</a></li>
          <li><a href="http://www.jagat.or.jp/" target="_blank">社団法人 日本印刷技術協会</a></li>
        </ul>
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