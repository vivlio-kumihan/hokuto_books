<?php if(is_search()): ?>
<body id="PageSearch">
<?php elseif(is_home()): ?>
<body id="PageIndex">
<?php elseif(is_page()): ?>
<body id="Page<?php echo $parent_slug = get_page_uri($post->post_parent); ?>"> 
<?php endif; ?>