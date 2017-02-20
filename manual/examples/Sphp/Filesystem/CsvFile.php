<?php

namespace Sphp\Stdlib;

use Sphp\Html\Tables\Table;
use Sphp\Core\Path;

$data = (new CsvFile(Path::get()->local("manual/snippets/example.csv")))->toArray();
$table = new Table("Cars to buy:");
$table->thead()->appendHeaderRow(array_shift($data));
foreach ($data as $row) {
	$table->tbody()->appendBodyRow($row);
}
$table->printHtml();

?>