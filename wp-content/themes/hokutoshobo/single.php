<?php get_header(); ?>
<!-- ID=159 -->
<!-- ID=225 -->
<main>
  <div class="container">
    <div class="category-link-menu">
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
                    <span>ジャンル</span><?php echo esc_html($genre_name); ?>
                  </div>
                  <div class="book-post__single-author">
                    <span>執筆者</span><?php echo esc_html($author_name); ?>
                  </div>
                  <time class="book-post__single-release-date" datetime="<?php echo get_the_date("Y-m-d") ?>">
                    <span>発行日</span><?php echo get_the_date("Y年m月d日") ?>
                  </time>
                </li>
          </ul>
          <div class="book-post__single-content">
            <?php echo the_content(); ?>
          </div>
      <?php endwhile;
            endif; ?>
        </div>
      </div>

      <div class="book-post__book-info">
        <div class="book-post__image-wrapper single">
          <?php the_post_thumbnail('thumbnail'); ?>
        </div>
      </div>
      <div id="Container">
        <div id="Main">
          <div class="conBox" id="BookDetail">
            <?php
            the_post();
            $post_custome = get_post_custom();
            ?>
            <div id="BookImages">
              <div class="infoBox">
                <div class="bookInfo">
                  <dl>
                    <dt>
                      ジャンル
                    </dt>
                    <dd>
                      <?php echo esc_html($genre_name); ?>
                    </dd>
                  </dl>
                  <dl>
                    <dt>
                      執筆者
                    </dt>
                    <dd>
                      <?php echo esc_html($author_name); ?>
                    </dd>
                  </dl>

                  <dl>
                    <dt>価格</dt>
                    <dd class="price">
                      <?php
                      $book_order = post_custom('book_order'); // カスタムフィールド 'book_order' の値を取得

                      // 販売状況に応じて表示する要素を切り替える
                      if ($book_order === 'order') :
                        $book_title = post_custom('book_title'); ?>
                        <a href="<?php echo esc_url(site_url('/book-order/?book_title=' . urlencode($book_title))); ?>" class="order-button">
                          購入
                        </a>

                      <?php elseif ($book_order === 'sold-out') : ?>
                        <div class="soldOut">絶版</div>

                        <?php elseif ($book_order === 'amazon') :
                        $amazon_url = post_custom('book_amazon_url');
                        if (!empty($amazon_url)) : ?>
                          <div class="amazon">
                            <a href="<?php echo esc_url($amazon_url); ?>" target="_blank">
                              <img src="/common/img/btn/btn-amazon.png" alt="Amazon 詳細ページへ" />
                            </a>
                          </div>
                        <?php endif; ?>

                      <?php elseif ($book_order === 'undecided') : ?>
                        <div class="undecided">在庫切れ重版未定</div>

                      <?php else : ?>
                        <!-- デフォルトや不明な状態の場合の処理（必要なら追加） -->
                        <!-- <p>在庫情報がありません。</p> -->
                      <?php endif; ?>
                    </dd>
                  </dl>

                  <dl>
                    <dt>
                      発行日
                    </dt>
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
                    <dt>サイズ</dt>
                    <dd><?php echo post_custom('book_size'); ?></dd>
                  </dl>
                  <dl>
                    <dt>頁数</dt>
                    <dd><?php echo post_custom('book_page'); ?>頁</dd>
                  </dl>
                  <dl>
                    <dt>カテゴリー</dt>
                    <dd>
                    </dd>
                  </dl>
                  <p class="howtoOrder"><a class="arrow" href="/purchase/">自費出版ご購入お申し込み方法</a></p>
                </div>
              </div>
              <ul>
            </div>
          </div>
        </div>














        <div class="page-direction">
          <a class="to-index" href="<?php echo home_url('/news') ?>">記事一覧へ</a>
          <ul>
            <?php if (get_previous_post() !== '') : ?>
              <li class="previuos"><?php previous_post_link('%link', '前の記事へ', true); ?></li>
            <?php endif; ?>
            <?php if (get_next_post() !== '') : ?>
              <li><?php next_post_link('%link', '次の記事へ', true); ?></li>
            <?php endif; ?>
          </ul>
        </div>
      </div>
    </div>

    <?php
    // 投稿のIDを取得
    $post_id = get_the_ID();

    // カスタムフィールドのデータを取得
    $custom_field_value = get_post_meta($post_id, '書籍情報入力', true);

    // 値が存在する場合のみ表示
    if ($custom_field_value) {
      echo '<div class="custom-field">';
      echo '<strong>カスタムフィールド:</strong> ' . esc_html($custom_field_value);
      echo '</div>';
    }
    ?>

</main>



<?php get_footer(); ?>