<?php

namespace Sphp\Html\Foundation\F6\Media\Orbit;

use Sphp\Html\Media\Img as Img;
use Sphp\Core\PathFinder as PathFinder;

$pathFinder = new PathFinder();
$folder = $pathFinder->http("manual/photos/");
$lb = new Orbit();

$root = "http://samiholck.com/";

$lb->appendFigure(new Img($folder . "andromeda.jpg"), "The andromeda galaxy");
$lb->appendFigure(new Img($folder . "comet.jpg"), "A comet");
$lb->appendFigure(new Img($folder . "earth.jpg"), "Earth from the space");
$lb->appendFigure(new Img($folder . "launch.jpg"), "A spaceshuttle launch");
$lb->appendFigure(new Img($folder . "moon.jpg"), "A man on the moon");
$lb->appendFigure(new Img($folder . "satelite.jpg"), "A satelite orbiting the earth");
$lb->appendFigure(new Img($folder . "space.jpg"), "ISS (International Space Station)");
$lb->appendFigure(new Img($folder . "spacewalk.jpg"), "A spacewalking astronault");
echo $lb->setStyle("width", "800px");
?>
