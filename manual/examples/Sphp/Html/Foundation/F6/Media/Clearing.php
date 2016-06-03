<?php

namespace Sphp\Html\Foundation\F6\Media;

use Sphp\Html\Media\Size as Size;

$root = \Sphp\HTTP_ROOT;
$lb = (new Clearing(new Size(FALSE, 50)))
		->appendImage($root . "sphpManual/photos/andromeda.jpg", "The andromeda galaxy")
		->appendImage($root . "sphpManual/photos/comet.jpg", "A comet")
		->appendImage($root . "sphpManual/photos/earth.jpg", "Earth from the space")
		->appendImage($root . "sphpManual/photos/launch.jpg", "A spaceshuttle launch")
		->appendImage($root . "sphpManual/photos/moon.jpg", "A man on the moon")
		->appendImage($root . "sphpManual/photos/satelite.jpg", "A satelite orbiting the earth")
		->appendImage($root . "sphpManual/photos/space.jpg", "ISS (International Space Station)")
		->appendImage($root . "sphpManual/photos/space.jpg", "ISS (International Space Station)", new Size(100,100))
		->appendImage($root . "sphpManual/photos/spacewalk.jpg", "A spacewalking astronault");
$lb->printHtml();
?>