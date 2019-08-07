<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media\ImageMap;

/**
 * Implements an HTML &lt;area shape="rect"&gt; tag
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
   * @param string|null $href the URL of the link
   * @param string $alt
   */
  public function __construct(int $x1 = 0, int $y1 = 0, int $x2 = 0, int $y2 = 0, string $href = null, string $alt = null) {
    parent::__construct('area', '/^(\d+(,\d+){3})*$/');
     $this->setHref($href)->setAlt($alt);
    $this->setCoordinates($x1, $y1, $x2, $y2);
  }

  /**
   * Sets the coordinates of the rectangle
   * 
   * @param  int $x1 the top left x-coordinate
   * @param  int $y1 the top left y-coordinate
   * @param  int $x2 the bottom right x-coordinate
   * @param  int $y2 the bottom right y-coordinate
   * @return $this for a fluent interface
   */
  public function setCoordinates(int $x1, int $y1, int $x2, int $y2) {
    $this->setAttribute('coords', "$x1,$y1,$x2,$y2");
    return $this;
  }

}
