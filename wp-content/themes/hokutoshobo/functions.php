<?php
// ウィジェットの登録
function theme_slug_widgets_init()
{
  register_sidebar(array(
    'name' => 'サイドバー', //ウィジェットの名前を入力
    'id' => 'sidebar', //ウィジェットに付けるid名を入力
  ));
}
add_action('widgets_init', 'theme_slug_widgets_init');

// 投稿編集画面でアイキャッチ画像のメタボックスを有効にする
add_action('after_setup_theme', function () {
  add_theme_support('post-thumbnails');
});

function enable_post_thumbnail_for_post() {
  add_post_type_support('post', 'thumbnail');
}
add_action('init', 'enable_post_thumbnail_for_post');



// JavaScriptを読み込む
function my_scripts()
{
  // wp_enqueue_script('swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), null, true);
  wp_enqueue_script('latest-year-js', get_template_directory_uri() . '/scripts/libs/latest-year.js', array(), null, true);
  wp_enqueue_script('hide-header-js', get_template_directory_uri() . '/scripts/libs/hide-header.js', array(), null, true);
  wp_enqueue_script('mobile-menu-js', get_template_directory_uri() . '/scripts/libs/mobile-menu.js', array(), null, true);
  wp_enqueue_script('monitor-line-js', get_template_directory_uri() . '/scripts/libs/monitor-line.js', array(), null, true);
  wp_enqueue_script('main-js', get_template_directory_uri() . '/scripts/main.js', array(), null, true);
  wp_enqueue_script('facebook-jssdk', 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v15.0', array(), null, true);
}
add_action('wp_enqueue_scripts', 'my_scripts');

// 外部スタイルシートとフォントの読み込み
function my_enqueue_styles() {
  // デフォルトのスタイルシート（style.css）
  wp_enqueue_style('hokutoshobo-style', get_stylesheet_uri());

  // リセットCSS
  wp_enqueue_style('destyle', 'https://unpkg.com/destyle.css@4.0.0/destyle.min.css');

  // Google Fontsの事前接続とフォントの読み込み
  wp_enqueue_style('google-fonts-preconnect1', 'https://fonts.googleapis.com', [], null, 'preconnect');
  wp_enqueue_style('google-fonts-preconnect2', 'https://fonts.gstatic.com', [], null, 'preconnect');
  wp_enqueue_style('noto-sans', 'https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@200;500;900&display=swap');
  wp_enqueue_style('noto-serif', 'https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@400;600;900&display=swap');
  wp_enqueue_style('roboto', 'https://fonts.googleapis.com/css2?family=Roboto:wght@900&display=swap');

  // Font Awesome
  wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');

  // Swiperのスタイルシート
  wp_enqueue_style('swiper', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.7/swiper-bundle.min.css');
}
add_action('wp_enqueue_scripts', 'my_enqueue_styles');

// // CSSを読み込む
// function my_theme_enqueue_styles()
// {
//   // css-resetスタイルシートをテーマのフォルダから読み込む
//   // wp_enqueue_style('css-reset', get_template_directory_uri() . '/styles/vendors/css-reset.css');
//   // wp_enqueue_style('css-reset', get_template_directory_uri() . '/styles/vendors/swiper-bundle.min.css');
//   // 外部のCSSファイルをHTTPSで読み込む例
//   wp_enqueue_style('reset-css', 'https://unpkg.com/destyle.css@4.0.0/destyle.min.css', array(), null);
//   // メインスタイルシートを読み込む
//   wp_enqueue_style('main-stylesheet', get_stylesheet_uri());
// }

// add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');

// post_has_archive()関数の定義
function post_has_archive($args, $post_type)
{
  if ('post' == $post_type) {
    $args['rewrite'] = true;
    // 任意のスラッグ名を登録←アーカイブページが有効になる。
    $args['has_archive'] = 'book';
  }
  return $args;
}
add_filter('register_post_type_args', 'post_has_archive', 10, 2);

// 書籍タイトルをcontact form 7に送る。
function my_wpcf7_dynamic_text($text) {
    $text = isset($_GET[$text]) ? sanitize_text_field($_GET[$text]) : '';
    return $text;
}
add_filter('wpcf7_dynamic_text', 'my_wpcf7_dynamic_text');
