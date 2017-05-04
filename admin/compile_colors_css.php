<?php
/**
* Convert hex to rgb color
*
*/
function hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);
   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   return implode(",", $rgb); // returns the rgb values separated by commas
   //return $rgb; // returns an array with the rgb values
}


/**
* Compile CSS after acf field update
*
*/
function compile_color_css( $themeColor, $themeColor2 )
{
  if ( !current_user_can( 'manage_options' ) ) {
    die('Pro tuto funkci je nutné být přihlášen jako administrátor.');
  }
  $replaceColor = strtolower('#ED9136');
  $replaceColor2 = strtolower('#07AE1C');

	$cssFile = file_get_contents(get_template_directory().'/assets/styles/index.css');

  $cssFile = str_replace($replaceColor, $themeColor, $cssFile);
  $cssFile = str_replace(hex2rgb($replaceColor), hex2rgb($themeColor), $cssFile);

  $cssFile = str_replace($replaceColor2, $themeColor2, $cssFile);
  $cssFile = str_replace(hex2rgb($replaceColor2), hex2rgb($themeColor2), $cssFile);

  file_put_contents(get_template_directory().'/assets/styles/index_colored.css', $cssFile);
  return $value;
}
