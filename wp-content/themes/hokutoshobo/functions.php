<?php

//+++++++++++++++++++++++++++++++++
//カスタムメニュー
register_sidebar();


//+++++++++++++++++++++++++++++++++
//エディタ・スタイルシート
add_editor_style();


//+++++++++++++++++++++++++++++++++
//投稿画像のwidthとheight指定無し設定

function remove_hwstring_from_image_tag( $html, $id, $alt, $title, $align, $size ) {
    list( $img_src, $width, $height ) = image_downsize($id, $size);
    $hwstring = image_hwstring( $width, $height );
    $html = str_replace( $hwstring, '', $html );
    return $html;
}
add_filter( 'get_image_tag', 'remove_hwstring_from_image_tag', 10, 6 );


//+++++++++++++++++++++++++++++++++
//固定ページで抜粋を使用できるようにする
add_post_type_support( 'page', 'excerpt' );


//+++++++++++++++++++++++++++++++++
//文字数制限[...]消して...に
function new_excerpt_more($more) {
      return ' ...';
}
add_filter('excerpt_more', 'new_excerpt_more');


//+++++++++++++++++++++++++++++++++
//ウィジェットカテゴリーのカウントをaタグ内に表示

add_filter( 'wp_list_categories', 'my_list_categories', 10, 2 );
function my_list_categories( $output, $args ) {
  return preg_replace('@</a>(.+?)\s*?<@', '\1</a><', $output );
}


//+++++++++++++++++++++++++++++++++
//全ブログ記事一覧を表示できるようにする

function get_recentposts_from_network( $args = null ) {
 
    $defaults = array( 'num' => 50, 'perblog' => 1, 'start' => 0 );
 
    $r = wp_parse_args( $args, $defaults );
 
    // 全ブログのBLOG_IDを取得
    global $wpdb;
    $blogs = $wpdb->get_results( $wpdb->prepare( "SELECT blog_id FROM wp_blogs ORDER BY blog_id" ) );
 
    if( is_array( $blogs ) ) { reset( $blogs );
 
    // 各ブログの最新記事を指定件数取得する
    foreach( $blogs as $blog ) {
    switch_to_blog( $blog->blog_id );
 
    $posts = get_posts( "numberposts=" . $r['perblog'] );
 
    if( $posts ) {
        foreach( $posts as $post ) {
            $recent_posts[] = $post->post_date;
            $post->blog_id = $blog->blog_id;
            $post_list[] = $post;
        } // endforeach
        unset( $posts );
    } // endif ( $posts )
        restore_current_blog();
    } // endforeach
 
    // 投稿日時で並べ替える
    arsort( $recent_posts );
    reset( $recent_posts );
    foreach( (array) $recent_posts as $key => $details ) {
        $t[$key] = $post_list[$key];
    } // endforeach
        unset($recent_posts);
        $recent_posts = $t;
    } //endif ( is_array( $blogs ) )
 
    if( $recent_posts )
        return array_slice( $recent_posts, $r['start'], $r['num'], true );
 
    return array();
}

?>