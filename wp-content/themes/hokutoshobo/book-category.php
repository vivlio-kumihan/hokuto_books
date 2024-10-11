<?php if (is_category( '8' )) : ?>
<?php get_header();
   include(TEMPLATEPATH.'/book-parent8-category.php'); ?>
<?php elseif (is_category( '10' )) : ?>
<?php get_header();
   include(TEMPLATEPATH.'/book-parent10-category.php'); ?>
<?php else: ?>
<?php get_header();
   include(TEMPLATEPATH.'/book-child-category.php'); ?>
<?php endif; ?>