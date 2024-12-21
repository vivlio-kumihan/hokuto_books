<?php /* Template Name: contact */ ?>

<?php get_header(); ?>

<div id="page-top" class="main contact">
  <div class="main__contents-aside-wrapper">
    <div class="main__contents-wrapper">
      <div class="main__inner">
        <h3 class="main__header3">お電話でのお問い合わせはこちら</h3>
        <ul class="tel-fax">
          <li class="tel-fax__tel">
            <span>TEL</span>075-791-6125
          </li>
          <li class="tel-fax__fax">
            <span>FAX</span>075-791-7290
          </li>
        </ul>

        <div class="contact-item">
          <div class="contact-item__business-Hours">
            <div><span>受付時間</span>&ensp;9：00〜19：00</div>
            <a class="arrow-link" href="http://www.hokuto-p.co.jp/calendar/index.html" target="_blank">
              当社の営業カレンダーはこちら<span class="arrow-link__mark"></span>
            </a>
          </div>
          <div class="contact-item__adress">
            <div>〒606-8540 京都市左京区下鴨高木町38-2</div>
            <a class="arrow-link" href="<?php echo esc_url(home_url('/access')); ?>">
              アクセスマップはこちら<span class="arrow-link__mark"></span>
            </a>
          </div>
        </div>
      </div>

      <div class="main__inner">
        <div class="book-order">
          <h3 class="main__header3 book-order__title">お問い合わせ、ニュースレターのお申し込みはコチラ</h3>
          <p>下記の「個人情報保護方針」をご確認の上、同意いただける場合は<strong>「個人情報保護方針に同意する」</strong>にチェックを入れてください。</p>
          <p><span class="cancel-display-block color-attention">※</span>は入力必須項目です。<br />ニュースレターの定期配布をご希望の方は、「お問い合わせ内容」にご記入ください。</p>

          <div class="book-order__confirm-privacy">
            <a href="<?php echo get_template_directory_uri(); ?>/images/privacy-policy.pdf" target="_blank">
              <span>
                <img src="<?php echo get_template_directory_uri(); ?>/images/icon-PDF.png" alt="">
              </span>
              プライバシーポリシーの確認
            </a>
          </div>

          <?php echo do_shortcode('[contact-form-7 id="b39c655" title="お問い合わせ 添付機能付き"]') ?>
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
    <div class="book-order__entry">[checkbox* confirm "確認※"]</div>
  </li>
  <li class="book-order__list">
    <div class="book-order__title">お名前※</div>
    <div class="book-order__entry">[text* your-name autocomplete:name]</div>
  </li>
  <li class="book-order__list">
    <div class="book-order__title">フリガナ※</div>
    <div class="book-order__entry">[text* name-ruby autocomplete:ruby]</div>
  </li>
  <li class="book-order__list">
    <div class="book-order__title">お電話番号（携帯可）（例：00-000-000）</div>
    <div class="book-order__entry">[tel* tel autocomplete:tel]</div>
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
    <div class="book-order__title">メールアドレス※</div>
    <div class="book-order__entry">[email* email autocomplete:email]</div>
  </li>
  <li class="book-order__list">
    <div class="book-order__title">その他ご要望</div>
    <div class="book-order__entry">[textarea request]</div>
  </li>
  <li class="book-order__list">
    <div class="book-order__title">ファイル・アップロード</div>
    <div class="book-order__upload-file">ファイル1（サイズ: 最大3MB）<br>[file file-01 limit:3mb class:file]</div>
    <div class="book-order__upload-file">ファイル2（サイズ: 最大3MB）<br>[file file-02 limit:3mb class:file]</div>
  </li>
  <li class="book-order__submit">[submit "送　信"]</li>
</ul> 
-->