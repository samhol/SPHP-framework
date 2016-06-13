<?php

namespace Sphp\Html\Foundation\F6\Core;

use Sphp\Html\Foundation\F6\Core\Screen as Screen;

(new Grid())
        ->append("small-12")
        ->append(["small-6", "small-6"])
        ->append(["small-4", "small-4", "small-4"])
        ->append(new Row(["first column", new Column("small-2 medium-4 large-6", 2, 4, 6), "third column"]))
        ->append((new Column("small-3 medium-5 large-7 small-centered", 3, 5, 7))
                ->centerize(Screen::SMALL))
        ->append((new Column("single column with grid offset", 8))->setGridOffset(3))
        ->append(range(1, 12))
        ->printHtml();
?>
