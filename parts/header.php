<?php
$bg = metaimage('h_image', 'l', $Post);
?>
<header class="header"<?php if($bg){?> style="background-image:url(<?php echo $bg;?>);"<?php }?>>
	<div class="container view-relative">
		<h1 class="header-title title"><?php echo nl2br(rwmb_meta( 'h_title', '', $Post)); ?></h1>
		<div class="section-desc">
			<p>
			<?php
				$tags = array("<p>", "</p>");
				echo str_replace($tags, "", rwmb_meta( 'h_editor', '', $Post)); ?>

			<?php if(rwmb_meta( 'h_morebtn', '', $Post)){ ?>
			<a href="#main" class="header-morebtn"><span>Více info</span>
				<svg class="shape shape-arrow"><use xlink:href="#shape-arrow" /></svg>
			</a>
			<?php } ?>
			</p>
		</div>

		<?php
		$ctaLogo = metaimage('cta_logo', 'square50', $Post);
		$ctaButton = rwmb_meta( 'cta_button', '', $Post);
		$ctaButtonLabel = rwmb_meta( 'cta_button_label', '', $Post);
		$ctaButtonLink = rwmb_meta( 'cta_button_link', '', $Post);
		$ctaPrice = rwmb_meta( 'cta_price', '', $Post);
		$ctaSubscribers = rwmb_meta( 'cta_subscribers', '', $Post);
		$ctaProgressbar = rwmb_meta( 'cta_progressbar', '', $Post);
		$ctaTarget = rwmb_meta( 'cta_target', '', $Post);
		$ctaTargetPrice = rwmb_meta( 'cta_target_price', '', $Post);

		$progress = calculateProgress();

		if(!$ctaPrice && !$ctaLogo && $ctaButton){
		?>
			<div class="contributebox-simple">
				<a href="<?php print($ctaButtonLink ? $ctaButtonLink : get_permalink().'#projekty');?>" class="btn view-secondary"><?php print($ctaButtonLabel ? $ctaButtonLabel : 'Chci také darovat') ?></a>
				<?php if($ctaSubscribers){ ?>
					<div class="center"><small><?php echo esc_html(darujmeCountDonors()) ?> dárců</small></div>
				<?php } ?>
			</div>
		<?php }else{
			if($ctaPrice || $ctaButton){
		?>
		<div class="contributebox<?php if($ctaButton && $ctaLogo && !$ctaPrice){ ?> view-logobutton<?php } ?>">
			<table>
				<tr>
					<?php
					if($ctaLogo){
					?>
					<td>
						<div class="contributebox-img">
							<img src="<?php echo $ctaLogo;?>" alt="">
						</div>
					</td>
					<?php
					}

					if($ctaPrice){
					?>
					<td>
						<div class="contributebox-main">
							<?php if($ctaProgressbar){ ?>
									<div class="contributebox-price view-m"><?php echo str_replace(',', '&nbsp;', number_format(darujmeCountCollectedAmount(), 0));?>&nbsp;Kč</div>
									<div class="progressbar">
										<span style="width: <?php echo number_format($progress, 2, '.', '');?>%"></span>
									</div>
							<?php }else{ ?>
								<p>Již se vybralo</p>
								<div class="contributebox-price"><?php echo str_replace(',', '&nbsp;', number_format(darujmeCountCollectedAmount(), 0));?> Kč</div>
							<?php } ?>

							<?php if($ctaTarget && $ctaTargetPrice){ ?>
								<p><small>Z cílové částky <?php echo str_replace(',', '&nbsp;', number_format($ctaTargetPrice, 0));?> Kč</small></p>
							<?php } ?>
						</div>
					</td>
					<?php
					}

					if($ctaButton){ ?>
					<td>
						<a href="<?php print($ctaButtonLink ? $ctaButtonLink : get_permalink().'#projekty');?>" class="btn view-secondary"><?php print($ctaButtonLabel ? $ctaButtonLabel : 'Chci také darovat') ?></a>
						<?php if($ctaSubscribers){ ?>
						<div class="center"><small><?php echo esc_html(darujmeCountDonors()) ?> dárců</small></div>
						<?php } ?>
					</td>
					<?php } ?>
				</tr>
			</table>
		</div>
		<?php }} ?>

	</div>
</header>
