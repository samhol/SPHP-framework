<?php

namespace Sphp\Manual;

use Sphp\Html\Foundation\F6\Containers\ExceptionCallout as ExceptionCallout;
use Sphp\Util\FileUtils as FileUtils;

include_once 'settings.php';
include_once __DIR__ . "/manualTools/main.php";
try {
	ob_start();
	$pageName = filter_input(\INPUT_GET, "page");
	if ($pageName !== NULL) {
		//$req = Arrays::map($_REQUEST, array("xssClean"));
		$filename = "$pageName.php";
		$path = __DIR__ . "/pages/";
		if (!in_array($filename, FileUtils::dirToArray($path))) {
			include __DIR__ . "/error.php";
		} else {
			include_once $path . $filename;
		}
	} else {
		include(__DIR__ . "/pages/index.php");
	}
	$content = ob_get_contents();
} catch (\Exception $e) {
	$content .= new ExceptionCallout($e);
}
ob_end_clean();
echo $content;
?>
