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
 * @since   2016-05-31
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
  public function __construct(array $coords = [], string $href = null, string $alt = null) {
    parent::__construct('poly', $href, $alt);
    $this->setCoordinates($coords);
  }

  /**
   * Appends an edge to the polygon
   * 
   * @param  int $x the x-coordinate of the edge
   * @param  int $y the y-coordinate of the edge
   * @return self for a fluent interface
   */
  public function appendEdge(int $x, int $y) {
    $coords = split(',', $this->getCoordinates());
    $coords[0] = $x;
    $coords[1] = $y;
    $coordsString = implode(',', $coords);
    $this->attrs()->set('coords', $coordsString);
    return $this;
  }

  /**
   * Sets the coordinates of the polygon
   * 
   * @param int[] $coords coordinates as an array
   * @return self for a fluent interface
   */
  public function setCoordinates(array $coords) {
    $count = count($coords);
    if ($count % 2 !== 0) {
      throw new \Sphp\Exceptions\InvalidArgumentException("The sum of coordinates must divisible by 2");
    }
    $coordsString = implode(',', $coords);
    $this->attrs()->set('coords', $coordsString);
    return $this;
  }

}
