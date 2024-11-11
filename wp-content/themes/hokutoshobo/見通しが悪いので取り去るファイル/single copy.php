<?php get_header(); ?>

<main>
  <div class="container">
    <div class="category-link-menu">







      <hr />
      <?php
      // 'author_hiragana' に基づいて並べ替えを行う
      $args = array(
        'post_type' => 'post', // 投稿タイプ（カスタム投稿タイプを使っている場合は適宜変更）
        'posts_per_page' => -1, // 全ての投稿を取得
        'meta_key' => 'book_ruby', // 並び替え基準となるカスタムフィールド名
        'orderby' => 'meta_value', // メタ値で並び替え
        'order' => 'ASC', // 昇順（あいうえお順）
      );

      // クエリを作成
      $query = new WP_Query($args);

      // 各投稿をループして表示
      if ($query->have_posts()) {
        echo '<ul class="post-list">';
        while ($query->have_posts()) {
          $query->the_post();

          // カテゴリーを取得
          $categories = get_the_category();
          if ($categories) {
            $category_name = $categories[0]->name; // 最初のカテゴリーを取得
            $category_link = esc_url(get_category_link($categories[0]->term_id)); // カテゴリーのリンク
          }

          echo '<li>';
          echo '<a href="' . get_permalink() . '">' . get_the_title() . '</a>';
          echo ' | <a href="' . $category_link . '">' . $category_name . '</a>';
          echo ' | <a href="' . $category_link . '">' . $category_name . '</a>';
          echo '</li>';
        }
        echo '</ul>';
      } else {
        echo '投稿はありません。';
      }

      // 投稿データのリセット
      wp_reset_postdata();
      ?>











      <hr />
      <header data-cat-id="all">記事カテゴリー</header>
      <ul class="sub-menu">
        <li><a href="/news/">すべて</a></li>
        <?php
        $categories = get_categories();
        if ($categories) {
          foreach ($categories as $category) {
            echo '<li><a href="/category/' . $category->slug . '">' . $category->name . '</a></li>';
          }
        }
        ?>
      </ul>
    </div>

    <div class="post-content">
      <div class="header-sub">
        <ul class="post-category">
          <?php
          $categories = get_the_category();
          if ($categories) {
            echo '<li><a href="' . esc_url(get_category_link($categories[0]->term_id)) . '">' . $categories[0]->name . '</a></li>';
          }
          ?>
        </ul>
        <time datetime="<?php echo get_the_date("Y-m-d") ?>"><?php echo get_the_date("Y年m月d日") ?></time>
      </div>
      <hr />
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
          <h2><?php the_title(); ?></h2>
          <hr />
          <p><?php echo the_content(); ?></p>
          <hr />
      <?php endwhile;
      endif; ?>

      <hr />
      <div id="Container">
        <div id="Main">
          <div class="conBox" id="BookDetail">
            <?php if (have_posts()): while (have_posts()): the_post(); ?>
                <h3>
                  <?php the_title(); ?>
                  <span class="subTitle <?php echo post_custom('sub_title_off'); ?>"><?php echo post_custom('book_sub_title'); ?></span>
                </h3>
                <?php the_content(); ?>
            <?php endwhile;
            endif; ?>
            <?php the_post();
            $post_custome = get_post_custom(); ?>
            <?php
            $image_attributes['image1'] = wp_get_attachment_image_src($post_custome['image1'][0], 'large');
            $image_attributes['image2'] = wp_get_attachment_image_src($post_custome['image2'][0], 'large');
            $image_attributes['image3'] = wp_get_attachment_image_src($post_custome['image3'][0], 'large');
            $image_attributes['image4'] = wp_get_attachment_image_src($post_custome['image4'][0], 'large');
            $image_attributes['image5'] = wp_get_attachment_image_src($post_custome['image5'][0], 'large');
            ?>
            <script language="JavaScript">
              function changePic(myPicURL) {
                document.images["MainImage"].src = myPicURL;
              }
            </script>
            <div id="BookImages">
              <div class="infoBox">
                <div class="bookInfo">
                  <dl>
                    <dt>著者</dt>
                    <dd class="authorName">
                      <h4>hello
                        <?php echo post_custom('book_title'); ?>
                        <?php echo post_custom('book_sub_title'); ?>
                        <?php echo post_custom('book_author'); ?>
                        <?php echo post_custom('book_ruby'); ?>
                        <?php
                        $categories = get_the_category();
                        foreach ($categories as $category)
                          if (cat_is_ancestor_of(8, $category))
                            echo '<a href="' . get_category_link($category->cat_ID) . '">' . $category->cat_name . '</a> ';
                        ?>
                      </h4>
                    </dd>
                  </dl>
                  <dl>
                    <dt>価格</dt>
                    <dd class="price <?php echo post_custom('book_order'); ?>">
                      <?php echo post_custom('book_price'); ?>
                      <?php echo post_custom('price_tax'); ?>
                      <div class="btOrder">
                        <a href="/book/order/?title=<?php the_title(); ?>&price=<?php echo post_custom('book_price'); ?>">
                          <img src="/common/img/bt-order.png" alt="ご購入" />
                        </a>
                      </div>
                      <div class="soldOut">絶版</div>
                      <div class="amazon"><a href="<?php echo post_custom('book_amazon_url'); ?>" target="_blank"><img src="/common/img/btn/btn-amazon.png" alt="Amazon 詳細ページへ" width="164" height="26" /></a></div>
                      <div class="undecided">在庫切れ重版未定</div>
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
                      <?php
                      $categories = get_the_category();
                      foreach ($categories as $category)
                        if (cat_is_ancestor_of(10, $category))
                          echo '<a href="' . get_category_link($category->cat_ID) . '">' . $category->cat_name . '</a> '; ?>
                    </dd>
                  </dl>
                  <p class="howtoOrder"><a class="arrow" href="/purchase/">自費出版ご購入お申し込み方法</a></p>
                </div>
              </div>
              <ul>
                <li class="bookImgMain">
                  <?php if ($post_custome['image1'][0] != '') : ?>
                    <img src="<?php echo $image_attributes['image1'][0]; ?>" id="MainImage" />
                  <?php endif; ?>
                </li>
                <li class="bookImgSub"><?php echo $post_custome['image1'][0] == '' ? '' : wp_get_attachment_image($post_custome['image1'][0], 'large', 1, array('onclick' => 'changePic("' . $image_attributes['image1'][0] . '")')); ?></li>
                <li class="bookImgSub"><?php echo $post_custome['image2'][0] == '' ? '' : wp_get_attachment_image($post_custome['image2'][0], 'large', 1, array('onclick' => 'changePic("' . $image_attributes['image2'][0] . '")')); ?></li>
                <li class="bookImgSub"><?php echo $post_custome['image3'][0] == '' ? '' : wp_get_attachment_image($post_custome['image3'][0], 'large', 1, array('onclick' => 'changePic("' . $image_attributes['image3'][0] . '")')); ?></li>
                <li class="bookImgSub"><?php echo $post_custome['image4'][0] == '' ? '' : wp_get_attachment_image($post_custome['image4'][0], 'large', 1, array('onclick' => 'changePic("' . $image_attributes['image4'][0] . '")')); ?></li>
                <li class="bookImgSub"><?php echo $post_custome['image5'][0] == '' ? '' : wp_get_attachment_image($post_custome['image5'][0], 'large', 1, array('onclick' => 'changePic("' . $image_attributes['image5'][0] . '")')); ?></li>
              </ul>
            </div>
            <div id="tabs" class="clr">
              <ul class="tabsMenu">
                <li><a href="#page1">主な内容</a></li>
                <?php if ($post_custome['page2_title'][0] != '') : ?>
                  <li><a href="#page2"><?php echo $post_custome['page2_title'][0]; ?></a></li>
                <?php endif; ?>
                <?php if ($post_custome['page3_title'][0] != '') : ?>
                  <li><a href="#page3"><?php echo $post_custome['page3_title'][0]; ?></a></li>
                <?php endif; ?>
                <?php if ($post_custome['page4_title'][0] != '') : ?>
                  <li><a href="#page4"><?php echo $post_custome['page4_title'][0]; ?></a></li>
                <?php endif; ?>
                <?php if ($post_custome['page5_title'][0] != '') : ?>
                  <li><a href="#page5"><?php echo $post_custome['page5_title'][0]; ?></a></li>
                <?php endif; ?>
                <li></li>
              </ul>
              <div id="page1"> <?php echo $post_custome['page1_body'][0]; ?> </div>
              <?php if ($post_custome['page2_title'][0] != '') : ?>
                <div id="page2"> <?php echo $post_custome['page2_body'][0]; ?> </div>
              <?php endif; ?>
              <?php if ($post_custome['page3_title'][0] != '') : ?>
                <div id="page3"> <?php echo $post_custome['page3_body'][0]; ?> </div>
              <?php endif; ?>
              <?php if ($post_custome['page4_title'][0] != '') : ?>
                <div id="page4"> <?php echo $post_custome['page4_body'][0]; ?> </div>
              <?php endif; ?>
              <?php if ($post_custome['page5_title'][0] != '') : ?>
                <div id="page5"> <?php echo $post_custome['page5_body'][0]; ?> </div>
              <?php endif; ?>
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