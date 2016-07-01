<?php

namespace Sphp\Html\Foundation\F6\Media;

use Sphp\Html\Foundation\F6\Grids\Row as Row;

(new Row())
        ->appendColumn(new FlexVideo("CdMs7eqMvNg", FlexVideo::YOUTUBE), 12, 4)
        ->appendColumn(new FlexVideo("WwrpLgWyAjU", FlexVideo::YOUTUBE), 12, 4)
        ->appendColumn(new FlexVideo("X8E1wkenjEk", FlexVideo::YOUTUBE), 12, 4)
        ->printHtml();
?>
