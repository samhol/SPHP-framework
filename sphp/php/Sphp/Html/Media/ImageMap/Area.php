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
   * @param string $shape
   * @param array $coords
   * @param type $href
   * @param string $alt
   */
  public function __construct($shape, array $coords = [], $href = "#", $alt = "") {
    parent::__construct("area");
  }

  /**
   * 
   * @param type $shape
   * @return self for PHP Method Chaining
   */
  public function setShape($shape) {
    $this->attrs()->set("shape", $shape);
    return $this;
  }

  /**
   * 
   * @param type $coords
   * @return self for PHP Method Chaining
   */
  public function setCoordinates($coords) {
    $this->attrs()->set("coords", $coords);
    return $this;
  }

}
