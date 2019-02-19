<?php

//include_once './manual/snippets/icons/countryFlags.php';
//include_once './manual/snippets/icons/devicons_svg.php';
use Sphp\Html\Foundation\Sites\Grids\BlockGrid;
use Sphp\Html\Media\Icons\Crossbones;
use Sphp\Html\Media\Icons\SvgLoader;

$blocks = new BlockGrid('small-up-3', 'medium-up-4', 'large-up-4');
$svg = new Crossbones();
$svg1 = SvgLoader::fileToObject('/home/int48291/public_html/playground/manual/svg/human-skull.svg');
$svg->setOpacity(.5)->setStroke('red', 1.5);
$svg1->setOpacity(.5);
$blocks->append($svg)->addCssClass('shadow', 'foo');
$blocks->append($svg1)->addCssClass('shadow');
echo $blocks;
