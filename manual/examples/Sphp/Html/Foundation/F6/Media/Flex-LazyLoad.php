<?php

namespace Sphp\Html\Foundation\F6\Media;

use Sphp\Html\Foundation\F6\Grids\Row as Row;
(new Row())
        ->appendColumn(FlexMedia::fromSrc("http://193.64.245.223/basket/widget/")->setLazy(), 12, 3)
        ->appendColumn(FlexMedia::fromSrc("manual/snippets/demodoc.pdf")->setLazy(), 12, 3)
        ->appendColumn(FlexVideo::youtube("WwrpLgWyAjU")->setLazy(), 12, 3)
        ->appendColumn(FlexVideo::dailymotion("x2p4pkp")->setLazy(), 12, 3)
        ->appendColumn(FlexVideo::vimeo("174190102")->setLazy(), 12, 3)
        ->printHtml();
?>
