<?php

namespace Sphp\Html;

include_once "../settings.php";

(new Headings\H5("Form submission data"))
		->addCssClass("sphp-submission-heading")
		->printHtml();

namespace Sphp\Html\Foundation\F6\Core;

$panels = [];
$get = filter_input_array(\INPUT_GET, FILTER_SANITIZE_STRING);
if (is_array($get) && count($get) > 0) {
	$panels[] = "<h6><code>GET</code> data:</h6><pre>" . print_r($get, true) . "</pre>";
}
$post = filter_input_array(\INPUT_POST, FILTER_SANITIZE_STRING);
if (is_array($post) && count($post) > 0) {
	$panels[] = "<h6><code>POST</code> data:</h6><pre>" . print_r($post, true) . "</pre>";
}
//print_r($panels);
if (count($panels) > 0) {
	$grid = (new Grid());
	$grid[] = (new Row($panels))
			->setAttr("data-equalizer");
	foreach ($grid->getColumns() as $column) {
		$column->addCssClass("panel")
				->setAttr("data-equalizer-watch");
	}
	$grid->printHtml();
} else{
	echo "<p>No submission data!</p>";
}
/*echo "<pre>";
print_r($_GET);
print_r($_POST);
echo "</pre>";*/