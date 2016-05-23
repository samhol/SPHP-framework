<?php

namespace Sphp\Html\Foundation\Content;

use Sphp\Html\Foundation\Structure\Screen as Screen;
use Sphp\Html\Foundation\Structure\Grid as Grid;
use Sphp\Html\Foundation\Structure\Row as Row;

$panel1 = (new Panel("First panel"))->showOnlyFor(Screen::MEDIUM_UP);
$panel2 = (new Panel("Second panel"))->showOnlyFor(Screen::X_LARGE);
$grid = (new Grid())
		->append(new Row([$panel1, $panel2]))
		->printHtml();
?>