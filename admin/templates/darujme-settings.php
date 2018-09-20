<?php

$api_id = darujmeGetApiId();
$api_secret = darujmeGetApiSecret();
$items = darujmeGetItems();

function itemRowTemplate($key, $item = NULL) {
	$type = NULL;
	$id = '';
	if ($item) {
		$id = $item['id'];
		$type = $item['type'];
		$donate_label = $item['donate_label'];
		$donate_url = $item['donate_url'];
	}
?>
	<tr class="darujme-table-row">
		<th>
			↑↓
		</th>
		<td>
			<label style="margin-right:1em">
				<input type="radio" name="darujme_project_type[<?php echo esc_attr($key) ?>]" value="project" <?php echo ($type === 'project' || $type === NULL) ? 'checked="checked"' : '' ?>> projekt
			</label>
			<label>
				<input type="radio" name="darujme_project_type[<?php echo esc_attr($key) ?>]" value="promotion" <?php echo ($type === 'promotion') ? 'checked="checked"' : '' ?>> výzva
			</label>
			<br>
			<input name="darujme_project_id[<?php echo esc_attr($key) ?>]" type="text" id="darujme_project_id[<?php echo esc_attr($key) ?>]" value="<?php echo esc_attr($id) ?>" placeholder="ID projektu nebo výzvy (použijte vždy ID, ne číslo projektu)" class="regular-text code">
			<br>
			<input name="darujme_project_donate_label[<?php echo esc_attr($key) ?>]" type="text" id="darujme_project_donate_label[<?php echo esc_attr($key) ?>]" value="<?php echo esc_attr($donate_label) ?>" class="regular-text" placeholder="Popis tlačítka (nepovinné, výchozí: Chci darovat)">
			<br>
			<input name="darujme_project_donate_url[<?php echo esc_attr($key) ?>]" type="text" id="darujme_project_donate_url[<?php echo esc_attr($key) ?>]" value="<?php echo esc_attr($donate_url) ?>" class="regular-text" placeholder="URL tlačítka (nepovinné)">
		</td>
		<td>
			<button type="button" class="button" data-action="darujme-remove-project">Odebrat</button>
		</td>
	</tr>
<?php
}

?>
<style>
.darujme-table-row {
	border-top: solid 1px rgba(220, 220, 220, .75);
}
.darujme-table-row th {
	vertical-align: middle;
	padding-left: 20px;
	font-size: 30px;
}
.darujme-table-row:hover {
	background: rgba(220, 220, 220, .75);
}
</style>
<div class="wrap">
	<h1>Nastavení propojení s Darujme.cz</h1>
	<form method="post" novalidate="novalidate" id="darujme_form">
		<table class="form-table" style="max-width:900px">
			<tbody>
				<tr>
					<th scope="row">
						<label for="darujme_api_id">API id</label>
					</th>
					<td>
						<input type="text" name="darujme_api_id" id="darujme_api_id" value="<?php echo esc_attr($api_id) ?>" class="regular-text code">
					</td>
					</td>
				</tr>
				<tr>
					<th scope="row">
						<label for="darujme_api_secret">API secret</label>
					</th>
					<td>
						<input type="text" name="darujme_api_secret" id="darujme_api_secret" value="<?php echo esc_attr($api_secret) ?>" class="regular-text code">
					</td>
					</td>
				</tr>
			</tbody>
		</table>
		<hr>
		<h1>Projekty a výzvy</h1>
		<table class="form-table" style="max-width:900px">
			<tbody id="darujme_sortable_items">
				<?php foreach ($items as $key => $item) itemRowTemplate($key, $item) ?>
			</tbody>
			<tfoot>
				<tr>
					<th>
					</th>
					<td>
						<button type="button" class="button" data-action="darujme-add-project">Přidat projekt</button>
					</td>
					<td>
						&nbsp;
					</td>
				</tr>
			</tfoot>
		</table>
		<hr>

		<h1>Nastavení patičky</h1>
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row">
						<label for="darujme_footer_left">Levá část</label>
					</th>
					<td>
						<input type="text" name="darujme_footer_left" id="darujme_footer_left" value="<?php echo esc_attr(darujmeGetThemeSettingsItem('footer_left')) ?>" class="regular-text code">
					</td>
					</td>
				</tr>
				<tr>
					<th scope="row">
						<label for="darujme_footer_right">Pravá část</label>
					</th>
					<td>
						<input type="text" name="darujme_footer_right" id="darujme_footer_right" value="<?php echo esc_attr(darujmeGetThemeSettingsItem('footer_right')) ?>" class="regular-text code">
					</td>
					</td>
				</tr>
			</tbody>
		</table>
		<hr>

		<h1>Nastavení barev</h1>
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row">
						<label for="darujme_color_primary">Primární</label>
					</th>
					<td>
						<input type="text" name="darujme_color_primary" id="darujme_color_primary" value="<?php echo esc_attr(darujmeGetThemeSettingsItem('color_primary')) ?>" class="regular-text code colorpicker">
					</td>
					</td>
				</tr>
				<tr>
					<th scope="row">
						<label for="darujme_color_secondary">Sekundární</label>
					</th>
					<td>
						<input type="text" name="darujme_color_secondary" id="darujme_color_secondary" value="<?php echo esc_attr(darujmeGetThemeSettingsItem('color_secondary')) ?>" class="regular-text code colorpicker">
					</td>
					</td>
				</tr>
			</tbody>
		</table>

		<p class="submit">
			<input type="submit" name="submit" id="submit" class="button button-primary" value="Uložit změny">
		</p>
	</form>
</div>

<script type="text/template" id="darujme_item_template">
	<?php itemRowTemplate('{new}') ?>
</script>

<script type="text/javascript">
jQuery(document).ready( function($) {
	$('.colorpicker').iris({
		hide: false,
		palettes: ['#ED9136','#17AE1C', '#2980B9', '#8e44ad', '#34495e', '#f1c40f', '#d35400', '#e74c3c']
	});

	var $items = $('#darujme_sortable_items')
	$items.sortable()

	var id = 100
	var limit = 9

	var addProject = function() {
		id++
		var count = $items.find('tr').length
		if(count >= limit) {
			alert('Můžete přidat maximálně ' + limit + ' projektů.');
			return
		}
		var $new = $('#darujme_item_template').html().split('{new}').join(id)
		$items.append($new)
	}

	$('[data-action="darujme-add-project"]').on('click', addProject)

	$items.on('click', '[data-action="darujme-remove-project"]', function() {
		$(this).closest('tr').remove()
	})

	if($items.find('tr').length === 0) {
		addProject()
	}

})
</script>
