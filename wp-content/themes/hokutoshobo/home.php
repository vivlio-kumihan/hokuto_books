<?php if (is_main_site()) {
  get_header();
  include(TEMPLATEPATH.'/home-top.php');
} elseif ($blog_id == 2) {
  get_header();
  include(TEMPLATEPATH.'/book-top.php');
} elseif ($blog_id == 3) {
  get_header();
  include(TEMPLATEPATH.'/news-top.php');
}
?>