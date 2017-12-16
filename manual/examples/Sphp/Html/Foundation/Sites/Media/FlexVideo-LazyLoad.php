<?php

namespace Sphp\Html\Foundation\Sites\Media;

use Sphp\Html\Foundation\Sites\Grids\Row;
$row = new Row();
        $row->appendColumn(ResponsiveEmbed::iframe("http://193.64.245.223/basket/widget/")->setLazy());
        $row->appendColumn(ResponsiveEmbed::youtube("WwrpLgWyAjU")->setLazy(), 12, 3);
        $row->appendColumn(ResponsiveEmbed::dailymotion("x2p4pkp")->setLazy(), 12, 3);
        $row->appendColumn(ResponsiveEmbed::vimeo("174190102")->setLazy(), 12, 3);
        $row->printHtml();
