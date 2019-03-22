<?php

namespace Sphp\Html\Foundation\Sites\Media;

use Sphp\Html\Foundation\Sites\Grids\BlockGrid;

$blockGrid = (new BlockGrid('small-up-1', 'medium-up-2', 'large-up-3', 'xlarge-up-4'));
$blockGrid->append(ResponsiveEmbed::iframe('http://193.64.245.223/basket/widget/')
                ->setAspectRatio('square')
                ->setLazy());
$blockGrid->append(ResponsiveEmbed::vieverJs('manual/snippets/demodoc.pdf')
                ->setAspectRatio('default')
                ->setLazy());
$blockGrid->append(ResponsiveEmbed::youtube('6aPhv2J89_s')
                ->setAspectRatio('widescreen')
                ->setLazy());
$blockGrid->append(ResponsiveEmbed::dailymotion('x2p4pkp')
                ->setAspectRatio('panorama')
                ->setLazy());
$blockGrid->printHtml();
