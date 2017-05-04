<?php
/*
Template Name: Homepage
*/

echo get_template_part('layout-header');

if (have_posts()) : while (have_posts()) : the_post(); ?>

<header class="header center view-static">
	<div class="container view-l">
		<h1 class="header-title title"><?php bloginfo('name'); ?></h1>
		<div class="header-nav">
			<a href="<?php echo home_url();?>">Přejít na úvodní stránku</a>
		</div>
	</div>
</header>

<main class="textbox">
	<div class="container">
		<div class="textbox-in">
			<h2 class="title view-heading"><?php the_title();?></h2><br>
			<div class="basic"><?php the_content();?></div>
		</div>
	</div>
</main>

<?php
endwhile; endif;

echo get_template_part('parts/copy');

echo get_template_part('layout-footer');

?>
