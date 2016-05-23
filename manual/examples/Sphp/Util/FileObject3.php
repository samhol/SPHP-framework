<?php

namespace Sphp\Util;

use Sphp\Html\Tables\Table as Table;
use Sphp\Core\PathFinder as PathFinder;

$pathFinder = new PathFinder();
$data = (new LocalFile($pathFinder->local("manual/snippets/example.csv")))->csvToArray();
$table = new Table("Cars to buy:");
$table->thead()->append(array_shift($data));
foreach ($data as $row) {
	$table->tbody()[] = $row;
}
$table->printHtml();
?>