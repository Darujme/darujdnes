<section class="projects" id="projekty">
	<div class="container">
		<h2 class="title view-heading"><svg class="shape shape-projects-icon"><use xlink:href="#shape-projects-icon" /></svg><?php echo rwmb_meta( 'p_title', '', $Post);?></h2>
		<div class="section-desc">
			<p><?php echo nl2br(rwmb_meta( 'p_editor', '', $Post)); ?></p>
		</div>

		<div class="projects-list">
			<?php
			$defaultImage = getAssetsPath() . '/images/project-default.jpg';
			$projects = darujmeListProjects();
			foreach ($projects as $project) {
			?>
			<article class="projects-item center" style="background-image:url(<?php echo esc_attr(!empty($project['image_header_url']) ? $project['image_header_url'] : $defaultImage) ?>)">
				<img class="projects-item-img" src="<?php assetsPath();?>/images/project.png" alt="">
				<div class="projects-item-in">
					<div class="projects-item-logo">
						<img src="<?php echo esc_attr($project['organization_logo_url']) ?>" alt="">
					</div>
					<div class="projects-item-logo-name"><?php echo esc_html($project['organization_name']) ?></div>
					<div class="projects-item-hr"></div>

					<div class="projects-item-main">
						<div class="projects-item-main-in">
							<?php foreach ($project['project_tags'] as $tag): ?>
								<div class="projects-item-subtitle upper"><?php echo esc_html(strtoupper($tag)) ?></div>
							<?php endforeach ?>
							<h3 class="title projects-item-title"><?php echo esc_html($project['project_name']) ?></h3>
						</div>
					</div>

					<div class="projects-item-btn">
						<a href="<?php echo esc_attr($project['donate_url']) ?>" class="btn view-secondary-s"><?php echo esc_html($project['donate_label']) ?></a>
					</div>
				</div>
			</article>
			<?php
			}
			?>

		</div>
	</div>
</section>
