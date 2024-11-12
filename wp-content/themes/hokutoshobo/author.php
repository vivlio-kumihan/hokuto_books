<?php
get_header(); // ヘッダーを読み込む

// カテゴリー情報を取得
$category = get_queried_object();
?>

<h1>執筆者: <?php echo esc_html($category->name); ?></h1>

<?php
// 現在のカテゴリー（執筆者）の投稿を取得
$args = array(
  'post_type'      => 'post',       // 投稿タイプ
  'category__in'   => array($category->term_id), // 現在のカテゴリーID
  'posts_per_page' => 10,           // 1ページに表示する投稿数
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
  echo '<p>この執筆者の記事はまだありません。</p>';
endif;

// クエリのリセット
wp_reset_postdata();

get_footer(); // フッターを読み込む
?>