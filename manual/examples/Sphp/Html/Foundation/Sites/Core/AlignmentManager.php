<?php

namespace Sphp\Html\Foundation\Sites\Core;

use Sphp\Html\Foundation\Sites\Grids\ContainerCell;
use Sphp\Html\Foundation\Sites\Grids\BasicRow;

$cols[] = ContainerCell::create('align-center', ['small-3']);
$cols[] = ContainerCell::create('align-center', ['small-3']);
$row1 = BasicRow::from($cols);

$alignmentManager = new AlingmentAdapter($row1);

$alignmentManager->setHorizontalAlignment('align-center');
$row1->printHtml();
