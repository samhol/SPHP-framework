<?php

namespace Sphp\Html\Tables;

$carStocks = [
    ['Name', 'Stock', 'Sold'],
    ['Volvo', 22, 18],
    ['BMW', 15, 13],
    ['Saab', 5, 2],
    ['Land Rover', 17, 15],
];

$table = (new Table('Cars:'));
$table->thead()->appendHeaderRow(array_shift($carStocks));
$table->tbody()->fromArray($carStocks);

$table->printHtml();
?>