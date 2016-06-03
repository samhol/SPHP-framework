<?php

namespace Sphp\Html\Foundation\F6\Media\Orbit;

use Sphp\Html\Media\Img as Img;
use Sphp\Core\PathFinder as PathFinder;

$pathFinder = new PathFinder();
$folder = $pathFinder->http("manual/photos/");
$lb = new Orbit();

$root = "http://samiholck.com/";

$lb->appendNewSlide(new Img($folder . "andromeda.jpg"), "The andromeda galaxy");
$lb->appendNewSlide(new Img($folder . "comet.jpg"), "A comet");
$lb->appendNewSlide(new Img($folder . "earth.jpg"), "Earth from the space");
$lb->appendNewSlide(new Img($folder . "launch.jpg"), "A spaceshuttle launch");
$lb->appendNewSlide(new Img($folder . "moon.jpg"), "A man on the moon");
$lb->appendNewSlide(new Img($folder . "satelite.jpg"), "A satelite orbiting the earth");
$lb->appendNewSlide(new Img($folder . "space.jpg"), "ISS (International Space Station)");
$lb->appendNewSlide(new Img($folder . "spacewalk.jpg"), "A spacewalking astronault");
echo $lb->setStyle("width", "800px");

?>