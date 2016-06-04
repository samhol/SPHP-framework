<?php

namespace Sphp\Html\Foundation\F6\Media\Orbit;

use Sphp\Html\Media\Img as Img;
use Sphp\Core\PathFinder as PathFinder;

$pathFinder = new PathFinder();
$folder = $pathFinder->http("manual/photos/");
$orbit = new Orbit();

$root = "http://samiholck.com/";

$orbit->appendFigure(new Img($folder . "andromeda.jpg"), "The andromeda galaxy");
$orbit->appendFigure(new Img($folder . "comet.jpg"), "A comet");
$orbit->appendFigure(new Img($folder . "earth.jpg"), "Earth from the space");
$orbit->appendFigure(new Img($folder . "launch.jpg"), "A spaceshuttle launch");
$orbit->appendFigure(new Img($folder . "moon.jpg"), "A man on the moon");
$orbit->appendFigure(new Img($folder . "satelite.jpg"), "A satelite orbiting the earth");
$orbit->appendFigure(new Img($folder . "space.jpg"), "ISS (International Space Station)");
$orbit->appendFigure(new Img($folder . "spacewalk.jpg"), "A spacewalking astronault");
$orbit->printHtml();
//echo $lb->setStyle("width", "800px");
?>
