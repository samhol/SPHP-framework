<?php
//include_once './manual/snippets/icons/countryFlags.php';
//include_once './manual/snippets/icons/devicons_svg.php';
$svg = \Sphp\Html\Media\Icons\SvgLoader::fileToObject('/home/int48291/public_html/playground/manual/svg/crossbones.svg');
$svg->setOpacity(.5);
echo $svg;
