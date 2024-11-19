<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
</head>

<div id="global-container"> <!-- start #global-container -->
  <div id="container"> <!-- start #container -->
    <header class="header">
      <div class="header__upper">
        <div class="logo-space">
          <div class="logo-space__wrapper">
            <a href="<?php echo esc_url(home_url('/')); ?>">
              <span>株式会社北斗プリント社内</span>
              <div class="logo-space__name">
                <span>北</span><span>斗</span><span>書</span><span>房</span>
              </div>
              <span>京都市左京区下鴨高木町38-2</span>
            </a>
          </div>
          <div class="logo-space__catch">
            <div>京都&nbsp;洛北の出版社</div>
            <span>60年の歴史と実績&nbsp;自費出版の北斗書房</span>
          </div>
        </div>
        <div class="header-others">
          <div class="header-others__upper">
            <div class="tel-number">
              <a href="tel:0757916125">
                <span>お電話でのお問い合わせ</span>
                075-791-6125
              </a>
            </div>
            <div class="btn-contact">
              <a href="<?php echo esc_url(home_url('/contact/')); ?>">資料請求・お問い合わせ</a>
            </div>
          </div>
          <div class="header-others__lower">
            <form class="search" method="get" id="search-form" action="<?php echo esc_url(home_url('/')); ?>">
              <input class="search__input" type="text" name="search-input" placeholder="キーワードを入力" />
              <input class="search__submit-btn" name="search-submit-btn" type="submit" value="検索" />
            </form>
          </div>
        </div>
      </div>
    </header>

    <ul class="global-menu">
      <li class="global-menu__link"><a href="<?php echo esc_url(home_url('/')); ?>">ホーム</a></li>
      <li class="global-menu__link"><a href="<?php echo esc_url(home_url('/feature')); ?>">当社の特徴</a></li>
      <li class="global-menu__link"><a href="<?php echo esc_url(home_url('/price')); ?>">料金プラン</a></li>
      <li class="global-menu__link"><a href="<?php echo esc_url(home_url('/process')); ?>">自費出版<br />制作の流れ</a></li>
      <li class="global-menu__link">
        <a href="#">自費出版<br />アラカルト</a>
        <div class="global-menu__sub-link knowledge">
          <a href="<?php echo esc_url(home_url('/knowledge')); ?>">自費出版の<br />豆知識</a>
        </div>
        <div class="global-menu__sub-link novel-self-publish">
          <a href="<?php echo esc_url(home_url('/novel-self-publish')); ?>">文字もの<br />自費出版</a>
        </div>
        <div class="global-menu__sub-link visual-self-publish">
          <a href="<?php echo esc_url(home_url('/visual-self-publish')); ?>">ビジュアル系<br />自費出版</a>
        </div>
        <div class="global-menu__sub-link welcome-msword">
          <a href="<?php echo esc_url(home_url('/welcome-msword')); ?>">データ入稿<br />対応可能</a>
        </div>
      </li>
      <li class="global-menu__link"><a href="<?php echo esc_url(home_url('/voice')); ?>">お客様の声</a></li>
      <li class="global-menu__link"><a href="<?php echo esc_url(home_url('/faq')); ?>">Q&nbsp;&&nbsp;A</a></li>
      <li class="global-menu__link"><a href="<?php echo esc_url(home_url('/access')); ?>">アクセス</a></li>
    </ul>

    <div class="mobile-menu__btn">
      <span></span>
      <span></span>
      <span></span>
    </div>