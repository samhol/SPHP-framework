<?php

namespace Sphp\Html\Foundation\Sites\Media\Orbit;

use Sphp\Stdlib\Path;

$path = Path::get();

$orbit = new Orbit();
$orbit->appendFigure($path->http('manual/photos/andromeda.jpg'), 'The Andromeda galaxy')
        ->appendFigure($path->http('manual/photos/comet.jpg'), 'A comet')
        ->appendFigure($path->http('manual/photos/earth.jpg'), 'Earth from the space')
        ->appendFigure($path->http('manual/photos/launch.jpg'), 'A spaceshuttle launch')
        ->appendFigure($path->http('manual/photos/moon.jpg'), 'A man on the moon')
        ->appendFigure($path->http('manual/photos/satelite.jpg'), 'A satelite orbiting the earth')
        ->appendFigure($path->http('manual/photos/space.jpg'), 'ISS (International Space Station)')
        ->appendFigure($path->http('manual/photos/spacewalk.jpg'), 'A spacewalking astronault')
        ->printHtml();
?>