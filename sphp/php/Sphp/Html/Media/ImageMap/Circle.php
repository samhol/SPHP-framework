<?php

/**
 * Circle.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Media\ImageMap;
use Sphp\Html\EmptyTag;

/**
 * Implements an HTML &lt;area shape="circle"&gt; tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-05-26
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Circle extends EmptyTag implements AreaInterface {

  use AreaTrait;

  /**
   * Constructs a new instance
   * 
   * @param int $x the x-coodinate of the circle center
   * @param int $y the y-coodinate of the circle center
   * @param int $radius the radius of the circle
   * @param string|null $href the URL of the link
   * @param string|null $alt
   */
  public function __construct($x, $y, $radius, $href = null, $alt = null) {
    parent::__construct('area');
    $this->attrs()->lock('shape', 'circle');
    $this->setCoordinates($x, $y, $radius);
    if ($href !== null) {
      $this->setHref($href);
    }
    if ($alt !== null) {
      $this->setHref($href);
    }
  }

  /**
   * Sets the radius of the circle region
   * 
   * @param  int $radius the radius of the circle
   * @return self for a fluent interface
   */
  public function setRadius($radius) {
    $coords = split(',', $this->getCoordinates());
    $coords[2] = $radius;
    $coordsString = implode(',', $coords);
    $this->attrs()->set('coords', $coordsString);
    return $this;
  }

  /**
   * Sets the x-coodinate of the center of the circle region
   * 
   * @param  int $x the x-coodinate of the circle center
   * @return self for a fluent interface
   */
  public function setX($x) {
    $coords = split(',', $this->getCoordinates());
    $coords[0] = $x;
    $coordsString = implode(',', $coords);
    $this->attrs()->set('coords', $coordsString);
    return $this;
  }

  /**
   * Sets the y-coodinate of the center of the circle region
   * 
   * @param  int $y the y-coodinate of the circle center
   * @return self for a fluent interface
   */
  public function setY($y) {
    $coords = split(',', $this->getCoordinates());
    $coords[1] = $y;
    $coordsString = implode(',', $coords);
    $this->attrs()->set('coords', $coordsString);
    return $this;
  }

  /**
   * Sets the coodinates and the size of the circle region
   * 
   * @param  int $x the x-coodinate of the circle center
   * @param  int $y the y-coodinate of the circle center
   * @param  int $radius the radius of the circle
   * @return self for a fluent interface
   */
  public function setCoordinates($x, $y, $radius) {
    $coords = [$x, $y, $radius];
    $coordsString = implode(',', $coords);
    $this->attrs()->set('coords', $coordsString);
    return $this;
  }

}
