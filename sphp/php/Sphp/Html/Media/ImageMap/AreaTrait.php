<?php

/**
 * AreaTrait.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Media\ImageMap;

use Sphp\Html\Navigation\HyperlinkTrait;

/**
 * Trait implements {@link AreaInterface} for an an HTML &lt;area&gt; tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-05-26
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
   * Returnsthe coordinates of the area
   * 
   * @return int[] the coordinates of the area
   * @link   http://www.w3schools.com/TAGS/att_area_coords.asp coords attribute
   */
  public function getCoordinates() {
    $coords = [];
    if ($this->attrs()->exists("coords")) {
      $rawCoords = $this->getAttr("coords");
      $toInt = function($coord) {
        return (int) $coord;
      };
      $coords = array_map($toInt, explode(",", $rawCoords));
    }
    return $coords;
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

  /**
   * Specifies the alternate text for the area, if the image cannot be displayed
   *
   * **Definition and Usage:**
   *
   *  The alt attribute specifies an alternate text for an area, if the image 
   * cannot be displayed. The `alt` attribute provides alternative information for 
   * an image if a user for some reason cannot view it (because of slow 
   * connection, an error in the src attribute, or if the user uses a screen 
   * reader). 
   * 
   * The `alt` attribute is required if the `href` attribute is present.
   *
   * @param  string $alt the alternate text for an image
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_area_alt.asp alt attribute
   */
  public function setAlt($alt) {
    $this->attrs()->set("alt", $alt);
    return $this;
  }

  /**
   * Returns the alternate text for the area, if the image cannot be displayed
   * 
   * **Definition and Usage:**
   *
   *  The alt attribute specifies an alternate text for an area, if the image 
   * cannot be displayed. The `alt` attribute provides alternative information for 
   * an image if a user for some reason cannot view it (because of slow 
   * connection, an error in the src attribute, or if the user uses a screen 
   * reader). 
   * 
   * The `alt` attribute is required if the `href` attribute is present.
   *
   * @return string the value of the alt attribute
   * @link  http://www.w3schools.com/tags/att_area_alt.asp alt attribute
   */
  public function getAlt() {
    return $this->attrs()->get("alt");
  }

}
