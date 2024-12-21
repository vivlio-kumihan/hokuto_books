<?php /* Template Name: self-publishing-order-form */ ?>

<?php get_header(); ?>

<div id="page-top" class="main book-order">
  <div class="main__contents-aside-wrapper">
    <div class="main__contents-wrapper">
      <div class="main__inner">
        <div class="book-order">
          <h3 class="main__header3 book-order__title">自費出版依頼フォーム</h3>
          <div class="book-order__confirm-privacy">
            <a href="<?php echo get_template_directory_uri(); ?>/images/privacy-policy.pdf" target="_blank">
              <span>
                <img src="<?php echo get_template_directory_uri(); ?>/images/icon-PDF.png" alt="">
              </span>
              プライバシーポリシーの確認
            </a>
          </div>
          <?php echo do_shortcode('[contact-form-7 id="5c27489" title="自費出版依頼フォーム"]') ?>
        </div>
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


<!-- contact form 7に貼り付けているphp -->
<!-- 
<ul class=" book-order__form">
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
    <div class="book-order__entry">[number* zip-number class:book-order__zip-number min:1000000 max:9999999]

    </div>
  </li>
  <li class="book-order__list">
    <div class="book-order__title">ご住所</div>
    <div class="book-order__entry">[text* address]</div>
  </li>
  <li class="book-order__list">
    <div class="book-order__title">お電話番号（携帯可）（例：00-000-000）</div>
    <div class="book-order__entry">[tel* tel autocomplete:tel]</div>
  </li>
  <li class="book-order__list">
    <div class="book-order__title">メールアドレス</div>
    <div class="book-order__entry">[email* email autocomplete:email]</div>
  </li>
  <li class="book-order__list">
    <div class="book-order__title">ご注文書籍名</div>
    <div class="book-order__entry">[text* book_title default:get readonly]</div>
  </li>
  <li class="book-order__list">
    <div class="book-order__title">数量（部）</div>
    <div class="book-order__entry">[number* quantity]</div>
  </li>
  <li class="book-order__list">
    <div class="book-order__title">その他ご要望</div>
    <div class="book-order__entry">[textarea request]</div>
  </li>
  <li class="book-order__submit">[submit "送　信"]</li>
</ul>
-->