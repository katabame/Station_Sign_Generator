<?php
header("Content-type: image/png");

$currentStation = isset($_GET["cs"])? $_GET["cs"] : "";
$currentStationSubtitle = isset($_GET["css"])? $_GET["css"] : "";

$nextStation = isset($_GET["ns"])? $_GET["ns"] : "";
$nextStationSubtitle = isset($_GET["nss"])? $_GET["nss"] : "";

$prevStation = isset($_GET["ps"])? $_GET["ps"] : "";
$prevStationSubtitle = isset($_GET["pss"])? $_GET["pss"] : "";

$isNext = true;
if(isset($_GET["in"]))
{
	if($_GET["in"] == "true")
	{
		$isNext = true;
	}
	else
	{
		$isNext = false;
	}
}

$img = imagecreate(1500, 600);
$bg = ImageColorAllocate($img, 0x21, 0x21, 0x21);
$font = "font/mplus-1c-medium.ttf";
$font_color = ImageColorAllocate($img, 0xf5, 0xf5, 0xf5);

// Current Station
$tb = imagettfbbox(100, 0, $font, $currentStation);
$x = ceil( (1500 - $tb[2]) / 2 );
ImageTTFText($img, 100, 0, $x, 150, $font_color, $font, $currentStation);

$tb = imagettfbbox(50, 0, $font, $currentStationSubtitle);
$x = ceil( (1500 - $tb[2]) / 2 );
ImageTTFText($img, 50, 0, $x, 230, $font_color, $font, $currentStationSubtitle);


// Next Station
$tb = imagettfbbox(60, 0, $font, $nextStation);
$x = ceil( 1500 - 75 - $tb[2] );
ImageTTFText($img, 60, 0, $x, 500, $font_color, $font, $nextStation);

$tb = imagettfbbox(30, 0, $font, $nextStationSubtitle);
$x = ceil( 1500 - 75 - $tb[2] );
ImageTTFText($img, 30, 0, $x, 550, $font_color, $font, $nextStationSubtitle);


// Prev Station
$tb = imagettfbbox(60, 0, $font, $prevStation);
$x = ceil( 75 );
ImageTTFText($img, 60, 0, $x, 500, $font_color, $font, $prevStation);

$tb = imagettfbbox(30, 0, $font, $prevStationSubtitle);
$x = ceil( 75 );
ImageTTFText($img, 30, 0, $x, 550, $font_color, $font, $prevStationSubtitle);


// nav bar
if ($isNext)
{
	$bar = imagecreatefrompng("next.png");
}
else
{
	$bar = imagecreatefrompng("prev.png");
}
$bar_width = imagesx($bar);
$bar_height = imagesy($bar);
imagecopy($img, $bar, 75, 350, 0, 0, $bar_width, $bar_height);

Imagepng($img);
ImageDestroy($img);
?>
