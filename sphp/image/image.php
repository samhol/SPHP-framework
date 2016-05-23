<?php

namespace Sphp\Images;

include_once '../settings.php';

$src = filter_input(\INPUT_GET, 'src', \FILTER_SANITIZE_SPECIAL_CHARS);
$op = filter_input(\INPUT_GET, 'op', \FILTER_SANITIZE_NUMBER_INT);
if ($op !== NULL && $src !== NULL) {
	try {
		$img = new ImageScaler($src);
		if ($op == SCALE_TO_FIT || $op == RESIZE) {
			$width = filter_input(\INPUT_GET, 'width', \FILTER_SANITIZE_NUMBER_INT);
			$height = filter_input(\INPUT_GET, 'height', \FILTER_SANITIZE_NUMBER_INT);
			if ($op == SCALE_TO_FIT) {
				$img->scaleToFit($width, $height);
			}
			if ($op == RESIZE) {
				$img->resize($width, $height);
			}
		} else if ($op == SCALE) {
			$ratio = filter_input(\INPUT_GET, 'ratio', \FILTER_SANITIZE_NUMBER_FLOAT);
			if ($ratio !== NULL && ratio <= 2) {
				$img->scale($ratio);
			}
		}
	} catch (\Exception $e) {
		$img = new ImageScaler(\Sphp\HTTP_ROOT . "/sph/image/error.png");
	}
	$img->show();
}
exit;

