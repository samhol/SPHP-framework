<?php

namespace Sphp\Html\Foundation\F6\Media;

use Sphp\Html\Foundation\F6\Grids\Row as Row;

(new Row())
        ->appendColumn(Flex::fromSrc("http://193.64.245.223/basket/widget/")->setLazy(), 12, 3)
        ->appendColumn(Flex::youtube("WwrpLgWyAjU")->setLazy(), 12, 3)
        ->appendColumn(Flex::dailymotion("x2p4pkp")->setLazy(), 12, 3)
        ->appendColumn(Flex::vimeo("174190102")->setLazy(), 12, 3)
        ->printHtml();
?>
