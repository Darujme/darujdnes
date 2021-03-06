<?php
$ctaLogo = metaimage('cta_logo', 'square50', $Post);
$ctaButton = rwmb_meta( 'cta_button', '', $Post);
$ctaButtonLabel = rwmb_meta( 'cta_button_label', '', $Post);
$ctaButtonLink = rwmb_meta( 'cta_button_link', '', $Post);
$ctaPrice = rwmb_meta( 'cta_price', '', $Post);
$ctaTimerangeStart = rwmb_meta( 'cta_timerange_start', '', $Post);
$ctaTimerangeEnd = rwmb_meta( 'cta_timerange_end', '', $Post);
$range = [ 'fromDate' => $ctaTimerangeStart, 'toDate' => $ctaTimerangeEnd ];

$collectedAmount = darujmeCountCollectedAmount($range);
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
			<?php
			if($ctaPrice){
			?>
			<div class="sticky-price">
				<p>Již se vybralo: <b><?php echo str_replace(',', '&nbsp;', number_format($collectedAmount, 0));?> Kč</b></p>
			</div>
			<?php
			}

			if($ctaButton){
			?>
				<a href="<?php print($ctaButtonLink ? $ctaButtonLink : get_permalink().'#projekty');?>" class="btn view-secondary-s view-short"><?php print($ctaButtonLabel ? $ctaButtonLabel : 'Chci také darovat') ?></a>
			<?php
			}
			?>
		</div>

	</div>
</section>
