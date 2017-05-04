<main class="textbox" id="main">
	<div class="container">
		<div class="textbox-in">
			<h2 class="title view-heading"><?php the_title();?></h2><br>
			<div class="basic"><?php the_content();?></div>
		</div>
	</div>

	<?php
	echo get_template_part('parts/sidebar');
	?>

</main>
