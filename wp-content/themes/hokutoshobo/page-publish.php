<?php /* Template Name: publish */ ?>

<?php get_header(); ?>

<div class="main">
  <div class="main__contents-aside-wrapper">
    <div class="main__contents-wrapper">
      <div class="main__inner">
        <h3 class="main__header3">自費出版ニュース</h3>
        <p>自費出版ニュースは、PDFファイルでご覧いただけます。</p>
        <ul class="main__list">
          <li><a href="http://www.hokutoshobo.jp/wp-content/uploads/2012/06/news201005.pdf">自費出版ニュース　平成22年5月号　Vol.11 No.2</a></li>
          <li><a href="http://www.hokutoshobo.jp/wp-content/uploads/2012/06/news201001.pdf">自費出版ニュース　平成22年1月号　Vol.11 No.1</a></li>
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