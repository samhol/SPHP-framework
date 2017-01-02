<?php

namespace Sphp\Html\Foundation\Sites\Media;

use Sphp\Html\Media\Size;
use Sphp\Core\Path;

$path = Path::get();
$lb = (new Clearing(new Size(FALSE, 50)))
        ->appendImage($path->http('sphpManual/photos/andromeda.jpg'), 'The Andromeda galaxy')
        ->appendImage($path->http('sphpManual/photos/comet.jpg'), 'A comet')
        ->appendImage($path->http('sphpManual/photos/earth.jpg'), 'Earth from the space')
        ->appendImage($path->http('sphpManual/photos/launch.jpg'), 'A spaceshuttle launch')
        ->appendImage($path->http('sphpManual/photos/moon.jpg'), 'A man on the moon')
        ->appendImage($path->http('sphpManual/photos/satelite.jpg'), 'A satelite orbiting the earth')
        ->appendImage($path->http('sphpManual/photos/space.jpg'), 'ISS (International Space Station)')
        ->appendImage($path->http('sphpManual/photos/spacewalk.jpg'), 'A spacewalking astronault');
$lb->printHtml();
?>