<?php

namespace Sphp\Html\Foundation\Sites\Media;

use Sphp\Html\Foundation\Sites\Grids\Row as Row;

(new Row())
        ->appendColumn(ResponsiveEmbed::fromSrc("http://193.64.245.223/basket/widget/")->setLazy(), 12, 3)
        ->appendColumn(ResponsiveEmbed::youtube("WwrpLgWyAjU")->setLazy(), 12, 3)
        ->appendColumn(ResponsiveEmbed::dailymotion("x2p4pkp")->setLazy(), 12, 3)
        ->appendColumn(ResponsiveEmbed::vimeo("174190102")->setLazy(), 12, 3)
        ->printHtml();
?>
