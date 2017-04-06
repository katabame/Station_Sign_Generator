<?php
function get($input, $default = null)
{
	if (empty($input))
		return $default;

	return $input;
}

$currentStation = urldecode(get($_GET["cs"]));

$currentStationSubtitle = urldecode(get($_GET["css"]));

$nextStation = urldecode(get($_GET["ns"]));
$nextStationSubtitle = urldecode(get($_GET["nss"]));

$prevStation = urldecode(get($_GET["ps"]));
$prevStationSubtitle = urldecode(get($_GET["pss"]));

$isPrev = isset($_GET["ip"]);

$hex = get($_GET["hex"], "f5f5f5");
$hex = preg_replace("/#/", "", $hex);

$r = hexdec(substr($hex, 0, 2));
$g = hexdec(substr($hex, 2, 2));
$b = hexdec(substr($hex, 4, 2));

$img = imagecreate(1500, 600);
$bg = ImageColorAllocate($img, 0x21, 0x21, 0x21);
$font = "font/mplus-1c-medium.ttf";
$font_color = ImageColorAllocate($img, 0xf5, 0xf5, 0xf5);

// Current Station
$tb = imagettfbbox(100, 0, $font, $currentStation);
$x = ceil((1500 - $tb[2]) / 2);
ImageTTFText($img, 100, 0, $x, 150, $font_color, $font, $currentStation);

$tb = imagettfbbox(50, 0, $font, $currentStationSubtitle);
$x = ceil((1500 - $tb[2]) / 2);
ImageTTFText($img, 50, 0, $x, 230, $font_color, $font, $currentStationSubtitle);

// Next Station
$tb = imagettfbbox(60, 0, $font, $nextStation);
$x = ceil(1500 - 75 - $tb[2]);
ImageTTFText($img, 60, 0, $x, 500, $font_color, $font, $nextStation);

$tb = imagettfbbox(30, 0, $font, $nextStationSubtitle);
$x = ceil(1500 - 75 - $tb[2]);
ImageTTFText($img, 30, 0, $x, 550, $font_color, $font, $nextStationSubtitle);

// Prev Station
$tb = imagettfbbox(60, 0, $font, $prevStation);
$x = ceil(75);
ImageTTFText($img, 60, 0, $x, 500, $font_color, $font, $prevStation);

$tb = imagettfbbox(30, 0, $font, $prevStationSubtitle);
$x = ceil(75);
ImageTTFText($img, 30, 0, $x, 550, $font_color, $font, $prevStationSubtitle);

// nav bar
if($isPrev)
{
	$vertex = array(
		76, 410,
		1425, 410,
		1425, 350,
		194, 350
	);
}
else
{
	$vertex = array(
		76, 410,
		1425, 410,
		1307, 350,
		76, 350
	);
}
$barcolor = imagecolorallocate($img, $r, $g, $b);
imagefilledpolygon($img, $vertex, 4, $barcolor);

header("Content-Type: image/png");
Imagepng($img);
ImageDestroy($img);
