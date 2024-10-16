# 独自テーマ

## アプリをインストールする際に選択するオプション
`Choose your environment > Custom`を選択する

<hr style="border: 5px dotted #aaa; background-color: transparent">

## アプリのディレクトリを作成
`app/public/wp-content/themes/new-app-name`

<hr style="border: 5px dotted #aaa; background-color: transparent">

## 必須ファイル
```
index.php
style.css
functions.php
```
<hr style="border: 5px dotted #aaa; background-color: transparent">

## テーマの認識

- `@charset`の記述を`style.sass`へ記述する。ただ確認すると`style.css`へは反映されていない模様。特に不具合がないのでこのままいく。

```css
@charset "UTF-8"
```

- WP/外観から呼び出す時の名称になる。私の場合は、`_general.sass`の先頭行へ記述する。

```
/* Theme Name: サイト名 */
```

- 以上の設定後、ダッシュボード/外観にて独自テーマを確認・有効化をする。

<hr style="border: 5px dotted #aaa; background-color: transparent">

## 設定
- __日本語化__
  - `WP Multibyte --Patch WordPress`: 日本語版パッケージのためのマルチバイト機能の拡張をする。
- __セキュリティ__
  - `SiteGuard WP Plugin`　
    - インストールされたら左サイドバーに`SiteGuard`のアイコンが現れるので、そこから設定に入る。
    - 管理・制作の負担になる設定項目はチェックを外す。
      - ログインページ変更
      - 画像認証
      - ログインアラート
- __バックアップ__
  - `UpdraftPlus WordPress Backup Plugin`
    - 定期的なバックアップの設定
      - `設定`から期間を`選択` * `n個`を設定する。
      - `週` * `4`でれば、4週間分のバックアップを取るという意味。
- __検索エンジンでの表示__
  - `検索エンジンでの表示 検索エンジンがサイトをインデックスしないようにする`にチェックを入れるかどうかは、開発中か公開しているかの状態で決定する。
- __外観／ウィジットの追加__
  - 独自テーマでは外観／ウィジットの項目がない。これがないと投稿の設定（右サイドバーの項目）でカテゴリー・タグ・アイキャチ画像の各項目が表示できいない。
  - `functions.php`に以下のコードを書いて適宜処理をする。

```php
<?php 
// ウィジェットの登録
function theme_slug_widgets_init() {
  register_sidebar( array(
    'name' => 'サイドバー', //ウィジェットの名前を入力
    'id' => 'sidebar', //ウィジェットに付けるid名を入力
  ) );
}
add_action( 'widgets_init', 'theme_slug_widgets_init' );
```

- __アイキャッチ画像を編集できる状態にする__
  - ウィジェットで投稿の編集時、デフォルトでは右サイドバーにアイキャッチ画像の項目は無いので、`functions.php`に以下のコードを書いて適宜処理をする。

```php
// 投稿のサイドバーにアイキャッチ画像を付与。
add_theme_support('post-thumbnails');
```

- __JavaScriptの読み込み__
  - 任意の階層にjsを配置して読み込ませるには、functions.phpに以下のコードを書く。

```php
<?php 
function my_script() {
  wp_enqueue_script(
    // 重複しないよう呼び込むスクリプトの名称をつける
    'myscript',
    // 呼び出す関数までのパスを読み込む
    get_template_directory_uri().'/assets/js/behavior.js',
    // このjsを読み込む前に取り込んでおきたいjsがあればこの配列にパスを代入しておく
    array(),
    // true=> versionを出力する
    false,
    // true=>footerでjsを読み込む
    // false=>headerでjsを読み込む
    // HTMLが読まれてからjs読み込むのが吉なので、
    true
  );
}
add_action('wp_enqueue_scripts', 'my_script');
```

__JavaScriptの読み込み例__

まぁ、かなり冗長だけど、読めればいいわ。

```PHP
// JavaScriptを読み込む
function my_theme_enqueue_scripts()
{
  // 外部のJavaScriptファイルを読み込む
  wp_enqueue_script('pace-js', 'https://cdn.jsdelivr.net/npm/pace-js@latest/pace.min.js', array(), null, true);
  wp_enqueue_script('swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), null, true);

  // 内部のJavaScriptファイルを読み込む
  wp_enqueue_script('mobile-menu', get_template_directory_uri() . '/scripts/libs/mobile-menu.js', array(), null, true);
  wp_enqueue_script('hero-slider', get_template_directory_uri() . '/scripts/libs/hero-slider.js', array(), null, true);
  wp_enqueue_script('gsap', get_template_directory_uri() . '/scripts/vendors/gsap.min.js', array(), null, true);
  wp_enqueue_script('text-animation', get_template_directory_uri() . '/scripts/libs/text-animation.js', array(), null, true);
  wp_enqueue_script('scroll', get_template_directory_uri() . '/scripts/libs/scroll.js', array(), null, true);
  wp_enqueue_script('main-js', get_template_directory_uri() . '/scripts/main.js', array(), null, true);
}
```

## CSSの読み込み

__例__

```PHP
// CSSを読み込む
function my_theme_enqueue_styles()
{
  // メインスタイルシートを読み込む
  wp_enqueue_style('main-stylesheet', get_stylesheet_uri());

  // css-resetスタイルシートを読み込む
  wp_enqueue_style('css-reset', get_template_directory_uri() . '/styles/vendors/css-reset.css');
}

add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');
```

## リンク
- __固定ページのリンクへ飛ぶ__

```php
front-page.php
<?php echo home_url('/') ?>

archive.php
<?php echo home_url('/archive') ?>

category.php
<?php echo home_url('/category') ?>
```

- __HTMLから画像の呼び出し__
  - CSS, JSへのパスを通す。
  - 画像・動画・音楽までのパスを通しHTMLにレイアウトする。
  - これらをするために、`get_template_directory_uri()`関数を使って`テーマフォルダ`までの`パス`を取得する。

```php
<script src="<?php echo get_template_directory_uri(); ?>/path/to/js.file/"></script>

<img src="<?php echo get_template_directory_uri(); ?>/path/to/photo.file/" alt="">
```

- __a要素のファイルへのパス__

```php
<li><a href="/archive">全て</a></li>
```

- __パーマリンク設定__
  - 投稿ページのURLの付け方を設定する。ここは`投稿名`にする。
  - 投稿を新規追加する毎に、投稿ページのサイドバーにある`URL`から日本語になっている場合は適宜英語を割り当てて変更する。

<hr style="border: 5px dotted #aaa; background-color: transparent">

## 独自テーマの作成
`header`, `front-page`, `footer`という構成要素があったとして、それらの要素をWordPressの規則に則ってファイルで構成させる。

---
### 基礎となるサイトの作成

#### front-page.php

WordPressでは`index.php`にトップページの内容を書かない。
トップページの内容は、`front-page.php`という名称のファイルに記述する。

#### header

__スタイルシート設置の宣言__

head要素の該当箇所にCSSへのリンクをひく。

```php
<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
```

__wp_head()関数__

WordPressから出力されるJavaScript、他のphp、プラグインなどを呼び込む機能があるphpの関数を埋め込む。

```php
<?php wp_head(); ?>
```

__body_class()関数__

各ページの種類によって自動でclassを割り当ててくれる機能があるphpの関数を`body`要素に埋め込む。

```php
<body <?php body_class(); ?>>
```

__全体__
```php
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<header>
...
...
</header>
```

#### footer

__wp_footer()関数__

WordPressから出力されるJavaScript、他のphp、プラグインなどを呼び込む機能があるphpの関数を埋め込む。

```php
<?php wp_footer(); ?>
```

__全体__

```php
<footer>
  <small>footer here!</small>
</footer>
<?php wp_footer(); ?>
</body>

</html>
```

#### ファイル分断

`front-page.php`から、`header.php`と`footer.php`を作成し、上記までに作成した該当するコードをそれぞれのページに移す。

`front-page.php`には該当する箇所（行）に`header.php`と`footer.php`を呼び込むphpの関数を置く。

__front-page.php__

```php
<?php get_header(); ?>

contents

<?php get_footer(); ?>
```

以上が、独自ページの最低限の設定。

### コンポーネントを作る

カセット的に移築可能なコンポーネントを作る。念頭に置いているのは`Vue.js`。擬似的にWPのサイドバーを利用する。

#### function.phpの編集

__functions.php__

サイドバーの登録は、`theme_slug_widgets_init()`関数に`register_sidebar()`関数の引数へ配列に値として設定する。
`'name'`にはウィジェッドに登録される名称を入力する。
`'id'`で任意に設定した名称の『ー（ハイフン）』より右側がCSSでのクラス名。HTMLに埋め込む際`get_sidebar("ハイフンより右側の名称")`関数の引数となる。

__ウィジェットへの登録__
```php
function theme_slug_widgets_init() {
  register_sidebar(
    array(
      // ウィジェット上で認識される名前
      'name' => 'sidebarLeft',
      // ハイフンより右側が、
      // HTMLに埋め込む際に関数の引数
      // CSSでのクラス名
      'id' => 'sidebar-left',
    )
  );
  // 必要な分だけ『register_sidebar()』関数で定義していく。
  register_sidebar(
    array(
      'name' => 'sidebarRight',
      'id' => 'sidebar-right',
    )
  );
  ...
  ...
}
```

__コンポーネントとなるHTML（php）へphpを埋め込む__

`dynamic_sidebar()`関数に`functions.php`で設定した`'name'`キーの値を与える。

__sidebar-left.php, sidebar-right.php__

```php
<aside class="sidebar left">
  left side menu
  <ul class="widget">
    // phpを埋め込んだ範囲でWPが適当に構造を作るので
    // その要素に合わせてスタイルをつけていく。
    <?php dynamic_sidebar("sidebarLeft") ?>
  </ul>
</aside>
```

__レイアウトするため台紙となるHTML（php）へphpを挿し込む__

`get_sidebar()`関数に`functions.php`で設定した`id`の『ー（ハイフン）』より右側を名称を引数として渡す。

__front-page.php__

```php
<div class="wrapper">
  <?php get_sidebar("left"); ?>
  ...
  ...
  <?php get_sidebar("right"); ?>
</div>
```

---
### 投稿一覧ページの作成

#### archive.phpを作成

デフォルトで用意されている「投稿（post_type=’post’）」は、初期状態では、TOPページとは別の、独立したアーカイブURLが存在してないので、まずはこれを有効にするため`function.php`を編集する。

__function.php__

```php
// post_has_archive()関数の定義
function post_has_archive($args, $post_type) {
  if ('post' == $post_type) {
    $args['rewrite'] = true;
    // 任意のスラッグ名を登録←アーカイブページが有効になる。
    $args['has_archive'] = 'archive';
  }
  return $args;
}
add_filter('register_post_type_args', 'post_has_archive', 10, 2);
```

ヘッダーとフッターのコンポーネントを付けたら一覧ページの作成を開始。
ウィジェットの`投稿`ページにある『__全て__』の概要（インデックス）を出力させる。

ページに対して、have_posts()関数を送信してレスポンスがあれば、以下のコードに書いた関数に紐づいた値があるということで処理を進める。

__archive.php__

```php
// WPからテンプレートページの読み込みが必要だった。
<?php /* Template Name: ブログ　*/ ?>

<?php get_header(); ?>

<main>
  <ul class="post-archive">
    <?php
    // 一覧の後、ページネーションで必要になるコードでもある。
    //  get_query_var()関数に'paged'という引数を渡すと
    //  ページ数が返ってくる。
    //  ただし、最初は『0』が入るので、それを三項演算子を使い『1』に変更する。
    //  get_query_var('paged')がtrueならget_query_var('paged')を代入。
    //  get_query_var('paged')がfalseだったら『1』を代入する。
    $recent_page = get_query_var('paged') ? get_query_var('paged') : 1;
    $args = array(
      // defaultでは'post'。例えば'mesg'という名称のカスタム投稿を追加した場合は、
      // 'post_type' => 'mesg'として宣言する。
      'post_type' => 'post',
      // 投稿全体から3ページだけ取ってきてと命令してる。
      'posts_per_page' => 3,
      'paged' => $recent_page,
    );
    // 投稿に関する設定を入れた変数をWP_Query()関数の引数とする。
    $my_query = new WP_Query($args);
    // もし、投稿があれば、投稿が尽きるまでループする。ループしている間は次々にポストを投げ続ける。 
    if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post(); 
    ?>
    <li>
      <!--
      インスタンスの中で回して取れる　the_category();
      そのインスタンスのカテゴリー名を出してくれる便利な関数。
      以下の問題があるので注意。
      -->
      <!-- 『the_permalink()』の内側に、
              リスト要素を発生させるで生成させる
              『the_category()』を入れ子にすると、
              『the_permalink()』で生成したa要素の括りの構造を破壊する。
              回避方法は、『the_category()』を配列にして出力すること。  -->
      <a href="<?php the_permalink(); ?>">
        <div class="frame">
          <?php the_post_thumbnail(); ?>
        </div>
        <div class="header-sub">
          <ul class="post-categorie">
            <?php
            // 『the_category()』を配列にして出力すには、
            // 『get_the_category()関数』を使う。
            // 『the_category()』の属性が配列として取れた。
            $category = get_the_category();
            // name属性をキーにして値を取り出す。
            foreach ($category as $attr) {
              echo '<li>' . $attr->name . '</li>';
            }
            ?>
          </ul>
          <time datetime="<?php echo get_the_date("Y-m-d") ?>"><?php echo get_the_date("Y.m.d") ?></time>
        </div>
        <h4 class="shrinkLine"><?php the_title(); ?></h4>
        <?php
        add_filter('excerpt_length', function ($length) {
          return 50; //表示する文字数
        }, 999);
        ?>
        <p><?php the_excerpt(); ?></p>
      </a>
    </li>
    <?php endwhile; endif; ?>
  </ul>

  <!-- あしらいと装飾（<, >, ...）については、
        WPが書き出した要素を参照してSassで調節する。 -->
  <?php
  $args = array(
    'type' => 'list',
    'current' => $recent_page,
    'total' => $my_query->max_num_pages,
    'prev_text' => '<',
    'next_text' => '>',
  );
  echo paginate_links($args);
  ?>
</main>

<?php get_footer(); ?>
```

__一言コラム 中の肝心な箇所で使われるコードの意味を解説しておく。__
三項演算子を理解するためのサンプルコード
この原理を使った三項演算子での解決。

```php
<?php 
  if (get_query_var('paged')) {
    var_dump(get_query_var('paged'));
    var_dump('数字が入っているだからtrue');
  } else {
    var_dump(get_query_var('paged'));
    var_dump('数字が0だからfalse');
  }
?>
```

#### 投稿にアイキャッチ画像を紐付ける

投稿のアイキャッチになる画像を挿入する。画像の関連付けは、`ダッシュボード/投稿/投稿一覧`から各投稿を開いて右サイドバーの`アイキャッチ画像`で編集する。

#### アイキャッチ画像をレイアウトする

投稿をループしながら、該当する投稿の箇所に`the_post_thumbnail()`関数を`php`で埋め込む。

```php
<li>
  <a href="<?php the_permalink(); ?>">
    <!-- php ------------------------------ -->
    <?php the_post_thumbnail(); ?>
    <!------------------------------------- -->
    <h3><?php the_title(); ?></h3>
    <time><?php echo get_the_date('Y年m月d日'); ?></time>
    <p><?php the_excerpt(); ?></p>
  </a>
  <?php the_category(); ?>
</li>
```

埋め込まれた`php`は、以下のようなクラス名が付与された`img`要素となる。

```scss
a
  div.frame
    img.attachment-post-thumbnail
      &.size-post-thumbnail
      &.wp-post-image
```

クラス名または、要素名で指定する。

```scss
a
  display: block
  // img要素の場合
  img
    width: 100%
    height: 35vw
    object-fit: cover
    border-radius: 5px
```

#### 投稿のHTMLにbackground属性としてレイアウトする

`WP`で`background-image`属性を使う際は、`HTML`で`background-image`属性を指定し、`CSS`でその他に必要な指定をする。

```php
<li>
  <a href="<?php the_permalink(); ?>">
    <!-- background-image属性の指定 -->
    <div  
      class="thumbnail" 
      style="background-image:
        url(<? echo wp_get_attachment_url(get_post_thumbnail_id()); ?>)">
    </div>
    <h3><?php the_title(); ?></h3>
    ...
    ...
  </a>
  <?php the_category(); ?>
</li>
```

`CSS`へ`background-image`属性を指定した際に、残り必須の指定を付け加える。

```scss
.thumbnail
  width: 100%
  height: 35vw
  background-repeat: no-repeat
  background-position: center
  background-size: cover
  border-radius: 5px
```

---
### 投稿ページと固定ページ
固定ページ・投稿ページとも設定していない状態では、投稿ページのURL/パーマリンクにあるURLをクリックすると`index.php`へ飛んでしまう。

雛形となるページを編集する。
- 投稿ページは => `single.php`
- 固定ページは => `page.php`

#### 投稿ページ　single.php
HTML上で投稿記事の領域をクリックすると投稿内容の詳細ページへ飛ぶ仕様になっている。飛んだページ`single.php`のインスタンスが持っている関数を使ってフォーマットを編集する。こんな考え方がいいのかわからんが。。。

__ページの全体レイアウトの整理__
ページを新規で作る場合、ヘッダーとフッターのコンポーネントを埋め込む。
```php
<?php get_header(); ?>

<!-- ここにコンテンツ -->

<?php get_footer(); ?>
```

__中身のレイアウトを作成__

投稿のインスタンスで使える変数や関数

- $post
- get_the_post_thumbnail()
- the_title()
- the_content()
- the_category()
- get_the_date('Y年m月d日')
- the_modified_date("Y-m-d")

phpの変数を確認する方法は、

```php
<?php var_dump(変数) ?>
```

投稿に紐づいた内容を定義された変数や関数を使ってレイアウトを整える。

```php
<main>
  <section>
    <!-- 変数$postに何が入っているか調べる。 -->
    <?php var_dump($post) ?>
    <!-- サムネールを出力する。 -->
    <!-- 投稿された固定ページのID、出力するimg要素に付けるクラス名を引数にする。 -->
    <!-- そのクラス名にはプリフィックスが付与される。 -->
    <!-- この場合は、『.attachment-header-vusual』となる。 -->
    <?php echo get_the_post_thumbnail($post->ID, 'header-vusual'); ?>
    <!-- 投稿データから記事のタイトルを取得する。 -->
    <h1><?php the_title(); ?></h1>
    <div class="contents">
      <p>
        <!-- 投稿データから記事の本文を取得する。 -->
        <?php the_content(); ?>
      </p>
    </div>
  </section>
</main>
```

固定ページでは、`.page`クラス、投稿ページでは、`.single`クラスが付与される。定義する際には大元にそれらのクラスをつけてから展開していく。
なお、固定ページと投稿ページの体裁の共通をスタイリングさせて効率的にサイトを作成できる。

```scss
.page, .single
  main
    width: min(800px, 100%)
    margin: 50px auto
    background-color: #eee
    section
      padding: 45px
      .attachment-header-vusual
        width: 100%
        height: 60vw
        object-fit: cover
      h1
        font-size: 20px
        font-weight: 900
        margin: 20px 0
      p
        font-size: 15px
        font-weight: 500
        line-height: 1.7
```

__以下の要素を出力する関数でレイアウトしたサンプル__

- 画像にクラスの付与
- タイトル
- カテゴリー
- 本文
- 最終更新日

```php
<main>
  <section>
    <?php echo get_the_post_thumbnail($post->ID, 'header-vusual'); ?>
    <h1><?php the_title(); ?></h1>
    <!-- カテゴリーを出力する関数を挿木する。---------- -->
    <?php the_category(); ?>
    <!------------------------------------------- -->
    <div class="contents">
      <p>
        <?php the_content(); ?>
      </p>
      <p class="lastUpdate">
      <!-- 最終更新日を出力する関数を挿木する。------- -->
        最終更新日：<time datetime="<?php the_modified_date("Y-m-d"); ?>">
          <?php the_modified_date("Y/m/d"); ?>
        </time>
      <!---------------------------------------- -->
      </p>
    </div>
  </section>
</main>
```

#### 固定ページ　page.php

WEBサイトでは`ホーム`（WPでは`front-page.php`）と複数コンテンツを有するページ（`work`, `about`, `info`, `contact` etc...）で構成される。
`WP`は、これらの`ルーティング`を統括する機能を持つ。編集は、ダッシュボード／固定ページで行こなう。（なお、`archive.php`, `category.php`, `single.php`はデフォルトでルーティングは解決されている。）

##### 1. WPのダッシュボード上にコンテンツがあるページ

__用途：固定ページをお客さんがWPのダッシュボードから作成・編集したい場合。__

ページデザインのフォーマットになるページをテンプレート名：`固定ページ`として`page.php`という名称で作成する。

- `page.php`ファイルを作る。
- `<?php /* Template Name: 固定ページ */ ?>`を冒頭につける。
- ダッシュボード／固定ページでページを編集状態にして、先ほどのタグに付けた名称と同じものをタイトルに書く。
- URLを編集する。日本語になっているリンク名を`page`にする。
- これによりWPのダッシュボード／固定ページでページテンプレートとして登録される。
- `<?php the_content(); ?>`としておく。ダッシュボード上からページを編集した内容が反映される。

```php
<?php /* Template Name: 固定ページ */ ?>

// ヘッダー
<?php get_header(); ?>

// WPの『ダッシュボード』で『編集』するコンテンツ本体
<?php the_content(); ?>

// フッター
<?php get_footer(); ?>
```

このテンプレートを利用して新たに固定ページを作成する。
- phpファイルは必要ない。
- WPのダッシュボード／固定ページからページを新規作成し編集画面を出す。
- 任意で命名したタイトルが固定ページ名となる。
- URLを任意の英語に変更しておく。
- テンプレートのプルダウンメニューから`固定ページ`を選択する。
- あとは、その編集画面内で編集を進める。

##### 2. phpファイルを編集して作る

__用途：制作側で作るページ__

- `page-任意の名称.php`でファイルを作る。

```php
// ヘッダー
<?php get_header(); ?>

ここへ内容を書いていく。

// フッター
<?php get_footer(); ?>
```

- WPのダッシュボード／固定ページからページを新規作成し編集画面を出す。
- 任意で命名したタイトルが固定ページ名となる。
- __URLを任意の英語に変更しておく。これでルーティング完了！__
- 付けた英語名でアクセス。

### カテゴリーに紐づく投稿一覧の表示

カテゴリに紐づいた投稿は、投稿一覧と同様に__defaultでファイル名が決まっている。__
- category.php

#### archive.phpを作成

<!-- まずは、投稿一覧ページを作成する。

留意点として、`function.php`での設定は、投稿の一覧ページやカテゴリー一覧ページの生成とは __何の関係もないということ__。

__function.php__

```php
// post_has_archive()関数の定義
function post_has_archive($args, $post_type) {
  if ('post' == $post_type) {
    $args['rewrite'] = true;
    // 混乱するので、アーカイブにつけるスラッグ名(url)は
    // ファイル名と同じにする。
    $args['has_archive'] = 'archive';
  }
  return $args;
}
add_filter('register_post_type_args', 'post_has_archive', 10, 2);
```

__archive.php__

ページネーションをつけて投稿一覧を出力するやり方。
フォーマットで持っておいてコピペすべし。

```php
<?php get_header(); ?>
<div class="container">
  <div class="contents">
    <h1>投稿一覧</h1>
    <ul class="posts-list">
      <?php
      // 一覧の後、ページネーションで必要になるコード。
      //   get_query_var()関数に'paged'という引数を渡すと
      //   ページ数が返ってくる。
      //   ただし、最初は『0』が入るので、それを三項演算子を使い『1』に変更する。
      //   get_query_var('paged')がtrueならget_query_var('paged')を代入。
      //   get_query_var('paged')がfalseだったら『1』を代入する。
      $recent_page = get_query_var('paged') ? get_query_var('paged') : 1;
      // このページ内で表示する投稿の数を指定する。この場合は『3件』
      $args = array('posts_per_page' => 3);
      // WPのDBからのインスタンスにこの場合は『設定した制限数』を引数としてとる。
      $my_query = new WP_Query($args);
      // 3件の投稿を持っていたら、3件を最後まで回す。
      if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post(); 
      ?>
      // the_permalink()関数を呼んだら、現在の投稿のリンクを出力して、
      <li>
        <a href="<?php the_permalink(); ?>">
          // the_title()関数を呼んだらタイトルを出力して、
          <h3><?php the_title(); ?></h3>
          // the_excerpt()関数を呼んだら本文を出力する。
          <p><?php the_excerpt(); ?></p>
        </a>
      </li>
      <?php endwhile; endif; ?>
    </ul> 

    // ページネーションのリストを生成してくれる。
    // 必要な要素はWPが書き出すので、それに合わせてスタイルをつけていくこと。
    <?php 
      $args = array(
        'type' => 'list',
        'current' => $recent_page,
        'total' => $my_query->max_num_pages,
        'prev_text' => '<',
        'next_text' => '>'
      );
      echo paginate_links($args);
    ?>
  </div>
</div>
<?php get_footer(); ?>
``` -->




---
__カテゴリーに紐づく投稿__

archive.phpの一部だけ改造してやる。

__category.php__

```php
<div class="container">
  <div class="contents">
    <!-- 投稿の一覧ページの`カテゴリー`をクリックするとこのページに飛ぶようにデフォルトで紐づけられている。
    このページ自体が『選択した`カテゴリー`』の`インスタンス`である、それに対する関数を`WP`は定義している。
    それらを使って欲しい情報を適宜出力してページにレイアウトすると考える。 -->
    <!-- 『single_cat_title()』関数でカテゴリー名を出力する。 -->
    <h1><?php single_cat_title(); ?>カテゴリーの一覧</h1>
    <dl>
      <?php // ページ番号を取得する。1ページ目は『0』になるので条件節で変換する。
      $recent_page = get_query_var('paged') ? get_query_var('paged') : 1;
      // 現在カテゴリーの情報を『get_the_category()』関数で引き出す。
      $category = get_the_category();
      // $categoryはオブジェクトで値は一つだけなのでインデックス[0]と特定して呼び出す。
      // キー『slug（url）』に紐づいた値＝現在いるカテゴリーの名称を引き出すという流れ。
      // var_dump($category[0]->slug);
      // var_dump($category[0]);
      $args = array(
        // これはカスタム投稿じゃないからデフォルトのまま。なお省略可能。
        // 'post_type' => 'post',
        // 現在のカテゴリー（オブジェクト）をslug（url）（キー）を参照して値を変数に格納する。
        'category_name' => $category[0]->slug,
        // 『-1』は、あるだけ全部出してという意味
        'posts_per_page' => -1,
        // このインスタンスで定義された変数。現在のカテゴリーに対して現在のページ番号が格納されてる。
        'paged' => $recent_page
        // オプションが多数あり、下記参照。
        // 'orderby' => 
      );
      $my_query = new WP_Query($args); ?>

      <?php if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post(); ?>
          <a href="<?php the_permalink(); ?>">
            <dt><?php the_title(); ?></dt>
            <dd><?php the_excerpt(); ?></dd>
          </a>
        <?php endwhile; ?>
      <?php endif; ?>
    </dl>

    <!-- パンくずリスト -->
    <!-- このリストもWPが構造を書き出す。それに合わせてスタイルをつける。 -->
    <?php
      $args = array(
        'type' => 'list',
        'current' => $recent_page,
        // 現在のインスタンス、つまり全ページの総数を変数に格納している。
        'total' => $my_query->max_num_pages,
        // 記号は適宜
        'prev_text' => '<',
        'next_text' => '>'
      );
      // 『paginate_links()』関数の1行でパンくずリストを出力してる。
      echo paginate_links($args);
    ?>
  </div>
</div>
```
---

### the_category()関数で留意すべき点

WPの`the_permalink()`関数は、HTML要素を新たに生成させて構造を作る。
`the_category()`関数を入れ子にすると、`the_permalink()`関数で生成した構造を破壊してしまう。
`the_category()`関数からの出力を配列に変換してして出力して回避する。

```php
<ul class="post-archive">
    <?php
    $args = array('posts_per_page' => 3);
    $my_query = new WP_Query($args);
    if ($my_query->have_posts()) : while ($my_query->have_posts()) : $my_query->the_post();
    ?>
        <li>
          <a href="<?php the_permalink(); ?>">
            <div class="frame">
              <?php the_post_thumbnail(); ?>
            </div>
            <div class="header-sub">
              <ul class="post-categorie">
              // この部分 //////////////////////////////////////////////
                <?php
                  $category = get_the_category();
                  // name属性をキーにして値を取り出す。
                  // 文字列になったカテゴリー名を渡す。
                  foreach ($category as $attr) {
                    echo '<li>' . $attr->name . '</li>';
                  }
                ?>
              // ↑ ここまで ///////////////////////////////////////////
              </ul>
              <time datetime="<?php echo get_the_date("Y-m-d") ?>"><?php echo get_the_date("Y年m月d日") ?></time>
            </div>
            <h4 class="shrinkLine"><?php the_title(); ?></h4>
            <p><?php the_excerpt(); ?></p>
            <p><?php the_category(); ?></p>
          </a>
        </li>
      <?php endwhile; ?>
    <?php endif; ?>
  </ul>
```


### 'offset'=>1と投稿インデックスの文字数制限

最初のページをスキップするオプション

```php
  <ul class="post-archive">
    <?php
      $recent_page = get_query_var('paged') ? get_query_var('paged') : 1;
      $args = array(
        // defaultでは'post'。例えば'mesg'という名称のカスタム投稿を追加した場合は、
        // 'post_type' => 'mesg'として宣言する。
        'post_type' => 'post',
        'posts_per_page' => 3,
        'paged' => $recent_page,
        'offset' => 1
    );
    $my_query = new WP_Query($args);
    ?>
    <?php if ($my_query->have_posts()) : ?>
      <?php while ($my_query->have_posts()) : ?>
        <?php $my_query->the_post(); ?>
        <li>
          <a href="<?php the_permalink(); ?>">
            <div class="frame">
              <?php the_post_thumbnail(); ?>
            </div>
            <div class="header-sub">
              <ul class="post-categorie">
                <?php
                  $category = get_the_category();
                  foreach ($category as $attr) {
                    echo '<li>' . $attr->name . '</li>';
                  }
                ?>
              </ul>
              <time datetime="<?php echo get_the_date("Y-m-d") ?>"><?php echo get_the_date("Y.m.d") ?></time>
            </div>
            <h4 class="shrinkLine"><?php the_title(); ?></h4>
            <?php
              add_filter('excerpt_length', function ($length) {
                return 50; //表示する文字数
              }, 999);
            ?>
            <p><?php the_excerpt(); ?></p>
          </a>
        </li>
      <?php endwhile; ?>
    <?php endif; ?>
  </ul>
```















<hr style="border: 5px dotted #aaa; background-color: transparent">

## 独自テーマでカスタムメニューを設定・表示させる

### ページやコンテンツへのリンク集（navigation link menu）の作成

__HTML側で`link-pages`と命名した`navigation link menu`をこの場所で展開すると宣言する。__

__HTML__
```php
<header>
  <?php 
    wp_nav_menu(array(
      'theme_location' => 'link-pages'
    ))
  ?>
</header>
```

__`functions.php`で、ダッシュボードに登録したメニューの名称を紐づける。__

__functions.php__

```php
register_nav_menus(array(
  'link-pages' => 'link_pages',
));
```

__ダッシュボード／外観／メニューで`link_pages`という名称でメニューを作成し、展開したいページを追加、表示順の整理をする。__
__`メニュー設定／メニューの位置`では、必ず`同じ名称`を選択しておく。__

あとは勝手にWPがリストを生成してくれるという段取り。

```
<div class="menu-link_pages-container">
  <ul id="menu-link_pages" class="menu">
    <li id="menu-item-97" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-97">
      <a href="http://geekpictures.local/who-we-are/">
        Who We Are
      </a>
    </li>
    ...
    ...
    ...
  </ul>
</div
```


<hr style="border: 5px dotted #aaa; background-color: transparent">

<hr style="border: 5px dotted #aaa; background-color: transparent">

## スカスカのページのフッターを底ベタさせる方法

```scss
.page, .single
  position: relative
  // min-heightが肝
  min-height: 100vh // footerの高さ
  padding-bottom: 100px　// footerの高さ
  footer
    position: absolute
    bottom: 0
    left: 0
    width: 100%
    height: 100px　// ここに注意
    color: #fff
    background-color: #333
```

<hr style="border: 5px dotted #aaa; background-color: transparent">

<hr style="border: 5px dotted #aaa; background-color: transparent">

##　カテゴリー名を出力する

カテゴリー名を任意の順番で出力する。

- `ダッシュボード／投稿／カテゴリー`を開く。
- 各項目の説明に順番にしたい番号を入力する。
- `usort()`関数を使ってカテゴリー内の順番を変更して`foreach`で出力する。

```php
<ul class="items">
  <li><a href="/archive">全て</a></li>
  <?php
  $categories_list = get_categories();
  usort($categories_list, function ($a, $b) {
    return $a->description - $b->description;
  });
  foreach ($categories_list as $value) {
    echo '<li><a href="' . home_url('/') . 'category/' . $value->slug . '">' . $value->name . '</a></li>';
  }
  ?>
</ul>
```
<hr style="border: 5px dotted #aaa; background-color: transparent">

## カスタム投稿

- プラグイン`Custom Post Type UI`を使用する。
- ダッシュボード／CPT UI／新規投稿タイプを追加する。
  - 投稿タイプスラッグ => slugと紐づくので英語で記入する。
  - 複数形ラベル　ダッシュボード内での管理名　日本語で記入する。
    単数形ラベル　ダッシュボード内での管理名　日本語で記入する。
- `投稿タイプを追加`ボタンをクリックする。
- ダッシュボードに複数形ラベルで付けた名称の項目が追加される。
- 該当項目をクリックして編集ページへ
- ページを追加するため、`新規追加`ボタンを押してページ編集画面へ。
- タイトル・本文を入れて公開する。
- ダッシュボードの項目`CTP UI`から`タクソノミーの追加と編集`をクリックし`タクソノミーの編集`タブに入る。
- `選択`のプルダウンメニューから`複数形ラベルで付けた名称の項目`を選択する。
- 管理画面が便利になるので、`追加ラベル`の欄で以下の項目を`True`にする。
  - `管理画面でカラムを表示` => true
  - `クイック編集/一括編集パネルに表示` => true
- `複数形ラベルで付けた名称の項目`のカスタムページを作成する。



```php
<?php
$args = array(
  // 投稿タイプスラッグ => slugと紐づくので英語で記入するして名称を登録する。
  'post_type' => 'meeting',
  'posts_per_page' => 3
);
// 変数名をユニークにしておく。
$meeting_query = new WP_Query($args)
?>

<ul>
  // 投稿をカスタム投稿に限定する設定。
  <?php if ($meeting_query->have_posts()) : while ($meeting_query->have_posts()) : $meeting_query->the_post(); ?>
      <li>
        <a href="<?php the_permalink(); ?>">
          <h3><?php the_title(); ?></h3>
          <p><?php the_content(); ?></p>
        </a>
      </li>
  <?php endwhile;
  endif; ?>
</ul>
```


<hr style="border: 5px dotted #aaa; background-color: transparent">

## ページを作成してURLを付けWPDBへ認識させる

- 『`page-`ページ名称（英語）.php』でページのファイルを作成。
- `ダッシュボード／固定ページ／新規追加`でページのインスタンスをWEBページ上で運用する名称（日本語可能）で生成する。
- 当該ページ（のインスタンス）を編集状態で開き、`URL`末尾の文字列を作成したページの『ファイル名』で置き換える。この時点で編集するファイルとURLが紐づく。
- `ダッシュボード／外観／メニュー`で各ページへのリンクを収集したメニューのインスタンス（配列）へ登録する。

<hr style="border: 5px dotted #aaa; background-color: transparent">

## 各ページへのリンクを収集したメニューのインスタンス（配列）生成

- HTML（php）へ展開したいリンク（つまりWPDBから引っ張ってくる配列を定義する。例では`nav-link`とする。

__header.php__
```php
<?php
  wp_nav_menu(array(
    'theme_location' => 'nav-link'
  ))
?>
```

- `ダッシュボード／外観／メニュー`でリンクメニューのインスタンス（配列）を例えば`nav_lin`として作成する。当該インスタンス名を`functions.php`へ登録する。
- 左辺がHTML側の名称、右辺がWP側。ここでフロントエンドとWPDBを繋げる。ここの配列へページ内で使用するメニューのリンク群を登録していく。

__function.php__
```php
register_nav_menus(array(
  'nav-link' => 'nav_link',
));
```

バックエンドの知識が無くてもルーティングができてしまう。
カテゴリー、タグ、時間などで情報の振り分けができて、それらをHTML上へ表示できる仕組み。
WEB制作のスタンダードということの意味がわかった。

<hr style="border: 5px dotted #aaa; background-color: transparent">

## コンタクトフォーム7で作成したフォームデータをHTMLに埋め込む

```php
<!-- WPのコンタクトフォームを挿入 -->
<?php echo do_shortcode('[contact-form-7 id="174" title="contact-form"]') ?>
```

<hr style="border: 5px dotted #aaa; background-color: transparent">


### 【WordPress】出力する投稿記事のタイトルと本文の文字数を制限する方法

```html
<!-- 文字数制限なし -->
<?php the_title(); ?>

<!-- 10文字制限 -->
<?php echo wp_trim_words( get_the_title(), 10, '…' ); ?>

<!-- 文字数制限なし(本文の抜粋) -->
<?php the_excerpt(); ?>

<!-- 40文字制限 -->
<?php echo wp_trim_words( get_the_content(), 40, '…' ); ?>

<!-- タイトル40文字制限 -->
<?php echo wp_trim_words( get_the_title(), 40, '[続く]' ); ?>

<!-- 本文40文字制限 -->
<?php echo wp_trim_words( get_the_content(), 40, '[続く]' ); ?>
```

<hr style="border: 5px dotted #aaa; background-color: transparent">

## archive, category pageについて

ファイル名で自動で認識してルーティングをしてくれるわけではない。

まず、ファイル作成。

```php
<?php get_header(); ?>

<h1 style="font-size: 100px;">category</h1>

<?php get_footer(); ?>
```

WPダッシュボード／固定ページから
- 新規作成でタイトルに『カテゴリー一覧』を入力
- スラッグに適当な英語名を入力
以上で繋がる。


<hr style="border: 5px dotted #aaa; background-color: transparent">

## tag　out

```html
<ul>
  <?php
  $posttags = get_tags();
  if ($posttags) {
    foreach ($posttags as $tag) {
      echo '<li><a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a></li>';
    }
  }
  ?>
</ul>
```

```html
<ul>
  <?php
  $posttags = get_tags();
  if ($posttags) {
    foreach ($posttags as $tag) {
      echo '<li><a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a> (' . $tag->count . ')</li>';
    }
  }
  ?>
</ul>
```

```html
<ul>
  <?php
  $args = array(
    'orderby' => 'count',
    'order' => 'desc',
    'number' => 10
  );
  $tags = get_terms('post_tag', $args);
  foreach ($tags as $value) {
    echo '<li><a href="' . get_tag_link($value->term_id) . '">' . $value->name . ' (' . $value->count . ')</a></li>';
  }
  ?>
</ul>
```




<hr style="border: 5px dotted #aaa; background-color: transparent">







## WordPressのWP_Queryでよく使うコードスニペット
```php
<?php
$args = array(
  // 特定の「著者」に関連付けられた投稿を表示する場合
  'author' => '1,2,3',                     // 著者IDを指定
  'author_name' => 'solecolor',            // user_nicenameを指定（名前ではありません）
  'author__in' => array(2, 6),             // 著者IDを配列で指定（著者IDを含む記事を絞り込む）
  'author__not_in' => array(2, 6),         // 著者IDを配列で指定（著者IDを含まない記事を絞り込む）

  // 特定の「カテゴリー」に関連付けられた投稿を表示する場合
  'cat' => 5,                              // カテゴリーIDを指定
  'category_name' => 'daily, news',        // カテゴリースラッグを指定（複数の場合は「,」で区切る）
  'category__and' => array(2, 6),          // カテゴリーIDを配列で指定（カテゴリーIDを含む記事を絞り込む）
  'category__in' => array(2, 6),           // カテゴリーIDを配列で指定（カテゴリーIDを含む記事を絞り込む）
  'category__not_in' => array(2, 6),       // カテゴリーIDを配列で指定（カテゴリーIDを含まない記事を絞り込む）

  // 特定の「タグ」に関連付けられた投稿を表示する場合
  'tag' => 'cooking',                      // タグスラッグを指定
  'tag_id' => 5,                           // タグIDを指定
  'tag__and' => array(2, 6),               // タグIDを配列で指定（タグIDを含む記事を絞り込む）
  'tag__in' => array(2, 6),                // タグIDを配列で指定（タグIDを含む記事を絞り込む）
  'tag__not_in' => array(2, 6),            // タグIDを配列で指定（タグIDを含まない記事を絞り込む）
  'tag_slug__and' => array('red', 'blue'), // タグスラッグを配列で指定（タグスラッグを含む記事を絞り込む）
  'tag_slug__in' => array('red', 'blue'),  // タグスラッグを配列で指定（タグスラッグを含む記事を絞り込む）

  // 特定の「タクソノミー」に関連付けられた投稿を表示する場合（以下は複数のタクソノミーにてAND検索）
  'tax_query' => array(                // タクソノミーパラメーターを指定
    'relation' => 'AND',               // タクソノミーの検索条件に 'AND' か 'OR' が使用可能
    array(
      'taxonomy' => 'color',           // タクソノミーを指定
      'field' => 'slug',               // term_id(デフォルト),name,slug のいずれかのタームの種類を選択
      'terms' => array('red', 'blue'), // ターム(文字列かIDを指定)
      'include_children' => true,      // 階層を持つタクソノミーの場合に、子孫タクソノミーを含めるかどうか
      'operator' => 'IN'               // 演算子'IN','NOT IN','AND','EXISTS'(4.1.0以降),'NOT EXISTS'(4.1.0以降)が利用可能
    ),
    array(
      'taxonomy' => 'actor',
      'field' => 'id',
      'terms' => array(103, 115, 206),
      'include_children' => false,
      'operator' => 'NOT IN'
    )
  ),

  // 特定の「投稿＆固定ページ」に関連付けられた投稿を表示する場合
  'p' => 1,                                 // 投稿IDを指定
  'name' => 'hello-world',                  // 投稿スラッグを指定
  'page_id' => 1,                           // 固定ページのIDを指定
  'pagename' => 'sample-page',              // ページスラッグを指定
  'pagename' => 'contact_us/canada',        // 子ページを表示する場合、スラッシュ区切りで親と子のスラッグを指定
  'post_parent' => 1,                       // ページIDを指定した子ページを表示
  'post_parent__in' => array(1, 2, 3),      // 配列の親ページIDを含む投稿を表示
  'post_parent__not_in' => array(1, 2, 3),  // 配列の親ページIDを含まない投稿を表示
  'post__in' => array(1, 2, 3),             // 配列の投稿IDを含む投稿を表示
  'post__not_in' => array(1, 2, 3),         // 配列の投稿IDを含まない投稿を表示

  // 特定の「パスワード」に関連付けられた投稿を表示する場合
  'has_password' => true,                   // パスワード付きの投稿を表示( true or false )
  'post_password' => 'zxcvbn',              // 特定のパスワードが付いた投稿を表示

  // 特定の「タイプ」に関連付けられた投稿を表示する場合
  'post_type' => array(
    'post',               // 投稿
    'page',               // 固定ページ
    'revision',           // リビジョン
    'attachment',         // 添付ファイル
    'custom-post-type'    // カスタム投稿タイプ
  ),
  'post_type' => 'any',   // すべてのタイプを含めて表示(リビジョンと'exclude_from_search'がtrueにセットされたものを除く)

  // 特定の「投稿ステータス」に関連付けられた投稿を表示する場合
  'post_status' => array( // 投稿ステータスを指定 (デフォルト'publish')        
    'publish',            // 公開された投稿、または固定ページを表示
    'pending',            // レビュー待ちの投稿を表示
    'draft',              // 下書きの投稿を表示
    'auto-draft',         // コンテンツのない、新しく作成された投稿を表示
    'future',             // 予約公開設定された投稿を表示
    'private',            // ログインしていないユーザーには見えない投稿を表示
    'inherit',            // リビジョンを表示
    'trash',              // ゴミ箱に入った投稿を表示
  ),
  'post_status' => 'any', // すべてのステータスを表示(投稿タイプで'exclude_from_search'がtrueにセットされたものを除く)

  // ページ送りパラメーターを設定する場合
  'posts_per_page' => 10,            // 1ページあたりに表示する投稿数を指定(-1を指定するとすべての投稿を表示)
  'posts_per_archive_page' => 10,    // 1ページあたりに表示する投稿数(アーカイブページのみ)
  'nopaging' => false,               // ページ送りを使用するか、すべての投稿を表示するか、(デフォルトはfalseでページ送りを使用)
  'paged' => 6,                      // ページ番号6の記事を表示
  'paged' => get_query_var('paged'), // 現在のページから投稿を表示
  'offset' => 3,                     // 設定した数だけ、ずらして表示(例では4番目の投稿から表示)
  'ignore_sticky_posts' => false,    // 先頭固定表示投稿を無視するかどうか(デフォルト値は0で先頭固定表示投稿を無視しない)

  // 「投稿の並び順」を指定する場合
  'order' => 'DESC',    // 'ASC' 昇順  (1, 2, 3; a, b, c)
  // 'DESC' 降順 (3, 2, 1; c, b, a)

  'orderby' => 'date',  // デフォルト値'date' 複数のオプションを渡すことが可能
  'orderby' => 'modified',  // デフォルト値'date' 複数のオプションを渡すことが可能
  // 例：'orderby' => 'menu_order title'
  // その他のオプション ↓
  'none'                // 並び替えなし
  'ID'                  // 投稿IDで並び替え
  'author'              // 著者で並び替え
  'title'               // タイトルで並び替え
  'name'                // Order by post name(post slug)
  'modified'            // 更新日で並び替え
  'parent'              // 親ページIDで並び替え
  'rand'                // ランダム順
  'comment_count'       // コメント数で並び替え
  'menu_order'          // ページの表示順で並び替え
  'meta_value'          // アルファベット順で並び替え(数値ではうまくいかない)
  'meta_value_num'      // 数値で並び替え
  'post__in'            // post__inで配列で指定された投稿IDの並び順を維持して表示

  // 特定の「時間や日付の期間」に関連付けられた投稿を表示する場合
  'year' => 2015,       // 4桁の年を数字で指定(2015など)
  'monthnum' => 4,      // 月を数字で指定( 1～12 )
  'w' =>  25,           // 年内の週を数字で指定( 0～53 )
  'day' => 17,          // 月内の日を数字で指定( 1～31 )
  'hour' => 13,         // 時間を数字で指定（ 0～23 ）
  'minute' => 19,       // 分を数字で指定( 0～60 )
  'second' => 30,       // 秒を数字で指定( 0～60 )
  'm' => 201404,        // 年と月を数字で指定 ( 201508など )

  // 「○年○月○日から○年○月○日の範囲の投稿情報」を表示する場合(投稿日の検索が自由自在!)
  'date_query' => array(
    array(
      'year' => 2015,          // 4桁の年を数字で指定(2015など)
      'month' => 8,            // 月を数字で指定( 1～12 )
      'week' => 31,            // 年内の週を数字で指定( 0～53 )
      'day' => 5,              // 月内の日を数字で指定( 1～31 )
      'hour' => 2,             // 時間を数字で指定（ 0～23 ）
      'minute' => 3,           // 分を数字で指定( 0～60 )
      'second' => 36,          // 秒を数字で指定( 0～60 )
      'after' => 'January 1st, 2013', 
                               // 指定した日付以降の投稿を取得。strtotime()と互換性のある文字列で'after'=>'2015/08/31'などでもOK
      'before' => array(       // 指定した日付以前の投稿を取得。strtotime()と互換性のある文字列で'before'=>'2015/08/31'などでもOK
        'year'  => 2013,       // 4桁の年を数字で指定(2015など) デフォルトは空
        'month' => 2,          // 年内の月を数字で指定( 1～12 ) デフォルトは12
        'day'   => 28,         // 月内の日を数字で指定( 1～31 ) デフォルトは月内の末日
      ),
      'inclusive' => true,     //「after」または「before」パラメーターで指定された値を含むかどうか
      'compare' => '=',        // 使用可能な値は '=', '!=', '>', '>=', '<', '<=', 'LIKE', 'NOT LIKE', 'IN', 'NOT IN', 'BETWEEN', 'NOT BETWEEN', 'EXISTS' , and 'NOT EXISTS'
      'column' => 'post_date', // 照会するカラムを指定。デフォルトは「post_date」
      'relation' => 'AND',     // OR または AND デフォルトは「AND」
    ),
  ),

  // 特定の「カスタムフィールド」に関連付けられた投稿を表示する場合
  'meta_key' => 'key',     // カスタムフィールドのキーを指定
  'meta_value' => 'value', // カスタムフィールドの値を指定
  'meta_value_num' => 10,  // カスタムフィールドの値を指定
  'meta_compare' => '=',   //「meta_value」をテストする演算子。使える値は'!='、'>'、'>='、'<'、'=' デフォルト値は'='
  'meta_query' => array(   // カスタムフィールドパラメーター
    'relation' => 'AND',   // 「AND」または「OR」を指定。meta_query内の配列が「2つ以上」の場合に限る。meta_query配列が1つの場合は使用しない。
    array(
      'key' => 'color',    // カスタムフィールドのキー。
      'value' => 'blue',   // カスタムフィールドの値 (注意 compareの値が'IN'、'NOT IN'、'BETWEEN'、'NOT BETWEEN'のみ配列をサポート)
      'type' => 'CHAR',    // カスタムフィールドタイプ。タイプについては以下の「meta_queryで使えるデータ型」参照
      'compare' => '=',    // 演算子を指定 デフォルト値は'=' 演算子の種類については以下「meta_queryで指定できる演算子の種類」参照
    ),
    array(
      'key' => 'price',
      'value' => array(1, 200),
      'compare' => 'NOT LIKE',
    )
  ),

  // 適切な権限を持っているユーザーのプライベートの記事を表示する場合
  'perm' => 'readable',    // 使える値は’readable’と’editable’

  // キャッシュ系のパラメーター
  'cache_results' => true,           // 投稿情報をキャッシュするかどうか デフォルトはtrue
  'update_post_term_cache' => true,  // 投稿タームキャッシュを更新するかどうか デフォルトはtrue
  'update_post_meta_cache' => true,  // 投稿メタキャッシュを更新するかどうか デフォルトはtrue
  'no_found_rows' => false,          // カウントをスキップする？ tureでパフォーマンスが向上する可能性があるかも デフォルトはfalse

  // 検索系のパラメーター
  's' => $s, // 検索からクエリーストリング値を渡します。 
  'exact' => true, //タイトル／投稿の全体から正確なキーワードで検索するか デフォルト値はfalse
  'sentence' => true, //語句(フレーズ検索)で検索するか デフォルト値はfalse

  // 投稿フィールドパラメーター
  'fields' => 'ids' //１つのフィールドで返すか全てのフィールドで返すか デフォルトでは全てのフィールドが返される
  // 使用できる値
  // 'ids' 投稿のIDの配列を返します
  // 'id=>parent' 連想配列を返します
);

$query = new WP_Query($args);

if ($the_query->have_posts()) :
  while ($the_query->have_posts()) : $the_query->the_post();
  // 何かしらの処理
  endwhile;
endif;

// 投稿データのリセット
wp_reset_query();
?>
```

<hr style="border: 5px dotted #aaa; background-color: transparent">

## 構文
```php
<!-- 宣言 -->
<!-- ここから始まる、ここで終わる宣言が必要。 -->
<?php  ?>

<!-- 文字を出力する。要素も出力できる。 -->
<p><?php echo 'hello world!' ?></p>

<!-- 変数を使って文字列を出力する。 -->
<?php $str = 'WordPress'; ?>
<p><?php echo $str; ?></p>

<!-- 文字列を結合する。 -->
<?php
  $text = 'hello, ';
  $str = 'world!';
?>
<p><?php echo $text . $str; ?></p>

<!-- 配列 -->
<?php
$arr1 = array('晴れ', '曇り', '雨');
$arr2 = ['晴れ', '曇り', '雨'];
var_dump($arr2);
echo $arr1[0] . '<br>';
foreach ($arr1 as $key => $val) {
  echo $val . '<br>';
}
?>

<!-- 配列はechoできない。var_dump()で確認。 -->
<?php var_dump($arr2); ?>

<!-- if条件文 -->
<?php
$a = 2;
$b = 1;
if ($a > $b) {
  echo 'aはbより大きい';
} elseif ($a === $b) {
  echo 'aはbと同じ';
} else {
  echo 'aはbより小さい';
}
?>

<!-- 関数 -->
<!-- 関数を定義してみる -->
<?php 
  function calc($a, $b) {
    echo '<p>' . ($a + $b) . '</p>';
  }
  calc(5, 20);
?>
```