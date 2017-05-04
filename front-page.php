<?php
if (have_posts()) : while (have_posts()) : the_post();

echo get_template_part('layout-header');

echo get_template_part('parts/sticky');

echo get_template_part('parts/header');

echo get_template_part('parts/textbox');

echo get_template_part('parts/projects');

echo get_template_part('parts/copy');

echo get_template_part('layout-footer');

endwhile; endif;
?>
