<?php if (is_main_site()) {
   get_header();
   include(TEMPLATEPATH.'/index.php');
} elseif ($blog_id == 2) {
   include(TEMPLATEPATH.'/book-category.php');
} elseif ($blog_id == 3) {
   get_header();
   include(TEMPLATEPATH.'/index.php');
}
?>