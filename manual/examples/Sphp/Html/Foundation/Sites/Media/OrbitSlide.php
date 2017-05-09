<?php

namespace Sphp\Html\Foundation\Sites\Media\Orbit;

$orbit = new Orbit();
$orbit->appendFigure('manual/photos/andromeda.jpg', 'The Andromeda galaxy')
        ->appendFigure('manual/photos/comet.jpg', 'A comet')
        ->appendFigure('manual/photos/earth.jpg', 'Earth from the space')
        ->appendFigure('manual/photos/launch.jpg', 'A spaceshuttle launch')
        ->appendFigure('manual/photos/moon.jpg', 'A man on the moon')
        ->appendFigure('manual/photos/satelite.jpg', 'A satelite orbiting the earth')
        ->appendFigure('manual/photos/space.jpg', 'ISS (International Space Station)')
        ->appendFigure('manual/photos/spacewalk.jpg', 'A spacewalking astronault')
        ->printHtml();
?>