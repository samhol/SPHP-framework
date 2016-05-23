<?php

namespace Sphp\Html\Tables;

$table = new Table();
$table->thead()->append(["Row:", "Form:", "English:", "Finnish translation:"]);
$body = $table->tbody();

$th = function ($i) {
	return new Th($i . ".", "row");
};
$singular = function($data, $i) use ($body, $th) {
	$ptd = (new Td("singular"));
	$body[] = [$th($i), $ptd, $data["msgid"], $data["msgstr"][0]];
};
$plural = function($data, $i) use ($body, $th) {
	$ptd = (new Td("plural"))->setRowspan(2);
	$body[] = [
		$th($i)->setRowspan(2),
		$ptd,
		$data["msgid"],
		$data["msgstr"][0]
	];
	$body[] = [
		$data["msgid_plural"],
		$data["msgstr"][1]
	];
};
ksort($result);

//$offset = filter_input(\INPUT_GET, "offset", FILTER_SANITIZE_NUMBER_INT);
$length = filter_input(\INPUT_GET, "view", FILTER_SANITIZE_NUMBER_INT);
$page = filter_input(\INPUT_GET, "page", FILTER_SANITIZE_NUMBER_INT);
$offset = $length * $page;
if ($offset > count($result)) {
	$offset = 0;
}
$view = array_slice($result, $offset, $length, true);
$i = $offset + 1;
foreach ($view as $messageId => $data) {
	if (array_key_exists("msgid_plural", $data)) {
		$plural($data, $i);
	} else {
		$singular($data, $i);
	}
	$i++;
}


$table->printHtml();
