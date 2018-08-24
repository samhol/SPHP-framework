<?php

namespace Sphp\Html\Tables;

$table = (new Table('Cars:'));
$table->thead()->appendHeaderRow(['Name', 'Stock', 'Sold']);
$table->tbody()->appendBodyRow(['Volvo', 22, 18]);
$table->tbody()->appendBodyRow(['BMW', 15, 13]);
$table->tbody()->appendBodyRow(['Land Rover', 17, 15]);
$table->printHtml();
