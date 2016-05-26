<?php

/**
 * AreaTrait.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Media\ImageMap;

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
trait AreaTrait {

  use HyperlinkTrait;

  /**
   * Constructs a new instance
   * 
   * @param type $shape
   * @param array $coords
   * @param type $href
   * @param type $alt
   */
  public function __construct($shape, array $coords = [], $href = "#", $alt = "") {
    parent::__construct(self::TAG_NAME);
  }

  /**
   * Returns the shape of the area
   * 
   * @return string the shape of the area
   */
  public function getShape() {
    return $this->getAttr("shape");
  }

  /**
   * Returns the shape of the area
   * 
   * @return string the shape of the area
   */
  public function getCoordinates() {
    return $this->getAttr("shape");
  }

  public function setRelationship($rel) {
    $this->attrs()->set("rel", $rel);
    return $this;
  }

  /**
   * Returns the shape of the area
   * 
   * @return string the shape of the area
   */
  public function getRelationship() {
    return $this->getAttr("shape");
  }

}
