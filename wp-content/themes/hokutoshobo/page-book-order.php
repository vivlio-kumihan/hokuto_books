<?php /* Template Name: book-order */ ?>

<?php get_header(); ?>

<div id="page-top" class="main">
  <div class="main__contents-wrapper">
    <div class="main__inner">
      <div class="book-order">
        <h3 class="main__header3 book-order__title">書籍注文</h3>
        <div class="book-order__title">
          <a href="<?php echo get_template_directory_uri(); ?>/images/privacy-policy.pdf" target="_blank">プライバシーポリシーの確認</a>
        </div>
        <?php echo do_shortcode('[contact-form-7 id="0e928fe" title="書籍注文"]') ?>
      </div>
    </div>
  </div>
</div>

<?php get_footer(); ?>


<!-- contact form 7に貼り付けているphp -->
<!-- 
\<ul class=" book-order__form">
  <li class="book-order__list">
    <div class="book-order__entry">[checkbox* confirm "確認"]</div>
  </li>  
  <li class="book-order__list">
    <div class="book-order__title">お名前（漢字）</div>
    <div class="book-order__entry">[text* your-name autocomplete:name]</div>
  </li>
  <li class="book-order__list">
    <div class="book-order__title">お名前（フリガナ）</div>
    <div class="book-order__entry">[text* name-ruby autocomplete:ruby]</div>
  </li>
  <li class="book-order__list">
    <div class="book-order__title">郵便番号（例：0000000）</div>
    <div class="book-order__entry">[number* zip-number class:book-order__zip-number min:1000000 max:9999999 placeholder "0000000"]

    </div>
  </li>
  <li class="book-order__list">
    <div class="book-order__title">ご住所</div>
    <div class="book-order__entry">[text* address]</div>
  </li>
  <li class="book-order__list">
    <div class="book-order__title">お電話番号（携帯可）（例：00-000-000）</div>
    <div class="book-order__entry">[tel* tel autocomplete:tel placeholder "00-000-0000"]</div>
  </li>
  <li class="book-order__list">
    <div class="book-order__title">メールアドレス</div>
    <div class="book-order__entry">[email* email autocomplete:email]</div>
  </li>
  <li class="book-order__list">
    <div class="book-order__title">ご注文書籍名</div>
    <div class="book-order__entry">[text* book-title]</div>
  </li>
  <li class="book-order__list">
    <div class="book-order__title">数量</div>
    <div class="book-order__entry">[number* quantity]部</div>
  </li>
  <li class="book-order__list">
    <div class="book-order__title">その他ご要望</div>
    <div class="book-order__entry">[textarea request]</div>
  </li>
  <li class="book-order__submit">[submit "送信"]</li>
</ul>
-->