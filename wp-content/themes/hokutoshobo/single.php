<?php if (is_main_site() || $blog_id == 3) {
   get_header();
   include(TEMPLATEPATH.'/news-single.php');
} else {
   get_header();
   include(TEMPLATEPATH.'/book-single.php');
}
?>