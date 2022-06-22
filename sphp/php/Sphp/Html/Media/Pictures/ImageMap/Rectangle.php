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
  public function __construct(int $x1, int $y1, int $x2, int $y2) {
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
   */
  public function setCoordinates(int $x1, int $y1, int $x2, int $y2) {
    try {
      $this->attributes()->setAttribute('coords', "$x1,$y1,$x2,$y2");
    } catch (\Exception $ex) {
      throw new CoordinateException('A coordinate must be a positive integer', $ex->getCode(), $ex);
    }
    return $this;
  }

}
