<?php

namespace Sphp\Html\Foundation\Sites\Core;

use Sphp\Html\Foundation\Sites\Grids\XY\Column;
use Sphp\Html\Foundation\Sites\Grids\XY\Row;

$cols[] = Column::create('align-center', ['small-3']);
$cols[] = Column::create('align-center', ['small-3']);
$row1 = Row::from($cols);

$alignmentManager = new AlingmentAdapter($row1);

$alignmentManager->setHorizontalAlignment('align-center');
$row1->printHtml();
