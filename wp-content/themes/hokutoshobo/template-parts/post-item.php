<li class="category__list">
  <!-- リスト全体をリンクとして<a>タグで囲む -->
  <a href="<?php the_permalink(); ?>">
    <!-- サムネイル画像を表示 -->
    <?php if (has_post_thumbnail()) : ?>
      <div class="image-wrapper">
        <?php the_post_thumbnail('thumbnail'); ?>
      </div>
    <?php endif; ?>

    <!-- タイトルを表示 -->
    <div class="category__title"><?php the_title(); ?></div>
  </a>

  <!-- 販売状況の切り替え -->
  <?php
  $book_order = get_post_meta(get_the_ID(), 'book_order', true); // カスタムフィールド 'book_order' の値を取得

  // 販売状況に応じて表示する要素を切り替える
  switch ($book_order):
    case 'order':
      $book_title = get_post_meta(get_the_ID(), 'book_title', true);
  ?>
      <div class="selected-label buy">
        <a href="<?php echo esc_url(site_url('/book-order/?book_title=' . urlencode($book_title))); ?>">
          <span class="selected-label__icon">購入</span>
        </a>
      </div>
    <?php break;

    case 'sold-out': ?>
      <div class="selected-label sold-out">絶版</div>
      <?php break;

    case 'amazon':
      $amazon_url = get_post_meta(get_the_ID(), 'book_amazon_url', true);
      if (!empty($amazon_url)) : ?>
        <div class="selected-label buy amazon">
          <a href="<?php echo esc_url($amazon_url); ?>" target="_blank">
            <span class="selected-label__icon">Amazon</span>
          </a>
        </div>
      <?php endif;
      break;

    case 'undecided': ?>
      <div class="selected-label undecided">在庫切れ重版未定</div>
      <?php break; ?>
  <?php break;
  endswitch; ?>
</li>