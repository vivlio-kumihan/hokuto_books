// BoxLink 設定
jQuery(function(){
     jQuery(".boxLink").click(function(){
         window.location=jQuery(this).find("a").attr("href");
         return false;
    });
});

jQuery(function() {
    jQuery('a[target=_blank]').addClass('external-link');
});


// フォントサイズ用クッキー設定
jQuery(document).ready(function(){
	jQuery("#fontsize").attr({href:jQuery.cookie('fontstyle')});
});
function switchFontsize(cssname){
	var cssurl= '/common/css/'+cssname+'.css';
	jQuery('#fontsize').attr({href:cssurl});
	jQuery.cookie('fontstyle',cssurl,{expires:30,path:'/'});
}


// フォームにテキストを入れておき、フォーカスで消す（文字色も変更）
jQuery(function(){
     jQuery(".focus").focus(function(){
          if(this.value == "キーワードを入力"){
               jQuery(this).val("").css("color","#333");
          }
     });
     jQuery(".focus").blur(function(){
          if(this.value == ""){
               jQuery(this).val("キーワードを入力").css("color","#969696");
          }
     });
});

// 自費出版相談会：フォームにテキストを入れておき、フォーカスで消す（文字色も変更）
jQuery(function(){
     jQuery(".cnsltfocus").focus(function(){
          if(this.value == "自費出版相談会ご予約のお客様はご希望の日時をご記入ください。"){
               jQuery(this).val("").css("color","#333");
          }
     });
     jQuery(".cnsltfocus").blur(function(){
          if(this.value == ""){
               jQuery(this).val("自費出版相談会ご予約のお客様はご希望の日時をご記入ください。").css("color","#969696");
          }
     });
});


jQuery(function() {
  // スクロールのオフセット値
  var offsetY = -10;
  // スクロールにかかる時間
  var time = 500;

  // ページ内リンクのみを取得
  jQuery('a[href^=#]:not(.ui-tabs-anchor)').click(function() {
    // 移動先となる要素を取得
    var target = $(this.hash);
    if (!target.length) return ;
    // 移動先となる値
    var targetY = target.offset().top+offsetY;
    // スクロールアニメーション
    jQuery('html,body').animate({scrollTop: targetY}, time, 'swing');
    // ハッシュ書き換えとく
    window.history.pushState(null, null, this.hash);
    // デフォルトの処理はキャンセル
    return false;
  });
});


// ボックスの高さを合わせる
// jQuery(function($){
//     $(".boxLink").autoHeight({column:2});
// });