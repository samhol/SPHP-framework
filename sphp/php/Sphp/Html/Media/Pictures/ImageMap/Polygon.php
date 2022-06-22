<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media\Pictures\ImageMap;

use Sphp\Html\Media\Pictures\ImageMap\Exceptions\CoordinateException;

/**
 * Implementation of a polygon shaped HTML area tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Polygon extends AbstractArea {

  /**
   * Constructor
   * 
   * @param  int ...$coord coordinates
   * @throws CoordinateException if the number of coordinates is not divisible by 2
   */
  public function __construct(int ...$coord) {
    parent::__construct('poly');
    $this->setCoordinates(...$coord);
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
    $coords[] = $x;
    $coords[] = $y;
    $this->setCoordinates(...$coords);
    return $this;
  }

  /**
   * Sets the coordinates of the polygon
   * 
   * @param  int ...$coord coordinates
   * @return $this for a fluent interface
   * @throws CoordinateException if the number of coordinates is not divisible by 2
   */
  public function setCoordinates(int ...$coord) {
    $count = count($coord);
    if ($count % 2 !== 0 || $count < 4) {
      throw new CoordinateException('The number of coordinates must be divisible by 2');
    }
    $this->attributes()->setAttribute('coords', implode(',', $coord));
    return $this;
  }

}
