<?php

namespace Sphp\Html\Foundation\Media;

use Sphp\Html\Media\Img as Img;

$lb = new Orbit();

$root = "http://samiholck.com/";

$lb->appendNewSlide(new Img($root . "sphpManual/photos/andromeda.jpg"), "The andromeda galaxy");
$lb->appendNewSlide(new Img($root . "sphpManual/photos/comet.jpg"), "A comet");
$lb->appendNewSlide(new Img($root . "sphpManual/photos/earth.jpg"), "Earth from the space");
$lb->appendNewSlide(new Img($root . "sphpManual/photos/launch.jpg"), "A spaceshuttle launch");
$lb->appendNewSlide(new Img($root . "sphpManual/photos/moon.jpg"), "A man on the moon");
$lb->appendNewSlide(new Img($root . "sphpManual/photos/satelite.jpg"), "A satelite orbiting the earth");
$lb->appendNewSlide(new Img($root . "sphpManual/photos/space.jpg"), "ISS (International Space Station)");
$lb->appendNewSlide(new Img($root . "sphpManual/photos/spacewalk.jpg"), "A spacewalking astronault");
echo $lb->setStyle("width", "800px");
echo $lb->generateSlideLinks("Slide");
?>