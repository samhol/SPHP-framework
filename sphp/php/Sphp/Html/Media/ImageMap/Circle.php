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
 * Implements an HTML &lt;area shape="circle"&gt; tag
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
   * @param string|null $href the URL of the link
   * @param string|null $alt
   */
  public function __construct(int $x = 0, int $y = 0, int $radius = 0, string $href = null, string $alt = null) {
    parent::__construct('circle', $href, $alt);
    $parser = new \Sphp\Html\Attributes\MultiValueParser();
    $parser->setRange(3,3);
    $coords = new \Sphp\Html\Attributes\MultiValueAttribute('coords', $parser);
    $this->attributes()->setInstance($coords);
    $this->setCoordinates($x, $y, $radius);
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
    $this->attributes()->coords = [$x, $y, $radius];
    return $this;
  }

}
