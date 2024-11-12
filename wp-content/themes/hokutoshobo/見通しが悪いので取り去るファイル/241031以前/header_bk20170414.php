<?php echo '<?xml version="1.0" encoding="utf-8"?>' . "\n"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja" id="Top">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo(charset); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php if(is_month()): ?><?php the_time('Y年n月'); ?>｜<?php bloginfo('name'); ?><?php elseif(is_year()): ?><?php the_time('Y年'); ?>｜<?php bloginfo('name'); ?><?php elseif(is_home() || is_single() || is_category() || is_page()): ?><?php
  wp_title(' ');
  if (wp_title(' ', false)) echo '｜';
  bloginfo('name'); ?><?php endif; ?></title>
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta http-equiv="Content-Script-Type" content="text/javascript" />
<link rel="stylesheet" type="text/css" href="http://localhost:8888/common/css/page.css" />
<link rel="stylesheet" type="text/css" href="http://localhost:8888/common/css/print.css" media="print" />
<link rel="stylesheet" type="text/css" href="http://localhost:8888/common/css/fontMiddle.css" id="fontsize"/>
<link rel="stylesheet" type="text/css" href="http://localhost:8888/common/css/global.css" />
<?php
// ブログIDの取得
global $blog_id;
if($blog_id == 2) : ?>
<link rel="stylesheet" type="text/css" href="http://localhost:8888/common/css/smoothness/jquery-ui.css" />
<?php else: ?>
<link rel="stylesheet" type="text/css" href="http://localhost:8888/common/css/smoothness/jquery-ui-1.8.16.custom.css" />
<?php endif; ?>
<meta name="author" content="" />
<meta name="version" content="12.07.20" />
<link rel="contents" href="/" title="ホーム" />
<link rev="made" href="mailto:info@hokutoshobo.jp" />
<?php wp_enqueue_script('jquery'); ?>
<?php wp_enqueue_script('cookie', 'http://localhost:8888/hokuto-bs/common/js/jquery.cookie.js'); ?>
<?php wp_enqueue_script('tabs', 'http://localhost:8888/hokuto-bs/common/js/jquery-ui-1.8.16.custom.min.js'); ?>
<?php if(is_page(faq)): ?>
<?php wp_enqueue_script('accordion', 'http://localhost:8888/hokuto-bs/common/js/accordion.js'); ?>
<?php endif; ?>
<?php wp_enqueue_script('setup', 'http://localhost:8888/hokuto-bs/common/js/setup.js'); ?>
<?php wp_enqueue_script('tile', 'http://localhost:8888/hokuto-bs/common/js/jquery.tile.js'); ?>
<?php wp_head(); ?>
<?php if(is_home()): ?>
<!--[if lte IE 6]>  
<script type="text/javascript" src="http://localhost:8888/hokuto-bs/common/js/DD_belatedPNG.js">  
</script>  
<script type="text/javascript">  /* DD_belatedPNG */  DD_belatedPNG.fix('img,#HeadImg,#FootInner h2,.pagination li a,#FootInner .footMenuTop ul li a,#FootInner .footSiteMap ul li.child a,#FootInner .footSiteMap ul li a');</script> 
<![endif]-->
<?php else: ?>
<!--[if lte IE 6]>  
<script type="text/javascript" src="http://localhost:8888/hokuto-bs/common/js/DD_belatedPNG.js">  
</script>  
<script type="text/javascript">  /* DD_belatedPNG */  DD_belatedPNG.fix('img,.pngFix,#FootInner h2,#FootInner .footMenuTop ul li a,#FootInner .footSiteMap ul li.child a,#FootInner .footSiteMap ul li a');</script> 
<![endif]-->
<?php endif; ?>

</head>

<?php if($blog_id==1) : ?>
<?php include_once("main-body-id.php") ?>
<?php elseif($blog_id == 2 && is_page(order)): ?>
<body id="Pagebook" onload="pramWrite()">
<?php elseif($blog_id == 2) : ?>
<body id="Pagebook">
<?php elseif($blog_id == 3) : ?>
<body id="Pagenews">
<?php endif; ?>
<?php include_once("analyticstracking.php") ?>
<div id="Header">
  <h1 class="desc"><?php bloginfo('description'); ?></h1>
  <p class="logo"><a href="/"><img src="http://localhost:8888/hokuto-bs/common/img/logo.png" alt="<?php bloginfo('name'); ?>"/></a></p>
  <div class="headInfo">
    <p class="btContact"><a href="http://localhost:8888/hokuto-bs/contact/">お問い合わせ</a></p>
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
    <form method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
      <input type="text" class="focus" value="キーワードを入力" name="s" id="s" />
      <input name="searchsubmit" type="submit" id="searchsubmit" value="検索" />
    </form>
  </div>
  <!-- / 検索 --> 
</div>
<hr />
<div id="Menu">
  <ul>
    <li class="menuTop"><a href="/">ホーム</a></li>
    <li class="menu01"><a href="http://localhost:8888/hokuto-bs/feature/">当社の特徴</a></li>
    <li class="menu02"><a href="http://localhost:8888/hokuto-bs/price/">料金プラン</a></li>
    <li class="menu03"><a href="/staff/">専属スタッフ</a></li>
    <li class="menu04"><a href="/knowledge/">豆知識</a></li>
    <li class="menu05"><a href="http://localhost:8888/hokuto-bs/voice/">お客様の声</a></li>
    <li class="menu06"><a href="http://localhost:8888/hokuto-bs/faq/">Ｑ＆Ａ</a></li>
    <li class="menu07"><a href="http://localhost:8888/hokuto-bs/access/">アクセス</a></li>
  </ul>
</div>
<hr />
<div id="HeadImg">
  <?php if($blog_id == 1 && is_home()): ?>
  <div class="mainCopy pngFix">
    <h2>日本古典文学の街、学問の街　京都 洛北　北斗書房で個人出版しませんか</h2>
    <p>歴史・社会・教育／趣味・実用書／文芸書・写真集／絵本・自費出版</p>
    <p>60年の歴史「本づくり」の専門会社</p>
    <p>北斗書房はNPO法人自費出版ネットワーク会員です</p>
  </div>
  <div id="Sliders">
    <?php 
    echo do_shortcode("[metaslider id=464]"); 
?>
  </div>
  <?php else: ?>
  <h2 class="title"><?php bloginfo('name'); ?></h2>
  <?php endif; ?>
</div>
<?php if($blog_id == 1 && is_home()): ?>
<?php else: ?>
  <?php
if(function_exists('bcn_display'))
{
// Display the <span class="searchterm1">breadcrumb</span>
echo '<div id="TopicPath"><p>';
bcn_display();
echo '</p></div>';
}
?>
<?php endif; ?>
