<?php

/**
 * Circle.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Media\ImageMap;
use Sphp\Html\EmptyTag as EmptyTag;

/**
 * Class Circle
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-05-26
 * @version 1.0.0
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Circle extends EmptyTag implements AreaInterface {

  use AreaTrait;

  public function __construct($x, $y, $radius, $href = "#", $alt = "") {
    parent::__construct(self::TAG_NAME);
    $this->attrs()->lock("shape", "circle");
    $this->setCoordinates($x, $y, $radius);
  }

  public function setRadius($radius) {
    $coords = split(",", $this->getCoordinates());
    $coords[2] = $radius;
    $coordsString = implode(",", $coords);
    $this->attrs()->set("coords", $coordsString);
    return $this;
  }

  public function setX($x) {
    $coords = split(",", $this->getCoordinates());
    $coords[0] = $x;
    $coordsString = implode(",", $coords);
    $this->attrs()->set("coords", $coordsString);
    return $this;
  }

  public function setY($x) {
    $coords = split(",", $this->getCoordinates());
    $coords[1] = $x;
    $coordsString = implode(",", $coords);
    $this->attrs()->set("coords", $coordsString);
    return $this;
  }

  public function setCoordinates($x, $y, $radius) {
    $coords = [$x, $y, $radius];
    $coordsString = implode(",", $coords);
    $this->attrs()->set("coords", $coordsString);
    return $this;
  }

}
