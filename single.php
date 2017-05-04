<?php
/**
 * The template for displaying  pages.
 *
 */

get_header(); ?>

<div class="column fullsize">
	<h2><?php the_title();?></h2>
	<div class="in">
		<?php the_content();?>
	</div>
</div>

<?php get_footer(); ?>