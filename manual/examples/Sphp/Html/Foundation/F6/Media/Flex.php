<?php

namespace Sphp\Html\Foundation\Sites\Media;

use Sphp\Html\Foundation\Sites\Grids\Row as Row;

(new Row())
        ->appendColumn(Flex::fromSrc("http://193.64.245.223/basket/widget/"), 12, 3)
        ->appendColumn(Flex::youtube("WwrpLgWyAjU"), 12, 3)
        ->appendColumn(Flex::dailymotion("x2p4pkp"), 12, 3)
        ->appendColumn(Flex::vimeo("174190102"), 12, 3)
        ->printHtml();
?>
