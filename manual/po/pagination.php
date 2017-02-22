<?php
namespace Sphp\Html\Foundation\Navigation;
use Sphp\Stdlib\URL;

//$poparser = new PoParser();

//$poparser->parseFile(__DIR__ . "/../../sph/locale/fi_FI/LC_MESSAGES/" . \Sphp\DEFAULT_DOMAIN . ".po");
//$entries = $poparser->entries();
//echo "<pre>";
//ksort($entries);
//print_r($entries);
//var_dump($perPage);
if (!in_array($perPage, $perPageOptions)) {
	$perPage = 10;
}
//var_dump($perPage);
//$curl = URL::getCurrent();
$num = count($result);
//var_dump($result);
$offset = 0;
$page = 1;
$pages = [];
while ($offset < $num) {
	//echo "before:" . memory_get_peak_usage() . "\n";
	//pages[$page] = URL::getCurrent()->setParam("page", $page);
	//if ($offset > 0) {
	$pages[$page] = URL::getCurrent()->setParam("page", $page);
	//echo "creation+unset:" . memory_get_peak_usage() . "\n";
		//$pageLink->setParam("offset", $offset);
	//}
	$page++;
	$offset = $perPage * $page;
	//var_dump($offset);
	//var_dump($page);
	//echo "after:" . memory_get_peak_usage() . "\n";
}
$pagination = (new Pagination($pages))
		->printHtml();