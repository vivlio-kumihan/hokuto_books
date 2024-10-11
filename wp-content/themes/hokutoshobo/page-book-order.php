<?php
/*
Template Name: Page Book Order
*/
?>
<?php get_header(); ?>

<div id="Container">
  <div id="Main">
<!-- Mailform Pro 4 CSS -->
<link rel="stylesheet" href="/mailform/mailformpro4.1.5/mfp.statics/mailformpro.css" type="text/css" />
    <script type="text/javascript">
            /* パラメータを受取る側 */
            function pramWrite() {
                /* アドレスの「?」以降の引数(パラメータ)を取得 */
                var pram=location.search;
                /* 引数がない時は処理しない */
                if (!pram) return false;
                /* 先頭の?をカット */
                pram=pram.substring(1);
                /* 「&」で引数を分割して配列に */
                var pair=pram.split("&");
                var i=temp="";
                var key=new Array();
                for (i=0; i < pair.length; i++) {
                    /* 配列の値を「=」で分割 */
                    temp=pair[i].split("=");
                    keyName=temp[0];
                    keyValue=temp[1];
                    /* キーと値の連想配列を生成 */
                    key[keyName]=keyValue;
                }
				
                    var title=encodeURIComponent(title);
                    var price=encodeURIComponent(price);

                    title=decodeURIComponent(key["title"]);
                    price=decodeURIComponent(key["price"]);

                document.forms['orderform'].elements['title'].value=title+"\n";
                document.forms['orderform'].elements['price'].value=price+"\n";
            }
        </script> 
    <?php if(have_posts()): while(have_posts()): the_post(); ?>
    <?php the_content(); ?>
    <?php endwhile; endif; ?>
  </div>
  <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>
</body></html>