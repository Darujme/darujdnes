<?php
$gallery = rwmb_meta( 'sidebar_gallery', 'type=image&size=square290', $Post );
$galleryCount = count($gallery);
?>
<aside class="sidebar<?php if($galleryCount == 4){ echo " view-withgallery"; }?>">
			<?php
			if($galleryCount == 4){
				foreach ( $gallery as $image ) {
			?>
				<div class="sidebar-item">
					<img class="sidebar-img" src="<?php echo esc_url( $image['url']);?>" alt="">
				</div>
			<?php
				}
			}
			?>
			<?php
			if(rwmb_meta( 's_tile', '', $Post)){
			?>
			<div class="sidebar-item view-tile">
				<div class="tile center">
					<?php
					$tileImg = metaimage('s_image', 'square50', $Post);
					$tileEmail = rwmb_meta( 's_email', '', $Post);
					$tilePhone = rwmb_meta( 's_phone', '', $Post);

					if($tileImg){
					?>
					<img class="sidebar-img" src="<?php assetsPath();?>/images/gallery-blank.png" alt="">
					<?php
					}
					?>
					<div class="tile-in">
						<div class="tile-title"><?php echo rwmb_meta( 's_title', '', $Post);?></div>
						<img class="tile-img" src="<?php echo $tileImg;?>" alt="">
						<p><b class="large"><?php echo rwmb_meta( 's_name', '', $Post);?></b><br>
							<?php if($tileEmail){ ?>
								<a href="mailto:<?php echo $tileEmail; ?>"><?php echo $tileEmail; ?></a><br>
							<?php }if($tilePhone){ ?>
								<b><?php echo $tilePhone;?></b>
							<?php } ?>
						</p>
					</div>
			</div>
		</div>
		<?php } ?>
</aside>
