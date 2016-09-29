<?php

namespace Sphp\Html\Foundation\F6\Media\Orbit;

use Sphp\Core\PathFinder;

$pathFinder = new PathFinder();
$folder = $pathFinder->http("manual/photos/");
$folder = "manual/photos/";
$orbit = new Orbit();

$orbit->appendFigure($folder . "andromeda.jpg", "The andromeda galaxy")
        ->appendFigure($folder . "comet.jpg", "A comet")
        ->appendFigure($folder . "earth.jpg", "Earth from the space")
        ->appendFigure($folder . "launch.jpg", "A spaceshuttle launch")
        ->appendFigure($folder . "moon.jpg", "A man on the moon")
        ->appendFigure($folder . "satelite.jpg", "A satelite orbiting the earth")
        ->appendFigure($folder . "space.jpg", "ISS (International Space Station)")
        ->appendFigure($folder . "spacewalk.jpg", "A spacewalking astronault")
       // ->setActive(2)
        ->printHtml();
?>
