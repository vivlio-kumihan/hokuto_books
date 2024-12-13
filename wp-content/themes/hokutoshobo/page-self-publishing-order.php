<?php /* Template Name: self-publishing-order */ ?>

<?php get_header(); ?>

<div id="page-top" class="main book-order">
  <div class="main__contents-aside-wrapper">
    <div class="main__contents-wrapper">
      <h3 class="main__header3 book-order__title">自費出版依頼</h3>
      <div id="root" class="self-publishing-order"></div>
    </div>

    <aside class="main__other-info">
      <?php
      // データをテンプレートファイルに渡して表示
      load_template(get_template_directory() . '/components/other-info.php', false);
      ?>
    </aside>
  </div>
</div>
<script type="module" src="<?php echo get_template_directory_uri(); ?>/page-self-publishing-order/assets/index-HeOsRd9d.js">

</script>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/page-self-publishing-order/assets/index-DLXKAAdV.css">

<?php get_footer(); ?>