<?php

namespace Sphp\Util;

use Sphp\Html\Tables\Table;
use Sphp\Core\Router;

$data = (new LocalFile(Router::get()->local("manual/snippets/example.csv")))->csvToArray();
$table = new Table("Cars to buy:");
$table->thead()->append(array_shift($data));
foreach ($data as $row) {
	$table->tbody()[] = $row;
}
$table->printHtml();
?>