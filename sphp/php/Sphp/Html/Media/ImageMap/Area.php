<?php

/**
 * Area.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Media\ImageMap;

use Sphp\Html\EmptyTag as EmptyTag;

/**
 * Class Models an HTML &lt;area&gt; tag
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
   * @param array $coords the coordinates of the area
   * @param type $href 
   * @param string $alt
   * @link  http://www.w3schools.com/tags/att_area_shape.asp shape attribute
   */
  public function __construct($shape, array $coords = [], $href = "#", $alt = "") {
    parent::__construct("area");
    $this->attrs()->lock("shape", $shape);
    $this->setShape($shape)->setCoordinates($coords)->setHref($alt);
  }

  /**
   * Sets the coordinates of the area
   * 
   * @param  int[]|int... $coords the coordinates of the area
   * @return self for PHP Method Chaining
   */
  public function setCoordinates($coords) {
    $this->attrs()->set("coords", implode(",", $coords));
    return $this;
  }

}
