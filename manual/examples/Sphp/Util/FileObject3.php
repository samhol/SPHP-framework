<?php

namespace Sphp\Util;

use Sphp\Html\Tables\Table;
use Sphp\Core\Path;

$data = (new LocalFile(Path::get()->local("manual/snippets/example.csv")))->csvToArray();
$table = new Table("Cars to buy:");
$table->thead()->append(array_shift($data));
foreach ($data as $row) {
	$table->tbody()[] = $row;
}
$table->printHtml();
?>