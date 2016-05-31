<?php

/**
 * AreaTrait.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Media\ImageMap;

use Sphp\Html\Navigation\HyperlinkTrait as HyperlinkTrait;

/**
 * Trait implements {@link AreaInterface} for an an HTML &lt;area&gt; tag
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
   * Returns the shape of the area
   * 
   * @return string the shape of the area
   * @link   http://www.w3schools.com/TAGS/att_area_shape.asp shape attribute
   */
  public function getShape() {
    return $this->getAttr("shape");
  }

  /**
   * Returns the shape of the area
   * 
   * @return string the shape of the area
   * @link   http://www.w3schools.com/TAGS/att_area_coords.asp coords attribute
   */
  public function getCoordinates() {
    return $this->getAttr("coords");
  }

  /**
   * Returns the shape of the area
   * 
   * @return int[] the shape of the area
   * @link   http://www.w3schools.com/TAGS/att_area_coords.asp coords attribute
   */
  public function getCoordinatesArray() {
    $toInt = function($coord) {
      return (int) $coord;
    };
    return array_map($toInt, explode(",", $this->getCoordinates()));
  }

  /**
   * Sets the relationship between the current document and the linked document
   * 
   * @param  string $rel the value of the rel attribute
   * @return AreaInterface for PHP Method Chaining
   * @link   http://www.w3schools.com/TAGS/att_area_rel.asp rel attribute
   */
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
