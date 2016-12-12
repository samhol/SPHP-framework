<?php

namespace Sphp\Html\Foundation\Sites\Media\Orbit;

use Sphp\Core\Path;

$folder = Path::get()->http("manual/photos/");

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
