<?php

/**
 * Polygon.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Media\ImageMap;

/**
 * Implements an HTML &lt;area shape="poly"&gt; tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Polygon extends AbstractArea {

  /**
   * Constructs a new instance
   * 
   * @param int[] $coords coordinates as an array
   * @param string|null $href
   * @param string|null $alt
   */
  public function __construct(array $coords = null, string $href = null, string $alt = null) {
    parent::__construct('poly', $href, $alt);
    if ($coords !== null) {
      $this->setCoordinates($coords);
    }
  }

  /**
   * Appends an edge to the polygon
   * 
   * @param  int $x the x-coordinate of the edge
   * @param  int $y the y-coordinate of the edge
   * @return $this for a fluent interface
   */
  public function appendEdge(int $x, int $y) {
    $coords = $this->getCoordinates();
    $coords .= ",$x";
    $coords .= ",$y";
    $this->attributes()->set('coords', $coords);
    return $this;
  }

  /**
   * Sets the coordinates of the polygon
   * 
   * @param  int... $coords coordinates as an array
   * @return $this for a fluent interface
   */
  public function setCoordinates(int... $coord) {
    $count = count($coord);
    if ($count % 2 !== 0) {
      throw new \Sphp\Exceptions\InvalidArgumentException("The sum of coordinates must divisible by 2");
    }
    $coordsString = implode(',', $coord);
    $this->attributes()->set('coords', $coordsString);
    return $this;
  }

}
