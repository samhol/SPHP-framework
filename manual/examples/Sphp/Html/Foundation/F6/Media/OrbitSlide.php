<?php

namespace Sphp\Html\Foundation\F6\Media\Orbit;

use Sphp\Core\PathFinder as PathFinder;

$pathFinder = new PathFinder();
$folder = $pathFinder->http("manual/photos/");
$orbit = new Orbit();

$orbit->appendFigure($folder . "andromeda.jpg", "The andromeda galaxy");
$orbit->appendFigure($folder . "comet.jpg", "A comet");
$orbit->appendFigure($folder . "earth.jpg", "Earth from the space");
$orbit->appendFigure($folder . "launch.jpg", "A spaceshuttle launch");
$orbit->appendFigure($folder . "moon.jpg", "A man on the moon");
$orbit->appendFigure($folder . "satelite.jpg", "A satelite orbiting the earth");
$orbit->appendFigure($folder . "space.jpg", "ISS (International Space Station)");
$orbit->appendFigure($folder . "spacewalk.jpg", "A spacewalking astronault");
$orbit->printHtml();
?>
