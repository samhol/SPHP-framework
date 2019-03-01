<?php

namespace Sphp\Html\Foundation\Sites\Grids;

use Sphp\Html\Media\Icons\SvgLoader;

$skull = SvgLoader::fromUrl('http://playground.samiholck.com/manual/svg/human-skull.svg');

(new BlockGrid('small-up-2', 'large-up-4'))->setColumns([$skull, $skull, $skull, $skull])
        ->printHtml();
(new BlockGrid('small-up-4', 'medium-up-8'))->setColumns([$skull, $skull, $skull, $skull, $skull, $skull, $skull, $skull])
        ->printHtml();
