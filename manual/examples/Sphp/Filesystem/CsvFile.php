<?php

namespace Sphp\Stdlib\Parsers;

use Sphp\Html\Tables\Table;

$data = (new CsvFile("manual/snippets/example.csv"))->toArray();
$table = new Table();
$table->setCaption("Cars to buy:");
$table->thead()->appendHeaderRow(array_shift($data));
foreach ($data as $row) {
	$table->tbody()->appendBodyRow($row);
}
$table->printHtml();
