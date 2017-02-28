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
class Area extends EmptyTag implements AreaInterface {

  use AreaTrait;

  /**
   * Constructs a new instance
   * 
   * @precondition `$shape` == `default|circle|rect|poly`
   * @param string $shape the shape of the area
   * @link  http://www.w3schools.com/tags/att_area_shape.asp shape attribute
   */
  public function __construct($shape) {
    parent::__construct('area');
    $this->attrs()->lock('shape', $shape);
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
