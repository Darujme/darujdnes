<?php

if (!defined('DARUJME_CACHE_SECONDS')) {
	define('DARUJME_CACHE_SECONDS', 15);
}

if (!function_exists('darujmeGetSettings')) {
	function darujmeGetSettings($forceUpdate = FALSE) {
		static $settings;
		if (!$settings || $forceUpdate) {
			$settings = get_option('darujme_settings', []);

			if (!isset($settings['api_id'])) {
				$settings['api_id'] = '';
			}

			if (!isset($settings['api_secret'])) {
				$settings['api_secret'] = '';
			}

			if (!isset($settings['items'])) {
				$settings['items'] = [];
			}
		}

		return $settings;
	}
}

if (!function_exists('darujmeGetThemeSettings')) {
	function darujmeGetThemeSettings($forceUpdate = FALSE) {
		static $themeSettings;
		if (!$themeSettings || $forceUpdate) {
			$themeSettings = get_option('darujme_theme_settings', [
				'footer_left' => '',
				'footer_right' => '',
				'color_primary' => '',
				'color_secondary' => '',
			]);

			if (!isset($themeSettings['footer_left'])) {
				$themeSettings['footer_left'] = '';
			}

			if (!isset($themeSettings['footer_right'])) {
				$themeSettings['footer_right'] = '';
			}

			if (!isset($themeSettings['color_primary'])) {
				$themeSettings['color_primary'] = '';
			}

			if (!isset($themeSettings['color_secondary'])) {
				$themeSettings['color_secondary'] = '';
			}

		}

		return $themeSettings;
	}
}

function darujmeGetThemeSettingsItem($name) {
	return @darujmeGetThemeSettings()[$name];
}

function darujmeGetApiId() {
	if (defined('DARUJME_API_ID')) {
		return DARUJME_API_ID;
	}
	return darujmeGetSettings()['api_id'];
}

function darujmeGetApiSecret() {
	if (defined('DARUJME_API_SECRET')) {
		return DARUJME_API_SECRET;
	}
	return darujmeGetSettings()['api_secret'];
}

function darujmeGetItems() {
	return darujmeGetSettings()['items'];
}

function darujmeApiUrl($path, array $query, $id, $secret) {
	$path = ltrim($path, '/');
	$query['apiId'] = $id;
	$query['apiSecret'] = $secret;
	$query = array_filter($query);
	return "https://www.darujme.cz/api/v1/$path?".http_build_query($query);
}

function darujmeApiRequest($path, array $query, $id, $secret, $forceUpdate = FALSE) {
	$url = darujmeApiUrl($path, $query, $id, $secret);

	$cacheKey = 'dac_' . md5($url);

	$cached = get_option($cacheKey, NULL);

	if ($cached && !$forceUpdate) {
		$timediff = time() - $cached['timestamp'];
		if ($timediff < DARUJME_CACHE_SECONDS) {
			return $cached['result'];
		}
	}

	$result = json_decode(file_get_contents($url), TRUE);

	$cached = [
		'timestamp' => time(),
		'result' => $result
	];

	$cached['items'] = $result;
	$cached['timestamp'] = time();

	update_option($cacheKey, $cached);

	return $result;
}

function darujmeLoadAllStats($range = [], $forceUpdate = FALSE) {
	static $results;

	if (!$results) {
		$results = [];
	}

	$resultKey = serialize($range);

	if (!empty($results[$resultKey]) && !$forceUpdate) {
		return $results[$resultKey];
	}

	$result = [];

	$apiId = darujmeGetApiId();
	$apiSecret = darujmeGetApiSecret();
	$items = darujmeGetItems();

	foreach ($items as $original) {
		$id = $original['id'];
		$type = $original['type'];
		$item = darujmeApiRequest("/$type/$id/stats", $range, $apiId, $apiSecret);
		if ($item) {
			$type = isset($item['promotionStats']) ? 'promotionStats' : 'projectStats';
			$item = $item[$type];
			$item['type'] = $type;
			$item['original'] = $original;
			$item['promotionId'] = $item['projectId'] = $id;
		}
		if ($item) {
			$result[] = $item;
		}
	}
	$results[$resultKey] = $result;
	return $result;
}

function darujmeLoadAll($forceUpdate = TRUE) {
	static $result;

	if ($result && !$forceUpdate) {
		return $result;
	}

	$result = [];

	$apiId = darujmeGetApiId();
	$apiSecret = darujmeGetApiSecret();
	$items = darujmeGetItems();

	foreach ($items as $original) {
		$id = $original['id'];
		$type = $original['type'];
		$item = darujmeApiRequest("/$type/$id", [], $apiId, $apiSecret);
		if ($item) {
			$type = isset($item['promotion']) ? 'promotion' : 'project';
			$item = $item[$type];
			$item['type'] = $type;
			$item['original'] = $original;
			$item['promotionId'] = $item['projectId'] = $id;
		}
		if ($item) {
			$result[] = $item;
		}
	}

	return $result;
}

function darujmeCountCollectedAmount($range = []) {
	static $sum;

	if ($sum !== NULL) {
		return $sum;
	}

	$items = darujmeLoadAllStats($range);

	$unique = [];

	foreach ($items as $item) {
		if ($item) {
			$uid = 'project:'.$item['projectId'].':promotion:'.$item['promotionId'];
			$unique[$uid] = $item['collectedAmountEstimate']['cents'];
		}
	}

	$sum = 0;

	foreach ($unique as $projectSum) {
		$sum += $projectSum;
	}

	$sum = round($sum / 100);

	return $sum;
}

function darujmeCalculateProgress($range = [], $target) {
	if (!$target) {
		return 0;
	}

	$now = darujmeCountCollectedAmount($range);
	$percent = $now / ($target / 100);

	return $percent;
}

function darujmeCountDonors($range = []) {
	static $count;

	if ($count !== NULL) {
		return $count;
	}


	$items = darujmeLoadAllStats($range);

	$unique = [];

	foreach ($items as $item) {
		if ($item && !empty($item['donorsCount'])) {
			$uid = 'project:'.$item['projectId'].':promotion:'.$item['promotionId'];
			$unique[$uid] = $item['donorsCount'];
		}
	}

	$count = 0;

	foreach ($unique as $projectCount) {
		$count += $projectCount;
	}

	$count = $count;

	return $count;
}

function darujmeListProjects() {
	static $projects;

	if ($projects) {
		return $projects;
	}

	$projects = [];

	$items = darujmeLoadAll();

	foreach ($items as $item) {
		if ($item) {
			$tags = [];
			if (isset($item['tags'])) foreach ($item['tags'] as $tag) {
				$tags[] = $tag['label']['cs'];
			}
			$donateLabel = 'Chci darovat';
			$donateUrl = $item['donateUrl'];

			if (!empty($item['original'])) {
				if (!empty($item['original']['donate_label'])) {
					$donateLabel = $item['original']['donate_label'];
				}
				if (!empty($item['original']['donate_url'])) {
					$donateUrl = $item['original']['donate_url'];
				}
			}

			$projects[] = [
				'uid' => 'project:'.$item['projectId'].':promotion:'.$item['promotionId'],
				'organization_logo_url' => $item['organization']['logo']['url'],
				'organization_name' => $item['organization']['name'],
				'project_name' => $item['title']['cs'],
				'donate_url' => $donateUrl,
				'donate_label' => $donateLabel,
				'project_tags' => $tags,
				'image_header_url' => @$item['imageHeader']['url'],
			];
		}
	}

	return $projects;
}
