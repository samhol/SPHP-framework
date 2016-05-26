<?php

/**
 * Area.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Media\ImageMap;

use Sphp\Html\EmptyTag as EmptyTag;
use Sphp\Html\Navigation\HyperlinkTrait as HyperlinkTrait;

/**
 * Class Area
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-05-26
 * @version 1.0.0
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Area extends EmptyTag implements AreaInterface {

  use AreaTrait;

  /**
   * the tag name of the HTML component
   */
  const TAG_NAME = "area";

  /**
   * Constructs a new instance
   * 
   * @param string $shape
   * @param array $coords
   * @param type $href
   * @param string $alt
   */
  public function __construct($shape, array $coords = [], $href = "#", $alt = "") {
    parent::__construct(self::TAG_NAME);
  }

  public function setShape($shape) {
    $this->attrs()->set("shape", $shape);
    return $this;
  }

  public function setCoordinates($coords) {
    $this->attrs()->set("coords", $coords);
    return $this;
  }

}
