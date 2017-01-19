<?php

namespace Sphp\Html\Foundation\Sites\Media;

use Sphp\Html\Foundation\Sites\Grids\BlockGrid as BlockGrid;
(new BlockGrid(null, 1, 2, 3, 4))
        ->append(ResponsiveEmbed::fromSrc('http://193.64.245.223/basket/widget/')
                ->setAspectRatio('square')
                ->setLazy())
        ->append(ResponsiveEmbed::vieverJs('manual/snippets/demodoc.pdf')
                ->setAspectRatio('square')
                ->setLazy())
        ->append(ResponsiveEmbed::youtube('6aPhv2J89_s')
                ->setAspectRatio('default')
                ->setLazy())
        ->append(ResponsiveEmbed::dailymotion('x2p4pkp')
                ->setAspectRatio('panorama')
                ->setLazy())
        ->append(ResponsiveEmbed::vimeo('174190102')
                ->setAspectRatio('panorama')
                ->setLazy())
        ->printHtml();
?>