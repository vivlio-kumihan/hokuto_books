      <!-- <div class="bookList">
        <?php switch_to_blog(2) ?>
        <?php
        $myposts = get_posts('numberposts=4');
        foreach ($myposts as $post) :
        ?>
          <dl class="boxLink">
            <dt>
              <?php
              $post_custome = get_post_custom();
              $image_attributes = wp_get_attachment_image_src($post_custome['image1'][0], array(100, 145)); ?>
              <?php if ($image_attributes[0] != '') : ?>
                <a href="<?php the_permalink(); ?>"><img src="<?php echo $image_attributes[0]; ?>" alt="<?php the_title(); ?>" /></a>
              <?php endif; ?>
            </dt>
            <dd>
              <h4><a href="<?php the_permalink(); ?>">
                  <?php the_title(); ?>
                </a></h4>
              <p class="excerpt"><?php echo mb_substr(strip_tags($post->post_content), 0, 30) . '...'; ?></p>
              <p class="author">
                <?php
                $categories = get_the_category();
                foreach ($categories as $category)
                  if (cat_is_ancestor_of(8, $category))
                    echo '' . $category->cat_name . ' ';
                ?>
              </p>
              <p class="cat">
                <?php
                $categories = get_the_category();
                foreach ($categories as $category)
                  if (cat_is_ancestor_of(10, $category))
                    echo '' . $category->cat_name . ' ';
                ?>
              </p>
              <div class="price <?php echo post_custom('book_order'); ?>">
                <div class="btOrder"><img src="<?php echo get_template_directory_uri(); ?>/images/bt-order-s.png" alt="販売中" /></div>
                <div class="soldOut">絶版</div>
              </div>
            </dd>
          </dl>
        <?php endforeach; ?>
        <?php restore_current_blog(); ?>
      </div> -->