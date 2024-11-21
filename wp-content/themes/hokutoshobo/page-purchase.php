<?php /* Template Name: purchase */ ?>

<?php get_header(); ?>

<div class="main">
  <div class="main__contents-aside-wrapper">
    <div class="main__contents-wrapper">
      <div class="main__inner">
        <h3 class="main__header3">自費出版ご購入お申し込み方法</h3>
        <p>書籍一覧で<span class="into-selected-label">
            <span class="selected-label buy only-mark">
              <a href="#">
                <span class="selected-label__icon">購入</span>
              </a>
            </span>
          </span>マークが記載された作品は弊社より購入が可能です。
        </p>
        <p>また、書籍詳細ページでも、同マークをクリックいただくと該当書籍のお申し込み専用フォームのページに移りますので必要項目を入力してお申し込みくださいますようお願い申し上げます。
        <p>ご入金確認の後、商品をお送り致します。<br />手続きは以下の方法でお受け致しております。</p>

        <h4 class="main__header4">お申し込みフォームに必要事項をご記入のうえ送信して下さい</h4>
        <p>お申し込みフォームから送信いただきますと自動返信メールがお客さまに届きます。<br />内容にお間違いがないか今一度ご確認くださいますようお願い申し上げます。</p>
        <div class="note indent-minus">※確認メールが届かない場合は、お客様ご登録のメールアドレスの誤り、もしくはシステム等の不具合が考えられますので、誠に恐れ入りますが再度ご送信いただきますようお願い申し上げます。</div>

        <h4 class="main__header4">弊社指定口座に代金をご入金下さい</h4>
        <ul class="main__list">
          <li>振替用紙の通信欄に、ご希望の書籍名を必ずご明記お願い申し上げます。</li>
          <li>振込用紙は金融機関のものをお使いいただきますようお願い申し上げます。</li>
          <li>振込手数料はお客さま負担でお願い申し上げます。</li>
        </ul>

        <h5 class="main__header5">振込先</h5>
        <dl class="payee">
          <div>
            <dt>金融機関名</dt>
            <dd>郵便局</dd>
          </div>
          <div>
            <dt>口座番号</dt>
            <dd>00970-4-47841</dd>
          </div>
          <div>
            <dt>加入者名</dt>
            <dd>北斗書房</dd>
          </div>
        </dl>

        <p>ご入金確認後、発送の手続きを執らせて頂きます。<br />併せまして発送完了のメールをお送り致します。<br />ご入金確認から１週間程度で商品をお届け致します。</p>

        <h4 class="main__header4">マークが記載されていない書籍につきまして</h4>
        <p>マーク記載以外の書籍は弊社で在庫保管をしておらず著者様から直接お送りいただきます。 大変恐れ入りますが、お客様のご氏名・ご連絡先をお教えいただきましたら、弊社より著者様にご連絡いたします。個人情報保護の観点からご面倒をお掛けいたしますが、 ご協力いただきますようお願い申し上げます。</p>
        <p>なお、絶版その他の事情により書籍の入手が不可能な場合がございますことを予めご了承ください。</p>
        <a class="arrow-link margin-top-1em" href="http://localhost:8888/hokuto-bs/contact/">
          お問い合わせはこちら<span class="arrow-link__mark"></span>
        </a>
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