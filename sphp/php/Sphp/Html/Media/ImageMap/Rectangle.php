<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media\ImageMap;

use Sphp\Html\Media\ImageMap\Exceptions\CoordinateException;

/**
 * Implementation of a rectangle shaped HTML area tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Rectangle extends AbstractArea {

  /**
   * Constructor
   * 
   * @param int $x1 the top left x-coordinate
   * @param int $y1 the top left y-coordinate
   * @param int $x2 the bottom right x-coordinate
   * @param int $y2 the bottom right y-coordinate
   */
  public function __construct(int $x1 = 0, int $y1 = 0, int $x2 = 0, int $y2 = 0) {
    parent::__construct('rect', '/^(\d+(,\d+){3})*$/');
    $this->setCoordinates($x1, $y1, $x2, $y2);
  }

  /**
   * Sets the coordinates of the polygon
   * 
   * @param  int $x1 the top left x-coordinate
   * @param  int $y1 the top left y-coordinate
   * @param  int $x2 the bottom right x-coordinate
   * @param  int $y2 the bottom right y-coordinate
   * @return $this for a fluent interface
   * @throws CoordinateException if the number of coordinates is not 4
   */
  public function setCoordinates(int ...$coord) {
    $count = count($coord);
    if ($count !== 4) {
      throw new CoordinateException('The number of coordinates must be divisible by 2');
    }
    parent::setCoordinates(...$coord);
    return $this;
  }

}
