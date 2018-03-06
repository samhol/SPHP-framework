<?php

/**
 * Circle.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Media\ImageMap;

/**
 * Implements an HTML &lt;area shape="circle"&gt; tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Circle extends AbstractArea {

  /**
   * Constructs a new instance
   * 
   * @param int $x the x-coordinate of the circle center
   * @param int $y the y-coordinate of the circle center
   * @param int $radius the radius of the circle
   * @param string|null $href the URL of the link
   * @param string|null $alt
   */
  public function __construct(int $x = 0, int $y = 0, int $radius = 0, string $href = null, string $alt = null) {
    parent::__construct('circle', $href, $alt);
    $this->setCoordinates($x, $y, $radius);
  }

  /**
   * Sets the radius of the circle region
   * 
   * @param  int $radius the radius of the circle
   * @return $this for a fluent interface
   */
  public function setRadius(int $radius) {
    $this->getCoordinates()->offsetSet(2, $radius);
    return $this;
  }

  /**
   * Sets the x-coordinate of the center of the circle region
   * 
   * @param  int $x the x-coordinate of the circle center
   * @return $this for a fluent interface
   */
  public function setX(int $x) {
    $this->getCoordinates()->offsetSet(0, $x);
    return $this;
  }

  /**
   * Sets the y-coordinate of the center of the circle region
   * 
   * @param  int $y the y-coordinate of the circle center
   * @return $this for a fluent interface
   */
  public function setY(int $y) {
    $this->getCoordinates()->offsetSet(1, $y);
    return $this;
  }

  /**
   * Sets the coordinates and the size of the circle region
   * 
   * @param  int $x the x-coordinate of the circle center
   * @param  int $y the y-coordinate of the circle center
   * @param  int $radius the radius of the circle
   * @return $this for a fluent interface
   */
  public function setCoordinates(int $x, int $y, int $radius) {
    $this->getCoordinates()->set($x, $y, $radius);
    return $this;
  }

}
