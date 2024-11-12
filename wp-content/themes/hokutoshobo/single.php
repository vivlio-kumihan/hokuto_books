<?php get_header(); ?>

<div id="page-top" class="main">
  <div class="main__contents-wrapper">
    <div class="main__inner">
      <div class="book-post">
        <?php
        $categories = get_the_category();
        $genre_category_id = 159;
        $author_category_id = 225;
        $genre_name = '';
        $author_name = '';
        // 各カテゴリーを確認し、ジャンルと執筆者一覧のカテゴリ内にあるものを抽出
        if ($categories) {
          foreach ($categories as $category) {
            if ($category->parent == $genre_category_id) {
              $genre_name = $category->name;
            }
            if ($category->parent == $author_category_id) {
              $author_name = $category->name;
            }
          }
        }
        ?>

        <div class="book-post__single-header">
          <ul>
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <li class="book-post__header-lower">
                  <h3 class="main__header3"><?php the_title(); ?></h3>
                </li>
                <li class="book-post__header-upper">
                  <div class="book-post__single-genre">
                    <span>分類</span><?php echo esc_html($genre_name); ?>
                  </div>
                </li>
          </ul>
          <div class="book-post__single-content">
            <?php echo the_content(); ?>
          </div>
      <?php endwhile;
            endif; ?>
        </div>
      </div>
    </div>
    <div class="main__inner">
      <div class="book-post__book-info">
        <div class="book-post__image-wrapper single">
          <?php the_post_thumbnail('thumbnail'); ?>
        </div>
        <div>
          <?php
          the_post();
          $post_custome = get_post_custom();
          ?>
          <div id="BookImages">
            <div class="infoBox">
              <div class="bookInfo">
                <dl>
                  <dt>分類</dt>
                  <dd><?php echo esc_html($genre_name); ?></dd>
                </dl>
                <dl>
                  <dt>表題</dt>
                  <dd><?php the_title(); ?></dd>
                </dl>
                <dl>
                  <dt>執筆者</dt>
                  <dd><?php echo esc_html($author_name); ?></dd>
                </dl>
                <dl>
                  <dt>版型</dt>
                  <dd><?php echo post_custom('book_size'); ?></dd>
                </dl>
                <dl>
                  <dt>頁数</dt>
                  <dd><?php echo post_custom('book_page'); ?>頁</dd>
                </dl>
                <dl>
                  <dt>発行日</dt>
                  <dd>
                    <time datetime="<?php echo get_the_date("Y-m-d") ?>">
                      <span></span><?php echo get_the_date("Y年m月d日") ?>
                    </time>
                  </dd>
                </dl>
                <dl>
                  <dt>ISBNコード</dt>
                  <dd><?php echo post_custom('book_isbn'); ?></dd>
                </dl>
                <dl>
                  <dt>価格</dt>
                  <dd class="price">
                    <?php
                    // 価格
                    // チェックボックスのカスタムフィールド名
                    $tax_included = get_post_meta(get_the_ID(), 'book_tax_included', true);
                    $book_price = post_custom('book_price'); // book_price の値を取得

                    // チェックボックスが選択されている場合に "円（税込）" を表示
                    if ($tax_included) {
                      echo $book_price . '円（税込）';
                    } else {
                      echo $book_price;
                    }
                    ?>
                    <?php
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

                    <?php else : ?>
                      <!-- デフォルトや不明な状態の場合の処理（必要なら追加） -->
                      <div class="selected-label">在庫情報がありません。</div>
                    <?php endif; ?>
                  </dd>
                </dl>
                <a class="arrow" href="<?php echo esc_url(home_url('"/purchase')); ?>">自費出版ご購入お申し込み方法</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="main__inner page-direction">
      <ul>
        <li>
          <a class="page-derection__to-index" href="<?php echo esc_url(home_url('/book')) ?>">書籍一覧へ</a>
        </li>
        <?php if (get_previous_post() || get_next_post()) : ?>
          <li><?php next_post_link('%link', '前へ', true); ?></li>
          <li><?php previous_post_link('%link', '次へ', true); ?></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</div>


<?php get_footer(); ?>