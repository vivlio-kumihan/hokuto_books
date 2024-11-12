<?php echo '<?xml version="1.0" encoding="utf-8"?>' . "\n"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja" id="Top">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo(charset); ?>" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>「<?php echo wp_specialchars($s, 1); ?>」の検索結果｜<?php bloginfo('name'); ?></title>
  <meta http-equiv="Content-Style-Type" content="text/css" />
  <meta http-equiv="Content-Script-Type" content="text/javascript" />
  <link rel="stylesheet" type="text/css" href="http://localhost:8888/common/css/page.css" />
  <link rel="stylesheet" type="text/css" href="http://localhost:8888/common/css/print.css" media="print" />
  <link rel="stylesheet" type="text/css" href="http://localhost:8888/common/css/fontMiddle.css" id="fontsize" />
  <link rel="stylesheet" type="text/css" href="http://localhost:8888/common/css/global.css" />
  <meta name="author" content="" />
  <meta name="version" content="12.06.01" />
  <link rel="contents" href="/" title="ホーム" />
  <link rev="made" href="mailto:info@hokutoshobo.jp" />
  <?php wp_enqueue_script('jquery'); ?>
  <?php wp_enqueue_script('cookie', 'http://localhost:8888/hokuto-bs/common/js/jquery.cookie.js'); ?>
  <?php wp_enqueue_script('setup', 'http://localhost:8888/hokuto-bs/common/js/setup.js'); ?>
  <?php wp_head(); ?>
  <!--[if lte IE 6]>  
<script type="text/javascript" src="http://localhost:8888/hokuto-bs/common/js/DD_belatedPNG.js">  
</script>  
<script type="text/javascript">  /* DD_belatedPNG */  DD_belatedPNG.fix('img,.pngFix,#FootInner h2,#FootInner .footMenuTop ul li a,#FootInner .footSiteMap ul li.child a,#FootInner .footSiteMap ul li a');</script> 
<![endif]-->
  <?php include_once("analyticstracking.php") ?>
</head>

<body id="Pagesearch">
  <div id="Header">
    <h1 class="desc">
      <?php bloginfo('description'); ?>
    </h1>
    <p class="logo"><a href="/"><img src="http://localhost:8888/hokuto-bs/common/img/logo.png" alt="<?php bloginfo('name'); ?>" /></a></p>
    <div class="headInfo">
      <p class="btContact"><a href="http://localhost:8888/hokuto-bs/contact/index.html">お問い合わせ</a></p>
      <p class="telNo">お電話でのお問い合わせ 075-791-6125</p>
    </div>
    <div class="btCaps">
      <p class="capsTitle">文字サイズの変更</p>
      <ul>
        <li class="btCaps01"><a href="javascript:void(0);" onclick="switchFontsize('fontSmall'); return false;">小</a></li>
        <li class="btCaps02"><a href="javascript:void(0);" onclick="switchFontsize('fontMiddle'); return false;">中</a></li>
        <li class="btCaps03"><a href="javascript:void(0);" onclick="switchFontsize('fontLarge'); return false;">大</a></li>
      </ul>
    </div>
    <!-- 検索 -->
    <div class="searchBox">
      <form method="get" id="searchform" action="<?php echo home_url('/'); ?>">
        <input type="text" class="focus" value="キーワードを入力" name="s" id="s" />
        <input name="searchsubmit" type="submit" id="searchsubmit" value="検索" />
      </form>
    </div>
    <!-- / 検索 -->
  </div>
  <hr />
  <div id="Menu">
    <ul>
      <li class="menu01"><a href="http://localhost:8888/hokuto-bs/feature/">当社の特徴</a></li>
      <li class="menu02"><a href="http://localhost:8888/hokuto-bs/book/">書籍一覧</a></li>
      <li class="menu03"><a href="http://localhost:8888/hokuto-bs/guide/">自費出版ご案内</a></li>
      <li class="menu04"><a href="http://localhost:8888/hokuto-bs/voice/">お客さまの声</a></li>
      <li class="menu05"><a href="http://localhost:8888/hokuto-bs/price/">ご参考価格・ご予算例</a></li>
      <li class="menu06"><a href="http://localhost:8888/hokuto-bs/faq/">よくあるご質問</a></li>
      <li class="menu07"><a href="http://localhost:8888/hokuto-bs/access/">アクセス</a></li>
    </ul>
  </div>
  <hr />
  <div id="HeadImg">
    <h2 class="title">検索結果</h2>
  </div>
  <?php
  if (function_exists('bcn_display')) {
    // Display the <span class="searchterm1">breadcrumb</span>
    echo '<div id="TopicPath"><p>';
    bcn_display();
    echo '</p></div>';
  }
  ?>
  <div id="Container">
    <div id="Main">
      <div class="conBox" id="Search">
        <?php

        $searchfor = get_search_query(); // Get the search query for display in a headline
        ?>
        <h3>「<?php echo wp_specialchars($s, 1); ?>」の検索結果</h3>
        <!-- ページナビゲーション -->
        <?php if (function_exists('wp_page_numbers')) : wp_page_numbers();
        endif; ?>
        <?php

        $query_string = esc_attr($query_string); // Escaping search queries to eliminate potential MySQL-injections
        $blogs = get_blog_list(0, 'all');
        foreach ($blogs as $blog):
          switch_to_blog($blog['blog_id']);
          $search = new WP_Query($query_string);
          if ($search->found_posts > 0) {
            foreach ($search->posts as $post) {
              setup_postdata($post);
              $author_data = get_userdata(get_the_author_meta('ID'));
        ?>
              <h4 class="clr"><a href="<?php the_permalink(); ?>">
                  <?php the_title(); ?>
                </a></h4>
              <p class="floatRight">
                <?php
                $post_custome = get_post_custom();
                $image_attributes = wp_get_attachment_image_src($post_custome['image1'][0], array(100, 145)); ?>
                <?php if ($image_attributes[0] != '') : ?>
                  <a href="<?php the_permalink(); ?>"><img src="<?php echo $image_attributes[0]; ?>" alt="<?php the_title(); ?>" /></a>
                <?php endif; ?>
              </p>
              <p><?php echo mb_substr(get_the_excerpt(), 0, 200); ?></p>
        <?php

            }
          }
        endforeach;
        restore_current_blog(); // Reset settings to the current blog
        ?>

        <!-- ページナビゲーション -->
        <?php if (function_exists('wp_page_numbers')) : wp_page_numbers();
        endif; ?>
      </div>
    </div>
    <?php get_sidebar(page); ?>
  </div>
  <?php get_footer(); ?>