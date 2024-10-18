<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>
    <!-- というか、こんな条件分岐文を入れないといけなかったか？ -->
    <?php
    if (is_month()) {
      echo get_the_date('Y年n月') . '｜' . get_bloginfo('name');
    } elseif (is_year()) {
      echo get_the_date('Y年') . '｜' . get_bloginfo('name');
    } elseif (is_home() || is_single() || is_category() || is_page()) {
      $title = get_the_title() ?: get_bloginfo('name');
      echo $title . '｜' . get_bloginfo('name');
    } ?>
  </title>

  <head>
  </head>
  <link rel="stylesheet" href="https://unpkg.com/destyle.css@4.0.0/destyle.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@200;500;900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@400;600;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.7/swiper-bundle.min.css" />
  <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
  <?php wp_head(); ?>
</head>

<header class="header">
  <div class="header__upper">
    <div class="logo-space">
      <div class="logo-space__wrapper">
        <a href="<?php echo esc_url(home_url('/')); ?>">
          <span>株式会社北斗プリント社内</span>
          <div class="logo-space__name">北斗書房</div>
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
        <form class="search" method="get" id="search-form" action="<?php echo home_url('/'); ?>">
          <input class="search__input" type="text" name="search-input" placeholder="キーワードを入力" />
          <input class="search__submit-btn" name="search-submit-btn" type="submit" value="検索" />
        </form>
      </div>
    </div>
  </div>
</header>

<ul class="global-menu">
  <li><a href="<?php echo esc_url(home_url('/')); ?>">ホーム</a></li>
  <li><a href="<?php echo esc_url(home_url('/feature')); ?>">当社の特徴</a></li>
  <li><a href="<?php echo esc_url(home_url('/price')); ?>">料金プラン</a></li>
  <li><a href="<?php echo esc_url(home_url('/process')); ?>">自費出版<br />制作の流れ</a></li>
  <li><a href="<?php echo esc_url(home_url('/knowledge')); ?>">豆知識</a></li>
  <li><a href="<?php echo esc_url(home_url('/voice')); ?>">お客様の声</a></li>
  <li><a href="<?php echo esc_url(home_url('/faq')); ?>">Q&nbsp;&&nbsp;A</a></li>
  <li><a href="<?php echo esc_url(home_url('/access')); ?>">アクセス</a></li>
</ul>