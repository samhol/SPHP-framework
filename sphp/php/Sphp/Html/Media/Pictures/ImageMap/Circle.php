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
 * Implementation of a circle shaped HTML area tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Circle extends AbstractArea {

  /**
   * Constructor
   * 
   * @param int $x the x-coordinate of the circle center
   * @param int $y the y-coordinate of the circle center
   * @param int $radius the radius of the circle
   */
  public function __construct(int $x = 0, int $y = 0, int $radius = 0) {
    parent::__construct('circle', '/^(\d+(,\d+){2})*$/');
    $this->setCoordinates($x, $y, $radius);
  }

  /**
   * Sets the coordinates of the polygon
   * 
   * @param  int $x the x-coordinate of the circle center
   * @param  int $y the y-coordinate of the circle center
   * @param  int $radius the radius of the circle
   * @return $this for a fluent interface
   * @throws CoordinateException if the number of coordinates is not 3
   */
  public function setCoordinates(int $x, int $y, int $radius) {
    try {
      $this->attributes()->setAttribute('coords', "$x,$y,$radius");
    } catch (\Exception $ex) {
      throw new CoordinateException('A coordinate must be a positive integer', $ex->getCode(), $ex);
    }
    return $this;
  }

}
