<?php
$ctaLogo = metaimage('cta_logo', 'square50', $Post);
$ctaButton = rwmb_meta( 'cta_button', '', $Post);
$ctaButtonLabel = rwmb_meta( 'cta_button_label', '', $Post);
$ctaButtonLink = rwmb_meta( 'cta_button_link', '', $Post);
?>
<section class="sticky">
	<div class="container view-l">

		<div class="sticky-left relative">
			<?php
			if($ctaLogo){
			?>
				<img src="<?php echo $ctaLogo;?>" alt="">
			<?php
			}
			?>
			<h1 class="title sticky-title"><?php echo rwmb_meta( 'h_title', '', $Post); ?></h1>
		</div>

		<div class="sticky-right">
			<div class="sticky-price">
				<p>Již se vybralo: <b><?php echo str_replace(',', '&nbsp;', number_format(darujmeCountCollectedAmount(), 0));?> Kč</b></p>
			</div>
			<a href="<?php echo $ctaButtonLink;?>" class="btn view-secondary-s view-short"><?php print($ctaButtonLabel ? $ctaButtonLabel : 'Chci také darovat') ?></a>
		</div>

	</div>
</section>
