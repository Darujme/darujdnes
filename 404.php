<?php
/*
Template Name: Homepage
*/

echo get_template_part('layout-header');
?>

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
			<h2 class="title view-heading">Chyba 404 - Stránka nenalezena</h2><br>
			<div class="basic">
				<p>Zkuste se vrátit na <a href="<?php echo home_url();?>">úvodní stránku</a>. Za případné potíže se Vám omlouváme.</p>
			</div>
		</div>
	</div>
</main>

<?php
echo get_template_part('parts/copy');

echo get_template_part('layout-footer');

?>
