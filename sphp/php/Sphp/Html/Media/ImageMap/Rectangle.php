<?php

/**
 * Rectangle.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Media\ImageMap;

use Sphp\Html\EmptyTag as EmptyTag;

/**
 * Class Models an HTML &lt;area shape="rect"&gt; tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-05-31
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Rectangle extends EmptyTag implements AreaInterface {

  use AreaTrait;
  
  
  /**
   * 
   * @param int $x
   * @param int $y
   * @param int $radius
   * @param string $href
   * @param string $alt
   */
  public function __construct($x1, $y1, $x2, $y2, $href = null, $alt = null) {
    parent::__construct(self::TAG_NAME);
    $this->attrs()->lock("shape", "rect");
    $this->setCoordinates($x1, $y1, $x2, $y2);
    if ($href !== null) {
      $this->setHref($href);
    }
    if ($alt !== null) {
      $this->setHref($href);
    }
  }
  
  

  /**
   * Sets the top left coordinates of the rectangle
   * 
   * @param  int $x
   * @param  int $y
   * @return self for PHP Method Chaining
   */
  public function setTopLeft($x, $y) {
    $coords = split(",", $this->getCoordinates());
    $coords[0] = $x;
    $coords[1] = $y;
    $coordsString = implode(",", $coords);
    $this->attrs()->set("coords", $coordsString);
    return $this;
  }

  /**
   * Sets the bottom right coordinates of the rectangle
   * 
   * @param  int $x
   * @param  int $y
   * @return self for PHP Method Chaining
   */
  public function setBottomRight($x, $y) {
    $coords = split(",", $this->getCoordinates());
    $coords[2] = $x;
    $coords[3] = $y;
    $coordsString = implode(",", $coords);
    $this->attrs()->set("coords", $coordsString);
    return $this;
  }

  /**
   * 
   * @param  int $x1
   * @param  int $y1
   * @param  int $x2
   * @param  int $y3
   * @param  int $radius
   * @return self for PHP Method Chaining
   */
  public function setCoordinates($x1, $y1, $x2, $y2) {
    $coords = [$x1, $y1, $x2, $y2];
    $coordsString = implode(",", $coords);
    $this->attrs()->set("coords", $coordsString);
    return $this;
  }
}
