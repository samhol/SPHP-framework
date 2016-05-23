<?php

namespace Sphp\Html\Headings;

$numResults = count($result);
if ($numResults > 0) {
	$heading = new H4("Results found: Total $numResults");
} else {
	$result = $entries;
	$numEntries = count($entries);
	$heading = new H4("No results found: viewing all $numEntries entries");
}
$heading->printHtml();
include("resultTable.php");
include("pagination.php");
