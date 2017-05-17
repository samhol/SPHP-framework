<?php

namespace Sphp\Html\Foundation\Sites\Media;

use Sphp\Html\Foundation\Sites\Grids\BlockGrid as BlockGrid;

(new BlockGrid(1, 2, 3, 4))
        ->append(ResponsiveEmbed::fromSrc('http://193.64.245.223/basket/widget/')
                ->setAspectRatio('square')
                ->setLazy())
        ->append(ResponsiveEmbed::vieverJs('manual/snippets/demodoc.pdf')
                ->setAspectRatio('default')
                ->setLazy())
        ->append(ResponsiveEmbed::youtube('6aPhv2J89_s')
                ->setAspectRatio('widescreen')
                ->setLazy())
        ->append(ResponsiveEmbed::dailymotion('x2p4pkp')
                ->setAspectRatio('panorama')
                ->setLazy())
        ->printHtml();
