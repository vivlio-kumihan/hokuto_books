<?php
get_header(); // ヘッダーを読み込む

// 現在表示されているカテゴリー情報を取得
$current_category = get_queried_object();
?>

<h1>ジャンル: <?php echo esc_html($current_category->name); ?></h1>

<?php
// このジャンルに関連する投稿を取得
$args = array(
  'post_type' => 'post', // 投稿タイプ
  'posts_per_page' => -1, // すべての投稿を取得
  'category__in' => array($current_category->term_id), // 現在のカテゴリーIDに関連する投稿
);

$query = new WP_Query($args);

if ($query->have_posts()) :
  echo '<ul>';
  while ($query->have_posts()) : $query->the_post();
    echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
  endwhile;
  echo '</ul>';

  // ページネーション（ページ分け）を表示
  the_posts_pagination();
else :
  echo '<p>このジャンルには投稿がありません。</p>';
endif;

// クエリのリセット
wp_reset_postdata();

get_footer(); // フッターを読み込む
?>