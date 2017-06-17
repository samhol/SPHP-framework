<?php

/**
 * Area.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Media\ImageMap;

use Sphp\Html\EmptyTag;

/**
 * Implements an HTML &lt;area&gt; tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-05-26
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Area extends AbstractArea {

  /**
   * Constructs a new instance
   * 
   * @param string $shape
   * @param string|null $href the URL of the link
   * @param string|null $alt
   */
  public function __construct(string $shape, string $href = null, string $alt = null) {
    parent::__construct($shape, $href, $alt);
  }
  /**
   * Sets the coordinates of the area
   * 
   * @param  int[]|int... $coords the coordinates of the area
   * @return self for a fluent interface
   * @link  http://www.w3schools.com/tags/att_area_coords.asp coords attribute
   */
  public function setCoordinates($coords) {
    $this->attrs()->set('coords', implode(',', $coords));
    return $this;
  }

}
