<?php

/**
 * Polygon.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Media\ImageMap;

use Sphp\Html\EmptyTag;

/**
 * Implements an HTML &lt;area shape="poly"&gt; tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-05-31
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Polygon extends EmptyTag implements AreaInterface {

  use AreaTrait;

  /**
   * Constructs a new instance
   * 
   * @param int[] $coords coordinates as an array
   * @param string|null $href
   * @param string|null $alt
   */
  public function __construct($coords, $href = null, $alt = null) {
    parent::__construct('area');
    $this->attrs()->lock('shape', 'poly');
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
   * @param  int $x the x-coordinate of the edge
   * @param  int $y the y-coordinate of the edge
   * @return self for a fluent interface
   */
  public function appendEdge($x, $y) {
    $coords = split(',', $this->getCoordinates());
    $coords[0] = $x;
    $coords[1] = $y;
    $coordsString = implode(',', $coords);
    $this->attrs()->set('coords', $coordsString);
    return $this;
  }

}
