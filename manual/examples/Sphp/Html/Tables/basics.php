<?php

namespace Sphp\Html\Tables;

use Sphp\Html\Foundation\Sites\Grids\Row as Row;

$a = array(array("rose", 1.25, 15),
    array("daisy", 0.75, 25),
    array("orchid", 1.15, 7)
);

$table = (new Table('Table 1:'));
$body = $table->tbody()->fromArray($a);

$table->printHtml();
?>
