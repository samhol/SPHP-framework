<?php

namespace Sphp\Html\Foundation\F6\Media;

use Sphp\Html\Foundation\F6\Grids\BlockGrid as BlockGrid;
(new BlockGrid(null, 1, 2, 3, 4))
        ->append(Flex::fromSrc("http://193.64.245.223/basket/widget/")->setLazy())
        ->append(Flex::vieverJs("manual/snippets/demodoc.pdf")->setLazy())
        ->append(Flex::youtube("WwrpLgWyAjU")->setLazy())
        ->append(Flex::dailymotion("x2p4pkp")->setLazy())
        ->append(Flex::vimeo("174190102")->setLazy())
        ->printHtml();
?>
