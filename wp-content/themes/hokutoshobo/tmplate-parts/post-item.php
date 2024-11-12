<?php get_header(); ?>

<?php
// 現在表示されているカテゴリー情報を取得
$current_category = get_queried_object();
$is_author_category = $current_category->parent === 225; // 執筆者カテゴリの親ID
$is_genre_category = $current_category->parent === 159; // ジャンルカテゴリの親ID

if ($is_author_category) {
  echo '<h1>執筆者: ' . esc_html($current_category->name) . '</h1>';
} elseif ($is_genre_category) {
  echo '<h1>分類: ' . esc_html($current_category->name) . '</h1>';
}

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
    echo '<li>';

    // リスト全体をリンクとして<a>タグで囲む
    echo '<a href="' . get_permalink() . '">';

    // サムネイル画像を表示
    if (has_post_thumbnail()) {
      echo '<div class="image-wrapper">';
      the_post_thumbnail('thumbnail');
      echo '</div>';
    }

    // タイトルを表示
    echo '<div class="title">' . get_the_title() . '</div>';

    // <a>タグの終了位置を調整
    echo '</a>';

    // 販売状況の切り替え
    $book_order = post_custom('book_order'); // カスタムフィールド 'book_order' の値を取得

    // 販売状況に応じて表示する要素を切り替える
    if ($book_order === 'order') :
      $book_title = post_custom('book_title');
?>
      <div class="selected-label buy">
        <a href="<?php echo esc_url(site_url('/book-order/?book_title=' . urlencode($book_title))); ?>" class="order-button">
          購入
        </a>
      </div>
    <?php elseif ($book_order === 'sold-out') : ?>
      <div class="selected-label sold-out">絶版</div>

      <?php elseif ($book_order === 'amazon') :
      $amazon_url = post_custom('book_amazon_url');
      if (!empty($amazon_url)) :
      ?>
        <div class="selected-label buy-amazon">
          <a href="<?php echo esc_url($amazon_url); ?>" target="_blank">
            <img src="<?php echo get_template_directory_uri(); ?>/images/btn/btn-amazon.png" alt="Amazon 詳細ページへ" />
          </a>
        </div>
      <?php endif; ?>

    <?php elseif ($book_order === 'undecided') : ?>
      <div class="selected-label undecided">在庫切れ重版未定</div>
<?php endif;

    echo '</li>';
  endwhile;
  echo '</ul>';

  // ページネーション（ページ分け）を表示
  the_posts_pagination();
else :
  echo '<p>このジャンルには投稿がありません。</p>';
endif;

// クエリのリセット
wp_reset_postdata();
?>

<?php get_footer(); ?>