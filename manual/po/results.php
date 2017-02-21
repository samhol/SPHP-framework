<?php

namespace Sphp\Util;

include_once '../settings.php';

use Sepia\PoParser as PoParser;
use Sepia\FileHandler as FileHandler;
use Sphp\Stdlib\Arrays;

//echo "<pre>";
//print_r($_GET);
//echo "</pre>";

$search = filter_input(\INPUT_GET, "search", \FILTER_SANITIZE_STRING);
$submit = filter_input(\INPUT_GET, "submit", \FILTER_SANITIZE_STRING);
$perPage = filter_input(\INPUT_GET, "view", FILTER_SANITIZE_NUMBER_INT);

$fileHandler = new FileHandler(\Sphp\LOCALE_PATH . "/fi_FI/LC_MESSAGES/" . \Sphp\DEFAULT_DOMAIN . ".po");
$poParser = new PoParser($handler);
$poParser->parseFile();
$entries = $poParser->entries();
if (isset($submit, $search) && $search !== "") {
	//$msgids = array_keys($entries);
	$result = Arrays::keyContains($entries, $search);
	//$input = preg_quote($search, '~'); // don't forget to quote input string!
	//$result = preg_grep('~' . $input . '~', $msgids);
	//print_r($entries);
	//print_r(array_keys($result));
	//echo "<pre>";
	//print_r($result);
	//echo "</pre>";
} else {
	$result = [];
}

include("resultsViewer.php");
