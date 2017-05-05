<?php

if (have_posts()) : while (have_posts()) : the_post();

$Post = $post->ID;

require __DIR__ . '/layout-header.php';

require __DIR__ . '/parts/sticky.php';

require __DIR__ . '/parts/header.php';

require __DIR__ . '/parts/textbox.php';

require __DIR__ . '/parts/projects.php';

require __DIR__ . '/parts/copy.php';

require __DIR__ . '/layout-footer.php';

endwhile; endif;
?>
