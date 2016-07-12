<?php

/**
 * Polygon.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Media\ImageMap;

use Sphp\Html\EmptyTag as EmptyTag;

/**
 * Class Models an HTML &lt;area shape="poly"&gt; tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-05-31
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Polygon extends EmptyTag implements AreaInterface {

  use AreaTrait;

  /**
   * 
   * @param int[] $coords
   * @param int $radius
   * @param string $href
   * @param string $alt
   */
  public function __construct($coords, $href = null, $alt = null) {
    parent::__construct(self::TAG_NAME);
    $this->attrs()->lock("shape", "poly");
    $this->setCoordinates($coords);
    if ($href !== null) {
      $this->setHref($href);
    }
    if ($alt !== null) {
      $this->setHref($href);
    }
  }

  /**
   * 
   * @param  int $x
   * @param  int $y
   * @return self for PHP Method Chaining
   */
  public function appendEdge($x, $y) {
    $coords = split(",", $this->getCoordinates());
    $coords[0] = $x;
    $coords[1] = $y;
    $coordsString = implode(",", $coords);
    $this->attrs()->set("coords", $coordsString);
    return $this;
  }

}
