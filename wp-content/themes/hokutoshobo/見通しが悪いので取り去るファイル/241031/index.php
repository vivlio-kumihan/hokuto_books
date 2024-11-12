<?php if (is_main_site() || $blog_id == 3) {
  get_header();
  include(TEMPLATEPATH.'/news-top.php');
} else {
  get_header();
  include(TEMPLATEPATH.'/book-top.php');
}
?>