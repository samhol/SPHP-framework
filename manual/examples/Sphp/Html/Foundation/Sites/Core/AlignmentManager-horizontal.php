<?php

namespace Sphp\Html\Foundation\Sites\Core;

use Sphp\Html\Foundation\Sites\Grids\DivCell;
use Sphp\Html\Foundation\Sites\Grids\BasicRow;

$cols1[] = DivCell::create('align-center', ['small-3']);
$cols1[] = DivCell::create('align-center', ['small-3']);
$row1 = BasicRow::from($cols1);

$alignmentManager = new AlingmentAdapter($row1);

$alignmentManager->setHorizontalAlignment('align-center');
$row1->printHtml();

$cols2[] = DivCell::create('align-right', ['small-3']);
$cols2[] = DivCell::create('align-right', ['small-3']);
$row2 = BasicRow::from($cols2);
$alignmentManager2 = new AlingmentAdapter($row2);

$alignmentManager2->setHorizontalAlignment('align-right');
$row2->printHtml();
