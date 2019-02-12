<?php

namespace Sphp\Html\Foundation\Sites\Core;

use Sphp\Html\Foundation\Sites\Grids\DivColumn;
use Sphp\Html\Foundation\Sites\Grids\Row;

$cols1[] = DivColumn::create('align-center', ['small-3']);
$cols1[] = DivColumn::create('align-center', ['small-3']);
$row1 = Row::from($cols1);

$alignmentManager = new AlingmentAdapter($row1);

$alignmentManager->setHorizontalAlignment('align-right');
$row1->printHtml();


$alignmentManager2 = new AlingmentAdapter($row1);

$alignmentManager2->setHorizontalAlignment('align-right');

$cols2[] = DivColumn::create('align-right', ['small-3']);
$cols2[] = DivColumn::create('align-right', ['small-3']);
$row2 = Row::from($cols2);
$row2->printHtml();
