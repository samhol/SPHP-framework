<?php

namespace Imagine;

//use Imagine\Image\Box;
include_once '../settings.php';
$imagine = new Gd\Imagine();

use Sphp\Stdlib\Arrays;
use Sphp\Util\FileUtils as FileUtils;
use Sphp\Images\Images as ImageUtils;

$src = filter_input(\INPUT_GET, 'src', \FILTER_SANITIZE_SPECIAL_CHARS);
if ($src !== NULL) {
	try {
		if (!FileUtils::remoteFileExists($src)) {
			$src = "../../" . $src;
			if (!is_file($src)) {
				throw new \Exception("Image not found");
			}
		}
		$finfo = ImageUtils::getImageInfo($src);
		$mime = $finfo["mime"];
		header('Content-type: ' . $mime);
		header('Content-Disposition: filename="thumb.' . $finfo["ext"]);
		$image = $imagine->open($src);
	} catch (\Exception $e) {
		header('Content-type: image/png');
		header('Content-Disposition: filename="error.png"');
		$image = $imagine->open("error.png");
	}
	$box1 = $image->getSize();
	//echo $box1->getWidth();

	$width = filter_input(\INPUT_GET, 'w', \FILTER_SANITIZE_NUMBER_INT);
	if ($width > 0 && $box1->getWidth() > $width) {
		$image->resize($box1->widen($width));
	}
	$box2 = $image->getSize();
	$height = filter_input(\INPUT_GET, 'h', \FILTER_SANITIZE_NUMBER_INT);
	if ($height > 0 && $box2->getHeight() > $height) {
		$image->resize($box2->heighten($height));
	}
	echo $image;
}
exit;

function scaleDown($src, $w = null, $h = null) {
	$imagine = new Gd\Imagine();
	try {
		$finfo = ImageUtils::getImageInfo($src);
		$mime = $finfo["mime"];
		header('Content-type: ' . $mime);
		header('Content-Disposition: filename="thumb.' . $finfo["ext"]);
		$image = $imagine->open($src);
	} catch (\Exception $e) {
		header('Content-type: image/png');
		header('Content-Disposition: filename="error.png"');
		$image = $imagine->open("error.png");
	}
	$img = $imagine->open($src);
	$box1 = $img->getSize();
	if (isset($w) && $w > 0 && $box1->getWidth() > $w) {
		$img->resize($box1->widen($w));
	}
	$box2 = $img->getSize();
	if (isset($h) && $h > 0 && $box2->getHeight() > $h) {
		$img->resize($box2->heighten($h));
	}
	return $img;
}
