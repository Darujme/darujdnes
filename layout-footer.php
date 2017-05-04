<?php wp_footer(); ?>
<?php
if(file_exists(__DIR__.'/.mango-snippet.html')){
	include __DIR__.'/.mango-snippet.html';
}
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="<?php assetsPath();?>/scripts/index.js" defer></script>

</body>
</html>
