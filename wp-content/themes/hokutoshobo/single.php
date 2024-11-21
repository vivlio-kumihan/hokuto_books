<?php get_header(); ?>

<div id="page-top" class="main single">
  <div class="main__contents-wrapper">
    <div class="main__inner">
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
      <div class="single">
        <ul class="single__headline">
          <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
              <li class="single__header-upper">
                <h3 class="main__header3"><?php the_title(); ?></h3>
              </li>
              <li class="single__header-lower">
                <div class="single__genre">
                  <span>分類</span><?php echo esc_html($genre_name); ?>
                </div>
              </li>
        </ul>
        <div class="single__content">
          <?php echo the_content(); ?>
        </div>
    <?php endwhile;
          endif; ?>
      </div>
    </div>

    <div class="main__inner">
      <div class="book-info">
        <div class="book-info__image-wrapper">
          <?php the_post_thumbnail('thumbnail'); ?>
        </div>
        <?php
        the_post();
        $post_custome = get_post_custom();
        ?>
        <div class="book-info__spec">
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
            <dt>ISBN</dt>
            <dd><?php echo post_custom('book_isbn'); ?></dd>
          </dl>
          <dl class="fee">
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
                  <a href="<?php echo esc_url(site_url('/book-order/?book_title=' . urlencode($book_title))); ?>">
                    <span class="selected-label__icon">購入</span>
                  </a>
                </div>
              <?php elseif ($book_order === 'sold-out') : ?>
                <div class="selected-label sold-out">絶版</div>

                <?php elseif ($book_order === 'amazon') :
                $amazon_url = post_custom('book_amazon_url');
                if (!empty($amazon_url)) :
                ?>
                  <div class="selected-label buy amazon">
                    <a href="<?php echo esc_url($amazon_url); ?>" target="_blank">
                      <span class="selected-label__icon">Amazon</span>
                    </a>
                  </div>
                <?php endif; ?>

              <?php elseif ($book_order === 'undecided') : ?>
                <div class="selected-label undecided">在庫切れ重版未定</div>

              <?php else : ?>
                <!-- デフォルトや不明な状態の場合の処理（必要なら追加） -->
                <!-- <div class="selected-label">在庫情報がありません。</div> -->
              <?php endif; ?>
            </dd>
          </dl>
          <div class="selected-label buy how-to">
            <a href="<?php echo esc_url(home_url('"/purchase')); ?>">
              <span>自費出版ご購入お申し込み方法</span>
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="page-direction">
      <ul class="pagination">
        <li class="pagination__to-index page-numbers">
          <a href="<?php echo esc_url(home_url('/book')) ?>">書籍一覧へ</a>
        </li>
        <!-- 前と次へがテレコになっているが、このWPの一連の投稿に関して見た目の感覚で合わせている。 -->
        <?php if (get_next_post()) : ?>
          <li class="pagination__prev-btn"><?php next_post_link('%link', '前へ', true); ?></li>
        <?php endif; ?>
        <?php if (get_previous_post()) : ?>
          <li class="pagination__next-btn"><?php previous_post_link('%link', '次へ', true); ?></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</div>


<?php get_footer(); ?>