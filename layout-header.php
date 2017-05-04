<?php
// Variables
$v = '1.01';
?>

<!DOCTYPE html>

<html lang="cs">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1">

<title><?php bloginfo('name'); ?> | <?php is_front_page() ? bloginfo('description') : wp_title(); ?></title>
<meta name="description" content="<?php bloginfo('description'); ?>" />

<meta property="og:url"                content="<?php echo home_url();?>" />
<meta property="og:type"               content="website" />
<meta property="og:title"              content="<?php bloginfo('name'); ?> | <?php is_front_page() ? bloginfo('description') : wp_title(); ?>" />
<meta property="og:description"        content="<?php bloginfo('description'); ?>" />
<?php
$bg = metaimage('h_image', 'l', $Post);
?>
<?php if($bg){?><meta property="og:image"              content="<?php echo $bg;?>" /><?php }?>

<link rel="stylesheet" href="<?php assetsPath();?>/styles/print.css" media="print">

<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,600,700&amp;subset=latin-ext" rel="stylesheet">

<link rel="icon" type="image/png" href="<?php assetsPath();?>/images/favicon.png?v=darujdnes<?php echo $v;?>" sizes="16x16">
<link rel="icon" type="image/png" href="<?php assetsPath();?>/images/favicon-32x32.png?v=darujdnes<?php echo $v;?>" sizes="32x32">

<!--[if lt IE 9]>
<script src="<?php assetsPath();?>/node_modules/lt-ie-9/lt-ie-9.min.js"></script>
<![endif]-->

<script>
	var homeUrl = "<?php echo home_url();?>"

	initComponents = [
		{ name: 'shapes', data: { url: '<?php assetsPath();?>/sprites/shapes.svg' } }
	]

	function runAnimation(timeout){
		setTimeout(function(){
			document.documentElement.className += ' js run-animation';
		}, timeout)
	}

	runAnimation(400)
</script>

<?php wp_head(); ?>
</head>

<body>
	<?php do_action( 'before' ); ?>
