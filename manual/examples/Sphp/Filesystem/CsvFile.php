<?php

namespace Sphp\Stdlib;

use Sphp\Html\Tables\Table;

$data = (new CsvFile("manual/snippets/example.csv"))->toArray();
$table = new Table("Cars to buy:");
$table->thead()->appendHeaderRow(array_shift($data));
foreach ($data as $row) {
	$table->tbody()->appendBodyRow($row);
}
$table->printHtml();
