<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>
    <?php
    if (is_month()) {
      echo get_the_date('Y年n月') . '｜' . get_bloginfo('name');
    } elseif (is_year()) {
      echo get_the_date('Y年') . '｜' . get_bloginfo('name');
    } elseif (is_home() || is_single() || is_category() || is_page()) {
      $title = get_the_title() ?: get_bloginfo('name');
      // 記事タイトルが空でなければそのまま、それ以外はサイト名
      echo $title . '｜' . get_bloginfo('name');
    } ?>
  </title>
</head>

<header>
  <div class="logo-space">
    <div class="logo-space__wrapper">
      <a href="<?php echo esc_url(home_url('/')); ?>">
        <span>株式会社北斗プリント社内</span>
        <div class="logo-space__name">北斗書房</div>
        <span>京都市左京区下鴨高木町38-2</span>
      </a>
    </div>
    <div class="logo-space__catch">
      京都&nbsp;洛北の出版社<span>60年の歴史と実績&nbsp;自費出版の北斗書房</span>
    </div>
  </div>
  <div class="header-others">
    <div class="header-others__upper">
      <div class="tel-number"><span>お電話でのお問い合わせ</span>075-791-6125</div>
      <div class="btn-contact">
        <a href="<?php echo esc_url(home_url('/contact/')); ?>">資料請求・お問い合わせ</a>
      </div>
    </div>
    <div class="header-others__lower">
      <form class="header-others__search-window" method="get" id="searchform" action="<?php echo home_url('/'); ?>">
        <label for="s">検索:</label>
        <input type="text" class="focus" placeholder="キーワードを入力" name="s" id="s" />
        <input name="searchsubmit" type="submit" id="searchsubmit" value="検索" />
      </form>
    </div>
  </div>

  <div class="global-menu">
    <ul>
      <li><a href="<?php echo esc_url(home_url('/')); ?>">ホーム</a></li>
      <li><a href="<?php echo esc_url(home_url('/feature')); ?>">当社の特徴</a></li>
      <li><a href="<?php echo esc_url(home_url('/price')); ?>">料金プラン</a></li>
      <li><a href="<?php echo esc_url(home_url('/process')); ?>">自費出版制作の流れ</a></li>
      <li><a href="<?php echo esc_url(home_url('/knowledge')); ?>">豆知識</a></li>
      <li><a href="<?php echo esc_url(home_url('/voice')); ?>">お客様の声</a></li>
      <li><a href="<?php echo esc_url(home_url('/faq')); ?>">Q&nbsp;&&nbsp;A</a></li>
      <li><a href="<?php echo esc_url(home_url('/access')); ?>">アクセス</a></li>
      <!--    <li class="menu03"><a href="/staff/">専属スタッフ</a></li>-->
    </ul>
  </div>
</header>